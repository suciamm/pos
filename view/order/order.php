<?php 
$db  			= model('M_sales');
$getMenu 		= $db->getMenu();
$db				= model('M_promo');
// $getDiscount    =$db->getDiscount();
 //echo $getDiscount['data']['promo_id'];
$db = model('M_tax');
$getTax = $db->getTax();


?>


<div class="row mr-2 ml-1">

	<!--list product to order-->
	<div class="col-lg-8 col-sm-12">
		<!--Header & search -->
		<div class="row m1-2">		
			<div class="row col-lg-8 col-sm-12 mt-3">
			<span class="col-lg-12 ml-2"><h4>ORDER PRODUCT_ <label class="label-menu"></label></h4></span>
			</div>
			<div class="col-lg-4 col-sm-12 material-search">
				<ul class="row">
					<span class="col-10 mt-1">
					<input type="text" name="" class="input-material none autoList" placeholder="Search Product .." id="search-product">
					</span>
					<span class="row col-1 mt-3 search-product-icon"><i class="fa fa-search"></i></span>
				</ul>			
			</div>
		</div>

		<!--Product menu -->
		<div class="row">
			<!--MAIN VIEW -->

			<!--list category-->
			<div class="row col-lg-12" id="list-cat" style="display: none">
				<ul class="row col-lg-12">	
					<div class="col-lg-6" id="cat-showAll">
						<div class="card ml-2 menu-product-custom text-center">
						<i class="fa fa-table"></i>
						<label>Show all</label>
						</div>
					</div>

					<div class="col-lg-6" id="cat-favorite">
						<div class="card menu-product-custom text-center">
						<i class="fa fa-star"></i>
						<label>Favorite</label>
						</div>
					</div>
				</ul>
				<ul class="row">
				
					<?php foreach ($getMenu['data'] as $menu) { ?>
					<li class="card menu-product cbig text-center cat-menu" data-value="<?php echo $menu['menu']; ?>">
						<img src="image/upload/<?php echo $menu['icon']; ?>" alt="..." class="img-responsive mb-3" width="100">
						<label><?php echo $menu['menu']; ?></label>
					</li>
					<?php } ?>
				</ul>
			</div><!--close list category-->


			<!--list favorite -->
			<div class="row col-lg-12" id="list-favorite" style="display: none">
				<ul class="row">
					<?php foreach ($getMenu['data'] as $menu) { ?>
					<li class="card menu-product cbig text-center" data-value="<?php echo $menu['menu']; ?>">
						<img src="image/upload/<?php echo $menu['icon']; ?>" alt="..." class="img-responsive mb-3" width="100">
						<label><?php echo $menu['menu']; ?></label>
					</li>
					<?php } ?>
				</ul>
			</div>



			<!--DETAIL VIEW -->

			<!--show product all-->
			<div class="row col-lg-12" id="show_product_all">
				<input type="hidden" id="pages">
				<ul class="row" id="list-product">
				</ul>
			</div><!--close product all -->
		</div>

		<!--Card static -->
		<div class="row">		
			<div class="col-md-12 ml-2 nav-product">
			<div class="row pt-3">
				<div class="col-lg-4">
					<div class="card pt-2 pb-2 text-center" id="cat">
						<i class="fa fa-windows"></i>
						CATEGORY
					</div>			
				</div>
				<div class="col-lg-2">
					<div class="row card pt-3 pb-2 text-center" id="previous">
					<label id="previous-label">Previous</label>
					</div>			
				</div>
				<div class="col-lg-2">
					<div class="row card pt-3 pb-2 text-center" id="next">
					<label id="next-label">Next</label>
					</div>			
				</div>		
				<div class="col-lg-4">
					<div class="card pt-2 pb-2 text-center" id="favorite">
						<i class="fa fa-star"></i>
						FAVORITE
					</div>			
				</div>
			</div>
			</div>
		</div>
	</div><!--close col-8 list product-->



	<!--bill order-->
	<div class="col-lg-4 mt-1" id="bill-order">
		<div class="row text-center bill">
			<span class="col-4 card" id="menu-order" data-id="order-bill"><i class="fa fa-shopping-cart"></i></span>		
			<span class="col-4 card" id="menu-listOrder" data-id="listOrder-bill"><i class="icon-user"></i></span>
			<span class="col-4 card" id="menu-payment" data-id="payment-bill"><i class="fa fa-money"></i></span>
		</div>

		<div class="row order-list card">
			<!--order-->
			<div class="col-12 d-none" id="order-bill">
				<div class="row">
					<div class="col-6 mt-3">
					<h4>ITEM</h4>
					</div>
					<div class="col-6 mt-3 text-right">
					<h4><span class="badge badge-success total_item">0</span></h4>
					</div>							
				</div>

				<form id="add-order" method="post" enctype="multipart/form-data">
					<table class="table table-hover table-vertical-scroll h-340 table-order">
						<tbody>							
						</tbody>	
					</table>			
					<div class="row mt-3">
						<div class="col-12 fs-13">
							<div class="row">
							<span class="col-lg-6">Subtotal</span>
							<span class="col-lg-6 text-right price_subtotal">Rp 0</span>
							<span class="col-lg-6">Discount</span>
							<span class="col-lg-6 text-right price_discount">Rp 0</span>
							<span class="col-lg-6">Tax</span>
							<span class="col-lg-6 text-right price_tax">Rp 0</span>
							<span class="col-lg-6">Service charge</span>
							<span class="col-lg-6 text-right price_service">Rp 0</span>

							<span class="col-lg-12"><hr></span>

							<span class="col-6"><h5>TOTAL</h5></span>
							<span class="col-6 text-right price_total text-bold fs-15">Rp 0</span>
							</div>
						</div>					
						<div class="col-12">
							<input type="hidden" name="total" 	 class="hide-total">
							<input type="hidden" name="table_id" class="hide-table_id">
							<input type="hidden" name="operator" value="<?php echo $_SESSION['pos-username']; ?>">
							<input type="hidden" name="aksi" value="add-order">
							<div class="row">
								<span class="col-4">
								<span class="col-12 btn btn-success modal-table" data-toggle="modal" data-target="#modal-table">TABLE</span>
								</span>
								<span class="col-8">
								<button type="submit" class="col-12 btn btn-primary">CHECKOUT</button>
								</span>							
							</div>						
						</div>
					</div>
				</form>
			</div>

			<!--list-->
			<div class="col-12 d-none" id="listOrder-bill">
				<div class="row">
					<span class="col-11 mt-1">
					<input type="text" class="input-material none" placeholder="Search .." id="search-order_code">
					</span>
					<span class="row col-1 mt-3">
					<i class="fa fa-search"></i>
					</span>
				</div>

				<div class="row pr-3 pl-3 table-vertical-scroll h-400" id="table-listorder">
				</div>

				<div class="row pl-3 pr-3 mt-3 d-none" id="button-listorder">
					<div class="col-6 listorder-detail p-0" id="listorder-change">
						<div class="col-12 text-center btn-primary text-white p-3 mr-1">
						<span>Change</span>
						</div>
					</div>
					<div class="col-6 listorder-detail p-0 pr-1" id="listorder-print">
						<div class="col-12 text-center btn-primary text-white p-3 ml-1">
						<span>Print</span>
						</div>
					</div>
				</div>
			</div>

			<!--payment-->
			<div class="col-12 d-none" id="payment-bill">
				<div class="row pl-3 pr-3 pt-1">
						<div class="col-6 p-0 pt-2">
						<span class="fs-23 pt-4">Pay</span>
						</div>
						<div class="col-6 text-right p-0">
							<span class="col-12 fs-11 p-0 pointer detail-payment" data-toggle="modal" data-target="#payment-detail-modal" data-id="">
								detail 
								<i class="fa fa-info-circle fs-13"></i>
							</span>
							<span class="col-12 b p-3 text-bold payment-total">Rp 0</span>
						</div>

						<div class="col-12 fs-13 p-0 mt-3" id="payment-detail">
							<span class="col-12 text-bold pb-1 line payment-table">Order Table 0</span>
							<div class="row pt-2">
								<div class="col-6 p-0">
									<span class="col-12 fs-11">Order number</span>
									<span class="col-12 text-bold fs-15 payment-order">0</span>
								</div>
								<div class="col-6 p-0 text-right">
									<span class="col-12 fs-11">Total</span>
									<span class="col-12 text-bold fs-15 payment-total">Rp 0</span>
								</div>
							</div>						
						</div>
				</div>

				<div class="col-12 mt-1 p-0 d-none" id="payment-method-back">
					<span class="col-12 p-0 fs-12 pointer">
						<i class="fa fa-arrow-left"></i> 
						Back to payment method
					</span>
				</div>

				<div class="col-12 mt-3 pt-3" id="payment-method">
				</div>
				
				<div class="row pl-3 pr-3 mt-3 d-none" id="payment-method-cash">
				payment cash
				</div>

				<div class="row pl-3 pr-3 mt-3 d-none" id="payment-method-noncash">
					<h3 class="row pt-3 pb-3">
						<b class="col-12">Payment Method :</b> 
						<b class="col-12 pt-1" id="noncash-type"></b>
					</h3>

					<div class="col-12 p-0" id="payment-noncash-detail">
							<div class="row">
								<span class="col-6">Total Item</span>
								<span class="col-6 text-right text-bold" id="payment-noncash-item"></span>
							</div>
							<div class="row">
								<span class="col-6">Grand Total</span>
								<span class="col-6 text-right text-bold" id="payment-noncash-grandtotal"></span>
							</div>
							<div class="row">
								<span class="col-6">Discount</span>
								<span class="col-6 text-right text-bold" id="payment-noncash-discount"></span>
							</div>
							<div class="row">
								<span class="col-6">Tax</span>
								<span class="col-6 text-right text-bold" id="payment-noncash-discount"></span>
							</div>
							<div class="row">
								<span class="col-6">Total</span>
								<span class="col-6 text-right text-bold" id="payment-noncash-total"></span>
							</div>
					</div>

					<div class="col-12 p-0 mt-2" id="payment-print">
						<div class="col-12 text-center btn-primary text-white p-3 mr-1">
						<span>PRINT</span>
						</div>	
					</div>
					<div class="col-12 p-0 mt-2" id="payment-finish">
						<div class="col-12 text-center btn-success text-white p-3 mr-1">
						<span>FINISH</span>
						</div>					
					</div>
				</div>			
			</div>	
		</div>
	</div><!--close col-4 bill order-->



	<!--change bill order-->
	<div class="col-4 mt-1 d-none" id="bill-order-change">
		<div class="row card">
				<div class="col-12 pt-3 pb-3">
					<div class="row b-bottom pb-3">
						<span class="col-6 text-bold"><i class="fa fa-bars"></i> Change list order</span>
						<span class="col-6 text-right pointer" id="close-bill-order-change"><i class="fa fa-close"></i></span>
					</div>
					<div class="row">
						<div class="col-6 mt-3">
						<h4>ITEM</h4>
						</div>
						<div class="col-6 mt-3 text-right">
						<h4><span class="badge badge-success total_item-change">0</span></h4>
						</div>	
					</div>				
				</div>

				<div class="col-12 pb-4">
				<form id="update-order" method="post" enctype="multipart/form-data">
					<table class="table table-hover table-vertical-scroll h-300 table-order-change">
						<tbody id="tbody-change">				
						</tbody>	
					</table>			
					<div class="row mt-3">
						<div class="col-12 fs-13">
							<div class="row">
							<span class="col-lg-6">Subtotal</span>
							<span class="col-lg-6 text-right price_subtotal-change">Rp 0</span>
							<span class="col-lg-6">Discount</span>
							<span class="col-lg-6 text-right price_discount-change">Rp 0</span>
							<span class="col-lg-6">Tax</span>
							<span class="col-lg-6 text-right price_tax-change">Rp 0</span>
							<span class="col-lg-12"><hr></span>

							<span class="col-6"><h5>TOTAL</h5></span>
							<span class="col-6 text-right price_total-change text-bold fs-15">Rp 0</span>
							</div>
						</div>					
						<div class="col-12">
							<input type="hidden" name="total" class="hide-total-change">
							<input type="hidden" name="sales_code" class="hide-sales-code-change">
							<input type="hidden" name="operator" value="<?php echo $_SESSION['pos-username']; ?>">
							<input type="hidden" name="aksi" value="update-order">
							<button type="submit" class="col-12 btn btn-primary">UPDATE</button>						
						</div>
					</div>
				</form>
				</div>
		</div>
	</div>
</div>

<!--close main row -->



















<!--MODALS-->

	<!--MODAL GET TABLE-->
	<div class="modal fade" id="modal-table" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Choose table number</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<span class="col-12 text-bold">LIST TABLE READY TO USED</span>
					<div class="col-12 table-vertical-scroll h-340 mt-2" id="listTable-modal">	
					</div>				
				</div>
			
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn-table-modal-yes">Yes</button>
				</div>
		</div>
		</div>
	</div>


	<!--MODAL PAYMENT DETAIL-->
	<div class="modal fade" id="payment-detail-modal" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Order Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="row text-bold">
						<div class="col-8">
						<span class="col-12" id="payment-modal-salescode"></span>
						</div> 
						<div class="col-4">
						<span class="col-12 text-right" id="payment-modal-qty"></span>	
						</div>
					</div>										
					<div class="col-12 table-vertical-scroll h-340 mt-2" id="listOrder_payment_detailorder">
					</div>				
				</div>
			
				<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
		</div>
		</div>
	</div>


	<!--MODAL PAYMENT CASH SHOW -->
	<div class="modal fade" id="payment-method-cash-modal" data-backdrop='static'>
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">PAYMENT CASH</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
				<div class="row">
					<div class="col-8">
						<div class="col-lg-12">
								<div class="row">
									<div class="col-12 pl-3">
										<span class="col-12 bg-secondary-outline text-white p-3 pr-0">
											<div class="row text-secondary">
											<span class="col-12 text-right text-bold">
											<span id="modal-payment-cash"></span>
											</span>
											</div>
										</span>
									</div>								
								</div>

								<div class="col-12 pt-2">
									<div class="row p-2 bg-material">
										<div class="col-8">
											<div class="row text-center pb-1">
												<span class="col-4 p-0 pr-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="7">7</span>
												</span>
												<span class="col-4 p-0 m-0 pr-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="8">8</span>
												</span>
												<span class="col-4 p-0 m-0">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="9">9</span>
												</span>												
											</div>

											<div class="row text-center pb-1">
												<span class="col-4 p-0 pr-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="4">4</span>
												</span>
												<span class="col-4 p-0 m-0 pr-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="5">5</span>
												</span>
												<span class="col-4 p-0 m-0">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="6">6</span>
												</span>												
											</div>

											<div class="row text-center pb-1">
												<span class="col-4 p-0 pr-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="1">1</span>
												</span>
												<span class="col-4 p-0 m-0 pr-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="2">2</span>
												</span>
												<span class="col-4 p-0 m-0">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="3">3</span>
												</span>	

												<span class="col-4 p-0 pr-1 pt-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="00">00</span>
												</span>
												<span class="col-4 p-0 m-0 pr-1 pt-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="0">0</span>
												</span>
												<span class="col-4 p-0 m-0 pt-1">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="x"><i class="fa fa-close pt-1 pb-1"></i></span>
												</span>															
											</div>
										</div>

										<div class="col-4">
											<div class="row text-center pl-1 pb-1">
												<span class="col-12 p-0">
												<span class="col-12 m-0 p-3 card pointer payment-input-number" data-id="clear">CLEAR</span>
												</span>
											</div>
											<div class="row text-center pl-1 pb-1">												
												<span class="col-12 p-0">
												<span class="col-12 m-0 p-3 card pointer payment-input-number btn-primary text-white" data-id="print"">PRINT</span>
												</span>
											</div>
											<div class="row text-center pl-1 pb-1">
												<span class="col-12 p-0">
												<span class="col-12 m-0 pt-4 pr-5 pb-5 pl-5 card pointer payment-input-number" data-id="enter">
												<b class="pt-3 pb-1">ENTER</b>
												</span>
												</span>
											</div>
										</div>

										<div class="col-12">											
											<div class="row text-center">
												<span class="col-12 p-0">
												<span class="col-12 m-0 p-3 card payment-input-number btn-primary" data-id="finish">FINISH</span>
												</span>								
											</div>
										</div>
									</div>
								</div>
						</div>							
					</div>
					<div class="col-4 pl-0">
						<div class="row text-bold pb-2">
						<span class="col-12">Order : <span id="modal-payment-sales-order"></span></span>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="row">
									<span class="col-6">Total Item</span>
									<span class="col-6 text-right" id="modal-payment-item"></span>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<span class="col-6">Grand Total</span>
									<span class="col-6 text-right" id="modal-payment-grand-total"></span>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<span class="col-6">Discount</span>
									<span class="col-6 text-right" id="modal-payment-discount"></span>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<span class="col-6">Total</span>
									<span class="col-6 text-right" id="modal-payment-total"></span>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<span class="col-6">Cash</span>
									<span class="col-6 text-right" id="modal-payment-cash-info"></span>
								</div>
							</div>
						</div>

						<div class="row text-bold pt-4 d-none" id="change-due">							
							<div class="col-12">
								<div class="row pt-3 pb-3">									
									<span class="col-12 text-right">CHANGE DUE</span>
									<span class="col-12 text-right fs-25" id="modal-payment-remine"></span>
								</div>
							</div>
						</div>

						<span class="row col-12 mt-3" id="modal-payment-msg-error"></span>
					</div>
				</div>
				</div>
			
				<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
		</div>
		</div>
	</div>


	<!--MODAL ALERT MESSAGE -->
	<div class="modal fade" id="alert-modal">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">ALERT</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<h6><span class="alert-msg"></span></h6>
				</div>
			
				<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
		</div>
		</div>
	</div>




<script type="text/javascript">

	//PRODUCT//
	function allProduct(url){
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'getAllProduct'},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				$('#list-product').html(data.output);
				$('#pages').val(data.pages);
			}
		})	
	}

	function Product(url,val) {
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'product':val,'aksi':'getProduct'},
			dataType: 'html',
			success: function(response){
				var data =  $.parseJSON(response);
				$('#list-product').html(data.output);				
			}
		})	
	}

	function menuProduct(url,val) {
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'menu':val,'aksi':'getProductByMenu'},
			dataType: 'html',
			success: function(response){
				var data =  $.parseJSON(response);
				$('#list-product').html(data.output);			
			}
		})	
	}

	function disableButton(id1,id2){
		$(id1,id2).css({
			'disabled': true,
			'cursor':' not-allowed',
			'background':'#444958'
		});
	}

	function enableButton(id1,id2){
		$(id1,id2).css({
			'disabled': false,
			'cursor':'pointer',
			'background':'#2f333e'
		});
	}



	//BILL ORDER//
	function addRow(image,product,price,product_code) {
		var tr_class= product.replace(/\s+/g,'').toLowerCase();
		var row = 
				'<tr class="'+tr_class+'">'+
					'<td class="w-60">'+
						'<div class="row">'+
						'<div class="col-lg-3">'+
						'<img src="'+image+'" alt="..." class="img-fluid rounded-circle">'+
						'</div>'+
						'<div class="col-md-7 p-0 m-0"">'+
						'<span class="product_item text-bold">'+product+'</span><br>'+
						'<span class="price_item">'+price+'</span>'+
						'</div>'+						
						'</div>'+
					'</td>'+
					'<td>'+
						'<span class="frame">'+
						'<span class="minus text-bold">-</span>'+
						'<span class="qty_item">'+1+'</span>'+
						'<span class="plus text-bold">+</span>'+
						'</span>'+
					'</td>'+
					'<td>'+
						'<input type="hidden" class="subtotal_item" value="'+price+'">'+
						'<input type="hidden" class="hide-prodcut_code" name="product_code[]" value="'+product_code+'">'+
						'<input type="hidden" class="hide-prodcut_qty"  name="qty[]" value="'+1+'">'+
						'<span class="remove-item"><i class="fa fa-close"></i></span>'+
					'</td>'+
				'</tr>';
			return row;
	}


	function listTable(url)
	{
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'listTable'},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				$('#listTable-modal').html(data.output);
			}
		})	
	}


	function listOrder(url){
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'listOrder'},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				$('#table-listorder').html(data.output);
			}
		})	
	}


	function listOrder_search(url,val){
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'listOrder_search','sales_code':val},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				$('#table-listorder').html(data.output);
			}
		})	
	}


	function listOrder_change(url,val){
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'listOrder_change','sales_code':val},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				if(data.status == 'success') 
				{
					var subtotal 	= data.subtotal;
					var total 	 	= data.total;
					var total_item  = data.total_item;
					var discount 	= data.discount; 

						$('#tbody-change').html(data.output);
						$('.price_discount-change').text(rupiah(discount));
						$('.price_subtotal-change').text(rupiah(subtotal));
						$('.price_total-change').text(rupiah(total));
						$('.total_item-change').text(total_item);						
						$('.hide-total-change').val(total);
				}
				else 
				{
					$('#tbody-change').html(data.output);
				}
			}
		})	
	}


	function listOrder_payment(url,val) {
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'listOrder_payment','sales_code':val},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				if(data.status == 'success') 
				{
					$('.payment-total').text(rupiah(data.total));
					$('.payment-table').text(data.table_code);
					$('.payment-order').text(data.sales_code);
					$('.detail-payment').attr('data-id', data.sales_code);

					setCookie('payment-total',rupiah(data.total));
					setCookie('payment-table',data.table_code);
					setCookie('payment-order',data.sales_code);
				}
			}
		})	
	}


	function listOrder_payment_detailorder(url,sales_code)
	{
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'listOrder_payment_detailorder','sales_code':sales_code},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				if(data.status == 'success') {
					$('#listOrder_payment_detailorder').html(data.output);
					$('#payment-modal-salescode').html(data.sales_code);
					$('#payment-modal-qty').html(data.total_item);
				}
				else {
					$('#listOrder_payment_detailorder').html(data.output);
				}
			}
		})	
	}


	function paymentMethod(url)
	{
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data  	: {'aksi':'paymentMethod'},
			dataType: 'html',
			success : function(response) {
				var data = $.parseJSON(response);
				if(data.status == 'success') {
					$('#payment-method').html(data.output);
				}
				else {
					$('#payment-method').html(data.output);
				}
			}
		})
	}

	function paymentCash(url,sales_code,id){
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'paymentCash','sales_code':sales_code,'id_payment':id},
			dataType: 'html',
			success : function(response) {
				var data = $.parseJSON(response);

				if(data.status == 'success') 
				{
					$('#modal-payment-sales-order').text(data.sales_code);
					$('#modal-payment-item').text(data.qty);
					$('#modal-payment-grand-total').text(data.grand_total);
					$('#modal-payment-discount').text(data.discount);
					$('#modal-payment-total').text(data.total);
					$('#modal-payment-cash-info').text('');
					$('#modal-payment-remine').text('');
					$('#modal-payment-msg-error').html('');
					$('#change-due').addClass('d-none');
					$('#payment-method-cash-modal').modal('show');
				}
				else {
					notification(data.msg,'right top','danger','notifDanger',5000);
					$('#modal-payment-sales-order').text('');
					$('#modal-payment-item').text('');
					$('#modal-payment-grand-total').text('');
					$('#modal-payment-discount').text('');
					$('#modal-payment-total').text('');
					$('#modal-payment-cash-info').text('');
					$('#modal-payment-remine').text('');
					$('#modal-payment-msg-error').html('');
					$('#change-due').addClass('d-none');
				}
			}
		})
	}

	function paymentNonCash(url,sales_code,id){
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':'paymentNonCash','sales_code':sales_code,'id_payment':id},
			dataType: 'html',
			success : function(response) {
				var data = $.parseJSON(response);

				if(data.status == 'success') 
				{
					$('#payment-noncash-item').text(data.qty);
					$('#payment-noncash-grandtotal').text(data.grand_total);
					$('#payment-noncash-discount').text(data.discount);
					$('#payment-noncash-total').text(data.total);
				}
				else 
				{
					$('#payment-noncash-item').text('');
					$('#payment-noncash-grandtotal').text('');
					$('#payment-noncash-discount').text('');
					$('#payment-noncash-total').text('');	
				}
			}
		})
	}

	function payamentFinish(url,sales_code,id_payment)
	{
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data  	: {'aksi':'paymentFinish','sales_code':sales_code,'id_payment':id_payment},
			dataType: 'html',
			success : function(response) {
				var data = $.parseJSON(response);
				if(data.status == 'success') {
					notification(data.msg,'right top','success','notifSuccess',5000);
				}
				else {
					notification(data.msg,'right top','danger','notifDanger',5000);
				}
			}
		})
	}


	$(document).ready(function() {
		var url 	  = 'process/P_sales.php';
		var arr_pages = [1];
		removeCookie('open');

		/*GENERAL*/ 			
			$('#list-product').ready(function() {
				allProduct(url);
			});

			$('#search-product').focus(function(event) {
				$(this).removeAttr('placeholder');	
				}).keyup(function(event) {
					var val = $(this).val();
					if(val == '') { allProduct(url); }
					else { Product(url,val); }
				}).blur(function(event) {
				$(this).attr('placeholder','Search Product ..');
			});

			$('.search-product-icon').click(function(event) {
				var val = $('#search-product').val();
				if(val == '') { $('#search-product').focus(); }
				else { Product(url,val); }
			});

			//chenge product
			$('#list-product').on('click', '.menu-product', function(){

				var image 		 = $(this).find('.img-product').attr('src');
				var product 	 = $(this).find('.label-product').text();
				var price 		 = $(this).find('.input-price').val();
				var product_code = $(this).find('.input-product_code').val();
				var priceInt 	 = toInteger(price);
				// alert(priceInt);

				//var discount	= priceInt*10/100;

				if(getCookie('menu') == 'menu-order')
				{
					var gTotal,sTotal,tr,disc;
					gTotal  = parseInt($('.total_item').text());
					sTotal  = $('.total_item').text(gTotal+1);
					tr 		= $('.table-order tr').length;					
					var gPrice_discount = toInteger($('.price_discount').text());
					// var dc = 0;

						// $.ajax({
						// 	type: "POST",
						// 	url: url,
						// 	async :false,
						// 	data: {
						// 		'aksi': "getDiscount",
						// 		'product_code' : product_code
						// 	},
						// 	success: function(data) {
						// 			//var hasil = $.parseJSON(data)
						// 			//console.log(hasil);
						// 			if(hasil.discount){
						// 				var discount=priceInt*(hasil.discount/100);
						// 				if(gPrice_discount){
						// 					discount=gPrice_discount+discount;
						// 					// dc += parseInt(discount);
						// 				}
						// 				$('.price_discount').text(rupiah(discount));
						// 				//  dc = discount
										
						// 			}
						// 	}
						// });
						// alert(dc);
					// disc = $
					// alert(discount);

						//add row table


						function Product(url,val) {
							$.ajax({
								url 	: url,
								type 	: 'POST',
								data 	: {'product':val,'aksi':'getDiscount'},
								dataType: 'html',
								success: function(response){
									var data =  $.parseJSON(response);
									$('#list-product').html(data.output);				
								}
							})	
						}
											
						if(tr < 1) 
						{ 
							$('.table-order').html(addRow(image,product,price,product_code));
							$('.price_subtotal').text(rupiah(price));
							$('.price_total').text(rupiah(price));
							$('.hide-total').val(priceInt);
							// alert(product_code);
						}
						else 
						{
							// alert(product_code);
							var order_product = [];				
							$('.table-order tr').find('.product_item').each(function(index, el) {
								var table_order = $(this).text();
								order_product.push(table_order);			
							});
							var same_product = [];
							for (var i = 0; i < order_product.length; i++) {
								if(order_product[i] == product) {
									same_product.push(product);
									
								}
							}

							if(same_product[0] == product) {
								
								var tr_class 		= product.replace(/\s+/g,'').toLowerCase();
								var gQty_item 		= parseInt($('.'+tr_class).find('.qty_item').text());
								var gSubtotal_item 	= toInteger($('.'+tr_class).find('.subtotal_item').val());

								var gPrice_subtotal = toInteger($('.price_subtotal').text());
								var gPrice_discount = toInteger($('.price_discount').text());
								var gPrice_total 	= toInteger($('.price_total').text());


								var subtotal_item 	= priceInt * (gQty_item+1);
								var subtotal 		= (gPrice_subtotal - gSubtotal_item) + subtotal_item;
								var total 	 		= subtotal - gPrice_discount;

								var sProduct_qty 	= $('.'+tr_class).find('.hide-prodcut_qty').val(gQty_item+1);
								var sqty_item 		= $('.'+tr_class).find('.qty_item').text(gQty_item+1);							
								var ssubtotal_item 	= $('.'+tr_class).find('.subtotal_item').val(rupiah(subtotal_item));
								var ssubtotal 		= $('.price_subtotal').text(rupiah(subtotal));
								var stotal 			= $('.price_total').text(rupiah(total));
								var htotal 			= $('.hide-total').val(total);
							}
							else {
								$('.table-order tr:last').after(addRow(image,product,price,product_code));

								var gPrice_subtotal = toInteger($('.price_subtotal').text());
								var gPrice_discount = toInteger($('.price_discount').text());
								var gPrice_total 	= toInteger($('.price_total').text());

								var subtotal = priceInt + gPrice_subtotal;
								var total 	 = subtotal + gPrice_discount;

								$('.price_subtotal').text(rupiah(subtotal));
								$('.price_total').text(rupiah(total));
								$('.hide-total').val(total);									
							}
						}		
				}
				else 
				{
					if(!!getCookie('open')) {

						if(getCookie('open') == 'menu-order-change')
						{
							var gTotal,sTotal,tr;
							gTotal  = parseInt($('.total_item-change').text());
							sTotal  = $('.total_item-change').text(gTotal+1);
							tr 		= $('.table-order-change tr').length;
							
							//add row table
								if(tr < 1) 
								{ 
									$('.table-order-change').html(addRow(image,product,price,product_code));
									$('.price_subtotal-change').text(rupiah(price));
									$('.price_total-change').text(rupiah(price));
									$('.hide-total-change').val(priceInt);
								}
								else 
								{
									var order_product = [];				
									$('.table-order-change tr').find('.product_item').each(function(index, el) {
										var table_order = $(this).text();
										order_product.push(table_order);			
									});
									var same_product = [];
									for (var i = 0; i < order_product.length; i++) {
										if(order_product[i] == product) {
											same_product.push(product);
										}
									}

									if(same_product[0] == product) {
										// alert(product);
										var tr_class 		= product.replace(/\s+/g,'').toLowerCase();
										var gQty_item 		= parseInt($('.'+tr_class).find('.qty_item').text());
										var gSubtotal_item 	= toInteger($('.'+tr_class).find('.subtotal_item').val());

										var gPrice_subtotal = toInteger($('.price_subtotal-change').text());
										var gPrice_discount = toInteger($('.price_discount-change').text());
										var gPrice_total 	= toInteger($('.price_total-change').text());


										var subtotal_item 	= priceInt * (gQty_item+1);
										var subtotal 		= (gPrice_subtotal - gSubtotal_item) + subtotal_item;
										var total 	 		= subtotal - gPrice_discount;

										var sProduct_qty 	= $('.'+tr_class).find('.hide-prodcut_qty').val(gQty_item+1);
										var sqty_item 		= $('.'+tr_class).find('.qty_item').text(gQty_item+1);							
										var ssubtotal_item 	= $('.'+tr_class).find('.subtotal_item').val(rupiah(subtotal_item));
										var ssubtotal 		= $('.price_subtotal-change').text(rupiah(subtotal));
										var stotal 			= $('.price_total-change').text(rupiah(total));
										var htotal 			= $('.hide-total-change').val(total);
									}
									else {
										$('.table-order-change tr:last').after(addRow(image,product,price,product_code));

										var gPrice_subtotal = toInteger($('.price_subtotal-change').text());
										var gPrice_discount = toInteger($('.price_discount-change').text());
										var gPrice_total 	= toInteger($('.price_total-change').text());

										var subtotal = priceInt + gPrice_subtotal;
										var total 	 = subtotal + gPrice_discount;

										$('.price_subtotal-change').text(rupiah(subtotal));
										$('.price_total-change').text(rupiah(total));
										$('.hide-total-change').val(total);									
									}
								}	
						}

					}//close getCookie;
					else 
					{
						$('#alert-modal').find('.alert-msg').text('Please select menu order product');
						$('#alert-modal').modal('show');
					}
				}
								
			});


		/*CATEGORY*/
			$('#cat').click(function(event) {
				$('#list-favorite').css({'display': 'none'});
				$('#show_product_all').css({'display': 'none'});

				$(this).addClass('active');
				$('.label-menu').text('| category');
				$('#list-cat').css({'display': 'block'});				
			});

				$('#cat-showAll').click(function(event) {
					$('#cat').removeClass('active');
					$('#list-cat').css({'display':'none'});
					$('#list-favorite').css({'display': 'none'});

					$('#show_product_all').css({'display': 'block'});
				});


				$('#cat-favorite').click(function(event) {
					$('#cat').removeClass('active');
					$('#list-cat').css({'display':'none'});
					$('#show_product_all').css({'display': 'none'});

					$('#list-favorite').css({'display': 'block'});
					$('.label-menu').text('| favorite');										
				});

				$('.cat-menu').click(function(event) {
					$('#cat').removeClass('active');
					$('#list-cat').css({'display':'none'});
					$('#list-favorite').css({'display': 'none'});

					$('#show_product_all').css({'display': 'block'});				
					var val 	= $(this).attr('data-value');
					var label 	= val.toLowerCase();
					$('.label-menu').text('| '+label);
					menuProduct(url,val);
				});


		/*FAVORITE*/
			$('#favorite').click(function(event) {
				$('#show_product_all').css({'display':'none'});
				$('#cat').removeClass('active');
				$('#list-cat').css({'display':'none'});

				$(this).addClass('active');
				$('.label-menu').text('| favorite');
				$('#list-favorite').css({'display':'block'});
			});


		/*PREVIOUS*/
			disableButton('#previous,#previous-label');
			$('#previous').click(function(event) {
				enableButton('#next,#next-label');
				var arr_length  = arr_pages.length;
				var pages 		= $('#pages').val();

				if(arr_length < 2) {
					disableButton('#previous,#previous-label');
				}
				else {
					arr_pages.shift();
					var newpage = arr_pages.length;
					$.ajax({
							url 	: url,
							type 	: 'POST',
							data 	: {'aksi':'getAllProduct','halaman':newpage},
							dataType: 'html',
							success	: function(response){
								var data =  $.parseJSON(response);
								$('#list-product').html(data.output);
							}
					})	
				}
			});


		/*NEXT*/
			$('#next').click(function(event) {
				enableButton('#previous,#previous-label');
				var arr_length  = arr_pages.length;
				var pages 		= $('#pages').val();

				if(arr_length >= pages){
					disableButton('#next,#next-label');
				} 
				else {
					arr_pages.push(1);					
					var newpage = arr_pages.length;				
					if(newpage <= pages) 
					{
						console.log(newpage);					
						$.ajax({
							url 	: url,
							type 	: 'POST',
							data 	: {'aksi':'getAllProduct','halaman':newpage},
							dataType: 'html',
							success	: function(response){
								var data =  $.parseJSON(response);
								$('#list-product').html(data.output);
							}
						})	
					}
				}
			});



		//BILL//
			var menu;
			var bill;

			if(!!getCookie('menu'))
			{
				menu = getCookie('menu');
				bill = getCookie('bill');
				$('#'+menu).addClass('active');
				$('#'+bill).addClass('d-block');
			}
			else 
			{
				setCookie('menu','menu-order');
				setCookie('bill','order-bill');

				menu = getCookie('menu');
				bill = getCookie('bill');

				$('#'+menu).addClass('active');
				$('#'+bill).addClass('d-block');
			}

			$('#menu-order').click(function(event) {
				$('#'+menu).removeClass('active');
				$('#'+bill).removeClass('d-block');
				clearCookie();
				setCookie('menu','menu-order');
				setCookie('bill','order-bill');

				menu = getCookie('menu');
				bill = getCookie('bill');
				$('#'+menu).addClass('active');
				$('#'+bill).addClass('d-block');
			});

			$('#menu-listOrder').click(function(event) {
				$('#'+menu).removeClass('active');
				$('#'+bill).removeClass('d-block');
				clearCookie();
				setCookie('menu','menu-listOrder');
				setCookie('bill','listOrder-bill');

				menu = getCookie('menu');
				bill = getCookie('bill');
				$('#'+menu).addClass('active');
				$('#'+bill).addClass('d-block');

				listOrder(url);
				$('#search-order_code').val('');

				if($('.listorder-checkbox').checked) { $('#button-listorder').removeClass('d-none'); }
				else { $('#button-listorder').addClass('d-none');}
			});

			$('#menu-payment').click(function(event) {
				$('#'+menu).removeClass('active');
				$('#'+bill).removeClass('d-block');
				clearCookie();
				setCookie('menu','menu-payment');
				setCookie('bill','payment-bill');

				menu = getCookie('menu');
				bill = getCookie('bill');

				$('#'+menu).addClass('active');
				$('#'+bill).addClass('d-block');

				paymentMethod(url);
			});


		//ORDER BILL//
		// min item 
		$('.table-order').on('click', '.minus', function(event) {
			event.preventDefault();

			var gQty_item = toInteger($(this).parent().find('.qty_item').text());
			var gPrice_item = toInteger($(this).closest('tr').find('.price_item').text());
			var gPrice_subtotal = toInteger($('.price_subtotal').text());
			var gPrice_discount = toInteger($('.price_discount').text());

			var subtotal_item = gPrice_item * (gQty_item - 1);
			var subtotal = gPrice_subtotal - gPrice_item;
			var total = subtotal - gPrice_discount;

			if (gQty_item > 1) {
				$(this).parent().find('.qty_item').text(gQty_item - 1);
				$(this).closest('tr').find('.subtotal_item').val(rupiah(subtotal_item));

				$('.price_subtotal').text(rupiah(subtotal));
				$('.price_total').text(rupiah(total));
				$('.hide-total').val(total);

				// Menghitung ulang diskon berdasarkan subtotal yang baru
				//var product_code = $(this).closest('tr').find('.input-product_code').val();

				var product_code = $(this).closest('tr').find('.input-product_code').val();

						$.ajax({
							type: "POST",
							url: url,
							async :false,
							data: {
								'aksi': "getDiscount",
								'product_code': product_code
							},
							success: function(data) {
								var hasil = $.parseJSON(data);
								console.log(hasil);
								if (hasil.discount) {
									var priceInt = gPrice_item; // Gunakan harga item yang baru setelah penambahan
									var new_discount = priceInt * (hasil.discount / 100);
									if (gPrice_discount) {
										new_discount = gPrice_discount - new_discount;
									}
									$('.price_discount').text(rupiah(new_discount));
									// Update nilai dc dengan diskon yang baru
									var dc = parseInt(new_discount);
									console.log("New Discount:", dc);
								}
							}
						});
			}
		});


		// plus item 
		$('.table-order').on('click', '.plus', function(event) {
			event.preventDefault();

				var gQty_item = toInteger($(this).parent().find('.qty_item').text());
				var gPrice_item = toInteger($(this).closest('tr').find('.price_item').text());
				var gPrice_subtotal = toInteger($('.price_subtotal').text());
				var gPrice_discount = toInteger($('.price_discount').text());

				var subtotal_item = gPrice_item * (gQty_item + 1);
				var subtotal = gPrice_subtotal + gPrice_item;
				var total = subtotal - gPrice_discount;

				$(this).parent().find('.qty_item').text(gQty_item + 1);
				$(this).closest('tr').find('.subtotal_item').val(rupiah(subtotal_item));

				$('.price_subtotal').text(rupiah(subtotal));
				$('.price_total').text(rupiah(total));
				$('.hide-total').val(total);

				var product_code = $(this).closest('tr').find('.input-product_code').val();

				$.ajax({
					type: "POST",
					url: url,
					async :false,
					data: {
						'aksi': "getDiscount",
						'product_code': product_code
					},
					success: function(data) {
						var hasil = $.parseJSON(data);
						console.log(hasil);
						if (hasil.discount) {
							var priceInt = gPrice_item; // Gunakan harga item yang baru setelah penambahan
							var new_discount = priceInt * (hasil.discount / 100);
							if (gPrice_discount) {
								new_discount = gPrice_discount + new_discount;
							}
							$('.price_discount').text(rupiah(new_discount));
							// Update nilai dc dengan diskon yang baru
							var dc = parseInt(new_discount);
							console.log("New Discount:", dc);
						}
					}
				});
			});

			// remove item 
			$('.table-order').on('click', '.remove-item', function(event) {
				event.preventDefault();
				var gSubtotal_item = toInteger($(this).parent().find('.subtotal_item').val());
				var gPrice_subtotal = toInteger($('.price_subtotal').text());
				var gPrice_discount = toInteger($('.price_discount').text());

				var subtotal = gPrice_subtotal - gSubtotal_item;
				var total = subtotal - gPrice_discount;

				// Menghitung ulang diskon berdasarkan subtotal yang baru
				var product_code = $(this).closest('tr').find('.input-product_code').val();

				$.ajax({
					type: "POST",
					url: url,
					async :false,
					data: {
						'aksi': "getDiscount",
						'product_code': product_code
					},
					success: function(data) {
						var hasil = $.parseJSON(data);
						console.log(hasil);
						if (hasil.discount) {
							var new_discount = subtotal * (hasil.discount / 100);
							$('.price_discount').text(rupiah(new_discount));
							// Update nilai dc dengan diskon yang baru
							var dc = parseInt(new_discount);
							console.log("New Discount:", dc);
						}
					}
				});

				$('.price_subtotal').text(rupiah(subtotal));
				$('.price_total').text(rupiah(total));
				$('.hide-total').val(total);

				
			});

			$('#modal-table').on('show.bs.modal', function (event){ 	
	    		listTable(url);
	    	});

			$(document).on('click', '.list-table-ready', function(event) {
				event.preventDefault();
				var table_id = $(this).closest('.list-table-ready').find('.table_id-modal-hidden').val();

	    		$(this).closest('.list-table-ready').css({'background':'#f3f3f3'});
	    		$(this).closest('.list-table-ready').find('.table_id-modal').addClass('table-selected');
	    		$(this).closest('.list-table-ready').find('.checked-modal').removeClass('d-none');
	    		$(this).closest('.list-table-ready').find('.table_id-modal').val(table_id);

	    		$(this).siblings('.list-table-ready').css({'background':'none'});
	    		$(this).siblings('.list-table-ready').find('.table_id-modal').val('');
	    		$(this).siblings('.list-table-ready').find('.table_id-modal').removeClass('table-selected');
	    		$(this).siblings('.list-table-ready').find('.checked-modal').addClass('d-none');		
			});

	    	$('#btn-table-modal-yes').click(function(event) {
	    		event.preventDefault();	    			
	    		var table_id = $('.table-selected').val();
	    			
	    			$('.hide-table_id').val(table_id);
	    			$('#modal-table').modal('hide');
	    	});

			$(document).on('submit', '#add-order', function(event) {
				event.preventDefault();
				$('.checked-modal').addClass('d-none');
				$.ajax({
					url 	: url,
					type 	: 'POST',
					data 	: $('#add-order').serialize(),
					dataType: 'html',
					success	: function(response){
						var data =  $.parseJSON(response);
						
						if(data.status == 'success') {
							
							$('.table-order tr').each(function(index, el) {
								$(this).remove();
							});
							$('.total_item').text(0); 
							$('.price_subtotal').text('Rp 0');
							$('.price_discount').text('Rp 0');
							$('.price_total').text('Rp 0');
							$('.hide-total').val(0);
							notification(data.msg,'right top','success','notifSuccess',5000);
						}
						else {
							notification(data.msg,'right top','warning','notifWarning',5000); 
						}
					}
				});	

				$('.hide-table_id').val('');
			});


		//LIST ORDER//
			listOrder(url);

			$(document).on('change', '.listorder-checkbox', function(event) {
				event.preventDefault();
				var val = $(this).val();
				$(this).closest('.listorder-container').siblings().find('.listorder-checkbox').prop('checked', false);
				$(this).closest('.listorder-container').css({'background':'#f3f3f3'});
				$(this).closest('.listorder-container').siblings().css({'background':'none'});

				if(this.checked) { $('#button-listorder').removeClass('d-none'); }
				else { $('#button-listorder').addClass('d-none');}
			});

			$(document).on('click', '.listorder-detail', function(event) {
				var val = $(this).attr('data-id');
				
				$('#id-'+val).css({'background':'#FFFFFF'});
				$(this).closest('.listorder-container').css({'background':'#f3f3f3'});
				$(this).closest('.listorder-container').siblings().css({'background':'none'});			
				$(this).closest('.listorder-container').siblings().find('.collapse').collapse('hide');
			});		

			$(document).on('click', '.btn-pay', function(event) {
				event.preventDefault();
				var val = $(this).val();

					/*
					 * COOKIE
					 */					
						$('#'+menu).removeClass('active');
						$('#'+bill).removeClass('d-block');
						clearCookie();
						setCookie('menu','menu-payment');
						setCookie('bill','payment-bill');

						menu = getCookie('menu');
						bill = getCookie('bill');

						$('#'+menu).addClass('active');
						$('#'+bill).addClass('d-block');

					/*
					 * PAYMENT METHOD 
					 */						
						$('#payment-method').removeClass('d-none');
						$('#payment-method-back').addClass('d-none');
						$('#payment-method-noncash').addClass('d-none');
						$('#payment-method-cash').addClass('d-none');

						listOrder_payment(url,val);
						paymentMethod(url);
			});

			$('#search-order_code').keyup(function(event) {
				var val = $(this).val();
				listOrder_search(url,val);
			});

			$('#listorder-print').click(function(event) {
				var data_checked = $('.listorder-checkbox:checked').val();
				var code 		 = btoa(data_checked);
				window.open('Http://localhost/pos/report/print-order.php?id='+code, 'POS', 'width=100, height=200, '); 				
			});

			$('#listorder-change').click(function(event) {
				event.preventDefault();
				setCookie('open','menu-order-change');

				var data_checked = $('.listorder-checkbox:checked').val();

					$('#bill-order').addClass('d-none');
					$('#bill-order-change').removeClass('d-none');
					$('.hide-sales-code-change').val(data_checked);

					listOrder_change(url,data_checked);
			});	
			//form change listorder
				$('#close-bill-order-change').click(function(event) {
					event.preventDefault();
					removeCookie('open');

						$('#bill-order-change').addClass('d-none');
						$('#bill-order').removeClass('d-none');
				});

				$('.table-order-change').on('click', '.minus', function(event) {
					event.preventDefault();
						
						var gQty_item 		= toInteger($(this).parent().find('.qty_item').text());
						var gPrice_item 	= toInteger($(this).closest('tr').find('.price_item').text());
						var gSubtotal_item  = toInteger($(this).closest('tr').find('.subtotal_item').val());

						
						var gTotal_item 	= toInteger($('.total_item-change').text());					
						var gPrice_subtotal = toInteger($('.price_subtotal-change').text());
						var gPrice_discount = toInteger($('.price_discount-change').text());

						
						if (gQty_item > 1) {
							var subtotal_item  	= gPrice_item * (gQty_item-1);
							var subtotal 		= gPrice_subtotal - gPrice_item;
							var total 			= subtotal - gPrice_discount;

							$(this).parent().find('.qty_item').text(gQty_item-1);

							$(this).closest('tr').find('.subtotal_item').val(rupiah(subtotal_item));
							$(this).closest('tr').find('.hide-prodcut_qty').val(gQty_item-1);
							
							$('.total_item-change').text(gTotal_item-1);
							$('.price_subtotal-change').text(rupiah(subtotal));
							$('.price_total-change').text(rupiah(total));
							$('.hide-total-change').val(total);				
						}

				});

				$('.table-order-change').on('click', '.plus', function(event) {
					event.preventDefault();
						
						var gQty_item 		= toInteger($(this).parent().find('.qty_item').text());
						var gPrice_item 	= toInteger($(this).closest('tr').find('.price_item').text());
						var gSubtotal_item  = toInteger($(this).closest('tr').find('.subtotal_item').val());

						var gTotal_item 	= toInteger($('.total_item-change').text());	
						var gPrice_subtotal = toInteger($('.price_subtotal-change').text());
						var gPrice_discount = toInteger($('.price_discount-change').text());

						var subtotal_item  	= gPrice_item * (gQty_item+1);
						var subtotal 		= gPrice_subtotal + gPrice_item;
						var total 			= subtotal - gPrice_discount;


						$(this).parent().find('.qty_item').text(gQty_item+1);

						$(this).closest('tr').find('.subtotal_item').val(rupiah(subtotal_item));
						$(this).closest('tr').find('.hide-prodcut_qty').val(gQty_item+1);
						
						$('.total_item-change').text(gTotal_item+1);
						$('.price_subtotal-change').text(rupiah(subtotal));
						$('.price_total-change').text(rupiah(total));
						$('.hide-total-change').val(total);					
				});

				$('.table-order-change').on('click', '.remove-item', function(event) {
					event.preventDefault();

					var gQty_item 		= toInteger($(this).closest('tr').find('.qty_item').text());
					var gSubtotal_item 	= toInteger($(this).parent().find('.subtotal_item').val());
					var gPrice_subtotal = toInteger($('.price_subtotal-change').text());
					var gPrice_discount = toInteger($('.price_discount-change').text());
					var gTotal_item 	= toInteger($('.total_item-change').text());

					var subtotal = gPrice_subtotal - gSubtotal_item;
					var total 	 = subtotal - gPrice_discount;

					$('.total_item-change').text(gTotal_item - gQty_item);
					$('.price_subtotal-change').text(rupiah(subtotal));
					$('.price_total-change').text(rupiah(total));
					$('.hide-total-change').val(total);
				
					$(this).closest('tr').remove();
				});


				$(document).on('submit', '#update-order', function(event) {
					event.preventDefault();
					$.ajax({
						url 	: url,
						type 	: 'POST',
						data 	: $('#update-order').serialize(),
						dataType: 'html',
						success	: function(response){
							var data =  $.parseJSON(response);
							listOrder(url);

							if(data.status == 'success') {
								notification(data.msg,'right top','success','notifSuccess',5000);
								$('#button-listorder').addClass('d-none')
								$('#bill-order-change').addClass('d-none');
								$('#bill-order').removeClass('d-none');							
							}
							else {								
								notification(data.msg,'right top','warning','notifWarning',5000); 
							}
						}
					});	
				});


		//PAYMENT//
			paymentMethod(url);
			var id_payment = [];

			if(!!getCookie('payment-order'))
			{
				$('.payment-total').text(getCookie('payment-total'));
				$('.payment-table').text(getCookie('payment-table'));
				$('.payment-order').text(getCookie('payment-order'));
			}


			$('#payment-detail-modal').on('show.bs.modal', function (e){ 
	    		var id = $(e.relatedTarget).attr('data-id');	    		
		    	listOrder_payment_detailorder(url,id);
	    	});

			
			$(document).on('click', '.payment-method', function(event) {
				event.preventDefault();
				var data 	= $(this).closest('span').attr('data-id');
	    		var split 	= data.split('&');
	    		var id 		= split[0];
	    		var payment = split[1];
	    		var sales_code = $('.detail-payment').attr('data-id');

	    			id_payment = [];
	    			id_payment.push(id);	    			
    		
		    		if(payment == 'cash' || payment == 'Cash') 
		    		{		    			 
		    			paymentCash(url,sales_code,id);
		    		}
		    		else 
		    		{
		    			$('#payment-method').addClass('d-none');
	    				$('#payment-method-back').removeClass('d-none');
		    			
		    			$('#payment-method-noncash').removeClass('d-none');
		    			$('#noncash-type').text(payment);

		    			//hide button finish & print
		    			if(sales_code == '') { 
		    				$('#payment-finish').addClass('d-none'); 
		    				$('#payment-print').addClass('d-none');
		    			}
		    			else { 
		    				$('#payment-finish').removeClass('d-none'); 
		    				$('#payment-print').removeClass('d-none');
		    			} 

		    			paymentNonCash(url,sales_code,id);
		    		}
			});
		

	    	$('#payment-method-back').click(function(event) {
	    		$(this).addClass('d-none');
	    		$('#payment-method').removeClass('d-none');
	    		$('#payment-method-noncash').addClass('d-none');
	    	});


	    	//payment non cash
		    	$('#payment-finish').click(function(event) {
		    		var payment 	= id_payment[0];
		    		var sales_code  = $('#payment-detail').find('.payment-order').text();
		    		var code 		= btoa(sales_code);

					payamentFinish(url,sales_code,payment);

					/*
					 * SET COOKIE
					 */
						$('#'+menu).removeClass('active');
						$('#'+bill).removeClass('d-block');
						clearCookie();
						setCookie('menu','menu-listOrder');
						setCookie('bill','listOrder-bill');

						menu = getCookie('menu');
						bill = getCookie('bill');

						$('#'+menu).addClass('active');
						$('#'+bill).addClass('d-block');
						listOrder(url);

					/*
					 * SET FORM NULL
					 */
						$('.payment-total').text('Rp 0');
						$('.payment-table').text('Rp 0');
						$('.payment-order').text('Order Table 0');
						$('.detail-payment').attr('data-id', '');

						$('#payment-method').removeClass('d-none');
						$('#payment-method-back').addClass('d-none');
						$('#payment-method-noncash').addClass('d-none');
						$('#payment-method-cash').addClass('d-none');
		    	});

		    	$('#payment-print').click(function() {
		    		var payment 	= $('#noncash-type').text();
		    		var code 		= $('#payment-detail').find('.payment-order').text();
		    		 	code 		= btoa(code);
		    		 	payment 	= btoa(payment);
		    			window.open('Http://localhost/pos/report/print-order-finish.php?id='+code+'&pay='+payment, 'POS', 'width=100, height=200, ');
		    	});


	    	//payment cash
				$('.payment-input-number').click(function(event) {
						event.preventDefault();
						var data 	= $(this).attr('data-id');

							if(data == 'clear') { $('#modal-payment-cash').text(''); }
							else if(data == 'enter')
							{	
								var cash  	 = $('#modal-payment-cash').text();
								var total 	 = $('#modal-payment-total').text();
								
									if(cash != '') 
									{								
										total 	= toInteger(total);
										cash  	= toInteger(cash);
										remine 	= cash-total;
										
										$('#modal-payment-cash-info').text(rupiah(cash));
										$('#modal-payment-remine').text(rupiah(remine));
										$('#change-due').removeClass('d-none');
										$('#modal-payment-cash').text('');
									}
							}
							else if(data == 'print')
							{
								var cashInfo = $('#modal-payment-cash-info').text();
								var code 	 = $('#modal-payment-sales-order').text();
									
									if(cashInfo != '')
									{
										payment 	= btoa('cash');
										cashInfo 	= btoa(toInteger(cashInfo));
										code 		= btoa(code);
										window.open('Http://localhost/pos/report/print-order-finish.php?id='+code+'&pay='+payment+'&c='+cashInfo, 'POS', 'width=100, height=200, ');
									}
									else { $('#modal-payment-msg-error').html(alertDanger('Plese enter cash'));}							
							}
							else if(data == 'finish')
							{
								var payment 	= id_payment[0];
			    				var sales_code  = $('#modal-payment-sales-order').text();
								
								$('#payment-method-cash-modal').modal('hide');
								payamentFinish(url,sales_code,payment);
								$('#button-listorder').addClass('d-none');

								/*
								 * SET COOKIE
								 */
									$('#'+menu).removeClass('active');
									$('#'+bill).removeClass('d-block');
									clearCookie();
									setCookie('menu','menu-listOrder');
									setCookie('bill','listOrder-bill');


									menu = getCookie('menu');
									bill = getCookie('bill');

									$('#'+menu).addClass('active');
									$('#'+bill).addClass('d-block');
									listOrder(url);

							}
							else if(data == 'X' || data == 'x' )
							{
								var cashOld 	= $('#modal-payment-cash').text();
								if(cashOld == '') { cash = ''; }
								else 
								{
									var cashOld 	= toInteger(cashOld);
									var cashOld 	= cashOld.toString();
									var leng 		= cashOld.length;
									var splice 		= cashOld.slice(0, -1);

									if(leng < 2) { cash = ''; }
									else { cash = rupiah(splice);}
								}
								$('#modal-payment-cash').text(cash);
							}
							else 
							{
								var cashOld 	= $('#modal-payment-cash').text();
								if(cashOld == '') { cashOld = cashOld; }
								else { cashOld = toInteger(cashOld); }							 
									var data 	 = data;
									var cash 	 = cashOld+data;
									$('#modal-payment-cash').text(rupiah(cash));
							}
				});

	});
</script>
