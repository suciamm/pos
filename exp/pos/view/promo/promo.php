<?php 
	
	$db  	= model('M_promo');
	$fetch 	= $db->getPromo();
	$data 	= $fetch['data'];
	$row 	= $fetch['row'];	
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
								<a href="#" id="btn-add">
								<i class="fa fa-plus-circle"></i> Add</a>
							</li>
							<li class="mr-4"><a href="#" id="delete_all" disabled="disabled"><i class="fa fa-trash"></i> Delete</a></li>
							<li class="mr-4"><a href="#" id="refresh"><i class="fa fa-refresh"></i> Refresh</a></li>
						</ul>									
					</div>
					<div class="col-6">
						<ul class="breadcrumb bg-none pull-right">
						<li class="breadcrumb-item"><b class="text-white">PROMO</b></li>
						<li class="breadcrumb-item"><b class="text-white">Table Promo</b></li>
						</ul>
					</div>	
					</div>
			</div>

			<div class="col-md-12 mt-4">
				<div class="col-md-12">
					<span class="row col-8" id="error-msg"></span>
					<form class="row d-none" id="form-input" method="POST" enctype="multipart/form-data">			
						<span class="col-12 pb-2">
							<span class="pointer" id="btn-cancel"><i class="fa fa-close pointer"></i> close</span>
							<input type="hidden" name="promo_id" id="promo_id">
							<input type="hidden" name="aksi" id="aksi">
						</span>

						<span class="col-lg-3 col-sm-5">
							<div class="row col-12">
							<div class="input-group">
								<input type="text" 	class="form-control" name="start" id="start" autocomplete="off" placeholder="Promo start">
								<div class="input-group-append">
									<label class="btn btn-secondary bor-right"  for="start">
									<i class="fa fa-calendar"></i>
									</label>
								</div>
								<div class="text-danger col-md-12 row"></div>
							</div>
							</div>
						</span>

						<span class="col-lg-3 col-sm-5">
							<div class="row col-12">
							<div class="input-group">
								<input type="text" 	class="form-control" name="end" id="end" autocomplete="off" placeholder="Promo end">
								<div class="input-group-append">
									<label class="btn btn-secondary bor-right"  for="end">
									<i class="fa fa-calendar"></i>
									</label>
								</div>
								<div class="text-danger col-md-12 row"></div>
							</div>
							</div>
						</span>

						<span class="col-2 pl-1">
						<button class="btn btn-primary" id="btn-submit"></button>
						</span>
					</form>

					<div class="row" id="table-filter">
						<div class="col-md-1 col-sm-6">
							<select class="show form-control">
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="50">50</option>
									<option value="1000">ALL</option>
							</select>
						</div>
						<div class="col-md-3">						
						<input type="text" name="" class="search form-control" placeholder="Search ">
						</div>
					</div>
				</div>
			</div>

			<div class="row card-body">
				<div class="table-responsive">
				<table class="table table-hover table-striped" id="view-table">
					<thead>
						<tr>
						<th class="pr-0" width="5%">
							<div class="i-checks">
							<input type="checkbox" class="check-all checkbox-template">
							</div>
						</th>
						<th width="10%">NO</th>
						<th width="25%">PROMO START</th>
						<th width="80%">PROMO END</th>
						<th width="80%">DETAIL</th>
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
								<input type="checkbox" class="check checkbox-template" name="id[]" value="<?php echo $view['promo_id']; ?>">
								</div>
							</td>
							<td><?php echo $no++; ?></td>
							<td><?php echo $view['start']; ?></td>
							<td><?php echo $view['end']; ?></td>
							<td>
								<a href="index.php?page=promo&sub=detail&id=<?php echo base64_encode($view['promo_id']); ?>
								&s=<?php echo base64_encode($view['start']); ?>&e=<?php echo base64_encode($view['end']); ?>">
									detail
								</a>
							</td>									
							<td>								
								<a href="#" class="btn-edit" data-id="<?php echo $view['promo_id'].'&'.$view['start'].'&'.$view['end'] ?>">
								<i class="fa fa-pencil mr-1"></i>
								</a>
								
								<a href="#" data-toggle="modal" data-target="#btn_delete" data-id="<?php echo $view['promo_id']; ?>">
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
						history.go(0);;
					}
					else {
						$('body').loadingModal('destroy');
						$('#error-msg').html(alertDanger(data.msg));
					}
				}
		})	
	}

	function formDelete(url,aksi,id)
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
					$('#show-msg').html(alertDanger(data.msg));
				}
			}
		});
	}
</script>



<script type="text/javascript">
	$(document).ready(function() {
		var url 	  = 'process/P_promo.php';
		var checked   = [];


		/*
		 * BUTTON
		*/
			$('#btn-add').click(function(event) {
				event.preventDefault();

					$('#aksi').val('addPromo');
					$('#promo_id').val('');
					$('#start').val('');
					$('#end').val('');


					$('#table-filter').addClass('d-none');
					$('#form-input').removeClass('d-none');			
					$('#btn-submit').text('Save');
			});


			$('.btn-edit').click(function(event) {
				event.preventDefault();
				var val 	 = $(this).attr('data-id');
				var split 	 = val.split('&');
				var promo_id = split[0];
				var start 	 = split[1];
				var end 	 = split[2];

					$('#aksi').val('editPromo');
					$('#promo_id').val(promo_id);
					$('#start').val(start);
					$('#end').val(end);

					$('#table-filter').addClass('d-none');
					$('#form-input').removeClass('d-none');
					$('#btn-submit').text('Update');
			});


			$('#btn-cancel').click(function(event) {
				$('#table-filter').removeClass('d-none');
				$('#form-input').addClass('d-none');
			});


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
		 * INPUT
		*/
			$('#start').change(function(event) {
				var val = $(this).val();
				if(val == '') { error(this,'Please complete the form');}
				else { success(this);}
				}).keyup(function(event) {
					if(val == '') { error(this,'Please complete the form');}
					else { success(this);}
			});

			$('#end').change(function(event) {
				var val = $(this).val();
				if(val == '') { error(this,'Please complete the form');}
				else { success(this);}
				}).keyup(function(event) {
					if(val == '') { error(this,'Please complete the form');}
					else { success(this);}
			});

			$('#start').datetimepicker({
				format:'Y-m-d H:i:s',
				onShow:function(ct){
					this.setOptions({
					maxDate:$('#end').val()?$('#end').val():false
					})
				},
				timepicker:true
			});

			$('#end').datetimepicker({
				format:'Y-m-d H:i:s',
				onShow:function(ct){
					this.setOptions({
					minDate:$('#start').val()?$('#start').val():false
					})
				},
				timepicker:true
			});



		/*
		 * FORM
		*/
			$('#form-input').submit(function(event) {
				event.preventDefault();
				var valid 	= true;
				var aksi 	= $('#aksi').val();

					if(aksi == 'addPromo') 
					{
						$(this).find('input[type=text], select').each(function() {
							if(!$(this).val()) {
							error(this,"Please complete the form");
							valid= false;
							}
							if ($(this).hasClass('is-invalid')){
							valid = false;
							error(this,"Please complete the form");
							}
						});						
						if(valid) { formInput(url); }	
					}

					else if(aksi == 'editPromo')
					{
						$(this).find('input[type=text], select').each(function() {
							if(!$(this).val()) {
							error(this,"Please complete the form");
							valid= false;
							}
							if ($(this).hasClass('is-invalid')){
							valid = false;
							error(this,"Please complete the form");
							}
						});						
						if(valid) { formInput(url); }	
					}					
			});


			$('#btn-modal-delete-yes').click(function(event) {
				event.preventDefault()
				var id 		= $('#modal-delete').find('#id').val();
				var aksi 	= 'deletePromo';
				formDelete(url,aksi,id);
			});


			$('#btn_delete_all_yes').click(function(event) {
				event.preventDefault();
				var aksi = 'deleteAll';
				formDelete(url,aksi,checked);
			});
		
	});
</script>