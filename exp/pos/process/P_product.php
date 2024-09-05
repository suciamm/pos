<?php 
include_once '../include/paging.php';	
$db 	= direct_model('M_product');
$aksi 	= $_POST['aksi'];

if($aksi == 'add')
{

	$product_code = $_POST['product_code'];
	$product 	= $_POST['product'];
	$id_submenu = $_POST['id_submenu'];
	$price 		= $_POST['price'];
	$qty 		= $_POST['qty'];
	$status 	= $_POST['status'];
	$file_name 	= $_FILES['image']['name'];
	$file_tmp 	= $_FILES['image']['tmp_name'];
	$ext 		= pathinfo($file_name, PATHINFO_EXTENSION);
	$image 		= strtolower('product_'.$product_code.'.'.$ext);


	$result = $db->insert_product($product_code,$product,$qty,$price,$status,$image,$id_submenu);
	upload($file_tmp,$image);

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

	$product_code = $_POST['product_code'];
	$product 	= $_POST['product'];
	$submenu 	= $_POST['submenu'];
	$price 		= $_POST['price'];
	$qty 		= $_POST['qty'];
	$status 	= $_POST['status'];
	$image_old 	= $_POST['image_old'];
	$menu 		= $_POST['menu'];
	$id 		= $_POST['id'];
	
	if(isset($_POST['id_submenu'])) {
		$id_submenu = $_POST['id_submenu'];
	}
	else {
		$get_id_submenu = $db->get_id_submenu_byMenu($submenu,$menu);
		$id_submenu		= $get_id_submenu['data']['id_submenu'];	
	}


	if($_FILES['image']['name']){
		$file_name 	= $_FILES['image']['name'];
		$file_tmp 	= $_FILES['image']['tmp_name'];
		$ext 		= pathinfo($file_name, PATHINFO_EXTENSION);
		$image 		= strtolower('product_'.$product_code.'.'.$ext);

		update_file($image_old,$file_tmp,$image); 
		$result = $db->update_product($product_code,$product,$qty,$price,$status,$image,$id_submenu,$id);
	}
	else {
		$result = $db->update_product($product_code,$product,$qty,$price,$status,$image_old,$id_submenu,$id);
	}


	if($result == 1) {
		$response['status'] = 'success';
		$response['action'] = $aksi;
		$response['msg'] 	= "success updating data";
	}
	else {
		$response['status'] = 'failed';
		$response['action'] = $aksi;
		$response['msg'] 	= "failed updating data";
	}

	echo json_encode($response);
}


else if($aksi == 'delete')
{
	$id 	= $_POST['id'];

	remove_file($id);
	$result 	= $db->delete_product($id);

	if($result == 1) {
		$response['status'] = 'success';
		$response['aksi'] 	= $aksi;
		$response['msg']	= 'success deleting data';
	}
	else {
		$response['status'] = 'failed';
		$response['aksi'] 	= $aksi;
		$response['msg']	= 'failed deleting data';
	}
	echo json_encode($response);
}


else if($aksi == 'delete_all')
{
	$id 	= $_POST['id'];
	$count 	= count($id);

	
	foreach ($id as $key => $val) 
	{
		$result = $db->delete_product($id[$key]);
		remove_file($id[$key]);
	}
	
	$response['status'] = 'success';
	$response['action'] = $aksi;
	$response['msg'] 	= 'success deleting '.$count.' data';

	echo json_encode($response);
}











//CHECK//
else if($aksi == 'check_product_code') 
{
	$data	= $_POST['data'];
	$field	= 'product_code';

	$result 		= $db->checkonefieldProduct($field,$data);
	$data 			= $result['data'];
	$row 			= $result['row'];

	if($row > 0) {
		$response['status'] = 1;
		$response['aksi'] 	= $aksi;
		$response['msg'] 	= 'Product code was used';
	}
	else {
		$response['status'] = 0;
		$response['aksi'] 	= $aksi;
		$response['msg'] 	= 'Product code ready to used';
	}

	echo json_encode($response);

}

else if($aksi == 'check_product_code_byCategory') 
{
	$category 	= $_POST['submenu'];
	$data		= $_POST['data'];
	$field		= 'product_code';

	$result 		= $db->checkonefieldProduct_byCategory($field,$data,$category);
	$data 			= $result['data'];
	$row 			= $result['row'];

	if($row > 0) {
		$response['status'] = 1;
		$response['aksi'] 	= $aksi;
		$response['msg'] 	= 'Product code was used';
	}
	else {
		$response['status'] = 0;
		$response['aksi'] 	= $aksi;
		$response['msg'] 	= 'Product code ready to used';
	}

	echo json_encode($response);

}




else if($aksi == 'check_product')
{
	$data 	= $_POST['data'];
	$field 	= 'product';

	$result 		= $db->checkonefieldProduct($field,$data);
	$data 			= $result['data'];
	$row 			= $result['row'];

	if($row > 0) {
		$response['status'] = 1;
		$response['aksi'] 	= $aksi;
		$response['msg'] 	= 'Product was used';
	}
	else {
		$response['status'] = 0;
		$response['aksi'] 	= $aksi;
		$response['msg'] 	= 'Product ready to used';
	}

	echo json_encode($response);
}

else if($aksi == 'check_product_byCategory') 
{
	$category 	= $_POST['submenu'];
	$data		= $_POST['data'];
	$field		= 'product';

	$result 		= $db->checkonefieldProduct_byCategory($field,$data,$category);
	$data 			= $result['data'];
	$row 			= $result['row'];

	
	if($row > 0) {
		$response['status'] = 1;
		$response['aksi'] 	= $aksi;
		$response['msg'] 	= 'Product was used';
	}
	else {
		$response['status'] = 0;
		$response['aksi'] 	= $aksi;
		$response['msg'] 	= 'Product ready to used';
	}

	echo json_encode($response);

}




else if($aksi == 'get_submenu')
{
	$submenu = $_POST['data'];
	$menu 	 = $_POST['menu'];

	$submenuModel 	= direct_model('M_submenu');
	$query 		 	= $submenuModel->submenuserchByMenu($menu,$submenu);
	$row			= $query['row'];
	$data 			= $query['data'];

	$output['submenu'] = '';
	$output['submenu'] .= '<ul class="list-unstyled">';

	if($row > 0) {
		foreach ($data as $value) {
			$output['submenu'] .= '<li class="list-input">'.$value['submenu'].'
			<input type="hidden" name ="id_submenu" id="id_submenu" value="'.$value['id_submenu'].'"></li>';
		}
	}
	else {
		$output['submenu'] .= '<li class="list-input"><b>Category not found</b>
		<input type="hidden" name ="id_submenu" id="id_submenu" value="0"></li>';
	}
	$output['submenu'] .= '</ul>';
	echo json_encode($output);
}



else if($aksi == 'getCategory') 
{
	$menu 		= $_POST['menu'];
	$result 	= $db->getSubmenu_byMenu($menu);
	$response['output'] = '';

		if($result['row'] > 0) 
		{
			$response['status'] 	= 'success';
			$response['aksi'] 		= $aksi;
			foreach ($result['data'] as $view) {
				$response['output'] .= '<div class="col-12 b-top pl-3 list-table-ready">
										<div class="row">
											<div class="col-10 p-0 pt-2 pb-3">
												<span class="row col-12 text-bold">'.$view['submenu'].'</span>
												<span class="row col-12">Category '.$view['submenu'].' ready to use</span>
											</div>
											<div class="col-2 p-0 pt-2 pb-3">
												<span class="col-12 text-right text-success checked-modal d-none">
												<i class="fa fa-check"></i></span>

												<input type="hidden" class="row id_submenu_modal" value="'.$view['id_submenu'].'">
												<input type="hidden" class="row submenu_modal" value="'.$view['submenu'].'">
											</div>
										</div>
										</div>';
			}
		}
		else {
			$response['status'] 	= 'failed';
			$response['aksi'] 		= $aksi;
			$response['output'] 	.= 'tidak ada data';
		}		
		echo json_encode($response);
}


?>