setting

<div class="row mt-3 mr-3 ml-3">
	<div class="col-4">
		<div class="col-12 card pt-3 pb-3 h-550">
			<!--settings-->
			<div class="row b-bottom pb-3">
				<div class="col-12">
				<span><i class="fa fa-cog"></i></span>
				<span class="text-bold">Settings</span>
				</div>
			</div>
			<div class="row setting-content setting-payment" data-id="setting-payment">
				<div class="col-11 offset-1 setting-menu">
				<span>Payment Type</span>
				</div>
			</div>
			<div class="row setting-content setting-table" data-id="setting-table">
				<div class="col-11 offset-1 setting-menu">
				<span>Table</span>
				</div>
			</div>
			<div class="row setting-content setting-tax" data-id="setting-tax">
				<div class="col-11 offset-1 setting-menu">
				<span>Tax</span>
				</div>
			</div>
			<div class="row setting-content setting-charge" data-id="setting-charge">
				<div class="col-11 offset-1 setting-menu">
					<span>Service Charge</span>
				</div>
			</div>

			<!--store-->
			<div class="row b-top b-bottom pt-3 pb-3">
				<div class="col-12">
				<span><i class="fa fa-home"></i></span>
				<span class="text-bold">Store</span>
				</div>
			</div>
			<div class="row setting-content setting-profile" data-id="setting-profile">
				<div class="col-11 offset-1 setting-menu">
				<span>Profile</span>
				</div>
			</div>

		</div>
	</div>

	<div class="col-8 p-0">
		<div class="col-12 card p-0 pt-4 h-550">
			<div class="col-12 menu-setting d-none" id="setting-payment">
			<!--payment type table-->
				<div class="row mt-0 pt-0" id="payment-type-view">
					<div class="row col-12 pl-5">
						<ul class="breadcrumb action-bar pt-0 pb-4 fs-14">				
						<li class="mr-4">
							<a href="#" id="add-payment">
							<i class="fa fa-plus-circle"></i> ADD PAYMENT TYPE</a>
						</li>
						<li class="mr-4"><a href="#" class="d-none" id="delete-payment-all"><i class="fa fa-trash"></i> DELETE ALL</a></li>
						<li class="mr-4"><a href="#" class="d-none" id="delete-payment"><i class="fa fa-trash"></i> DELETE</a></li>
						<li class="mr-4"><a href="#" class="d-none" id="edit-payment"><i class="fa fa-pencil"></i> EDIT</a></li>
						</ul>
					</div>
					<div class="row col-12 p-0 m-0" id="payment-type-table">				
					</div>
				</div>

				<!-- payment form-->
				<div class="row d-none" id="payment-type-form">
					<div class="col-12">
						<div class="row">
							<div class="col-6">
							<span class="col-12"><h4 id="form-payment-type-title"></h4></span>
							</div>
							<div class="col-6">
								<span class="col-12 text-right"><h4><i class="fa fa-close pointer btn-form-payment-cancel"></i></h4>
							</span>
							</div>
						</div>				
						<form id="form-payment-type" method="POST" enctype="multipart/form-data">
							<div class="col-12 mt-3">
								<div class="form-group-material">
								<input type="hidden" name="aksi" id="aksi_payment">
								<input type="hidden" name="id_payment" id="id_payment">
								
								<input type="text" name="name" required="" autocomplete="off" class="input-material" id="name_payment">
								<label class="label-material label-payment">Name</label>
								</div>					
							</div>

							<div class="col-8 offset-4 pr-0 pt-3 pr-3 text-right">
								<button class="btn btn-primary btn-form-payment-add">Add</button>
								<button class="btn btn-primary btn-form-payment-update">Update</button>
							</div>
						</form>
					</div>		
				</div>
			</div>

			<div class="col-12 menu-setting d-none" id="setting-table">
				<!--table column table-->
				<div class="row mt-0 pt-0" id="table-column-view">
					<div class="row col-12 pl-5">
						<ul class="breadcrumb action-bar pt-0 pb-4 fs-14">				
						<li class="mr-4">
							<a href="#" id="add-table">
							<i class="fa fa-plus-circle"></i> ADD TABLE</a>
						</li>
						<li class="mr-4"><a href="#" class="d-none" id="delete-table-all"><i class="fa fa-trash"></i> DELETE ALL</a></li>
						<li class="mr-4"><a href="#" class="d-none" id="delete-table"><i class="fa fa-trash"></i> DELETE</a></li>
						<li class="mr-4"><a href="#" class="d-none" id="edit-table"><i class="fa fa-pencil"></i> EDIT</a></li>
						</ul>
					</div>
					<div class="row col-12 p-0 m-0" id="table-column-table">				
					</div>
				</div>
				<!-- table form--> 
				<div class="row d-none" id="table-column-form">
					<div class="col-12">
						<div class="row">
							<div class="col-6">
							<span class="col-12"><h4 id="form-table-title"></h4></span>
							</div>
							<div class="col-6">
							<span class="col-12 text-right"><h4><i class="fa fa-close pointer btn-form-table-cancel"></i></h4>
							</span>
							</div>
						</div>
						<form id="form-table" method="POST" enctype="multipart/form-data">
							<div class="col-12 mt-3">
								<div class="form-group-material">
								<input type="hidden" name="aksi" id="aksi_table">
								<input type="hidden" name="table_id" id="table_id">
								
								<input type="text" name="table_number" required="" autocomplete="off" maxlength="10" class="input-material" id="table_number">
								<label class="label-material label-table">Table Number</label>
								</div>					
							</div>

							<div class="col-8 offset-4 pr-0 pt-3 pr-3 text-right">
								<button class="btn btn-primary btn-form-table-add">Add</button>
								<button class="btn btn-primary btn-form-table-update">Update</button>
							</div>
						</form>
					</div>		
				</div>
			</div>
			
			<!-- tabel profile  -->
			<div class="col-12 menu-setting d-none" id="setting-profile">
				<span class="col-12"><h4>Profile Settings</h4></span>
				<span class="col-12 i-checks m-0 p-0 mt-2 pl-3" id="checkbox-editProfile">
					<input type="checkbox" class="checkbox-template checkbox-editProfile">
					<label>Edit Profile</label>
				</span>	

				<form id="form-profile" method="POST" enctype="multipart/form-data">
					<?php 
						$M_profile  	= model('M_profile');
						$profile 		= $M_profile->getProfile();
						$profileData 	= $profile['data'];
						$profileRow		= $profile['row'];
					?>			
					<div class="col-12 mt-3">
						<div class="form-group-material">
						<input type="hidden" id="profileRow" value="<?php echo $profileRow ?>">
						<input type="hidden" name="aksi" id="profile_aksi">
						<input type="hidden" name="id" id="id" value="<?php echo $profileData['id'] ?>">
						<input type="text" name="name" required="" autocomplete="off" maxlength="150" class="input-material profile-input" id="name" value="<?php echo $profileData['name'] ?>">
						<label class="label-material">Name</label>
						</div>

						<div class="form-group-material">
						<input type="text" name="phone" required="" maxlength="13" class="input-material profile-input" id="phone" value="<?php echo $profileData['phone'] ?>">
						<label class="label-material">Phone</label>
						</div>

						<div class="form-group-material">
						<input type="email" name="email" required="" maxlength="100" autocomplete="off" class="input-material profile-input" id="email" value="<?php echo $profileData['email'] ?>">
						<label class="label-material">Email</label>
						</div>

						<div class="form-group-material">
						<input type="text" name="address" required="" maxlength="200" autocomplete="off" class="input-material profile-input" id="address" value="<?php echo $profileData['address'] ?>">
						<label class="label-material">Address</label>
						</div>

						<div class="form-group-material">
						<input type="text" name="app_name" required="" maxlength="30" autocomplete="off" class="input-material profile-input" id="app_name" value="<?php echo $profileData['app_name'] ?>">
						<label class="label-material">Application Name</label>
						</div>

						<div class="col-8 offset-4 pr-0 pt-3 text-right mb-3">
						<button class="btn btn-primary btn-form-profile"></button>
						</div>
					</div>
				</form>
			</div>	

			<!-- table tax  -->
			<!-- <div> -->
				<div class="p-2 bg-dark pt-3 pb-3 menu-setting d-none" id="setting-tax">
					<div class="row"  id="tax-column-view">
						<div class="col-6">
							<ul class="breadcrumb action-bar breadcrumb-menu">
								<li class="mr-4">
									<a href="#" id="btn-add-tax">
										<i class="fa fa-plus-circle"></i> Add Tax
									</a>
								</li>
							</ul>
						</div>
						<div class="row col-12 p-0 m-0" id="tax-type-table">				
					</div>

						<div class="col-6">
							<ul class="breadcrumb bg-none pull-right">
								<li class="breadcrumb-item"><b class="text-white">TAX</b></li>
								<li class="breadcrumb-item"><b class="text-white">Tabel Pajak</b></li>
							</ul>
						</div>
						
					</div>
				</div>

				<!-- tax form -->
				<!-- <form class="row pb-2 bg-green " id="form-input-tax" method="POST" enctype="multipart/form-data" action="P_tax.php"> -->
				<form class="row d-none pb-2 bg-green " id="form-input-tax" method="POST" enctype="multipart/form-data">
					<!-- Isi form input di sini -->
					<span class="col-12 pb-2">
						<span clascss untuk style numbers="pointer" id="btn-cancel"><i class="fa fa-close pointer btn-form-tax-cancel"></i> Close </span>
						<input type="hidden" name="aksi" id="aksi" value="addTax">
						<input type="hidden" name="id_tax" id="id_tax">
						<!-- <input type="hidden" name="aksi" id="tax_aksi"> -->
					</span>

					<span class="col-lg-3 col-sm-5">
						<div class="row col-13">
							<!-- Field untuk tanggal awal -->
							<input type="date" class="form-control" name="date_from" id="date_from" autocomplete="off" placeholder="Dari Tanggal">
							<!-- Tambahkan elemen kalender untuk memilih tanggal -->
							<div class="input-group-append">
								<label class="btn btn-secondary bor-right" for="date_from">
									<i class="fa fa-calendar"></i>
								</label>
							</div>
							<div class="text-danger col-md-12 row"></div>
						</div>
					</span>
						<span class="col-lg-3 col-sm-5">
						<div class="row col-12">
							<!-- Field untuk tanggal berakhir -->
							<input type="date" class="form-control" name="date_till" id="date_till" autocomplete="off" placeholder="Sampai Tanggal">
							<!-- Tambahkan elemen kalender untuk memilih tanggal -->
							<div class="input-group-append">
								<label class="btn btn-secondary bor-right" for="date_till">
									<i class="fa fa-calendar"></i>
								</label>
							</div>
							<div class="text-danger col-md-12 row"></div>
						</div>
					</span>
						<span>
						<div class="row col-lg-12 mt-3">
							<label class="row col-lg-4 col-sm-12">Persentase</label>
							<!-- Field untuk persentase -->
							<div class="row col-lg-2 col-sm-12">
								<div class="input-group">
									<input type="number" class="form-control bor-left number" name="persentage" id="persentage" maxlength="3" autocomplete="off">
									<div class="input-group-append">
										<button type="button" class="btn btn-secondary bor-right">%</button>
									</div>
									<div class="text-danger col-md-12 row"></div>
								</div>
							</div>
						</div>
					</span>
						<span class="col-lg-2 col-sm-5">
						<div class="row col-12">
							<label>Status:</label><br>
							<!-- Field untuk status (Enable/Disable) -->
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="stat" id="enable" value="enable" checked>
								<label class="form-check-label" for="enable">Enable</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="stat" id="disable" value="disable">
								<label class="form-check-label" for="disable">Disable</label>
							</div>
						</div>
					</span>						
						<span class="col-2 pl-1">
						<!-- <button class="btn btn-primary btn-form-tax-add" id="btn-submit" onclick="coba()">Submit</button> -->
						<button id="btn-add-walfa" class="btn btn-primary btn-form-tax-add btn-submit-add">Submit</button>
					</span>
				</form>
				<!-- close halaman add  -->

				<div class="row card-body">
					<div class="table-responsive">
						<table class="table table-hover table-striped" id="view-tax">
							<thead>
								<tr>
									<th class="pr-0" width="5%">
										<div class="i-checks">
											<input type="checkbox" class="check-all checkbox-template">
										</div>
									</th>
									<th width="10%">Persentage</th>
									<th width="25%">Date From</th>
									<th width="25%">Till Date</th>
									<th width="10%">Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$db = model('M_tax');
								$fetch = $db->getTax();
								$data = $fetch['data'];
								$row = $fetch['row'];
								$no = 1;
								foreach ($data as $view) { ?>
									<tr>
										<td>
											<div class="i-checks">
												<input type="checkbox" class="check checkbox-template" name="id[]" value="<?php echo $view['id_tax']; ?>">
											</div>
										</td>
										<td><?php echo $view['persentage']; ?></td>
										<td><?php echo $view['date_from']; ?></td>
										<td><?php echo $view['date_till']; ?></td>
										<td><?php echo $view['stat']; ?></td>
										<td>
											
											<a href="index.php?page=p_tax&sub=detail&id=<?php echo base64_encode($view['id_tax']); ?>&s=<?php echo base64_encode($view['date_from']); ?>&e=<?php echo base64_encode($view['date_till']); ?>">
												<!-- Detail  -->
											</a>
											|
											<a href="#" class="btn-edit" data-id="<?php echo $view['id_tax'].'&'.$view['persentage'].'&'.$view['date_from'].'&'.$view['date_till'].'&'.$view['stat'] ?>">
												<i class="fa fa-pencil mr-1"></i>
											</a>
											|
											<a href="#" data-toggle="modal" data-target="#btn_delete" data-id="<?php echo $view['id_tax']; ?>">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			<!-- </div> -->
		<!-- close tax -->
			
		<!-- table Service Charge -->
		
		<div class="row mt-0 pt-0" id="service-charge-view">
			<div class="row col-12 pl-5">
				<ul class="breadcrumb action-bar pt-0 pb-4 fs-14">				
					<li class="mr-4">
						<a href="#" id="add-service-charge">
						<i class="fa fa-plus-circle"></i> ADD SERVICE CHARGE</a>
					</li>
				</ul>
			</div>
			<div class="row col-12 p-0 m-0" id="service-charge-table">				
			</div>
		</div>








<!--MODALS -->
	<div class="modal fade" id="modal-payment-delete" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">Delete data</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<h6>Are you sure delete <span class="qty-payment-delete"></span> data</h6>
			</div>

			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary" id="modal-payment-btn-yes">Yes</button>		
			</div>
		</div>
		</div>
	</div>


	<div class="modal fade" id="modal-table-delete" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">Delete data</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<h6>Are you sure delete <span class="qty-table-delete"></span> data</h6>
			</div>

			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary" id="modal-table-btn-yes">Yes</button>		
			</div>
		</div>
		</div>
	</div>


<!--modals tax-->

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


<!-- script add tax -->
<!-- jQuery library -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<!-- jQuery UI library (datepicker) -->
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil tombol "Add" berdasarkan ID
    var addButton = document.getElementById('btn-add-tax');

    // Tambahkan event listener untuk klik pada tombol "Add"
    addButton.addEventListener('click', function(event) {
        event.preventDefault(); // Menghentikan perilaku default link

        // Ambil elemen form input berdasarkan ID
        var formInput = document.getElementById('form-input-tax');

        // Tampilkan form input (menghapus kelas d-none untuk menampilkannya)
        formInput.classList.remove('d-none');
    });

    // Tambahkan event listener untuk tombol "Cancel"
    var cancelButton = document.getElementById('btn-cancel');
    cancelButton.addEventListener('click', function(event) {
        event.preventDefault();

        // Sembunyikan form input (menambah kembali kelas d-none untuk menyembunyikannya)
        formInput.classList.add('d-none');
    });
});
</script> -->
<!-- <script>
  $(document).ready(function() {
    // Inisialisasi datepicker untuk input 'date_from'
    $("#date_from").datepicker({
      dateFormat: 'yy-mm-dd',  // Format tanggal yang diinginkan
      onSelect: function(selectedDate) {
        $("#date_till").datepicker('option', 'minDate', selectedDate);  // Set batas minimal 'date_till'
      }
    });

    // Inisialisasi datepicker untuk input 'date_till'
    $("#date_till").datepicker({
      dateFormat: 'yy-mm-dd',  // Format tanggal yang diinginkan
      onSelect: function(selectedDate) {
        $("#date_from").datepicker('option', 'maxDate', selectedDate);  // Set batas maksimal 'date_from'
      }
    });
  });
</script> -->



<script type="text/javascript">

	/*
	 * PROFILE
	*/
		function seviceProfile(url) {
			$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	:  $('#form-profile').serialize(),
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					if(data.status) {
						$('body').loadingModal('destroy');
						history.go(0);
					}
					else {
						$('body').loadingModal('destroy');
						history.go(0);
					}
				}
			})	
		}



	/*
	 * PEYMENT TYPE
	*/
		function getPayment(url) {
			$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	: {'aksi':'getPayment'},
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					
					if(data.status == 'success') {
						$('#payment-type-table').html(data.output);
					}
					else 
					{
						$('#payment-type-table').html(data.output);
					}
					
					
				}
			})	
		}

		function formPayment(url) {
			$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	:  $('#form-payment-type').serialize(),
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					if(data.status == 'success') { notification(data.msg,'right top','success','notifSuccess',5000); } 
					else { notification(data.msg,'right top','danger','notifDanger',5000); }
				}
			})	
		}

		function deletePayment(url,action,id)
		{
			$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	: {'aksi':action,'id_payment':id},
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					if(data.status == 'success') { notification(data.msg,'right top','success','notifSuccess',5000); } 
					else { notification(data.msg,'right top','danger','notifDanger',5000); }
				}
			})	
		}		



	/*
	 * TABLE
	*/
		function getTable(url) {
			$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	: {'aksi':'getTable'},
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					
					if(data.status == 'success') {
						$('#table-column-table').html(data.output);
					}
					else 
					{
						$('#table-column-table').html(data.output);
					}
					
					
				}
			})	
		}


		function formTable(url) {
			$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	:  $('#form-table').serialize(),
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					if(data.status == 'success') { notification(data.msg,'right top','success','notifSuccess',5000); } 
					else { notification(data.msg,'right top','danger','notifDanger',5000); }
				}
			})	
		}


		function deleteTable(url,action,id)
		{
			$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	: {'aksi':action,'table_id':id},
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					if(data.status == 'success') { notification(data.msg,'right top','success','notifSuccess',5000); } 
					else { notification(data.msg,'right top','danger','notifDanger',5000); }
				}
			})	
		}	


		// /*
		// TAX
		// */

		// function formPayment(url) {
		// 	$.ajax({
		// 		url 	: url,
		// 		type 	: 'POST',
		// 		data 	:  $('#form-tax-t').serialize(),
		// 		dataType: 'html',
		// 		success	: function(response){
		// 			var data =  $.parseJSON(response);
		// 			if(data.status == 'success') { notification(data.msg,'right top','success','notifSuccess',5000); } 
		// 			else { notification(data.msg,'right top','danger','notifDanger',5000); }
		// 		}
		// 	})	
		// }

</script>


<script type="text/javascript">
	//var URL_TAX		= 'process/P_tax.php';
	$(document).ready(function() {
		var setContent,setMenu;
		
		var URL_TAX = "process/P_tax.php";
		var URL_PROFILE = 'process/P_profile.php';
		var URL_TABLE 	= 'process/P_table.php';
		var URL_PAYMENT = 'process/P_payment_type.php';
		
		var PROFILEROW 	= $('#profileRow').val();

		//check cookie
			if(!!getCookie('setting-content'))
			{
				setContent  = getCookie('setting-content');
				setMenu 	= getCookie('menu-setting');

				$('.'+setContent).addClass('setting-active');
				$('#'+setMenu).removeClass('d-none');
			}
			else 
			{
				setCookie('setting-content','setting-profile');
				setCookie('menu-setting','setting-profile');

				setContent  = getCookie('setting-content');
				setMenu 	= getCookie('menu-setting');

				$('.'+setContent).addClass('setting-active');
				$('#'+setMenu).removeClass('d-none');
			}
		$('.setting-content').click(function(event) {
			removeCookie('setting-content');
			removeCookie('menu-setting');
			var data = $(this).attr('data-id');	

				setCookie('setting-content', data);
				setCookie('menu-setting', data);

				$(this).addClass('setting-active');
				$(this).siblings().removeClass('setting-active');

				$('#'+data).closest('.menu-setting').removeClass('d-none');
				$('#'+data).siblings('.menu-setting').addClass('d-none');


				if(data == 'setting-profile') 
				{
					
				}
		});


		/* 
		 * FOR PROFILE
		*/
			if(PROFILEROW > 0) { 
				$('.btn-form-profile').text('Update Profile'); 
				$('.btn-form-profile').addClass('d-none');
				$('#profile_aksi').val('updateProfile');
				$('#checkbox-editProfile').removeClass('d-none');

				$('.profile-input').each(function(index, el) {
					$(this).prop('readonly', true);
				});
			}
				else { 
					$('.btn-form-profile').text('Add Profile'); 
					$('#profile_aksi').val('addProfile');
					$('#checkbox-editProfile').addClass('d-none');
				}

			$('.checkbox-editProfile').click(function(event) {
				if(this.checked) {					
					$('.btn-form-profile').removeClass('d-none');
					$('.profile-input').each(function(index, el) {
					$(this).prop('readonly', false);						
					});
				}
				else {
					$('.btn-form-profile').addClass('d-none');
					$('.profile-input').each(function(index, el) {
					$(this).prop('readonly', true);						
					});
				}
			});

			$('#form-profile').submit(function(event) {
				event.preventDefault();
				if(PROFILEROW > 0)
				{
					loading("Please wait to updating data ...");	
					seviceProfile(URL_PROFILE);
				}
				else 
				{
					loading("Please wait to add data ...");	
					seviceProfile(URL_PROFILE);
				}
			});



		/*
		 * PAYMENT METHODE
		*/
			var checked = [];
			getPayment(URL_PAYMENT);
			$(document).on('click', '.checkbox-payment-all', function(event) {		
				if(this.checked) 
				{
					$('#delete-payment-all').removeClass('d-none');
					$('.checkbox-payment').each(function(index, el) {
					$(this).prop('checked', true);
					});

					$('.checkbox-payment:checked').each(function(index, el) {
						var val 		= $(this).val();
						var datachecked = val.split('&');
						checked.push(datachecked[0]);
					});					
				}
				else 
				{
					$('#delete-payment-all').addClass('d-none');
					$('.checkbox-payment').each(function(index, el) {
					$(this).prop('checked', false);
					});	
					checked = [];
				}
			});

			$(document).on('click', '.checkbox-payment', function(event) {
				var val 			= $(this).val();
				var datachecked 	= val.split('&');
				var length_check 	= $('.checkbox-payment:checked').length;
				var length_uncheck 	= $('.checkbox-payment:unchecked').length;

				if(length_check == 1) {
					$('#edit-payment').removeClass('d-none'); 
					$('#delete-payment').removeClass('d-none');
					$('#delete-payment-all').addClass('d-none');
				}
				else {
					$('#edit-payment').addClass('d-none'); 
					$('#delete-payment').addClass('d-none');
					$('#delete-payment-all').removeClass('d-none');
				}	


				if(this.checked) 
				{
					checked.push(datachecked[0]);
					if(length_uncheck == 0) {
					$('.checkbox-payment-all').prop('checked',true);
					$('#delete-payment-all').removeClass('d-none');
					}					
				}
				else 
				{
					$('.checkbox-payment-all').prop('checked',false);
					var val  	= $(this).val().split('&');
					var uncheck = val[0];

					for (var i = checked.length - 1; i>=0; i--) {
						if(uncheck == checked[i]) {	checked.splice(i,1); }	    			
					}
				}
			});

			$('#add-payment').click(function(event) {
				$('#payment-type-view').addClass('d-none');
				$('#payment-type-form').removeClass('d-none');

				$('#form-payment-type-title').text('Add Payment Type');
				$('#aksi_payment').val('addPayment');
				$('#id_payment').val('');
				$('#name_payment').val('');

				$('.btn-form-payment-update').addClass('d-none');
				$('.btn-form-payment-add').removeClass('d-none');
				$('.label-payment').each(function(index, el) {
					$(this).removeClass('active');
				});				
			});

			$('#edit-payment').click(function(event) {
				var val 	= $('.checkbox-payment:checked').val();
				var split 	= val.split('&');

				$('#payment-type-view').addClass('d-none');
				$('#payment-type-form').removeClass('d-none');

				$('#form-payment-type-title').text('Edit Payment Type');
				$('#aksi_payment').val('editPayment');
				$('#id_payment').val(split[0]);
				$('#name_payment').val(split[1]);

				$('.btn-form-payment-update').removeClass('d-none');
				$('.btn-form-payment-add').addClass('d-none');

				$('.label-payment').each(function(index, el) {
					$(this).addClass('active');
				});				
			});

			$('.btn-form-payment-cancel').click(function(event) {
				event.preventDefault();
				checked = [];
				$('#payment-type-view').removeClass('d-none');
				$('#payment-type-form').addClass('d-none');
				$('#edit-payment').addClass('d-none');
				$('#delete-payment').addClass('d-none');
				$('#delete-payment-all').addClass('d-none');
				$('.checkbox-payment-all').prop('checked', false);
				$('.checkbox-payment').prop('checked', false);				
				getPayment(URL_PAYMENT);				
			});
		


			//action form
			$('#form-payment-type').submit(function(event) {
				event.preventDefault();
				var data = $('#id_payment').val();

					//for add
					if(data == '') 
					{
						formPayment(URL_PAYMENT);
						getPayment(URL_PAYMENT);	
						$('#payment-type-form').addClass('d-none');
						$('#edit-payment').addClass('d-none');
						$('#delete-payment').addClass('d-none');
						$('#payment-type-view').removeClass('d-none');
					}
					else 
					{
						formPayment(URL_PAYMENT);
						getPayment(URL_PAYMENT);	
						$('#payment-type-form').addClass('d-none');
						$('#edit-payment').addClass('d-none');
						$('#delete-payment').addClass('d-none');
						$('#payment-type-view').removeClass('d-none');						
					}
			});

			$('#delete-payment').click(function(event) {
				var val 	= $('.checkbox-payment:checked').val();
				var split	= val.split('&');
				var id 		= split[0];
				var action 	= 'deletePayment';

					deletePayment(URL_PAYMENT,action,id);
					getPayment(URL_PAYMENT);						
					$('#edit-payment').addClass('d-none');
					$('#delete-payment').addClass('d-none');
			});

			$('#delete-payment-all').click(function(event) {
				event.preventDefault();    	
				var length = $('.checkbox-payment:checked').length;

					$('#modal-payment-delete').modal('show');
					$('#modal-payment-delete').find('.qty-payment-delete').text(length);	    		
			});

			$('#modal-payment-btn-yes').click(function(event) {
				event.preventDefault();
				var id 		= checked;	
				var action 	= 'deletePayment-all';

					deletePayment(URL_PAYMENT,action,id);
					getPayment(URL_PAYMENT);	
					$('#edit-payment').addClass('d-none');
					$('#delete-payment').addClass('d-none');
					$('#modal-payment-delete').modal('hide');
					$('#modal-payment-delete').find('.qty-payment-delete').text('');
			});



		/* 
		 * TABLE
		*/
			var checked_table = [];
			getTable(URL_TABLE);
			$('#add-table').click(function(event) {
				$('#table-column-view').addClass('d-none');
				$('#table-column-form').removeClass('d-none');

				$('#form-table-title').text('Add Table');
				$('#aksi_table').val('addTable');
				$('#table_id').val('');
				$('#table_number').val('');

				$('.btn-form-table-update').addClass('d-none');
				$('.btn-form-table-add').removeClass('d-none');
				$('.label-table').each(function(index, el) {
					$(this).removeClass('active');
				});				
			});

			$('#edit-table').click(function(event) {
				var val 	= $('.checkbox-table:checked').val();
				var split 	= val.split('&');

					$('#table-column-view').addClass('d-none');
					$('#table-column-form').removeClass('d-none');

					$('#form-table-title').text('Edit Table');
					$('#aksi_table').val('editTable');
					$('#table_id').val(split[0]);
					$('#table_number').val(split[1]);

					$('.btn-form-table-update').removeClass('d-none');
					$('.btn-form-table-add').addClass('d-none');

					$('.label-table').each(function(index, el) {
						$(this).addClass('active');
					});			
			});

			$('.btn-form-table-cancel').click(function(event) {
				event.preventDefault();
					$('#table-column-view').removeClass('d-none');
					$('#table-column-form').addClass('d-none');
					$('#edit-table').addClass('d-none');
					$('#delete-table').addClass('d-none');
					$('.checkbox-table-all').prop('checked', false);
					$('.checkbox-table').prop('checked', false);
					getTable(URL_TABLE);				
			});

			$(document).on('click', '.checkbox-table-all', function(event) {		
				if(this.checked) 
				{
					$('#delete-table-all').removeClass('d-none');
					$('.checkbox-table').each(function(index, el) {
					$(this).prop('checked', true);
					});

					$('.checkbox-table:checked').each(function(index, el) {
						var val 		= $(this).val();
						var datachecked = val.split('&');
						checked_table.push(datachecked[0]);
					});					
				}
				else 
				{
					$('#delete-table-all').addClass('d-none');
					$('.checkbox-table').each(function(index, el) {
					$(this).prop('checked', false);
					});	
					checked_table = [];
				}
			});

			$(document).on('click', '.checkbox-table', function(event) {
				var val 			= $(this).val();
				var datachecked 	= val.split('&');
				var length_check 	= $('.checkbox-table:checked').length;
				var length_uncheck 	= $('.checkbox-table:unchecked').length;

					if(length_check == 1) {
						$('#edit-table').removeClass('d-none'); 
						$('#delete-table').removeClass('d-none');
						$('#delete-table-all').addClass('d-none');
					}
					else {
						$('#edit-table').addClass('d-none'); 
						$('#delete-table').addClass('d-none');
						$('#delete-table-all').removeClass('d-none');
					}	


					if(this.checked) 
					{
						checked_table.push(datachecked[0]);
						if(length_uncheck == 0) {
						$('.checkbox-table-all').prop('checked',true);
						$('#delete-table-all').removeClass('d-none');
						}					
					}
					else 
					{
						$('.checkbox-table-all').prop('checked',false);
						var val  	= $(this).val().split('&');
						var uncheck = val[0];

						for (var i = checked_table.length - 1; i>=0; i--) {
							if(uncheck == checked_table[i]) {	checked_table.splice(i,1); }	    			
						}
					}
			});



			//form action
			$('#form-table').submit(function(event) {
				event.preventDefault();
				var data = $('#table_id').val();

					//for add
					if(data == '') 
					{
						formTable(URL_TABLE);	
						getTable(URL_TABLE);					
						$('#table-column-form').addClass('d-none');
						$('#table-column-view').removeClass('d-none');
						$('#edit-table').addClass('d-none');
						$('#delete-table-all').addClass('d-none');											
					}
					else 
					{
						formTable(URL_TABLE);
						getTable(URL_TABLE);
						$('#table-column-form').addClass('d-none');
						$('#table-column-view').removeClass('d-none');
						$('#edit-table').addClass('d-none');
						$('#delete-table-all').addClass('d-none');			
					}
			});

			$('#delete-table').click(function(event) {
				event.preventDefault();
				var val 	= $('.checkbox-table:checked').val();
				var split	= val.split('&');
				var id 		= split[0];
				var action 	= 'deleteTable';

					deleteTable(URL_TABLE,action,id);
					getTable(URL_TABLE);
					$('#edit-table').addClass('d-none');
					$('#delete-table').addClass('d-none');
			});

			$('#delete-table-all').click(function(event) {
				event.preventDefault();    	
				var length = $('.checkbox-table:checked').length;

					$('#modal-table-delete').modal('show');
					$('#modal-table-delete').find('.qty-table-delete').text(length);	    		
			});

			$('#modal-table-btn-yes').click(function(event) {
				event.preventDefault();
				var id 		= checked_table;	
				var action 	= 'deleteTable-all';

					deleteTable(URL_TABLE,action,id);
					getTable(URL_TABLE);					
					$('#edit-table').addClass('d-none');
					$('#delete-table').addClass('d-none');
					$('#modal-table-delete').modal('hide');
					$('#modal-table-delete').find('.qty-table-delete').text('');				
			});

	});



</script>


<!-- TAX -->


<script>
// 	function formInput(url) {
//     // Tampilkan pesan loading
//     loading("Please wait ...");

//     // Ambil data formulir menggunakan serialize()
//     var formData = $('#form-input-tax').serialize();

//     // Kirim permintaan AJAX
//     $.ajax({
//         url: url,
//         type: 'POST',
//         data: formData,
//         dataType: 'json', // Harapkan respons dalam format JSON
//         success: function(response) {
//             if (response.status === 'success') {
//                 // Jika penyimpanan berhasil, hapus pesan loading
//                 $('body').loadingModal('destroy');
//                 // Refresh halaman untuk memperbarui tampilan data
//                 location.reload();
//             } else {
//                 // Jika terjadi kesalahan, tampilkan pesan kesalahan
//                 $('body').loadingModal('destroy');
//                 $('#error-msg').html(alertDanger(response.msg));
//             }
//         },
//         error: function(xhr, status, error) {
//             // Tangani kesalahan saat melakukan permintaan AJAX
//             console.error(error); // Tampilkan pesan kesalahan di konsol
//             $('body').loadingModal('destroy');
//             $('#error-msg').html(alertDanger('An error occurred. Please try again.'));
//         }
//     });
// }
		// function getTax(url) {
		// 	$.ajax({
		// 		url 	: url,
		// 		type 	: 'POST',
		// 		data 	: {'aksi':'getTax'},
		// 		dataType: 'html',
		// 		success	: function(response){
		// 			var data =  $.parseJSON(response);
					
		// 			if(data.status == 'success') {
		// 				$('#tax-type-table').html(data.output);
		// 			}
		// 			else 
		// 			{
		// 				$('#tax-type-table').html(data.output);
		// 			}
					
					
		// 		}
		// 	})	
		// }

		//  var URL_TAX = "process/P_tax.php";
		
		// $(document).ready(function() {
		// 	// Tempatkan kode JavaScript di sini
		// 	$('#btn-add-walfa').click(function(event) {
		// 		event.preventDefault();
		// 		$('#aksi').val('addTax');
		// 		TaxAdd(); // Panggil fungsi TaxAdd saat tombol ditekan
		// 	});
		// });

		// function TaxAdd() {
		// 	$.ajax({
		// 		url: URL_TAX,
		// 		type: 'POST',
		// 		data: $('#form-input-tax').serialize(),
		// 		// alert(form-input-tax);
		// 		//console.log($('#form-input-tax').serialize());
		// 		dataType: 'json',
		// 		success: function(response) {
		// 			// Fungsi yang dipanggil ketika AJAX berhasil
		// 			if (response.status == 'success') {
		// 				notification(data.msg,'right top','success','notifSuccess',5000);
		// 				// Tindakan jika data berhasil disimpan
		// 				alert('Data berhasil disimpan');
		// 			} else {
		// 				notification(data.msg,'right top','danger','notifDanger',5000
		// 				// Tindakan jika terjadi kesalahan saat menyimpan data
		// 				alert('Gagal menyimpan data');
		// 			}
		// 		},
		// 		error: function(xhr, status, error) {
		// 		// Fungsi yang dipanggil jika terjadi kesalahan pada AJAX request
		// 		console.log(xhr.responseText); // Debug: Log pesan kesalahan ke konsol browser
		// 		alert('Terjadi kesalahan saat mengirim data');
		// 	}
		// 	});

		// }






		// function TaxAdd(url) {
		// 	// alert("masuk");
		// 	// alert(URL_TAX);
		// 	//var aksi=document.getElementById("aksi_tax").value;
		// 	// alert(aksi);
		// 	//console.log(URL_TAX);
		// 	//console.log($('#form-input-tax').serialize());
		// 	$.ajax({
		// 		// url 	: url,
		// 		url 	: URL_TAX,
		// 		type 	: 'POST',
		// 		data 	:  $('#form-input-tax').serialize(),
		// 		dataType: 'html',
		// 		success	: function(response){
		// 			var data =  $.parseJSON(response);
		// 			if(data.status == 'success') { notification(data.msg,'right top','success','notifSuccess',5000); } 
		// 			else { notification(data.msg,'right top','danger','notifDanger',5000); }
		// 		}
		// 	})	
		// }


		function coba(){
			document.getElementById("aksi_tax").value="addTax";
			TaxAdd();
			// $('#aksi_tax').val('addTax');
			// alert("masuk");
			// alert(URL_TAX);
		}


	function TaxDelete(url,aksi,id)
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
		var URL_TAX 	  = 'process/P_tax.php';
		var checked   = [];

		// $('#btn-add-walfa').click(function(event) {
		// 	event.preventDefault();
		// 	TaxAdd();
		// });















		function getTax(url) {
			$.ajax({
				url 	: url,
				type 	: 'POST',
				data 	: {'aksi':'getTax'},
				dataType: 'html',
				success	: function(response){
					var data =  $.parseJSON(response);
					
					if(data.status == 'success') {
						$('#tax-type-table').html(data.output);
					}
					else 
					{
						$('#tax-type-table').html(data.output);
					}
					
					
				}
			})	
		}

		//var URL_TAX = "process/P_tax.php";
		
		$(document).ready(function() {
			// Tempatkan kode JavaScript di sini
			$('#btn-add-walfa').click(function(event) {
				event.preventDefault();
				$('#aksi').val('addTax');
				TaxAdd(); // Panggil fungsi TaxAdd saat tombol ditekan
			});
		});

		function TaxAdd() {
			$.ajax({
				url: URL_TAX,
				type: 'POST',
				data: $('#form-input-tax').serialize(),
				// alert(form-input-tax);
				//console.log($('#form-input-tax').serialize());
				dataType: 'json',
				success: function(response) {
					if (response.status == 'success') {
						//notification(data.msg,'right top','success','notifSuccess',5000); // Pastikan penutup kurung lengkap di sini
						alert('Data berhasil disimpan');
					} else {
						notification(data.msg,'right top','danger','notifDanger',5000); // Pastikan penutup kurung lengkap di sini
						alert('Gagal menyimpan data');
					}
				},
				error: function(xhr, status, error) {
					// Fungsi yang dipanggil jika terjadi kesalahan pada AJAX request
					console.log(xhr.responseText); // Debug: Log pesan kesalahan ke konsol browser
					alert('Terjadi kesalahan saat mengirim data');
				}
				
			});
		}












		//getTax(url);
		$('#btn-add-tax').click(function(event) {

			//TaxAdd(url);
			// alert("muncul");
			event.preventDefault();
			//$('#tax-column-view').addClass('d-none');
			//$('#view-tax').removeClass('d-none');
			// var url = 'process/P_tax.php';

			// Mengatur nilai-nilai elemen input
			$('#aksi_tax').val('addTax');
			//$('#aksi').val('addTax');
			
			//$('#tax_aksi').val('`addTax`');
			$('#persentage').val(persentage);
			$('#date_from').val(date_from);
			$('#date_till').val(date_till);
			//$('#stat').val(stat);
			$('input[name="stat"][value="enable"]').prop('checked', true); // Memilih radio button "Enable" secara default

			// Menampilkan form input tax dan menyembunyikan elemen lain
			$('#table-filter').addClass('d-none');
			$('#form-input-tax').removeClass('d-none');
			$('.btn-submit-add').removeClass('d-none');
			$('#btn-submit').text('Save');
		});



			$('.btn-edit').click(function(event) {
				event.preventDefault();
				var val 	 = $(this).attr('data-id');
				var split 	 = val.split('&');
				var id_tax = split[0];
				var persentage = split[1];
				var date_from 	 = split[2];
				var date_till 	 = split[3];
				var stat		 = split[4];

					$('#aksi').val('editTax');
					$('#id_tax').val(id_tax);
					$('#persentage').val(persentage);
					$('#date_from').val(date_from);
					$('#date_till').val(date_till);
					$('#stat').val(stat);

					$('#table-filter').addClass('d-none');
					$('#form-input-tax').removeClass('d-none');
					$('#btn-submit').text('Update');
			});


			$('#btn-cancel').click(function(event) {
				$('#table-filter').removeClass('d-none');
				$('#form-input-tax').addClass('d-none');
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
			$('#date_from').change(function(event) {
				var val = $(this).val();
				if(val == '') { error(this,'Please complete the form');}
				else { success(this);}
				}).keyup(function(event) {
					if(val == '') { error(this,'Please complete the form');}
					else { success(this);}
			});

			$('#date_till').change(function(event) {
				var val = $(this).val();
				if(val == '') { error(this,'Please complete the form');}
				else { success(this);}
				}).keyup(function(event) {
					if(val == '') { error(this,'Please complete the form');}
					else { success(this);}
			});

			// $('#date_from').datetimepicker({
			// 	format:'Y-m-d H:i:s',
			// 	onShow:function(ct){
			// 		this.setOptions({
			// 		maxDate:$('#date_till').val()?$('#date_till').val():false
			// 		})
			// 	},
			// 	timepicker:true
			// });

			// $('#date_till').datetimepicker({
			// 	format:'Y-m-d H:i:s',
			// 	onShow:function(ct){
			// 		this.setOptions({
			// 		minDate:$('#date_from').val()?$('#date_from').val():false
			// 		})
			// 	},
			// 	timepicker:true
			// });


			
		/*
		 * FORM
		*/
			// $('#form-input-tax').submit(function(event) {
			// 	event.preventDefault();
			// 	var valid 	= true;
			// 	var aksi 	= $('#aksi').val();

			// 		if(aksi == 'addTax') 
			// 		{
			// 			$(this).find('input[type=text], select').each(function() {
			// 				if(!$(this).val()) {
			// 				error(this,"Please complete the form");
			// 				valid= false;
			// 				}
			// 				if ($(this).hasClass('is-invalid')){
			// 				valid = false;
			// 				error(this,"Please complete the form");
			// 				}
			// 			});						
			// 			if(valid) { formInput(url); }	
			// 		} 

			// 		else if(aksi == 'editTax')
			// 		{
			// 			$(this).find('input[type=text], select').each(function() {
			// 				if(!$(this).val()) {
			// 				error(this,"Please complete the form");
			// 				valid= false;
			// 				}
			// 				if ($(this).hasClass('is-invalid')){
			// 				valid = false;
			// 				error(this,"Please complete the form");
			// 				}
			// 			});						
			// 			if(valid) { formInput(url); }	
			// 		}					
			// });


			$('#btn-modal-delete-yes').click(function(event) {
				event.preventDefault()
				var id 		= $('#modal-delete').find('#id').val();
				var aksi 	= 'deleteTax';
				formDelete(url,aksi,id);
			});


			$('#btn_delete_all_yes').click(function(event) {
				event.preventDefault();
				var aksi = 'deleteAll';
				formDelete(url,aksi,checked);
			});

			// function formInput(url) {
			// 	loading("Please wait ...");
			// 	$.ajax({
			// 			url 	: url,
			// 			type 	: 'POST',
			// 			data 	:  $('#form-input-tax').serialize(),
			// 			dataType: 'html',
			// 			success	: function(response){
			// 				var data =  $.parseJSON(response);
			// 				if(data.status == 'success') {
			// 					$('body').loadingModal('destroy');
			// 					history.go(-1);
			// 				}
			// 				else {
			// 					$('body').loadingModal('destroy');
			// 					$('#error-msg').html(alertDanger(data.msg));
			// 				}
			// 			}
			// 	})
			// }
			// $('#form-input-tax').submit(function(event) {
			// 	event.preventDefault();
			// 	var valid = true;

			// 		$(this).find('input[type=text]').each(function() {
			// 			if(!$(this).val()) {
			// 				error(this,"Please complete the form");
			// 				valid= false;
			// 			}
			// 			if ($(this).hasClass('is-invalid')){
		    //             	valid = false;
		    //             	$('.is-invalid').focus();
		    //         	}
			// 		});
			// 		if(valid) {formInput(URL);}
			// });
			
	});

	
</script>