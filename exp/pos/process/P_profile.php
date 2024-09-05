<?php 
	include_once '../include/paging.php';
	$db 	= direct_model('M_profile');
	$aksi 	= $_POST['aksi'];


	if($aksi == 'addProfile') 
	{

		$name 		= $_POST['name'];
		$phone 		= $_POST['phone'];
		$email 		= $_POST['email'];
		$address	= $_POST['address'];
		$app_name 	= $_POST['app_name'];

		$result 	= $db->addProfile($name,$phone,$email,$address,$app_name);
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



	else if($aksi == 'updateProfile') 
	{

		$id 		= $_POST['id'];
		$name 		= $_POST['name'];
		$phone 		= $_POST['phone'];
		$email 		= $_POST['email'];
		$address	= $_POST['address'];
		$app_name 	= $_POST['app_name'];

		$result 	= $db->updateProfile($id,$name,$phone,$email,$address,$app_name);
		if($result > 0)
		{
			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'success updating data';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'failed updating data';
		}

		echo json_encode($response);
	}


?>