<?php 
	$id = base64_decode($_GET['id']);

	$db 	= model('M_menu');
	$fetch 	= $db->edit_menu($id);
	$view 	= $fetch['data'];

?>




<div class="breadcrumb-holder container-fluid">
	<div class="row pt-3">
		<div class="row col-md-6 col-sm-12">
			<ul class="breadcrumb action-bar">				
				<li class="mr-4">
					<a href="#" id="back" data-id='index.php?page=menu&sub=view'>
					<i class="fa fa-arrow-left"></i> Back</a>
				</li>
			</ul>
		</div>
		<div class="col-md-6 col-sm-12">
			<ul class="row breadcrumb fa-pull-right">
			<li class="breadcrumb-item active"><b>MENU</b></li>
			<li class="breadcrumb-item active"><b>Edit Menu</b></li>
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
					<i class="fa fa-info-circle"></i> NEW SUBMENU | <span>item</span>
					</div>				
				</div><hr>
				<div class="card-body mb-5">
					<div class="row">
					<div class="col-md-7 col-sm-12">
						<div class="col-md-12 col-sm-12">						
						<form id="form_menu_edit" method="post" enctype="multipart/form-data">
							<div class="row col-md-12">								
								<label class="row col-md-4 col-sm-10">Menu</label>
								<div class="row col-md-8 col-sm-12">
									<input type="text" name="menu" class="form-control" id="menu" value="<?php echo $view['menu']; ?>" maxlength="30">
									<input type="hidden" name="id_menu" value="<?php echo $view['id_menu']; ?>">
									<input type="hidden" name="icon_old" value="<?php echo $view['icon']; ?>" id="icon_old">
									<input type="hidden" name="menu_old" value="<?php echo $view['menu']; ?>" id="menu_old">
									<div class="text-danger col-md-12 row"></div>
								</div>								
							</div>

							<div class="row col-md-12 mt-3">								
								<label class="row control-label col-md-4">Icon</label>
								<div class="row col-md-8 col-sm-12">
									<label class="control-label btn btn-outline-primary" for="choseImage">Chose file</label>
									<div class="text-danger col-md-12 row"></div>
									<input type="file" name="icon" class="row col-md-8" id="choseImage">
								</div>
							</div>						
						</div>
					</div>

					<div class="col-md-4">
						<div class="col-md-12 col-sm-12 mt-3">																			
							<img id="previewImage" align='middle' src="image/upload/<?php echo $view['icon']; ?>" height="100" class="mb-1">
							<label class="row control-label col-md-12" id="fileName_label"></label>
						</div>
					</div>					
					</div>	<!--close row-->
				</div>

				<div class="card-footer">
					<div class="col-md-4">
						<input type="hidden" name="aksi" value="edit">	
						<button type="reset" class="btn btn-secondary btn-sm mr-2" id="cancel" 
						value="index.php?page=menu&sub=view">
						<i class="fa fa-close"></i> Cancel</button>
						
						<button type="submit" class="btn btn-primary btn-sm">
						<i class="fa fa-save"></i> Update</button>
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

		$('#back').click(function(event) {
			window.location.href='index.php?page=menu&sub=view';
		});

		$('#cancel').click(function(event) {
			event.preventDefault();
			location.href='index.php?page=menu&sub=view';
		});

		$('#menu').blur(function() {
			var menu_old = $('#menu_old').val();
			var data 	= $(this).val();
			if(data !='')
			{ 
				$.ajax({
						url: 'process/P_menu.php',
						type: 'POST',
						data: {'menu':data,'menu_old':menu_old,'aksi':'check_menu_edit'},
						dataType: "text",
						success: function(response){
							var data = $.parseJSON(response);
						
							if(data.status == 1){
								return error('#menu','Menu was used');
							} 
							else {
								return success('#menu');
							}
					}
				}); 
			} 
			else { return error(this,'Please complete the form');}

			}).keyup(function() {
				var data = $(this).val();
				if(data !=''){return success(this);} 
				else {return error(this,'Please complete the form');}
		});

		$('#choseImage').change(function(e) {
			var filename,ext,size,icon_old;

			filename = getfileNeme(e);
			size 	 = getfileSize(e);
			ext 	 = getfileExt(e,filename);
			icon_old = $('#icon_old').val();
			
			if(filename != '') {
				if(ext == 'jpg' || ext == 'png' || ext == 'ico' || ext == 'icon') 
				{					
					if(size <= 300000) {
						readImage(this);		
						$('#fileName_label').text(filename);
						return file_success(this);
					}
					else {
						$('#previewImage').attr('src','image/upload/'+icon_old);
						$('#fileName_label').text('');
						return file_error(this,'Max size 300 Kb');
					}
				}

				else 
				{	
					$('#previewImage').attr('src','image/upload/'+icon_old);
					$('#fileName_label').text('');
					return file_error(this,'Please select image file');
				}
			}
			else { return file_error(this,'Please complete the form');}			
		});



		$('#form_menu_edit').submit(function(e) {
			e.preventDefault();
			var valid = true;

			$(this).find('input[type=text]').each(function() {
				if(!$(this).val()) {
					error(this,"Please complete the form");
					valid= false;
				}

				if ($(this).hasClass('is-invalid')){
                	valid = false;
            	}
			});

			if(valid){
				$.ajax({
					url: 'process/P_menu.php',
					type: 'POST',
					data: new FormData(this), 
					contentType: false,
					cache: false,
					processData:false,
					dataType: 'html',
					success: function(response){
						var data = $.parseJSON(response);
						
						if(data.status == "success"){
							location.href='index.php?page=menu&sub=view';
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
