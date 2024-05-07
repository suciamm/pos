<?php 
	
	$db  	= model('M_table');
	$fetch 	= $db->getTable();
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
						<li class="breadcrumb-item"><b class="text-white">SETTINGS</b></li>
						<li class="breadcrumb-item"><b class="text-white">Table Menu</b></li>
						</ul>
					</div>	
					</div>
			</div>

			<div class="col-md-12 mt-4">
				<div class="col-md-12">
					<div class="row d-none" id="form-input">
						<span class="col-4">
						<input type="text" name="table_number" class="form-control number table-number" placeholder="Please insert table number . ." autocomplete="off">
						<input type="hidden" name="table_number_old" class="table-number-hide">
						<input type="hidden" name="table_id" class="table-id-hide">
						<span class="text-danger"></span>
						</span>

						<span class="col-21 text-right">
						<button class="btn btn-secondary" id="btn-cancel">Cancel</button>
						</span>

						<span class="col-2 pl-1">
						<button class="btn btn-primary" id="btn-save">Save</button>
						</span>
					</div>

					<div class="row" id="table-filter">
						<div class="col-md-1 col-sm-6">
							<select class="show form-control">
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="50">50</option>
									<option value="1000">ALL</option>
							</select>
						</div>
						<div class="col-md-2 col-sm-12">						
							<select class="showBystatus form-control" >
								<option value="">All</option>
								<option value="not">Not</option>
								<option value="ready">Ready</option>
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
						<th class="pr-0">
							<div class="i-checks">
								<input type="checkbox" class="check-all checkbox-template">
							</div>
						</th>
						<th>NO</th>
						<th>TABLE CODE</th>
						<th>TABLE NUMBER</th>
						<th>STATUS</th>
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
								<input type="checkbox" class="check checkbox-template" name="id[]" value="<?php echo $view['table_id']; ?>">
								</div>
							</td>
							<td><?php echo $no++; ?></td>
							<td><?php echo $view['table_code']; ?></td>
							<td><?php echo 'Table '.$view['table_number']; ?></td>
							<td>
								<?php 
									if($view['status'] == 'N') { echo '<span class="badge badge-success">Ready</span>'; } 
									else { echo '<span class="badge badge-danger">Used</span>'; }									
								?>
							</td>										
							<td>
								<a href="#" class="btn-edit" data-id="<?php echo $view['table_id'].'&'.$view['table_number']; ?>">
								<i class="fa fa-pencil mr-1"></i>
								</a>
								
								<a href="#" data-toggle="modal" data-target="#btn_delete" data-id="<?php echo $view['table_id']; ?>">
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

		<form id="form-delete" method="post" enctype="multipart/form-data">
			<div class="modal-body">				
				<h6>Are you sure delete this data</h6>				
				<input type="hidden" name="id" class="show_id">
				<input type="hidden" name="aksi" value="delete">
				<div class="row col-12" id="show-msg"></div>
			</div>
		
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Yes</button>		
			</div>
		</form>
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

		<div class="modal-body">
			<h6>Are you sure delete <span class="qty_del"></span> data</h6>
			<div class="row col-12" id="msg-delete-all"></div>
		</div>

		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		<button type="submit" class="btn btn-primary" id="btn_delete_all_yes">Yes</button>		
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







<script type="text/javascript">

	function Insert(url,act,val)
	{
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':act,'data':val},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				if(data.status == 'success') {
					history.go(0);
				} else {
					notification(data.msg,'right top','danger','notifDanger',5000); 
				}
			}
		});	
	}

	function Delete(url,form)
	{
		loading("Please wait to deleting data ...");	 
		$.ajax({
			url: url,
			type: 'POST',
			data: form.serialize(),
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

	function Edit(url,act,id,val) 
	{
		$.ajax({
			url 	: url,
			type 	: 'POST',
			data 	: {'aksi':act,'id':id,'data':val},
			dataType: 'html',
			success	: function(response){
				var data =  $.parseJSON(response);
				if(data.status == 'success') {
					history.go(0);
				} else {
					notification(data.msg,'right top','danger','notifDanger',5000); 
				}
			}
		});	
	}


	function Delete_all(url,act,id)
	{
		loading("Please wait to deleting data ...");	    			    			
		$.ajax({
			url		: url,
			type 	: 'POST',
			data 	:  {'aksi':act,'id':id},
			dataType:  'html',
			success	: function(response)
			{
				var data = $.parseJSON(response);
				setCookie('notif-msg',data.msg);

				if(data.status == "success"){
					$('body').loadingModal('destroy');
					$('#msg-delete-all').html(alertSuccess(data.msg));
				}
				else {
					$('body').loadingModal('destroy');
					$('#msg-delete-all').html(alertDanger(data.msg));
				}
			}
		});			
	}


	$(document).ready(function() {
		var url 	  = 'process/P_table.php';
		var checked   = [];

		$('#btn-add').click(function(event) {
			event.preventDefault();
			$('#table-filter').addClass('d-none');
			$('#form-input').removeClass('d-none');
			$(".table-number").focus();
			$('.table-number').val('');
			$('.table-number-hide').val('');
			$('.table-id-hide').val('');
		});


		$('.btn-edit').click(function(event) {
			event.preventDefault();
			var val 			= $(this).attr('data-id');
			var split 			= val.split('&');
			var table_id 		= split[0];
			var table_number 	= split[1];

				$('.table-number').val(table_number);
				$('.table-number-hide').val(table_number);
				$('.table-id-hide').val(table_id);

				$('#table-filter').addClass('d-none');
				$('#form-input').removeClass('d-none');
				$(".table-number").focus();
				return success($('.table-number'));
		});


		$('#btn_delete').on('show.bs.modal', function (e){ 
	    		var id = $(e.relatedTarget).attr('data-id');
	    		$(this).find('.show_id').val(id);
	    });


		$('#btn-cancel').click(function(event) {
			$('#table-filter').removeClass('d-none');
			$('#form-input').addClass('d-none');
			$('.table-number').val('');
		});


		$('.table-number').keyup(function(event) {
			var val = $(this).val();
			if(val == '') { error($('.table-number'),"Please complete the form"); }
			else{ return success(this);}
		});


		$('#delete_all').click(function(event) {
			event.preventDefault();    	
			var length = $('.check:checked').length;

			if(length == 0 ){
			$('#modal_alert').modal('show');
			}
			else {
				$('#modal_delete_all').modal('show');
				$('#modal_delete_all').find('.qty_del').text(length);	    		
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






		//form action//
		$('#btn-save').click(function(event) {
			event.preventDefault();
			var val   		= $('.table-number').val();
			var table_id	= $('.table-id-hide').val();

				if(table_id == '') 
				{
					if(val == '') { error($('.table-number'),"Please complete the form"); }
					else { Insert(url,'add',val); }			
				}
				else 
				{
					if(val == '') { error($('.table-number'),"Please complete the form"); }
					else {

						var act 	= 'edit';
						var id 		= $('.table-id-hide').val();
						var val 	= $('.table-number').val();

						Edit(url,act,id,val) 
					}		
				}			
		});	


	    $('#form-delete').submit(function(e) {
				e.preventDefault();
				Delete(url, $('#form-delete'));
		});


		$('#btn_delete_all_yes').click(function(event) {
			event.preventDefault();
			var act = 'delete_all';

			Delete_all(url,act,checked);
		});

		$('#modal_delete_all').on('hidden.bs.modal', function () {
			 location.reload();
		})

		


	
	});
</script>