<?php 
	
	$product 	= $_GET['product'];
	$id 	 	= base64_decode($_GET['id']);

	$db  		= model('M_product');
	$fetch 		= $db->get_product_by_id($product,$id);
	$data 		= $fetch['data'];

?>


<div class="breadcrumb-holder container-fluid">
	<div class="row pt-3">
		<div class="row col-md-6 col-sm-12">
			<ul class="breadcrumb action-bar">				
				<li class="mr-4">
					<a href="#" id="back" data-id='index.php?page=product&sub=view&product=<?php echo $product ?>'>
					<i class="fa fa-arrow-left"></i> Back</a>
				</li>
			</ul>
		</div>
		<div class="col-md-6 col-sm-12">
			<ul class="breadcrumb fa-pull-right">
			<li class="breadcrumb-item active"><b>PRODUCT</b></li>
			<li class="breadcrumb-item active"><b> Edit <?php echo $product; ?></b></li>
			<li class="breadcrumb-item active"><b><?php echo $data['product']; ?></b></li>
			</ul>
		</div>
	</div>	
</div>

<div class="mt-3">
<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
		<div class="card mb-0">
				<div class="col-md-12 mt-4">
					<div class="col-md-12">
					<i class="fa fa-info-circle"></i> EDIT <?php echo strtoupper($product); ?> | <span>product</span>
					</div>					
				</div><hr>
				<div class="card-body mb-5">
					<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="col-md-12 col-sm-12">						
						<form id="form_product_edit" method="post" enctype="multipart/form-data">
							<div class="row col-md-12">
								<label class="row col-md-3 col-sm-10">Product Code</label>
								<div class="row col-md-3 col-sm-12">
									<input type="text" name="product_code" class="form-control" id="product_code" maxlength="20" autocomplete="off"
									value="<?php echo $data['product_code']; ?>">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<div class="text-danger col-md-12 row"></div>
								</div>		
							</div>

							<div class="row col-md-12 mt-3">
								<label class="row col-md-3 col-sm-10">Product</label>
								<div class="row col-md-9 col-sm-12">
									<input type="text" name="product" class="form-control" id="product" maxlength="100" autocomplete="off"
									value="<?php echo $data['product']; ?>">
									<div class="text-danger col-md-12 row"></div>
								</div>		
							</div>

							<div class="row col-md-12 mt-3">								
								<label class="row col-md-3 col-sm-10">Category</label>
								<div class="row col-md-6 col-sm-12">
									<div class="input-group">
										<input type="text" class="form-control" name="submenu" id="autoInput" maxlength="100" autocomplete="off"
										value="<?php echo $data['submenu']; ?>">
										<div class="input-group-append">
										<button type="button" class="btn btn-primary bor-right btn-category" data-toggle="modal" data-target="#modal-category">
										<i class="fa fa-plus"></i></button>
										</div>
										<div class="text-danger col-md-12 row"></div>
									</div>
									<div id="autoList">								
									</div>
								</div>								
							</div>

							<div class="row col-md-12 mt-3">
								<label class="row col-md-3 col-sm-10">Price</label>
								<div class="row col-md-4 col-sm-12">
									<div class="input-group">										
										<div class="input-group-append">
											<button type="button" class="btn btn-secondary bor-left">
											Rp</button>
										</div>
										<input type="text" 	class="form-control bor-right number" name="currency" id="currency" maxlength="20" autocomplete="off"
										value="<?php echo rupiah($data['price']); ?>">
										<div class="text-danger col-md-12 row"></div>
										<input type="hidden" name="price" id="price" value="<?php echo $data['price']; ?>">		
									</div>
								</div>		
							</div>

							<div class="row col-md-12 mt-3">
								<label class="row col-md-3 col-sm-10">Quantity</label>
								<div class="row col-md-3 col-sm-12">
									<input type="text" name="qty" class="form-control number" id="qty" maxlength="10" autocomplete="off"
									value="<?php echo $data['qty']; ?>">
									<div class="text-danger col-md-12 row"></div>
								</div>		
							</div>

							<div class="row col-md-12 mt-3">								
								<label class="row col-md-3 col-sm-10">Status</label>
								<div class="row col-md-6 col-sm-12">
										<div class="i-checks col-md-4 row">
										<?php $checked = $data['status']; ?>

										<input type="checkbox" class="check checkbox-template" name="status" value="not"
										<?php if($checked == 'not') { echo 'checked="checked"';} ?>>
										<label for="checkboxCustom">Not Ready</label>
										</div>
										<div class="i-checks col-md-6 row">
										<input type="checkbox" class="check checkbox-template" name="status" value="ready" 
										<?php if($checked == 'ready') { echo 'checked="checked"';} ?>>
										<label for="checkboxCustom"> Ready for sale</label>
										</div>
									<div class="text-danger col-md-12 row"></div>
								</div>								
							</div>

							<div class="row col-md-12 mt-3">
								<label class="row control-label col-md-3">Image</label>
								<div class="row col-md-4 col-sm-12">
									<label class="control-label btn btn-outline-primary" for="choseImage">Chose file</label>
									<div class="text-danger col-md-12 row"></div>
									<input type="file" name="image" class="row col-md-8" id="choseImage">
									<input type="hidden" name="image_old" value="<?php echo $data['image']; ?>" id="image_old">
								</div>
							</div>

							<div class="row col-md-12 mt-3">
								<label class="row control-label col-md-3"></label>
								<div class="row col-md-4 col-sm-12">
									<img id="previewImage" align='middle' src="image/upload/<?php echo $data['image']; ?>" height="100" class="mb-1">
									<label class="row control-label col-md-12" id="fileName_label"></label>
								</div>
							</div>

						</div>						
						<input type="hidden" name="aksi" value="edit">	
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="menu" value="<?php echo $product; ?>" id='menu' class="menu">
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





<!--MODAL GET CATEGORY-->
	<div class="modal fade" id="modal-category" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Choose category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<span class="col-12 text-bold">LIST CATEGORY READY TO USED</span>
					<div class="col-12 table-vertical-scroll h-340 mt-2" id="listCategory-modal">	
					</div>				
				</div>
			
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn-category-modal-yes">Yes</button>
				</div>
		</div>
		</div>
	</div>


<script type="text/javascript">
	
	$(document).ready(function() {
		var url = 'process/P_product.php';
		var id_submenu =  "<?php echo $data['id_submenu']; ?>";

		$('#product_code').blur(function() {
			var val = $(this).val();
			if(val != '') {

					$.ajax({
						url 	: url,
						type 	: 'POST',
						data 	: {'data':val,'submenu':id_submenu,'aksi':'check_product_code_byCategory'},
						dataType: 'html',
						success : function(response){
							var data = $.parseJSON(response);

							if(data.status == 1) {
								return error('#product_code','Product code was used');
							} else {
								return success('#product_code');
							}
						}
					});
			}

			}).keyup(function() {
				var val = $(this).val();
				if(val != '') {

						$.ajax({
							url 	: url,
							type 	: 'POST',
							data 	: {'data':val,'submenu':id_submenu,'aksi':'check_product_code_byCategory'},
							dataType: 'html',
							success : function(response){
								var data = $.parseJSON(response);

								if(data.status == 1) {
									return error('#product_code','Product code was used');
								} else {
									return success('#product_code');
								}
							}
						});
				}
		});


		$('#product').blur(function() {
			var val = $(this).val();
			if(val != '') {

					$.ajax({
						url 	: url,
						type 	: 'POST',
						data 	: {'data':val,'submenu':id_submenu,'aksi':'check_product_byCategory'},
						dataType: 'html',
						success : function(response){
							var data = $.parseJSON(response);

							if(data.status == 1) {
								return error('#product','Product was used');
							} else {
								return success('#product');
							}
						}
					});
			}
			
			}).keyup(function() {
				var val = $(this).val();
				if(val != '') {

						$.ajax({
						url 	: url,
						type 	: 'POST',
						data 	: {'data':val,'submenu':id_submenu,'aksi':'check_product_byCategory'},
						dataType: 'html',
						success : function(response){
							var data = $.parseJSON(response);

							if(data.status == 1) {
								return error('#product','Product was used');
							} else {
								return success('#product');
							}
						}
					});
				}
		});	


		$('#autoInput').keyup(function(){
			var value = $(this).val();
			var menu  = $('.menu').val();

			if( value != '') {
				$.ajax({
					url 	: url,
					type 	: 'POST',
					data 	: {'data':value,'menu':menu,'aksi':'get_submenu'},
					dataType: 'html',
					success: function(response){
						var data =  $.parseJSON(response);
						$('#autoList').fadeIn();
						$("#autoList").html(data.submenu);						
					}
				})					
			}
			else {
				$('#autoList').fadeOut();
			}
		});


		$(document).on('click', '.list-input', function() {
			$('#autoInput').val($(this).text());
			$('#autoList').fadeOut();
			var id_submenu = $('#id_submenu').val();
			
			if(id_submenu == 0){
				$('#autoInput').val('');
				return error('#autoInput','Pelse select category');
			}
			else {
				return success('#autoInput');
			}
		});


		$('#currency').on('keyup', function(e) {
			e.preventDefault();
			rupiahInput(this,'#price');
			return success(this);
		});


		$('#qty').blur(function(event) {
			var val = $(this).val();
			if(val != '') { return success(this); }
		});
		

		$(document).on('change', '.check', function() {
			$('.i-checks').siblings('div').find('.check').prop('checked', false);
			$(this).prop('checked', true);
		});


		$('#choseImage').change(function(e) {
			var filename,ext,size,icon_old;

			filename = getfileNeme(e);
			size 	 = getfileSize(e);
			ext 	 = getfileExt(e,filename);
			img_old  = $('#image_old').val();
			
			if(filename != '') {
				if(ext == 'jpg' || ext == 'png' || ext == 'ico' || ext == 'icon') 
				{					
					if(size <= 300000) {
						readImage(this);		
						$('#fileName_label').text(filename);
						return file_success(this);
					}
					else {
						$('#previewImage').attr('src','image/upload/'+img_old);
						$('#fileName_label').text('');
						return file_error(this,'Max size 300 Kb');
					}
				}

				else 
				{	
					$('#previewImage').attr('src','image/upload/'+img_old);
					$('#fileName_label').text('');
					return file_error(this,'Please select image file');
				}
			}
			else { return file_error(this,'Please complete the form');}			
		});


		$('#form_product_edit').submit(function(e) {
			e.preventDefault();
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

			if(valid) {
				loading("Please wait to updating data ...");	 
				$.ajax({
					url: url,
					type: 'POST',
					data: new FormData(this), 
					contentType: false,
					cache: false,
					processData:false,
					dataType: 'html',
					success: function(response){
						var data = $.parseJSON(response);
						
						if(data.status == "success"){
							$('body').loadingModal('destroy');
							window.location.href="index.php?page=product&view&product=<?php  echo $product; ?>";
							
						} 
						else {
							$('body').loadingModal('destroy');
							window.location.href="index.php?page=product&view&product=<?php  echo $product; ?>";
						}
					}
				});
			}			
		});




		//category plus
		$('#modal-category').on('show.bs.modal', function (event){
				var menu = $('.menu').val();
	    		$.ajax({
						url 	: url,
						type 	: 'POST',
						data 	: {'aksi':'getCategory','menu':menu},
						dataType: 'html',
						success : function(response){
							var data = $.parseJSON(response);

							if(data.status == 'success') {
								$('#listCategory-modal').html(data.output);
							} else {
								$('#listCategory-modal').html(data.output);
							}
						}
				});
	    });

	    $(document).on('click', '.list-table-ready', function(event) {
			event.preventDefault();

			var id_submenu  = $(this).closest('.list-table-ready').find('.id_submenu_modal').val();
			var submenu  	= $(this).closest('.list-table-ready').find('.submenu_modal').val();	

    		$(this).closest('.list-table-ready').css({'background':'#f3f3f3'});
    		$(this).closest('.list-table-ready').find('.checked-modal').removeClass('d-none');
    		$(this).closest('.list-table-ready').find('.id_submenu_modal').addClass('id_submenu_modal_selected');
    		$(this).closest('.list-table-ready').find('.submenu_modal').addClass('submenu_modal_selected');  



    		$(this).siblings('.list-table-ready').css({'background':'none'});
    		$(this).siblings('.list-table-ready').find('.id_submenu_modal').removeClass('id_submenu_modal_selected');
    		$(this).siblings('.list-table-ready').find('.submenu_modal').removeClass('submenu_modal_selected');
    		$(this).siblings('.list-table-ready').find('.checked-modal').addClass('d-none'); 			
		});

    	$(document).on('click','#btn-category-modal-yes', function(event) {
    		event.preventDefault();	    			
    		var id_submenu  = $('.id_submenu_modal_selected').val();
			var submenu  	= $('.submenu_modal_selected').val();

    			$('#autoInput').val(submenu);
    			$('#autoList').html('<input type="text" name="id_submenu" value="'+id_submenu+'">;');
				$('#modal-category').modal('hide');
    	});





	});
</script>