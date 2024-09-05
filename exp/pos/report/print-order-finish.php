<?php 

require '../lib/printer/pos-printer/custom-printer.php';
include_once '../include/paging.php';

	//get order
	$M_sales 	= direct_model('M_sales');
	$sales_code = base64_decode($_GET['id']);
	$payment 	= strtolower(base64_decode($_GET['pay']));
	if($payment == 'cash') {
	$cash  	= base64_decode($_GET['c']);
	}


	//order
	$order		= $M_sales->getSales_Limit_BySales_code($sales_code);
	$orderData 	= $order['fetch'];
	$date 		= $orderData['date'];
	$grand_total= $orderData['total'];


	//get deail order
	$order_detail  	= $M_sales->getSales_detail($sales_code);
	$detailData  	= $order_detail['fetch'];
	$datePrint 		= date('M d, Y H:i:s A');	


	//get table
	if($orderData['table_id'] == NULL) { $table_code = "Without Table"; }
	else 
	{ 		 
		$M_table	= direct_model('M_table');
		$id 		= $orderData['table_id'];
		$table 		= $M_table->getTable_ById($id);
		$tableData 	= $table['data'];
		$table_code = $tableData['table_code'];
	}


	//get payment
	$M_payment_type = direct_model('M_payment_type');
	$payment_type 	= $M_payment_type->getPaymentByName($payment);
	$id_payment 	= $payment_type['data']['id_payment']; 	








	/*
	 PRINT DOCUMENT
	*/
	//title
		$image 		= "logo.png";
		$logo 		= loadImage($image);
		$printer -> setJustification(alignCenter());
		$printer -> bitImage($logo);
		$printer -> text("\n");
		$printer -> setEmphasis(true);
		$printer ->selectPrintMode(doubleWidth(),doubleHeight());
		$printer -> text("ATI Store");
		$printer -> feed();
		$printer -> feed();

		//HEADER
		$printer -> selectPrintMode();
		$printer -> setJustification();
		$printer -> setEmphasis(false);
		$printer -> text(addSpaces('#Payment : ', 10) .addSpaces(strtoupper($payment), 15)."\n");
		$printer -> text("------------------------------------------------\n");
		$printer -> text(addSpaces('ITEM', 23) .addSpaces('QTY ', 12) .addSpaces('SUBTOTAL',10)."\n");
		$printer -> text("------------------------------------------------\n");
		$printer -> selectPrintMode();



	//CONTENT
		$totalQty 		= [];
		$grandTotal 	= $grand_total;
		$discountTotal 	= [];

		//check discount
		$getDiscount = $M_sales->getDiscount($date);
		$row 		 = $getDiscount['row'];	
		$data 		 = $getDiscount['data'];
		$promo_id 	 = $data['promo_id'];

		
		if($row > 0) 
		{			
				foreach ($detailData as $view) 
				{	
					$totalQty[] 	= $view['qty'];



					//detail discount 
					$promoDetail = $M_sales->getDiscountDetail($promo_id);
					$promoData 	 = $promoDetail['data'];
					$promoRow 	 = $promoDetail['row'];

					if($promoRow > 0)
					{
							foreach ($promoData as $promo) 
							{
								$promo_type 	= $promo['promo_type'];
								$promo_payment 	= $promo['promo_payment'];

								if($promo_payment  == 'all' && $promo_type == 'all') {
								$discountTotal[] 		= $view['subtotal'] * ($promo['discount'] / 100); 
								$discount 				= $promo['discount'];
								}

								else if($promo_payment 	== 'all' && $promo_type == 'custom') {
										if($view['id_product'] == $promo['id_product']){
										$pSale 					= $M_sales->getPriceDiscount($view['product_code'],$view['sales_code']);
										$discountTotal[]		= $pSale['discount_total'];
										$discount 				= $promo['discount'];
										}
								}

								else if($promo_payment == 'custom' && $promo_type == 'custom') {
										if($id_payment == $promo['id_payment'] && $view['id_product'] == $promo['id_product']){
										$pSale 			= $M_sales->getPriceDiscount($view['product_code'],$view['sales_code']);
										$discountTotal[]= $pSale['discount_total'];
										$discount 		= $promo['discount'];
										}
								}

								else if($promo_payment == 'custom' && $promo_type == 'all'){
										if($id_payment == $promo['id_payment']) {
										$discountTotal[]= $view['subtotal'] * ($promo['discount'] / 100);
										$discount 		= $promo['discount']; 
										}
								}
							}
					}
					else { $discount[] = NULL;}



				    
					/* ROW 1 */
					    $product 	= str_split($view['product'], 18);
					    $qty 		= str_split($view['qty'], 5);
					    $subtotal 	= str_split($view['subtotal'],10);

					    foreach ($product as $key => $item) {
					    $product[$key] 	= addSpaces(trim($item), 23);
					    }

					    foreach ($qty as $key => $item) { 
					    $qty[$key] 	= addSpaces(trim($item), 12);
					    }

					    foreach ($subtotal as $key => $item) { 
					    $subtotal[$key] = addSpaces(rupiah($item), 10);
					    }


					    $counter = 0;
					    $temp 	 = [];
					    $temp[]  = count($product);	    
					    $temp[]  = count($qty);
					    $temp[]  = count($subtotal);
					    $counter = max($temp);
					    for ($i = 0; $i < $counter; $i++) 
					    {
					        $line = '';

					        if (isset($product[$i])) {
					            $line .= ($product[$i]);
					        }
					        
					        if (isset($qty[$i])) {
					            $line .= ($qty[$i]);
					        }
					    
					        if (isset($subtotal[$i])) {
					            $line .= ($subtotal[$i]);
					        }

					        $printer->text($line . "\n");
					    }

				    /* ROW 2 */
					    $price 	 	= str_split($view['price'], 20);

					    foreach ($price as $key => $item) {
					    $price[$key] 	= addSpaces(rupiah($item), 32);
					    }

					    $temp 	 = [];
					    $temp[]  = count($price);
					    $counter = max($temp); 
					    for ($i = 0; $i < $counter; $i++) 
					    {
					        $line = '';

					        if (isset($price[$i])) {
					            $line .= 'Rp '.($price[$i]);
					        }

					        if (isset($discount[$i])) {
					            $line .= '('.($discount).'%)';
					        }
					        $printer->text($line . "\n");
					    }

				    $printer -> text("\n");
				}	
		}
		else 
		{				
				foreach ($detailData as $view) 
				{	
					$totalQty[] 	= $view['qty'];
					$discountTotal[]= 0;

				    
					/* ROW 1 */
					    $product 	= str_split($view['product'], 18);
					    $qty 		= str_split($view['qty'], 5);
					    $subtotal 	= str_split($view['subtotal'],10);

					    foreach ($product as $key => $item) {
					    $product[$key] 	= addSpaces(trim($item), 23);
					    }

					    foreach ($qty as $key => $item) { 
					    $qty[$key] 	= addSpaces(trim($item), 12);
					    }

					    foreach ($subtotal as $key => $item) { 
					    $subtotal[$key] = addSpaces(rupiah($item), 10);
					    }


					    $counter = 0;
					    $temp 	 = [];
					    $temp[]  = count($product);	    
					    $temp[]  = count($qty);
					    $temp[]  = count($subtotal);
					    $counter = max($temp);
					    for ($i = 0; $i < $counter; $i++) 
					    {
					        $line = '';

					        if (isset($product[$i])) {
					            $line .= ($product[$i]);
					        }
					        
					        if (isset($qty[$i])) {
					            $line .= ($qty[$i]);
					        }
					    
					        if (isset($subtotal[$i])) {
					            $line .= ($subtotal[$i]);
					        }

					        $printer->text($line . "\n");
					    }

				    /* ROW 2 */
					    $price 	 	= str_split($view['price'], 20);

					    foreach ($price as $key => $item) {
					    $price[$key] 	= addSpaces(rupiah($item), 32);
					    }

					    $temp 	 = [];
					    $temp[]  = count($price);
					    $counter = max($temp); 
					    for ($i = 0; $i < $counter; $i++) 
					    {
					        $line = '';

					        if (isset($price[$i])) {
					            $line .= 'Rp '.($price[$i]);
					        }
					        $printer->text($line . "\n");
					    }

				    $printer -> text("\n");
				}				
		}		


		//counting
		$totalQty 		= array_sum($totalQty);
		$discountTotal 	= array_sum($discountTotal);
		$total 			= $grandTotal - $discountTotal;

		if($payment == 'cash') {
		$changeDue 	= $cash-$total;
		}

		$printer -> setJustification();
		$printer -> selectPrintMode();
		$printer -> text("\n");
		$printer -> text(addSpaces('', 20) .'----------------------------'."\n");
		$printer -> text(addSpaces('', 20) .addSpaces('TOTAL ITEM ', 10).addSpaces(': ', 3) .addSpaces($totalQty,10)."\n");
		$printer -> text(addSpaces('', 20) .addSpaces('GRAND TOTAL', 11).addSpaces(': ', 3) .addSpaces(rupiah($grandTotal),10)."\n");
		$printer -> text(addSpaces('', 20) .addSpaces('DISCOUNT', 11).addSpaces(': ', 3) .addSpaces(rupiah($discountTotal),10)."\n");
		$printer -> text(addSpaces('', 20) .addSpaces('TOTAL', 11).addSpaces(': ', 3) .addSpaces(rupiah($total),10)."\n");

		if($payment == 'cash') {
		$printer -> text(addSpaces('', 20) .addSpaces('CHARGED', 11).addSpaces(': ', 3) .addSpaces(rupiah($cash),10)."\n");
		$printer -> text("\n");
		$printer -> text(addSpaces('', 20) .addSpaces('CHANGE DUE', 11).addSpaces(': ', 3) .addSpaces(rupiah($changeDue),10)."\n");
		}

	


	//FOOTER
	$printer -> feed(3);
	$printer -> selectPrintMode();
	$printer -> setJustification(alignCenter());
	$printer -> text("Kota Tua, Ancol, Pademangan, Kota Jkt Utara,\n Daerah Khusus Ibukota Jakarta 14430 \n");
	$printer -> text("Customer Service :  +62 21-2998-6561 \n");
	$printer -> text("EMAIL : ati@cloudtech.id \n");
	$printer -> feed(2);
	$printer -> text("** Printed ".$datePrint." **");
	$printer -> feed(2);
	
	
	close();

?>