<?php 
	$promo_id 	= base64_decode($_GET['id']);
	$start 		= base64_decode($_GET['s']);
	$end 		= base64_decode($_GET['e']);
	$db  		= model('M_promo_detail');
	$fetch 		= $db->getPromoDetail($promo_id);
	$data 		= $fetch['data'];
	$row 		= $fetch['row'];
?>
<div class="mt-3">
<div class="container-fluid">
	<div class="row">
	
		<div class="col-md-12">
		<div class="row card">

			<div class="col-lg-12 col-sm-12 bg-dark pt-3 pb-3">
					<div class="row">
					<div class="col-6">
						<ul class="breadcrumb action-bar breadcrumb-menu">										
							<li class="mr-4">
								<a href="#" id="add" data-id="index.php?page=promo&sub=detail_add&promo=<?php echo $promo_id ?>">
								<i class="fa fa-plus-circle"></i> Add</a>
							</li>
							<li class="mr-4"><a href="#" id="delete_all" disabled="disabled"><i class="fa fa-trash"></i> Delete</a></li>
							<li class="mr-4"><a href="#" id="refresh"><i class="fa fa-refresh"></i> Refresh</a></li>
							<li class="mr-4">
								<a href="#" id="back" data-id="index.php?page=promo&sub=promo"><i class="fa fa-close"></i> Close</a>
							</li>
						</ul>									
					</div>
					<div class="col-6">
						<ul class="breadcrumb bg-none pull-right">
						<li class="breadcrumb-item"><b class="text-white">PROMO</b></li>
						<li class="breadcrumb-item"><b class="text-white">Table Promo</b></li>
						<li class="breadcrumb-item"><b class="text-white">Details</b></li>
						</ul>
					</div>	
					</div>
			</div>

			<div class="col-md-12 mt-4">
				<div class="col-md-12">
					<span class="row col-8" id="error-msg"></span>
					<div class="row" id="table-filter">
						<div class="col-8">
								<div class="row">
									<div class="col-lg-2 col-sm-6">
										<select class="show form-control">
												<option value="5">5</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="1000">ALL</option>
										</select>
									</div>
									<div class="col-lg-4 col-sm-12">						
									<input type="text" name="" class="search form-control" placeholder="Search">
									</div>
								</div>
						</div>

						<div class="col-4 text-right">
							<span class="text-bold">
								<?php 
									echo date('M d Y H:i A', strtotime($start)); 
									echo ' to '; 
									echo date('M d Y H:i A', strtotime($end)); 
								?> 
							</span>
						</div>						
					</div>
				</div>
			</div>

			<div class="row card-body">
				<div class="table-responsive">
				<table class="table table-hover table-striped" id="view-table">
					<thead>
						<tr>
						<th width="5%">
							<div class="i-checks">
							<input type="checkbox" class="check-all checkbox-template">
							</div>
						</th>
						<th>NO</th>
						<th>PROMO CODE</th>
						<th>PROMO TYPE</th>
						<th>PROMO PAYEMENT</th>
						<th>PRODUCT</th>
						<th>PAYEMENT</th>
						<th>DISCOUNT</th>
						<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1; 
							foreach ($data as $view) { 
						?>
						<tr>
							<td>
								<div class="i-checks">
								<input type="checkbox" class="check checkbox-template" name="id[]" value="<?php echo $view['detail_promo_id']; ?>">
								</div>
							</td>
							<td><?php echo $no++; ?></td>
							<td><?php echo $view['promo_code']; ?></td>
							<td>
								<?php 
									if($view['promo_type'] == 'all') { echo 'All Product'; }
									else { echo 'Custom';} 
								?>									
							</td>
							<td>
								<?php 
									if($view['promo_payment'] == 'all') { echo 'All Payment'; }
									else { echo 'Custom';} 
								?>									
							</td>
							<td>
								<?php 
									if($view['id_product'] == NULL) { echo 'All'; }
									else { echo $view['product'];} 
								?>									
							</td>
							<td>
								<?php 
									if($view['id_payment'] == NULL) { echo 'All'; }
									else { echo $view['payment_name'];} 
								?>									
							</td>
							<td><?php echo $view['discount'].'%'; ?></td>
																
							<td>								
								<a href="#" class="btn-edit" data-id="<?php echo $view['detail_promo_id'] ?>">
								<i class="fa fa-pencil mr-1"></i>
								</a>
								
								<a href="#" data-toggle="modal" data-target="#btn_delete" data-id="<?php echo $view['detail_promo_id']; ?>">
								<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				</div>
			</div>	

		</div>
		</div>

	</div><!--close row-->
</div>
</div>





<!--modals-->
delete
	<!--modal delete-->
	<div class="modal fade" id="btn_delete" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Delete data</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>			

				<div id="modal-delete">
					<div class="modal-body">
						<h6>Are you sure delete this data</h6>				
						<input type="hidden" name="id" id="id">
						<div class="row col-12" id="show-msg"></div>
					</div>
				
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="btn-modal-delete-yes">Yes</button>		
					</div>
				</div>
		</div>
		</div>
	</div>

	<!--modal delete all-->
	<div class="modal fade" id="modal_delete_all" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Delete data</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div id="modal-delete-all">
					<div class="modal-body">
						<h6>Are you sure delete <span class="qty_del"></span> data</h6>
						<div class="row col-12" id="show-msg"></div>
					</div>

					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" id="btn_delete_all_yes">Yes</button>		
					</div>
				</div>
		</div>
		</div>
	</div>

	<!--modal alert-->
	<div class="modal fade" id="modal_alert" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Alert Message</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<div class="modal-body">
				<h6>Please checked the checkbox</h6>			
				</div>
				
				<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>	
			</div>
		</div>
		</div>
	</div>


<script>
	function formDelete(url,aksi,id,error)
	{
		loading("Please wait to deleting data ...");	 
		$.ajax({
			url: url,
			type: 'POST',
			data: {'aksi':aksi,'id':id},
			dataType: 'html',
			success: function(response){
				var data = $.parseJSON(response);
				if(data.status == "success"){
					$('body').loadingModal('destroy');
					history.go(0);
				}
				else {
					$('body').loadingModal('destroy');					
					error.find('#show-msg').html(alertDanger(data.msg));
				}
			}
		});
	}
</script>



<script type="text/javascript">
	$(document).ready(function() {
		var url 	  = 'process/P_promo_detail.php';
		var checked   = [];


		/*
		 * BUTTON
		*/
			$('#btn_delete').on('show.bs.modal', function (e){ 
		    		var id = $(e.relatedTarget).attr('data-id');
		    		$('#modal-delete').find('#id').val(id);
		    		$('#modal-delete').find('#show-msg').html('');
		    });

			$('#delete_all').click(function(event) {
				event.preventDefault();    	
				var length = $('.check:checked').length;

					if(length == 0 ){
					$('#modal_alert').modal('show');
					}
					else {
						$('#modal_delete_all').modal('show');
						$('#modal-delete-all').find('.qty_del').text(length);
						$('#modal-delete-all').find('#show-msg').html('');	    		
					}
			});

			$('.check-all').change(function(event) {
				if($(this).prop('checked') == true) 
				{
					$('.check').each(function(index, el) {
					$(this).prop('checked', true);	
					});

					$('.check:checked').each(function(index, el) {
					var datachecked = $(this).val();
					checked.push(datachecked);   				
					});
				}
				else 
				{
					$('.check').each(function(index, el) {
					$(this).prop('checked', false);
					});
					checked = [];
				}
			});

			$(document).on('change', '.check', function() {
				var val  			= $(this).val();
				var length 			= $('.check:checked').length;
				var length_uncheck 	= $('.check:unchecked').length;

				if(this.checked) 
				{
					checked.push(val);
					if(length_uncheck == 0) {
					$('.check-all').prop('checked',true);
					}
				}
				else 
				{
					$('.check-all').prop('checked',false);
					var uncheck = $(this).val();
					for (var i = checked.length - 1; i>=0; i--) {
						if(uncheck == checked[i]) {	checked.splice(i,1); }	    			
					}
				}
			});


		/*
		 * FORM
		*/
			$('#btn-modal-delete-yes').click(function(event) {
				event.preventDefault()
				var id 		= $('#modal-delete').find('#id').val();
				var aksi 	= 'deletePromoDetail';
				var error 	= $('#modal-delete');
				formDelete(url,aksi,id,error);
			});

			$('#btn_delete_all_yes').click(function(event) {
				event.preventDefault();
				var aksi = 'deletePromoDetailAll';
				var error = $('#modal-delete-all');
				formDelete(url,aksi,checked,error);
			});
		
	});
</script>