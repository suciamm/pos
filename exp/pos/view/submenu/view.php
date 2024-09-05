<?php 
	$db  	= model('M_submenu');
	$fetch 	= $db->view_submenu();
	$data 	= $fetch['data'];
	$row 	= $fetch['row'];
?>

<div class="breadcrumb-holder container-fluid">
	<div class="row pt-3">
		<div class="row col-md-8 col-sm-12">
			<ul class="breadcrumb action-bar">				
				<li class="mr-4">
					<a href="#" id="add" data-id='index.php?page=submenu&sub=add'>
					<i class="fa fa-plus-circle"></i> Add</a>
				</li>
				<li class="mr-4"><a href="#" id="delete_all" disabled="disabled"><i class="fa fa-trash"></i> Delete</a></li>
				<li class="mr-4"><a href="#" id="refresh"><i class="fa fa-refresh"></i> Refresh</a></li>
			</ul>
		</div>
		
		<div class="col-md-4 col-sm-12">
			<ul class="row breadcrumb fa-pull-right">
			<li class="breadcrumb-item active"><b>MENU</b></li>
			<li class="breadcrumb-item active"><b>Submenu</b></li>
			</ul>
		</div>
	</div>	
</div>


<div class="mt-3">
<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
		<div class="row card">
				<div class="col-md-12 mt-4">
					<div class="col-md-12">
					<div class="row">
						<div class="col-md-1 col-sm-6">
							<select class="show form-control">
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="50">50</option>
									<option value="1000">ALL</option>
							</select>
						</div>

						<div class="col-md-2 col-sm-12">						
							<select class="showBymenu form-control" >
								<option value="">All</option>
								<?php 
									$db_menu  	= model('M_menu');
									$fetch_menu = $db_menu->view_menu();
									$data_menu 	= $fetch_menu['data'];

									foreach ($data_menu as $menu) {
									echo "<option value='$menu[menu]'>$menu[menu]</option>";
									}
								?>
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
							<th>SUBMENU</th>
							<th>MENU</th>
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
									<input type="checkbox" class="check checkbox-template" name="id_submenu[]" value="<?php echo $view['id_submenu']; ?>">
									</div>
								</td>
								<td><?php echo $no++; ?></td>
								<td><?php echo $view['submenu']; ?></td>								
								<td><?php echo $view['menu']; ?></td>
								<td>
									<a href="index.php?page=submenu&sub=edit&id=<?php echo base64_encode($view['id_submenu']);  ?>">
									<i class="fa fa-pencil mr-1"></i>
									</a>
									
									<a href="#" data-toggle="modal" data-target="#btn_delete" data-id="<?php echo $view['id_submenu']?>">
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


	</div>
</div>
</div>


<!--modal delete-->
<div class="modal fade" id="btn_delete" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">Delete data</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

		<form id="form_delete" method="post" enctype="multipart/form-data">
			<div class="modal-body">
				<h6>Are you sure delete this data</h6>				
				<input type="hidden" name="id" class="show_id">
				<input type="hidden" name="aksi" value="delete">
			</div>
		
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Yes</button>		
			</div>
		</form>

		<script type="text/javascript">
		$(document).ready(function() {
			$('#form_delete').submit(function(e) {
				e.preventDefault();
				
				$.ajax({
					url: 'process/P_submenu.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'html',
					success: function(response){
						var data = $.parseJSON(response);
						
						if(data.status == "success"){
							history.go(0);
						}
						else {
							console.log('failed');
						}
					}
				});
			});
		});
		</script>
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
	
	$(document).ready(function() {
		var checked = [];	

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

		$('#btn_delete_all_yes').click(function(event) {
			event.preventDefault();
			var aksi = 'delete_all';
			console.log(checked);

				loading("Please wait to deleting data ...");	    			    			
				$.ajax({
					url		: 'process/P_submenu.php',
					type 	: 'POST',
					data 	:  {'aksi':aksi,'id':checked},
					dataType:  'html',
					success	: function(response)
					{
						var data = $.parseJSON(response);							
						if(data.status == "success"){
							$('body').loadingModal('destroy');
							history.go(0);
						}
						else {
							console.log('failed');
						}
					}
				});			
		});

   		$('#btn_delete').on('show.bs.modal', function (e){ 
	    		var id = $(e.relatedTarget).attr('data-id');
	    		$(this).find('.show_id').val(id);
	    });



	    //Pencarian//
	    $('.showBymenu').change(function(event) {
	    	var data = $(this).val();
	    	if(data == '') {
	    		window.filter_column(3,'');
	    	}
	    	else {
	    		window.filter_column(3,data);
	    	}
	    });


    	
	});
</script>