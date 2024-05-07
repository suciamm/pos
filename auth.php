<?php 
	include_once 'include/paging.php';	
	$db = model('Auth');
	


	$op = $_GET['op'];

	if($op == 'in')
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);


		$result = $db->loginCheck($username,$password);

		if($result == 1) {
			$response['status'] = 'success';
			$response['action'] = 'login';
			$response['msg'] 	= 'login succes';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['action'] = 'login';
			$response['msg'] 	= 'invalid username or password';
		}
		echo json_encode($response);
	}


	else if($op == 'out')
	{
		$db->logout();
		header("location:index.php");
	}





?>