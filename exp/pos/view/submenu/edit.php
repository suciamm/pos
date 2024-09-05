<?php
	$id 		= base64_decode($_GET['id']);
	$submenu 	= model('M_submenu');
	$view		= $submenu->edit_submenu($id);
?>


<div class="breadcrumb-holder container-fluid">
	<div class="row pt-3">
		<div class="row col-md-6 col-sm-12">
			<ul class="breadcrumb action-bar">				
				<li class="mr-4">
					<a href="#" id="back" data-id='index.php?page=submenu&sub=view'>
					<i class="fa fa-arrow-left"></i> Back</a>
				</li>
			</ul>
		</div>
		<div class="col-md-6 col-sm-12">
			<ul class="row breadcrumb fa-pull-right">
			<li class="breadcrumb-item active"><b>Menu</b></li>
			<li class="breadcrumb-item"><b>Edit Submenu</b></li>
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
					<i class="fa fa-info-circle"></i> EDIT SUBMENU | <span>item category</span>
					</div>					
				</div><hr>
				<div class="card-body mb-5">
					<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="col-md-12 col-sm-12">						
						<form id="form_submenu_add" method="post" enctype="multipart/form-data">
							<div class="row col-md-12">								
								<label class="row col-md-3 col-sm-10">Menu</label>
								<div class="row col-md-6 col-sm-12">
									<select class="form-control menu" id="menu" name="menu">
											<?php
												$modelmenu	= model('M_menu');
												$newmenu	= $modelmenu->view_menu();
												$fetch_menu = $newmenu['data'];
												
												foreach ($fetch_menu as $menu) {
												if ($view['id_menu'] == $menu['id_menu']) {$tandai = "selected";} 
												else {$tandai="";} ?>
											
											<option value="<?php echo $menu['id_menu']; ?>" <?php echo $tandai; ?>>
											<?php echo $menu['menu']; } ?></option>
									</select>
									<div class="text-danger col-md-12 row"></div>
								</div>								
							</div>

							<div class="row col-md-12 mt-3">								
								<label class="row col-md-3 col-sm-10">Submenu</label>
								<div class="row col-md-6 col-sm-12">
									<input type="text" name="submenu" class="form-control" id="submenu" maxlength="30" 
									value="<?php echo $view['submenu']; ?>">
									<div class="text-danger col-md-12 row"></div>
								</div>								
							</div>				
						</div>
					</div>				
					</div>	<!--close row-->
				</div>

				<div class="card-footer">
					<div class="col-md-4">
						<input type="hidden" name="aksi" value="edit">
						<input type="hidden" id="id_submenu" name="id_submenu" value="<?php echo $view['id_submenu']; ?>">	
						<input type="hidden" id="submenuold" name="submenuold" value="<?php echo $view['submenu']; ?>">

						<button type="reset" class="btn btn-secondary btn-sm mr-2" id="cancel" value="index.php?page=submenu&sub=view">
						<i class="fa fa-close"></i> Cancel</button>
						<button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Save</button>
						</form>
					</div>
				</div>
		</div>		
		</div>


	</div>
</div>
</div>


<script type="text/javascript">

	$(document).ready(function() {

		$('.menu').change(function() {
			var data = $(this).val();
			if(data !='') { 
				return success(this);
			} 
			else { return error(this,'Please complete the form');}
		});

		$('#submenu').blur(function(event) {
				var data 	= $(this).val();
				var menu 	= $('.menu').val();
				var dataold = $('#submenuold').val();
				
				if(menu == '') { return error(this,'Please select menu'); }
				else {
					if(data == '') { return error(this,'Please complete the form'); }
					else 
					{
						$.ajax({
								url 	: 'process/P_submenu.php',
								type 	: 'POST',
								data 	: {'menu':menu,'submenu':data,'submenuold':dataold, 'aksi':'check_submenu_edit'},
								dataType: "text",
								success : function(response){
									var data = $.parseJSON(response);								
									if(data.status == 1){
										return error('#submenu','Submenu was used');
									} 
									else {
										return success('#submenu');
									}
							}
						}); 
					}
				}
			}).keyup(function(event) {
				var data = $(this).val();
				var menu = $('.menu').val();

				if(menu == '') { return error(this,'Please select menu'); }
				else {	
					return success(this);
				}				
		});

		$('#form_submenu_add').submit(function(e) {
			e.preventDefault();
			var valid = true;

			$(this).find('input, select').each(function() {
				if(!$(this).val()) {
					error(this,"Please complete the form");
					valid= false;
				}

				if ($(this).hasClass('is-invalid')){
                	valid = false;
            	}
			});

			if(valid) {
				$.ajax({
					url: 'process/P_submenu.php',
					type: 'POST',
					data: new FormData(this), 
					contentType: false,
					cache: false,
					processData:false,
					dataType: 'html',
					success: function(response){
						var data = $.parseJSON(response);
						
						if(data.status == "success"){
							location.href='index.php?page=submenu&sub=view';
						} 
						else {
							console.log('gagal');
						}
					}
				});
			}			
		});
	});
</script>