<?php 
include_once '../include/paging.php';	
$db 	= direct_model('M_table');
$aksi 	= $_POST['aksi'];



/*
 * GET TABLE
*/
	if($aksi == 'getTable')
	{
		$table 	= $db->getTable();
		$data 	= $table['data'];
		$row 	= $table['row'];

		$response['output'] = '';

			if($row > 0) 
			{
				$response['status'] = 'success';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'data exist';

				$response['output'] .= '<div class="row col-12 table-vertical-scroll h-400 m-0 p-0">
											<table class="table table-hover table-column">
											<thead>
											<tr>
													<td class="pl-3" width="10%">
														<div class="i-checks pl-3">
														<input type="checkbox" class="checkbox-table-all checkbox-template">
														</div>
													</td>
													<td width="25%"><b>Table Code</b></td>
													<td><b>Table Number</b></td>
											</tr>
											</thead>
											<tbody>';
				foreach ($data as $view) {
				$response['output'] .= '	<tr>
													<td class="pl-3" width="10%">
														<div class="i-checks pl-3">
														<input type="checkbox" class="checkbox-table checkbox-template pb-3" value="'.$view['table_id'].'&'.$view['table_number'].'">
														</div>
													</td>
													<td>'.$view['table_code'].'</td>
													<td>Table '.$view['table_number'].'</td>
											</tr>';
				}
				$response['output'] .= '	</tbody>
											</table>
										</div>';
			}
			else 
			{
				$response['status'] = 'failed';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'data empty';	
				$response['output'] .= '<div class="row col-12 table-vertical-scroll h-400 m-0 p-0">
											<table class="table table-hover table-payment-type">
											<thead>
											<tr>
													<td class="pl-3" width="10%">
														<div class="i-checks pl-3">
														<input type="checkbox" class="checkbox-payment-all checkbox-template" disabled>
														</div>
													</td>
													<td><b>Name</b></td>
											</tr>
											</thead>
											<tbody>';
				foreach ($data as $view) {
				$response['output'] .= '	<tr>
													<td class="pl-3" width="10%">
														<div class="i-checks pl-3">
														<input type="checkbox" class="checkbox-payment checkbox-template pb-3" value="'.$view['id_payment'].'&'.$view['name'].'">
														</div>
													</td>
													<td>'.$view['name'].'</td>
											</tr>';
				}
				$response['output'] .= '	</tbody>
											</table>
										</div>';
			}	

			echo json_encode($response);
	}











/*
 * FORM ACTION
*/

	else if($aksi == 'addTable') 
	{
		$table_number 	= $_POST['table_number'];
		$table_code 	= 'TAB-'.$table_number;
		$result 		= $db->setTable($table_code,$table_number);


		if($result > 0) 
		{
			$response['status'] = 'success';
			$response['action'] = $aksi;
			$response['msg'] 	= 'success adding data';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['action'] = $aksi;
			$response['msg'] 	= 'Failed, data is exist';
		}
		echo json_encode($response);
	}



	else if($aksi == 'editTable') 
	{
		$id					= $_POST['table_id'];
		$table_number 		= $_POST['table_number'];
		$table_code 		= 'TAB-'.$table_number;


		$check  = $db->checkTable_code($id,$table_code);
		$row  	= $check['row'];

		if($row > 0 ) 
		{
			$response['status'] = 'failed';
			$response['action'] = $aksi;
			$response['msg'] 	= 'Update failed, data is exist';
		}
		else 
		{
			$result = $db->updateTable($id,$table_code,$table_number);
			if($result > 0) 
			{
				$response['status'] = 'success';
				$response['action'] = $aksi;
				$response['msg'] 	= 'success updating data ';
			}
			else 
			{
				$response['status'] = 'failed';
				$response['action'] = $aksi;
				$response['msg'] 	= 'Updating data failed, data is same';
			}
		}
		echo json_encode($response);
	}



	else if($aksi == 'deleteTable')
	{
		$id 	= $_POST['table_id'];
		$result = $db->deleteTable($id);

		if($result == 1) 
		{
			$response['status'] = 'success';
			$response['action'] = $aksi;
			$response['msg'] 	= 'success deleting data';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['action'] = $aksi;
			$response['msg'] 	= 'Delete failed, data is  used in another table';
		}

		echo json_encode($response);
	}



	else if($aksi == 'deleteTable-all')
	{
		$id 			= $_POST['table_id'];
		$count_id 		= count($id);
		$delete_success = [];
		
		for ($i = 0; $i < $count_id; $i++) {
			$result = $db->deleteTable($id[$i]);
			array_push($delete_success, $result);
		}

			$success =  array_sum($delete_success);
			$failed  = $count_id - $success;

			if($success > 0)
			{
				$response['status'] = 'success';
				$response['action'] = $aksi;
				$response['msg'] 	= 'success delete '.$success.' data,'.'<br>failed'.$failed.' data, cause data is used';
			}
			else 
			{
				$response['status'] = 'failed';
				$response['action'] = $aksi;
				$response['msg'] 	= 'Delete failed, data is used in another table';	
			}
			echo json_encode($response);
	}















































else if($aksi == 'add')
{
	$table_number 	= $_POST['data'];
	$table_code 	= 'TAB-'.$table_number;
	$result 		= $db->setTable($table_code,$table_number);


	if($result > 0) 
	{
		$response['status'] = 'success';
		$response['action'] = $aksi;
		$response['msg'] 	= 'success adding data';
	}
	else 
	{
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= 'Failed, data is exist';
	}
	echo json_encode($response);
}



else if($aksi == 'edit')
{
	$id					= $_POST['id'];
	$table_number 		= $_POST['data'];
	$table_code 		= 'TAB-'.$table_number;


	$check  = $db->checkTable_code($id,$table_code);
	$row  	= $check['row'];

	if($row > 0 ) 
	{
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= 'Update failed, data is exist';
	}
	else 
	{
		$result = $db->updateTable($id,$table_code,$table_number);
		if($result > 0) 
		{
			$response['status'] = 'success';
			$response['action'] = $aksi;
			$response['msg'] 	= 'success updating data ';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['action'] = $aksi;
			$response['msg'] 	= 'Updating data failed, data is same';
		}
	}
	echo json_encode($response);
}




else if($aksi == 'delete')
{
	 	$id 	= $_POST['id'];
		$result = $db->deleteTable($id);

		if($result == 1) 
		{
			$response['status'] = 'success';
			$response['action'] = $aksi;
			$response['msg'] 	= 'success deleting data';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['action'] = $aksi;
			$response['msg'] 	= 'Delete failed, data is  used in another table';
		}

		echo json_encode($response);
}



else if($aksi == 'delete_all')
{
		$id 			= $_POST['id'];
		$count_id 		= count($id);
		$delete_success = [];
		
		for ($i = 0; $i < $count_id; $i++) {
			$result = $db->deleteTable($id[$i]);
			array_push($delete_success, $result);
		}

		$success =  array_sum($delete_success);
		$failed  = $count_id - $success;

		if($success > 0)
		{
			$response['status'] = 'success';
			$response['action'] = $aksi;
			$response['msg'] 	= 'success delete '.$success.' data,'.' failed delete '.$failed.' data, cause data is used';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['action'] = $aksi;
			$response['msg'] 	= 'Delete failed, data is used in another table';	
		}
		echo json_encode($response);
}

?>