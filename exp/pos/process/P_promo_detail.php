<?php 
include_once '../include/paging.php';	
$db 	= direct_model('M_promo_detail');
$aksi 	= $_POST['aksi'];



/*
 * GET DATA
 */
	if($aksi == 'listProduct')
	{
		$product = direct_model('M_product');	
 		$product = $product->getProduct();
 		$data 	 = $product['data'];
 		$row 	 = $product['row'];
 		$response['output']  = '';

 			if($row > 0) 
 			{
 				$response['status'] = 'success';
 				$response['aksi'] 	= $aksi;
 				$response['msg']  	= 'data is exist';

 				foreach ($data as $view) {
 				$response['output'] .= '<div class="col-12 b-top pl-3 list-table-ready">
										<div class="row">
											<div class="col-5 p-0 pt-2 pb-3">
											<span class="row col-12">'.strtoupper($view['product']).'</span>
											</div>
											<div class="col-2 p-0 pt-2 pb-3">
											<span class="col-12 text-right">'.rupiah($view['price']).'</span>
											</div>
											<div class="col-5 p-0 pt-2 pb-3">
												<span class="col-12 text-right text-success checked-modal d-none"><i class="fa fa-check"></i></span>
												<input type="hidden" class="hidden-table-id" value="'.$view['id'].'">
												<input type="hidden" class="hidden-table-name" value="'.$view['product'].'">
											</div>
										</div>
										</div>';	
 				} 				
 			}

 			else 
 			{
 				$response['status'] = 'success';
 				$response['aksi'] 	= $aksi;
 				$response['msg']  	= 'data is exist';
 				$response['output'] .= '<h5 class="pt-3">Product List Empty</h5>';
 			}
 			echo json_encode($response);				
	}


	//payment
 	else if($aksi == 'listPayment') 
 	{
 		
 		$payment = direct_model('M_payment_type');	
 		$payment = $payment->getPayment();
 		$data 	 = $payment['data'];
 		$row 	 = $payment['row'];
 		$response['output']  = '';

 			if($row > 0) 
 			{
 				$response['status'] = 'success';
 				$response['aksi'] 	= $aksi;
 				$response['msg']  	= 'data is exist';

 				foreach ($data as $view) {
 				$response['output'] .= '<div class="col-12 b-top pl-3 list-table-ready">
										<div class="row">
											<div class="col-6 p-0 pt-2 pb-3">
											<span class="row col-12">'.strtoupper($view['name']).'</span>
											</div>
											<div class="col-6 p-0 pt-2 pb-3">
												<span class="col-12 text-right text-success checked-modal d-none"><i class="fa fa-check"></i></span>
												<input type="hidden" class="hidden-table-id" value="'.$view['id_payment'].'">
												<input type="hidden" class="hidden-table-name" value="'.$view['name'].'">
											</div>
										</div>
										</div>';	
 				} 				
 			}

 			else 
 			{
 				$response['status'] = 'success';
 				$response['aksi'] 	= $aksi;
 				$response['msg']  	= 'data is exist';
 				$response['output'] .= '<h5 class="pt-3">Payment List Empty</h5>';
 			}
 			echo json_encode($response);				
 	}





/*
 * FORM ACTION
 */
	else if($aksi == 'addPromoDetail')
	{
		$promo_id 		= $_POST['promo_id'];
		$promo_type 	= $_POST['promo_type'];
		$promo_payment	= $_POST['promo_payment'];
		$discount 		= $_POST['discount'];
		$date 			= date('ymd');
		$promo_code 	= rand($date,1);

		if($promo_type == 'all') { $id_product = 'NULL'; }
		else { $id_product = $_POST['id_product']; }

		if($promo_payment == 'all') { $id_payment = 'NULL'; }
		else { $id_payment = $_POST['id_payment']; }


		$result = $db->addPromoDetail($promo_code,$promo_id,$promo_type,$promo_payment,$id_product,$id_payment,$discount);
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


	else if($aksi == 'deletePromoDetail')
	{
		$id 	= $_POST['id'];
		$result = $db->deletePromoDetail($id);
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


	else if($aksi == 'deletePromoDetailAll')
	{
		$id 	= $_POST['id'];
		$result = count($id);
		if($result > 0 )
		{
			foreach ($id as $key => $id) {
				$db->deletePromoDetail($id);
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