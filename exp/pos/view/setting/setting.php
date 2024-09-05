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

<div class="col-8 p-0 ">
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
</div>
</div>
</div><!--close row-->








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
</script>


<script type="text/javascript">

	$(document).ready(function() {
		var setContent,setMenu;
		
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

