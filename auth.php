<?php 
	include_once 'include/paging.php';	
	$db = model('Auth');
	
	$op = $_GET['op'];

	//HASH
	// if($op == 'in') {
	// 	$username = $_POST['username'];
	// 	$password = MD5($_POST['password']);
	
	// 	$result = $db->loginCheck($username, $password);
	
	// 	if($result == 1) {
	// 		$response['status'] = 'success';
	// 		$response['action'] = 'login';
	// 		$response['msg'] = 'login success';
	// 	} else {
	// 		$response['status'] = 'failed';
	// 		$response['action'] = 'login';
	// 		$response['msg'] = 'invalid username or password';
	// 	}
	
	// 	// Convert response to JSON
	// 	$jsonResponse = json_encode($response);
	// 	error_log("JSON Response: " . $jsonResponse);
	
	// 	echo $jsonResponse;
	// }

	//TANPA HASH
	if($op == 'in') {
		$username = $_POST['username'];
		$password = $_POST['password']; // Tanpa MD5
	
		$result = $db->loginCheck($username, $password);
	
		if($result == 1) {
			$response['status'] = 'success';
			$response['action'] = 'login';
			$response['msg'] = 'login success';
		} else {
			$response['status'] = 'failed';
			$response['action'] = 'login';
			$response['msg'] = 'invalid username or password';
		}
	
		// Convert response to JSON
		$jsonResponse = json_encode($response);
		error_log("JSON Response: " . $jsonResponse);
	
		echo $jsonResponse;
	}
	
	//HASHING
	// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// 	$auth = new Auth();
	
	// 	if ($_GET['op'] == 'create') {
	// 		$username = $_POST['username'];
	// 		$password = $_POST['password'];
	// 		$status = $_POST['status'];
	// 		$level = $_POST['level'];
	
	// 		// Log data yang diterima
	// 		error_log("Received data for account creation: Username: $username, Password: $password, Status: $status, Level: $level");
	// 		echo json_encode($auth->createAccount($username, $password, $status, $level));
	// 	}
	// }

	//TANPA HASHING
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$auth = new Auth();
		
			if ($_GET['op'] == 'create') {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$status = $_POST['status'];
				$level = $_POST['level'];
		
				// Log data yang diterima
				error_log("Received data for account creation: Username: $username, Password: $password, Status: $status, Level: $level");
				echo json_encode($auth->createAccount($username, $password, $status, $level));
			}
		}
		
		else if($op == 'out')
		{
			$db->logout();
			header("location:index.php");
		}

	?>