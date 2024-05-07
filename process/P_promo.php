<?php 
include_once '../include/paging.php';	
$db 	= direct_model('M_promo');
$aksi 	= $_POST['aksi'];






/*
 * ACTION FORM
*/
	if($aksi == 'addPromo') 
	{
		$start 	= $_POST['start'];
		$end 	= $_POST['end'];

		$result = $db->addPromo($start,$end);

		if($result > 0 )
		{
			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'add data success';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'failed to adding data';
		}
		echo json_encode($response);
	}



	else if($aksi == 'editPromo')
	{
		$id 	= $_POST['promo_id'];
		$start 	= $_POST['start'];
		$end 	= $_POST['end'];
		$result = $db->editPromo($id,$start,$end);

		if($result > 0 )
		{
			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'edit data success';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'failed to edit data';
		}
		echo json_encode($response);
	}



	else if($aksi == 'deletePromo')
	{
		$id 	= $_POST['id'];
		$result = $db->deletePromo($id);
		if($result > 0 )
		{
			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'delete data success';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'failed to deleting data';
		}
		echo json_encode($response);
	}



	else if($aksi =='deleteAll')
	{
		$id 	= $_POST['id'];
		$result = count($id);
		if($result > 0 )
		{
			foreach ($id as $key => $id) {
				$db->deletePromo($id);
			}

			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'delete data success';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'failed to deleting data';
		}
		echo json_encode($response);
	}


?>