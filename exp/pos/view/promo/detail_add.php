<?php
$promo = $_GET['promo'];
?>


<div class="mt-3">
<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
		<div class="card mb-0">
				<div class="col-md-12 mt-4">
					<div class="row">
						<div class="col-lg-6">
						<i class="fa fa-info-circle"></i> NEW  | <span>Promo Detail</span>
						</div>
						<div class="col-lg-6 pr-4 text-right">
						<span class="pointer" id="btn-close"><i class="fa fa-close"></i> Close</span>
						</div>
					</div>
				</div><hr>

				<div class="card-body mb-5 h-450">
					<div class="row">
					<div class="col-lg-12 col-sm-12">
						<form id="form-input" method="post" enctype="multipart/form-data">
							<span class="pb-3 col-8" id="error-msg"></span>
							<div class="col-lg-12 col-sm-12">

								<div class="row col-lg-12 mt-3">
									<label class="row col-lg-3 col-sm-10">Promo Type</label>
									<div class="row col-lg-5 col-sm-12">
									<div class="input-group">
										<input type="text" class="form-control bor-left" name="product" id="product" autocomplete="off" readonly="" value="ALL PRODUCT">
										<div class="input-group-append">
										<button type="button" class="btn btn-primary bor-right" id="btn-product">custom</button>
										</div>
										<div class="text-danger col-lg-12 row"></div>
									</div>
									</div>
								</div>
								<div class="row col-lg-12 mt-3">
									<label class="row col-lg-3 col-sm-10">Payment Type</label>
									<div class="row col-lg-4 col-sm-12">
									<div class="input-group">
										<input type="text" class="form-control bor-left" name="payment" id="payment" autocomplete="off" readonly="" value="ALL PAYMENT">
										<div class="input-group-append">
											<button type="button" class="btn btn-primary bor-right" id="btn-payment">custom</button>
										</div>
										<div class="text-danger col-lg-12 row"></div>
									</div>
									</div>
								</div>
								<div class="row col-lg-12 mt-3">
									<label class="row col-lg-3 col-sm-10">Discount</label>
									<div class="row col-lg-2 col-sm-12">
										<div class="input-group">
											<input type="text" class="form-control bor-left number" name="discount" id="discount" maxlength="3" autocomplete="off">
											<div class="input-group-append">
												<button type="button" class="btn btn-secondary bor-right">%</button>
											</div>
											<div class="text-danger col-md-12 row"></div>
										</div>
									</div>
								</div>

							</div>
							<input type="hidden" name="aksi" 		value="addPromoDetail">
							<input type="hidden" name="promo_id" 	value="<?php echo $promo ?>">
							<input type="hidden" name="promo_type"    	id="promo_type" value="all">
							<input type="hidden" name="promo_payment" 	id="promo_payment" value="all">
							<input type="hidden" name="id_payment" 		id="id_payment">
							<input type="hidden" name="id_product"  	id="id_product">
							<button type="submit" class="btn btn-primary btn-sm btn-float"> <b>SAVE</b></button>
						</form>
					</div>
					</div>	<!--close row-->
				</div>

		</div>
		</div>
	</div>
</div>
</div>





<!--modal primary -->
	<div class="modal fade" id="modal-product" data-backdrop="static">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">PRODUCT</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="col-12">
					<span class="pb-2 text-bold">List Product</span>
					</div>

					<div class="row text-bold fs-13 pb-1">
						<div class="col-5"><span class="col-12">PRODUCT</span></div>
						<div class="col-2 text-right"><span class="col-12">PRICE</span></div>
						<div class="col-5 text-right"><span class="col-12">SELECT</span></div>		
					</div>
					<div class="col-12 table-vertical-scroll h-350" id="list-product">
					</div>

					<div class="col-12 btn-primary mt-4 text-center d-none" id="btn-yes-modal-product">
						<span class="col-12 pt-3 pb-3">SELECTED</span>
					</div>
				</div>
		</div>
		</div>
	</div>

	<div class="modal fade" id="modal-payment" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">PAYMENT</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="col-12">
					<span class="pb-2 text-bold">List Payment</span>
					</div>

					<div class="row text-bold fs-13 pb-1">
						<div class="col-6"><span class="col-12">TYPE</span></div>
						<div class="col-6 text-right"><span class="col-12">SELECT</span></div>	
					</div>
					<div class="col-12 table-vertical-scroll h-250" id="list-payment">
					</div>

					<div class="col-12 btn-primary mt-4 text-center d-none" id="btn-yes-modal-payment">
						<span class="col-12 pt-2 pb-2">SELECTED</span>
					</div>
				</div>
		</div>
		</div>
	</div>






<script>
	function formInput(url) {
		loading("Please wait ...");
		$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	:  $('#form-input').serialize(),
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					if(data.status == 'success') {
						$('body').loadingModal('destroy');
						history.go(-1);
					}
					else {
						$('body').loadingModal('destroy');
						$('#error-msg').html(alertDanger(data.msg));
					}
				}
		})
	}

	function listProduct(url) {
		$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	: {'aksi':'listProduct'},
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					if(data.status == 'success') {
						$('#modal-product').find('#list-product').html(data.output);
					}
					else 
					{
						$('#modal-product').find('#list-product').html(data.output);
					}
				}
		})
	}

	function listPayment(url) {
		$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	: {'aksi':'listPayment'},
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					if(data.status == 'success') {
						$('#modal-payment').find('#list-payment').html(data.output);
					}
					else 
					{
						$('#modal-payment').find('#list-payment').html(data.output);
					}
				}
		})
	}
</script>


<script>
	$(document).ready(function() {
		/*
		 * GLOBAL VARIABLE
		 */
			var URL = 'process/P_promo_detail.php';
			var ARR_PAYMENTID 	= [];
			var ARR_PAYMENT 	= [];
			var ARR_PRODUCTID 	= [];
			var ARR_PRODUCT 	= []; 

		/*
		 * Button
		*/
			$('#btn-close').click(function(event) {
				history.go(-1);
			});

			$('#btn-product').click(function(event) {
				event.preventDefault();
				var text 	= $(this).text();

					if(text == 'custom') {
						listProduct(URL);
						$('#modal-product').modal('show');
					}
					else 
					{
						$('#btn-product').text('custom');
		    			$('#product').val('ALL PRODUCT');
		    			$('#id_product').val('');
		    			$('#promo_type').val('all');		    			
					}				
			});

			$('#btn-payment').click(function(event) {
				event.preventDefault();
				var text 	= $(this).text();

					if(text == 'custom') {
						listPayment(URL);
						$('#modal-payment').modal('show');
					}
					else 
					{						
						$('#btn-payment').text('custom');
		    			$('#payment').val('ALL PAYMENT');
		    			$('#id_payment').val('');
		    			$('#promo_payment').val('all');
					}				
			});


		/*
		 * INPUT
		*/		
			$('#discount').blur(function(event) {
				var val = $(this).val();
				if(val == '') { error(this,'Please complete the form');}
				else { success(this);}
				}).keyup(function(event) {
					var val = $(this).val();
					if(val == '') { error(this,'Please complete the form');}
					else { success(this);}
			});

	    	$('#modal-product').on('click', '.list-table-ready', function(event) {
				event.preventDefault();
				ARR_PRODUCTID = [];
				ARR_PRODUCT   = [];
				var id 	 = $(this).closest('.list-table-ready').find('.hidden-table-id').val();
				var name = $(this).closest('.list-table-ready').find('.hidden-table-name').val();
				ARR_PRODUCTID.push(id);
				ARR_PRODUCT.push(name);

				/*
				 * view table
				 */ 
		    		$(this).closest('.list-table-ready').css({'background':'#f3f3f3'});
		    		$(this).closest('.list-table-ready').find('.checked-modal').removeClass('d-none');
		    		$(this).siblings('.list-table-ready').css({'background':'none'});    		
		    		$(this).siblings('.list-table-ready').find('.checked-modal').addClass('d-none');
		    	/*
		    	 * chose
		    	 */ 
		    	 	$('#btn-yes-modal-product').removeClass('d-none');
			});

			$('#btn-yes-modal-product').click(function(event) {
	    		event.preventDefault();
	    			id_product 	= ARR_PRODUCTID[0]; 
	    			product 	= ARR_PRODUCT[0];	

	    			$('#modal-product').modal('hide');
	    			$('#btn-product').text('all');
	    			$('#product').val(product);
	    			$('#id_product').val(id_product);
	    			$('#promo_type').val('custom');	    			
	    	});



	    	$('#modal-payment').on('click', '.list-table-ready', function(event) {
				event.preventDefault();
				ARR_PAYMENTID = [];
				ARR_PAYMENT   = [];
				var id 	 = $(this).closest('.list-table-ready').find('.hidden-table-id').val();
				var name = $(this).closest('.list-table-ready').find('.hidden-table-name').val();
				ARR_PAYMENTID.push(id);
				ARR_PAYMENT.push(name);

				/*
				 * view table
				 */ 
		    		$(this).closest('.list-table-ready').css({'background':'#f3f3f3'});
		    		$(this).closest('.list-table-ready').find('.checked-modal').removeClass('d-none');
		    		$(this).siblings('.list-table-ready').css({'background':'none'});    		
		    		$(this).siblings('.list-table-ready').find('.checked-modal').addClass('d-none');
		    	/*
		    	 * chose
		    	 */ 
		    	 	$('#btn-yes-modal-payment').removeClass('d-none');
			});

	    	$('#btn-yes-modal-payment').click(function(event) {
	    		event.preventDefault();
	    			id_payment 	= ARR_PAYMENTID[0]; 
	    			payment 	= ARR_PAYMENT[0];	

	    			$('#modal-payment').modal('hide');
	    			$('#btn-payment').text('all');
	    			$('#payment').val(payment);
	    			$('#id_payment').val(id_payment);
	    			$('#promo_payment').val('custom');	    			
	    	});


		/*
		 * FORM
		*/
			$('#form-input').submit(function(event) {
				event.preventDefault();
				var valid = true;

					$(this).find('input[type=text]').each(function() {
						if(!$(this).val()) {
							error(this,"Please complete the form");
							valid= false;
						}
						if ($(this).hasClass('is-invalid')){
		                	valid = false;
		                	$('.is-invalid').focus();
		            	}
					});
					if(valid) {formInput(URL);}
			});
	});
</script>
