<?php 
include_once '../include/paging.php';
$db 	= direct_model('M_payment_type');
$aksi 	= $_POST['aksi'];



/*
 GET PAYMENT 
*/
	if($aksi == 'getPayment') 
	{
		$payment 	= $db->getPayment();
		$data 		= $payment['data'];
		$row 		= $payment['row'];

		$response['output'] = '';

			if($row > 0) 
			{
				$response['status'] = 'success';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'data exist';

				$response['output'] .= '<div class="row col-12 table-vertical-scroll h-400 m-0 p-0">
											<table class="table table-hover table-payment-type">
											<thead>
											<tr>
													<td class="pl-3" width="10%">
														<div class="i-checks pl-3">
														<input type="checkbox" class="checkbox-payment-all checkbox-template">
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
 ACTION FORM 
*/
 	else if($aksi == 'addPayment')
 	{
 		$name  	= $_POST['name'];
 		$result = $db->addPayment($name);
 		
 		if($result > 0) 
 		{
 			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'add data success';
 		}
 		else 
 		{
 			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'add data failed';	
 		}
 		echo json_encode($response);
 	}



 	else if($aksi == 'editPayment')
 	{
 		$id 	= $_POST['id_payment'];
 		$name  	= $_POST['name'];
 		$result = $db->updatePayment($id,$name);

 		if($result > 0) 
 		{
 			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'update data success';
 		}
 		else 
 		{
 			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'update data failed';	
 		}
 		echo json_encode($response);
 	}



 	else if($aksi == 'deletePayment')
 	{
 		$id 	= $_POST['id_payment'];
 		$result = $db->deletePayment($id);


 		if($result > 0) 
 		{
 			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'delete data success';
 		}
 		else 
 		{
 			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'delete data failed';	
 		}
 		echo json_encode($response);
 	}



 	else if($aksi == 'deletePayment-all')
 	{
 		$id 	= $_POST['id_payment'];
 		$result = [];

 		foreach ($id as $key => $id) {
 			$query 		= $db->deletePayment($id);
 			$result[] 	= $query;  
 		}

 		$result = array_sum($result);

 		if($result > 0) 
 		{
 			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'delete '.$result.' data success';
 		}
 		else 
 		{
 			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'delete data failed';	
 		}
 		echo json_encode($response);
 	}

?>


	