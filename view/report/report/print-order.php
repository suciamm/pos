<?php 

require '../lib/printer/pos-printer/custom-printer.php';
include_once '../include/paging.php';

	//get order
	$M_sales 	= direct_model('M_sales');
	$sales_code = base64_decode($_GET['id']);
	$order		= $M_sales->getSales_Limit_BySales_code($sales_code);
	$orderData 	= $order['fetch'];



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


	//get deail order
	$order_detail  	= $M_sales->getSales_detail($sales_code);
	$detailData  	= $order_detail['fetch'];
	$date 			= date('M d, Y H:i:s A');	

















	/*
	 PRINT DOCUMENT
	*/
	$printer -> text(addSpaces('CHECKER', 30) .addSpaces('Ord# '.$sales_code, 15) . "\n");
	$printer -> setTextSize(2, 2);
	$printer -> text($table_code);
	$printer -> selectPrintMode(); //reset
	$printer -> feed();
	$printer -> text("------------------------------------------------\n");
	$printer -> feed();
	$printer -> selectPrintMode(doubleWidth());

	//$printer -> text(addSpaces('11', 10) .addSpaces('Nasi Goreng Seafood', 10) . "\n");

	foreach ($detailData as $view) 
	{

	    $qty 		= str_split($view['qty'], 4);
	    $product 	= str_split($view['product'], 15);

	 	foreach ($qty as $key => $item)
	 	{
	    	$qty[$key] 	= addSpaces(trim($item), 5);
	    }

	    foreach ($product as $key => $item) 
	    {
	    	$product[$key] 	= addSpaces(trim($item), 20);
	    }


	    $counter = 0;
	    $temp 	 = [];
	    $temp[]  = count($qty);
	    $temp[]  = count($product);
	    $counter = max($temp);

	    for ($i = 0; $i < $counter; $i++) 
	    {
	        $line = '';
	        
	        if (isset($qty[$i])) {
	        	$printer -> setJustification(alignRight());
	            $line .= ($qty[$i]);
	        }
	        if (isset($product[$i])) {
	        	$printer -> setJustification();
	            $line .= ($product[$i]);
	        }

	        $printer->text($line . "\n");
	    }

	    $printer -> text("\n");
	}


	$printer -> selectPrintMode();
	$printer -> setJustification(alignCenter());
	$printer -> feed(3);	
	$printer -> text("** Printed ".$date." **");
	
	// $printer -> feed();
	// $printer -> setEmphasis(true);
	// $printer -> text("with emphasis \n");
	// $printer -> selectPrintMode();
	// $printer -> setEmphasis(false);
	// $printer -> text("without emphasis \n");

	close();

?>