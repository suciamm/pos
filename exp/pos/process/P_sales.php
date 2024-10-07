
<?php
include_once '../include/paging.php';	
$db 	= direct_model('M_sales');

$aksi 	= $_POST['aksi'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Your existing code


/*
 * LIST PRODUCT
*/
	if($aksi == 'getProduct')
	{	
		$product 	= $_POST['product'];	
		$result 	= $db->getProduct($product);	
		$response['output'] ='';

		if($result['row'] > 0) {

			foreach ($result['data'] as $product) {
				$response['output'] .= '<li class="card menu-product text-center mr-2 mb-2 pt-2 pr-2 pb-1 pl-2">';
				$response['output'] .= '<img src="image/upload/'.$product['image'].'" alt="..." class="img-responsive mb-2 img-product" height="95" width="105">';
				$response['output'] .= '<label class="label-product" style="font-size: 10px;">'.$product['product'].'</label>';
				$response['output'] .= '<input type="hidden" class="input-price" value="Rp '.rupiah($product['price']).'">';
				$response['output'] .= '<input type="hidden" class="input-product_code" value="'.$product['product_code'].'">';
				$response['output'] .= '</li>';
			}
		}
		else 
		{
			$response['output'] .= '<div class="col-lg-6 offset-lg-3">';
			$response['output'] .= '<img src="image/assets/emty-data.png" alt="..." class="img-responsive" width="500">';
			$response['output'] .= '</div>';
		}

		echo json_encode($response); 
	}


	else if($aksi == 'getAllProduct')
	{
		$sort  	= 18;
		$row  	= $db->getAllProduct();
		$total 	= $row['row'];
		$pages 	= ceil($total/$sort);
		
		if(isset($_POST['halaman'])) {
			$page 	= $_POST['halaman'];
			$start 	= ($page * $sort) - $sort;		
		}
		else {	
			$page 	= 1;
			$start 	= 0;
		}


		$result = $db->getPageProduct($start,$sort);
		$response['output'] ='';

		if($result['row'] > 0) {
			$response['pages'] = $pages;
			foreach ($result['data'] as $product) {
				$response['output'] .= '<li class="card menu-product text-center mr-2 mb-2 pt-2 pr-2 pb-1 pl-2">';
				$response['output'] .= '<img src="image/upload/'.$product['image'].'" alt="..." class="img-responsive mb-2 img-product" height="95" width="105">';
				$response['output'] .= '<label class="label-product" style="font-size: 10px;">'.$product['product'].'</label>';
				$response['output'] .= '<input type="hidden" class="input-price" value="Rp '.rupiah($product['price']).'">';
				$response['output'] .= '<input type="hidden" class="input-product_code" value="'.$product['product_code'].'">';
				$response['output'] .= '</li>';
			}
		}
		else 
		{
			$response['pages'] 	 = $pages;
			$response['output'] .= '<div class="col-lg-6 text-center">';
			$response['output'] .= '<img src="image/assets/emty-data.png" alt="..." class="img-responsive mb-2">';
			$response['output'] .= '</div>';
		}

		echo json_encode($response); 
	}


	else if($aksi == 'getProductByMenu')
	{
		$menu  	= $_POST['menu'];
		$result = $db->getProductByMenu($menu);
		$response['output'] ='';

		if($result['row'] > 0) {

			foreach ($result['data'] as $product) {
				$response['output'] .= '<li class="card menu-product text-center mr-2 mb-2 pt-2 pr-2 pb-1 pl-2">';
				$response['output'] .= '<img src="image/upload/'.$product['image'].'" alt="..." class="img-responsive mb-2 img-product" height="95" width="105">';
				$response['output'] .= '<label class="label-product" style="font-size: 10px;">'.$product['product'].'</label>';
				$response['output'] .= '<input type="hidden" class="input-price" value="Rp '.rupiah($product['price']).'">';
				$response['output'] .= '<input type="hidden" class="input-product_code" value="'.$product['product_code'].'">';
				$response['output'] .= '</li>';
			}
		}
		else 
		{
			$response['output'] .= '<div class="col-lg-6 offset-lg-3">';
			$response['output'] .= '<img src="image/assets/emty-data.png" alt="..." class="img-responsive" width="500">';
			$response['output'] .= '</div>';
		}

		echo json_encode($response);
	}




/*
 * LIST ORDER
*/
	else if($aksi == 'listOrder') 
	{
		$result 	= $db->getSales();
		$data 		= $result['fetch'];
		$row 		= $result['row'];

		$response['output'] = '';
		
		if($row > 0) {

			foreach ($data as $view) {
				$response['output'] .= '<div class="col-12 b-top listorder-container">';
					
					$response['output'] .= '<div class="row">';
					$response['output'] .= '<div class="col-9 p-0 pl-1">
												<div class="row statistic pt-0 pt-2">
												<div class="i-checks">
												<input type="checkbox" class="check checkbox-template col-1 listorder-checkbox" value="'.$view['sales_code'].'">
												</div>
												<div class="icon bg-green mt-1 listorder-qty">'.$view['qty'].'</div>
												<span class="text p-0 m-0">
													<span class="text-bold fs-17 listorder-sales_code">'.$view['sales_code'].'</span><br>
													<small class="listorder-total">Rp '.rupiah($view['total']).'</small>
												</span>
												</div>						
											</div>';
					$response['output'] .= '<div class="col-3 p-0 m-0 pt-1 fs-12">
												<span class="col-12 text-right p-0 m-0 pr-1 listorder-detail" data-id="'.$view['sales_code'].'" data-toggle="collapse" data-target="#id-'.$view['sales_code'].'">
													'.date('H:i', strtotime($view['date'])).'
													<i class="fa fa-angle-down pl-2 fs-18"></i>
												</span>
												<span class="col-12 text-right p-0 m-0 pr-1">
												<button class="btn btn-primary pt-1 pr-3 pb-1 pl-3 fs-13 btn-pay" value="'.$view['sales_code'].'">Pay</button>
												</span>
											</div>';
					$response['output'] .= '</div>';


					//detail//
					$response['output'] .= '<div id="id-'.$view['sales_code'].'" class="row pr-1 pl-1 pt-1 pb-3 fs-12 collapse">';
					$response['output'] .= '<span class="col-6 m-0 p-0 text-bold">Details</span><span class="col-6 m-0 p-0 text-bold text-right">Subtotal</span>';

					$detail = $db->getSales_detail($view['sales_code']);
					foreach ($detail['fetch'] as $detail) {
					$response['output'] .= '<div class="col-5 text-bold p-0">'.$detail['product'].'</div>';
					$response['output'] .= '<div class="col-3 text-right">'.$detail['qty'].' item</div>';
					$response['output'] .= '<div class="col-4 text-right p-0">Rp '.rupiah($detail['subtotal']).'</div>';
					}
					$response['output']	.= '</div>';

				$response['output'] .= '</div>';
			}
		}
		else 
		{
			$response['output'] .= '<div class="bt pt-3 text-center"><h5>NO DATA TO DISPLAY</h5></div>';
		}
		echo json_encode($response);
	}


	else if($aksi == 'listOrder_search') 
	{
		$sales_code = $_POST['sales_code'];
		$result 	= $db->getSales_BySales_code($sales_code);
		$data 		= $result['fetch'];
		$row 		= $result['row'];

		$response['output'] = '';
		
		if($row > 0) {

			foreach ($data as $view) {
				$response['output'] .= '<div class="col-12 b-top listorder-container">';
					
					$response['output'] .= '<div class="row">';
					$response['output'] .= '<div class="col-9 p-0 pl-1">
												<divy class="row statistic pt-0 pt-2">
												<div class="i-checks">
												<input type="checkbox" class="check checkbox-template col-1 listorder-checkbox" value="'.$view['sales_code'].'">
												</div>
												<div class="icon bg-green mt-1 listorder-qty">'.$view['qty'].'</div>
												<span class="text p-0 m-0">
													<span class="text-bold fs-17 listorder-sales_code">'.$view['sales_code'].'</span><br>
													<small class="listorder-total">Rp '.rupiah($view['total']).'</small>
												</span>
												</div>						
											</div>';
					$response['output'] .= '<div class="col-3 p-0 m-0 pt-1 fs-12">
												<span class="col-12 text-right p-0 m-0 pr-1 listorder-detail" data-id="'.$view['sales_code'].'" data-toggle="collapse" data-target="#id-'.$view['sales_code'].'">
													'.date('H:i', strtotime($view['date'])).'
													<i class="fa fa-angle-down pl-2 fs-18"></i>
												</span>
												<span class="col-12 text-right p-0 m-0 pr-1">
												<button class="btn btn-primary pt-1 pr-3 pb-1 pl-3 fs-13 btn-pay" value="'.$view['sales_code'].'">Pay</button>
												</span>
											</div>';
					$response['output'] .= '</div>';


					//detail//
					$response['output'] .= '<div id="id-'.$view['sales_code'].'" class="row pr-1 pl-1 pt-1 pb-3 fs-12 collapse">';
					$response['output'] .= '<span class="col-6 m-0 p-0 text-bold">Details</span><span class="col-6 m-0 p-0 text-bold text-right">Subtotal</span>';

					$detail = $db->getSales_detail($view['sales_code']);
					foreach ($detail['fetch'] as $detail) {
					$response['output'] .= '<div class="col-5 text-bold p-0">'.$detail['product'].'</div>';
					$response['output'] .= '<div class="col-3 text-right">'.$detail['qty'].' item</div>';
					$response['output'] .= '<div class="col-4 text-right p-0">Rp '.rupiah($detail['subtotal']).'</div>';
					}
					$response['output']	.= '</div>';

				$response['output'] .= '</div>';
			}
		}
		else 
		{
			$response['output'] .= '<div class="bt pt-3 text-center"><h5>NO DATA TO DISPLAY</h5></div>';
		}
		echo json_encode($response);
	}


	else if($aksi == 'listOrder_change')
	{
		$sales_code 		= $_POST['sales_code'];
		$response['output'] = '';

		$result 	= $db->getSales_detail($sales_code);
		$data 		= $result['fetch'];
		$row 		= $result['row'];

		$discount	= 0;
		$subtotal 	= [];
		$total 		= [];
		$total_item = [];



		if($row > 0 )
		{
			$response['status'] = 'success';
			$response['aksi']  	= $aksi;

			foreach ($data as $view) 
			{
				$product = strtolower(str_replace(' ', '', $view['product']));
				array_push($subtotal, $view['subtotal']);
				array_push($total_item, $view['qty']);
				
				$response['output'] .= '<tr class="'.$product.'">';
				$response['output'] .= '<td class="w-60">
											<div class="row">
											<div class="col-lg-3">
											<img src="image/upload/'.$view['image'].'" alt="..." class="img-fluid rounded-circle">
											</div>
											<div class="col-md-7 p-0 m-0"">
											<span class="product_item text-bold">'.$view['product'].'</span><br>
											<span class="price_item">Rp '.rupiah($view['price']).'</span>
											</div>						
											</div>
										</td>';
				$response['output'] .= '<td>
											<span class="frame">
											<span class="minus text-bold">-</span>
											<span class="qty_item">'.$view['qty'].'</span>
											<span class="plus text-bold">+</span>
											</span>
										</td>';

				$response['output'] .= '<td>
											<input type="hidden" class="subtotal_item" value="'.$view['price']*$view['qty'].'">
											<input type="hidden" class="hide-prodcut_code" name="product_code[]" value="'.$view['product_code'].'">
											<input type="hidden" class="hide-prodcut_qty"  name="qty[]" value="'.$view['qty'].'">
											<span class="remove-item"><i class="fa fa-close"></i></span>
										</td>';
				$response['output'] .= '</tr>';

			}

			$response['discount']	= $discount;
			$response['subtotal']	= array_sum($subtotal);
			$response['total']		= array_sum($subtotal) - $discount;
			$response['total_item'] = array_sum($total_item);
		}
		else {
				$response['status'] = 'failed';
				$response['aksi']  	= $aksi;
				$response['output'] .= '<div class="bt pt-3 text-center"><h5>NO DATA TO DISPLAY</h5></div>';
		}

		echo json_encode($response);
	}	

	


/*
 * LIST ORDER PAYEMENT 
*/
	else if($aksi == 'listOrder_payment') 
	{
		$sales_code = $_POST['sales_code'];
		
		$result 	= $db->getSales_BySales_code($sales_code);
		$data 		= $result['fetch'];
		
		foreach ($data as $view) {
			$id = $view['table_id'];

			if($id != NULL)
			{
				$m_table = direct_model('M_table');
				$table 	 = $m_table->getTable_ById($id);
				$data 	 = $table['data'];

				$response['table_id'] 		= $data['table_id'];
				$response['table_code'] 	= $data['table_code'];
				$response['table_number'] 	= $data['table_number'];
				$response['sales_code']		= $sales_code;
				$response['total']			= $view['total'];

				$response['status'] = 'success';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'Table exist';
			}

			else 
			{	
				$response['table_id'] 		= '0';
				$response['table_code'] 	= 'WITHOUT TABLE';
				$response['table_number'] 	= '0';
				$response['sales_code']		= $sales_code;
				$response['total']			= $view['total'];

				$response['status'] = 'success';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'No table';
			}

			echo json_encode($response);		
		}
	}


	else if($aksi == 'listOrder_payment_detailorder')
	{
		$sales_code 		= $_POST['sales_code'];
		$response['output'] = '';

		$result 	= $db->getSales_detail($sales_code);
		$data 		= $result['fetch'];
		$row 		= $result['row'];

		$discount	= 0;
		$subtotal 	= [];
		$total 		= [];
		$total_item = [];



		if($row > 0 )
		{
			$response['status'] = 'success';
			$response['aksi']  	= $aksi;

			foreach ($data as $view) 
			{
				$product = strtolower(str_replace(' ', '', $view['product']));
				array_push($subtotal, $view['subtotal']);
				array_push($total_item, $view['qty']);
				
				$response['output'] .= '<div class="col-12 b-top pl-3">
										<div class="row">
											<div class="col-2 p-0 pt-2 pb-3">
											<span class="row col-12 text-bold">'.$view['qty'].'</span>
											</div>
											
											<div class="col-6 p-0 pt-2 pb-3">
												<span class="row col-12 text-bold table_code-modal">'.$view['product'].'</span>
												<span class="row col-12 table_number-modal">Rp '.rupiah($view['price']).'</span>
											</div>
											
											<div class="col-4 p-0 pt-2 pb-3">
											<span class="col-12 text-right">'.rupiah($view['subtotal']).'</span>
											</div>
										</div>
										</div>';
			}

			$response['sales_code']	= 'Order ID : '.$sales_code;
			$response['discount']	= $discount;
			$response['subtotal']	= array_sum($subtotal);
			$response['total']		= array_sum($subtotal) - $discount;
			$response['total_item'] = array_sum($total_item).' ITEM';
		}
		else {
				$response['status'] = 'failed';
				$response['aksi']  	= $aksi;
				$response['output'] .= '<div class="bt pt-3 text-center"><h5>NO DATA TO DISPLAY</h5></div>';
		}

		echo json_encode($response);
	}


	else if($aksi == 'paymentMethod') 
	{
		$M_payment 	= direct_model('M_payment_type');
		$payment 	= $M_payment->getPayment();
		$data 		= $payment['data'];
		$row 		= $payment['row'];

		$response['output'] = '';

			if($row > 0) 
			{
				$response['status'] = 'success';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'data exist';

				$response['output'] .= '<div class="row text-center p-0 pr-1 fs-13">';

				foreach ($data as $view) {
				$response['output'] .=	'	<div class="col-4 p-0 pb-1 pl-1">
											<span class="col-12 p-3 bg-green-outline payment-method" data-id="'.$view['id_payment'].'&'.$view['name'].'">'.$view['name'].'</span>
											</div>';
				}
				$response['output'] .=	'</div>';
			}
			else 
			{
				$response['status'] = 'failed';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'data empty';

				$response['output']		.= '<div class="row text-bold">Please set payment type</div>';
			}

			echo json_encode($response);
	}


	else if($aksi == 'paymentCash') 
	{
		$sales_code = $_POST['sales_code'];
		$id_payment = $_POST['id_payment'];
		$sales 		= $db->getSales_Limit_BySales_code($sales_code);
		$result 	= $sales['row'];

		if($result > 0) 
		{
			//detail order
			$detail 	= $db->getSales_detail($sales_code);
			$qty 		= [];
			$total 		= $sales['fetch']['total'];
			$date 		= $sales['fetch']['date'];			

			//check discount
			$discount    = [];
			$getDiscount = $db->getDiscount($date);
			$row 		 = $getDiscount['row'];
			$data 		 = $getDiscount['data'];
			$promo_id 	 = $data['promo_id'];

			if($row > 0) // jika ada promo
			{					
					foreach ($detail['fetch'] as $view)
					{
						$qty[] 		= $view['qty'];						

						//detail discount
						$promoDetail = $db->getDiscountDetail($promo_id);
						$promoData 	 = $promoDetail['data'];
						$promoRow 	 = $promoDetail['row'];

						if($promoRow > 0) //jika ada detail promo
						{
							foreach ($promoData as $promo)
							{
								$promo_type 	= $promo['promo_type'];
								$promo_payment 	= $promo['promo_payment'];

								if($promo_payment  == 'all' && $promo_type == 'all') {
								$discount[] 		= $view['subtotal'] * ($promo['discount'] / 100); 
								}

								else if($promo_payment 	== 'all' && $promo_type == 'custom') {
										if($view['id_product'] == $promo['id_product']){
										$pSale 					= $db->getPriceDiscount($view['product_code'],$view['sales_code']);
										$discount[] 			= $pSale['discount_total'];
										}
								}

								else if($promo_payment == 'custom' && $promo_type == 'custom') {
										if($id_payment == $promo['id_payment'] && $view['id_product'] == $promo['id_product']){
										$pSale 			= $db->getPriceDiscount($view['product_code'],$view['sales_code']);
										$discount[] 	= $pSale['discount_total'];
										}
								}

								else if($promo_payment == 'custom' && $promo_type == 'all'){
										if($id_payment == $promo['id_payment']) {
										$discount[] 	= $view['subtotal'] * ($promo['discount'] / 100); 
										}
								}
							}
						}
						else { $discount[] = NULL;}
					}
			}
			else 
			{
					foreach ($detail['fetch'] as $view) {
					$qty[] 	= $view['qty'];
					}					
			}
			$response['cash'] 		= $discount;			
			$qty 		= array_sum($qty);
			$discount 	= array_sum($discount);			

			
			$response['sales_code']	= $sales_code;
			$response['qty'] 		= $qty;			
			$response['grand_total']= 'Rp '.rupiah($total);
			$response['discount'] 	= 'Rp '.rupiah($discount);
			$response['total'] 		= 'Rp '.rupiah($total-$discount);

			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'data is exist';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'data not found';
		}
		echo json_encode($response);
	}


	else if ($aksi === 'paymentNonCash') {
        $sales_code = $_POST['sales_code'];
        $id_payment = $_POST['id_payment'];

        // Memanggil fungsi getQtyAndTotalBySalesCode dari M_sales
        $result = $db->getQtyAndTotalBySalesCode($sales_code);

        if ($result['status'] === 'success') {
            $qty = $result['qty'];
            $grandTotal = $result['total'];
			$tax = $result['tax'];
			$service = $result['service'];

            // Data statis untuk pengujian
            // $tax = 50000; // Rp 50.000
            // $serviceCharge = 30000; // Rp 30.000
            $discount = $grandTotal * 0.1; // Diskon 10%

            // Total setelah diskon, pajak, dan service charge
            $total = $grandTotal - $discount + $tax + $service;

            // Mengembalikan respons JSON
            $response = [
                'status' => 'success',
                'aksi' => $aksi,
                'msg' => 'Data is exist',
                'sales_code' => $sales_code,
                'qty' => $qty,
                'grand_total' => 'Rp ' . number_format($grandTotal, 0, ',', '.'),
                'discount' => 'Rp ' . number_format($discount, 0, ',', '.'),
                'tax' => 'Rp ' . number_format($tax, 0, ',', '.'),
                'service' => 'Rp ' . number_format($service, 0, ',', '.'),
                'total' => 'Rp ' . number_format($total, 0, ',', '.')
            ];
        } else {
            $response = [
                'status' => 'failed',
                'aksi' => $aksi,
                'msg' => $result['msg'] ?? 'Data not found'
            ];
        }

        echo json_encode($response);
    } 


	else if($aksi == 'paymentFinish')
	{
		$sales_code = $_POST['sales_code'];
		$id_payment = $_POST['id_payment'];

		$t_sales 	= $db->getSales_Limit_BySales_code($sales_code);
		$data 		= $t_sales['fetch'];
			
			if($data['table_id'] == '' || $data['table_id'] == NULL ) {  $db->updateSales_status($sales_code,'Y'); }
			else 
			{
				$table 		= direct_model('M_table');
				$table_id 	= $data['table_id'];

				$table->updateTable_status($table_id,'N');
				$db->updateSales_status($sales_code,'Y');
			}

			$payment  = direct_model('M_payment');
			$result   = $payment->addPayment($sales_code,$id_payment);

			if($result > 0 )
			{
				$response['status'] = 'success';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'order finish success';
			}
			else 
			{
				$response['status'] = 'failed';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'order finish failed';
			}
			echo json_encode($response);
	}




/*
 * LIST TABLE
*/
 	else if($aksi == 'listTable') 
 	{
 		
 		$m_table = direct_model('M_table');
		$table 	 = $m_table->getTable_ByStatus('N');
		

		$response['output'] = '';

		foreach ($table['data'] as $view) 
		{
			$response['output'] .= '<div class="col-12 b-top pl-3 list-table-ready">
									<div class="row">
										<div class="col-6 p-0 pt-2 pb-3">
											<span class="row col-12 text-bold table_code-modal">'.$view['table_code'].'</span>
											<span class="row col-12 table_number-modal">Table '.$view['table_number'].' ready to use</span>
										</div>
										<div class="col-6 p-0 pt-2 pb-3">
											<span class="col-12 text-right text-success checked-modal d-none"><i class="fa fa-check"></i></span>
											<input type="hidden" class="table_id-modal-hidden" value="'.$view['table_id'].'">
											<input type="hidden" class="table_id-modal">
										</div>
									</div>
									</div>';
		}
		echo json_encode($response); 
 	}





/*
 * ACTION FROM FORM
*/
	else if($aksi == 'add-order') 
	{
		if(isset($_POST['product_code'])) {
			

			$total 		= $_POST['total'];
			$date 		= date('Y-m-d H:i:s');	
			$operator	= $_POST['operator'];			
			$p_code 	= $_POST['product_code'];
			$qty 		= $_POST['qty'];


			if(empty($_POST['table_id']) OR ($_POST['table_id'] == '')) { $table_id = 'NULL'; }
			else 
			{
				//update status m_table	
				$table_id 	= $_POST['table_id'];
				$m_table 	= direct_model('M_table');
				$update 	= $m_table->updateTable_status($table_id,'Y');
			}


			//make sales code
			$get_order 		= $db->getSales_Limit();
			$order_row 		= $get_order['row'];
			$order 			= $get_order['fetch'];
			if($order_row > 0) { $id = $order['id']+1; }
			else { $id = 1; }
			$sales_code = date('ymdhi').'-'.$id;


			
			//insert t_sales & d_sales
			$add_order 	= $db->setOrder($sales_code,$date,$total,$operator,$table_id);
			foreach ($p_code as $i => $product_code) {
			$db->setDetail_order($product_code,$qty[$i],$sales_code);
			}

			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'add order success';
		}
		else {
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'Please select product to order';
		}

		echo json_encode($response);
	}



	else if($aksi == 'update-order')
	{
		if(!empty($_POST['product_code'])) {
			
			$sales_code = $_POST['sales_code'];
			$total 		= $_POST['total'];
			$operator	= $_POST['operator'];

			$p_code 	= $_POST['product_code'];
			$qty 		= $_POST['qty'];
			$update 	= $db->updateOrder($sales_code,$total,$operator);
	
			if($update > 0) 
			{
				$delete  = $db->deleteDetail_order($sales_code);				
				if($delete > 0)	{
					foreach ($p_code as $i => $product_code) {
					$db->setDetail_order($product_code,$qty[$i],$sales_code);				
					}
					$response['status'] = 'success';
					$response['aksi'] 	= $aksi;
					$response['msg'] 	= 'success update order detail';
				}
				else {
					$response['status'] = 'failed';
					$response['aksi'] 	= $aksi;
					$response['msg'] 	= 'failed update order detail';
				}
			}
			else 
			{
				$response['status'] = 'failed';
				$response['aksi'] 	= $aksi;
				$response['msg'] 	= 'Update failed, cause data is same';
			}						
		}

		else {
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'Update failed, please select product';
		}
		echo json_encode($response);			
	}
	else if ($aksi == 'getService') {
		// Return static service data as JSON
		$response = [
			'hasil' => [
				'persentage' => 3 // Example service percentage of 3%
			],
			'row' => 1
		];
		echo json_encode($response);
	} 
	else if ($aksi == 'getDiscountAll') {
		// Return static discount data as JSON
		$response = [
			'hasil' => [
				'discount' => 10 // Example discount of 10%
			],
			'row' => 1
		];
		echo json_encode($response);
	} 
	else if ($aksi == 'getTax') {
		// Return static tax data as JSON
		$response = [
			'hasil2' => [
				'persentage' => 5 // Example tax percentage of 5%
			],
			'row' => 1
		];
		echo json_encode($response);
	} 
	
	
?>