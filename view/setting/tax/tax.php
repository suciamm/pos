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
						<span class="pointer" id="btn-cancel"><i class="fa fa-close pointer btn-form-tax-cancel"></i> Close </span>
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
						<!-- <button id="btn-add-tax" class="btn btn-primary btn-form-tax-add btn-submit-add">Submit</button> -->
						<button id="btn-add-tax" class="btn btn-primary btn-form-tax-add btn-submit-add">Submit</button>

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
											
											<!-- <a href="index.php?page=p_tax&sub=detail&id=<?php echo base64_encode($view['id_tax']); ?>&s=<?php echo base64_encode($view['date_from']); ?>&e=<?php echo base64_encode($view['date_till']); ?>"> -->
												<!-- Detail  -->
											<!-- </a> -->
											|
											<a href="#" class="btn-edit-tax" data-id="<?php echo $view['id_tax'].'&'.$view['persentage'].'&'.$view['date_from'].'&'.$view['date_till'].'&'.$view['stat'] ?>">
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
<!-- TAX -->

<script type="text/javascript">
	$(document).ready(function() {
		var URL_TAX 	  = 'process/P_tax.php';
		var checked   = [];
		
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
			$('#btn-add-tax').click(function(event) {
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
				dataType: 'json',
				success: function(response) {
					if (response.status == 'success') {
						alert('Data berhasil disimpan');
						// Lakukan tindakan lain setelah sukses menyimpan data
						// Contoh: sembunyikan form setelah berhasil
						$('#form-input-tax').addClass('d-none');
						$('#table-filter').removeClass('d-none');
					} else {
						alert('Gagal menyimpan data');
					}
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
					alert('Terjadi kesalahan saat mengirim data');
				}
			});
		}




		//getTax(url);
		$('#btn-add-tax').click(function(event) {

			//TaxAdd(url);
			// alert("muncul");
			
			//$('#tax-column-view').addClass('d-none');
			//$('#view-tax').removeClass('d-none');
			// var url = 'process/P_tax.php';

			// Mengatur nilai-nilai elemen input
			$('#aksi_tax').val('addTax');
			event.preventDefault();
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


		//EDIT TAX

		function TaxEdit() {
			$.ajax({
				url: URL_TAX,
				type: 'POST',
				data: $('#form-input-tax').serialize(),
				dataType: 'json',
				success: function(response) {
					if (response.status == 'success') {
						alert('Data berhasil diperbarui'); // Tampilkan pesan sukses
						// Lakukan tindakan lain jika perlu, misalnya perbarui tampilan
					} else {
						alert('Gagal memperbarui data'); // Tampilkan pesan gagal
					}
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText); // Debug: Log pesan kesalahan ke konsol browser
					alert('Terjadi kesalahan saat mengirim data'); // Tampilkan pesan kesalahan
				}
			});
		}

		$('.btn-edit-tax').click(function(event) {
			event.preventDefault();
			var val = $(this).attr('data-id');
			var split = val.split('&');
			var id_tax = split[0];
			var persentage = split[1];
			var date_from = split[2];
			var date_till = split[3];
			var stat = split[4];

			// Mengisi nilai form dengan data yang dipilih untuk diedit
			$('#aksi').val('editTax');
			$('#id_tax').val(id_tax);
			$('#persentage').val(persentage);
			$('#date_from').val(date_from);
			$('#date_till').val(date_till);
			$('input[name="stat"][value="' + stat + '"]').prop('checked', true);

			// Menampilkan form input tax dan menyembunyikan elemen lain
			$('#table-filter').addClass('d-none');
			$('#form-input-tax').removeClass('d-none');
			$('#btn-submit').text('Update');
			TaxEdit();
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





			//DELETE TAX
			function deleteTax(url,aksi,id)
				{
					// loading("Please wait to delete data ...");
					$.ajax({
						url: URL_TAX,
						type: 'POST',
						data: { 'aksi': aksi, 'id': id },
						dataType: 'json',
						success: function(response) {
							if (response.status == 'success') {
								$('body').loadingModal('destroy');
								// Refresh halaman atau lakukan tindakan lain setelah penghapusan berhasil
								location.reload(); // Contoh: refresh halaman setelah penghapusan berhasil
							} else {
								$('body').loadingModal('destroy');
								alert('Gagal menghapus data: ' + response.msg);
							}
						},
					});
				}
				
			$('#btn-modal-delete-yes').click(function(event) {
				event.preventDefault()
				var id 		= $('#modal-delete').find('#id').val();
				var aksi 	= 'deleteTax';
				deleteTax(URL_TAX,aksi,id);
			});


			$('#btn_delete_all_yes').click(function(event) {
				event.preventDefault();
				var aksi = 'deleteAll';
				deleteTax(URL_TAX,aksi,checked);
			});
	});

	
</script>

