<?php 
include_once '../include/paging.php';	
$db = direct_model('M_menu');

$aksi = $_POST['aksi'];

if($aksi == 'add') 
{
	$menu 		= $_POST['menu'];
	$file_name 	= $_FILES['icon']['name'];
	$file_tmp 	= $_FILES['icon']['tmp_name'];
	$ext 		= pathinfo($file_name, PATHINFO_EXTENSION);
	$icon 		= strtolower($menu.'.'.$ext);

	$result = $db->insert_menu($menu,$icon);
	upload($file_tmp,$icon);

	if($result == 1) {
		$response['status'] = 'success';
		$response['action'] = $aksi;
		$response['msg'] 	= "success adding data";
	}
	else {
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= "failed adding data";
	}

	echo json_encode($response);
}


else if($aksi == 'edit') 
{
	$id 		= $_POST['id_menu'];
	$menu 		= $_POST['menu'];
	$icon_old	= $_POST['icon_old'];
	

	if($_FILES['icon']['name']) {
		$file_name 	= $_FILES['icon']['name'];
		$file_tmp 	= $_FILES['icon']['tmp_name'];
		$ext 		= pathinfo($file_name, PATHINFO_EXTENSION);
		$icon 		= strtolower($menu.'.'.$ext);
		
		update_file($icon_old,$file_tmp,$icon); 
		$result = $db->update_menu($id,$menu,$icon); 
	}
	else 
	{
		$result = $db->update_menu($id,$menu,$icon_old);
	}

	if($result == 1) {
		$response['status'] = 'success';
		$response['action'] = $aksi;
		$response['msg'] 	= "success update data";
	}
	else {
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= "failed upade data";
	}

	echo json_encode($response);
}


else if($aksi == 'delete')
{
	$id = $_POST['id'];

	remove_file($id);
	$result = $db->delete_menu($id);


	if($result == 1) {
		$response['status'] = 'success';
		$response['action'] = $aksi;
		$response['msg'] 	= "success deleting data";
	}
	else {
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= "failed deleting data";
	}
	echo json_encode($response);
}


else if($aksi == 'delete_all')
{
	$id 	= $_POST['id'];
	$count 	= count($id);

	
	foreach ($id as $key => $val) 
	{
		$result = $db->delete_menu($id[$key]);
		remove_file($id[$key]);
	}
	
	$response['status'] = 'success';
	$response['action'] = $aksi;
	$response['msg'] 	= 'success deleting '.$count.' data';

	echo json_encode($response);

}












//CHECK
else if($aksi == 'check_menu')
{
	$menu = $_POST['menu'];
	$row = $db->check_menu($menu);

	if($row == 1){
		$response['status'] = 1;
		$response['action'] = 'check menu';
		$response['msg'] 	= 'menu was used';
	}
	else {
		$response['status'] = 0;
		$response['action'] = 'check menu';
		$response['msg'] 	= 'menu ready to used';
	}
	echo json_encode($response);

}

else if($aksi == 'check_menu_edit')
{
	$menu 		= $_POST['menu'];
	$menu_old 	= $_POST['menu_old'];
	$row 		= $db->check_menu_edit($menu,$menu_old);

	if($row == 1){
		$response['status'] = 1;
		$response['action'] = $aksi;
		$response['msg'] 	= 'menu was used';
	}
	else {
		$response['status'] = 0;
		$response['action'] = $aksi;
		$response['msg'] 	= 'menu ready to used';
	}
	echo json_encode($response);

}

?>