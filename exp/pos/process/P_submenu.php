<?php 
include_once '../include/paging.php';	
$db = direct_model('M_submenu');
$aksi = $_POST['aksi'];

if($aksi == 'add'){

	$id_menu	= $_POST['menu'];
	$submenu 	= $_POST['submenu'];
	$result 	= $db->insert_submenu($submenu,$id_menu);

	if($result == 1) {
		$response['status'] = 'success';
		$response['action'] = $aksi;
		$response['msg'] 	= "success adding data submenu";
	}
	else {
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= "failed adding data submenu";
	}
	echo json_encode($response);
}


if($aksi == 'edit'){

	$id			= $_POST['id_submenu']; 
	$id_menu	= $_POST['menu'];
	$submenu 	= $_POST['submenu'];
	$result 	= $db->update_submenu($id,$submenu,$id_menu);

	if($result == 1) {
		$response['status'] = 'success';
		$response['action'] = $aksi;
		$response['msg'] 	= "success update data submenu";
	}
	else {
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= "failed update data submenu";
	}
	echo json_encode($response);
}


else if($aksi == 'delete')
{
	$id = $_POST['id'];

	$result = $db->delete_submenu($id);


	if($result == 1) {
		$response['status'] = 'success';
		$response['action'] = $aksi;
		$response['msg'] 	= "success deleting data submenu";
	}
	else {
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= "failed deleting data submenu";
	}
	echo json_encode($response);
}


else if($aksi == 'delete_all')
{
	$id 	= $_POST['id'];
	$count 	= count($_POST);

	foreach ($id as $key => $val) {
		$result = $db->delete_submenu($id[$key]);
	}
	
	$response['status'] = 'success';
	$response['action'] = $aksi;
	$response['msg'] 	= 'success deleting '.$count.' data submenu';
		
	echo json_encode($response);
}








//CHECK
else if($aksi == 'check_submenu')
{
	$id_menu 	= $_POST['menu']; 
	$submenu 	= $_POST['submenu'];
	$row  		= $db->check_submenu($id_menu,$submenu) ;

	if($row == 1){
		$response['status'] = 1;
		$response['action'] = $aksi;
		$response['msg'] 	= 'submenu was used';
	}
	else {
		$response['status'] = 0;
		$response['action'] = $aksi;
		$response['msg'] 	= 'submenu ready to used';
	}
	echo json_encode($response);
}


else if($aksi == 'check_submenu_edit')
{
	$menu 			= $_POST['menu'];
	$submenu 		= $_POST['submenu'];
	$submenuold 	= $_POST['submenuold'];
	
	$row 		= $db->check_submenu_edit($submenu,$menu,$submenuold);

	if($row == 1){
		$response['status'] = 1;
		$response['action'] = $aksi;
		$response['msg'] 	= 'submenu was used';
	}
	else {
		$response['status'] = 0;
		$response['action'] = $aksi;
		$response['msg'] 	= 'submenu ready to used';
	}
	echo json_encode($response);

}

?>