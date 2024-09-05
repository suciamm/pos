<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/fontastic.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">		
	<link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">

	<link rel="stylesheet" href="assets/css/custom.css">		
	<link rel="stylesheet" href="assets/vendor/loading-modal/css/jquery.loadingModal.css">

	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="include/function.js"></script>
	<script src="include/validation.js"></script>
</head>
<body class="page-login">


	<div class="pt-5">
	<div class="card col-lg-4 mx-auto shadow">        
    <div class="card-body px-5 py-5">   
        <h2 class="card-title text-center mb-5">SIGN IN</h2>
        <p><div id="login-failed"></div></p><br>

        <form id="form-login" role="form" method="POST" enctype="multipart/form-data">            
            <div class="form-group">
            <input type="text" id="username" class="form-control" placeholder="Username" name="username">
            <span class="text-danger text-right"></span><br>
            </div>
            
            <div class="form-group mb-5">
            <input type="password" id="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
            <span class="text-danger"></span><br>
            <a href="#" class="forgot-password mb-3" data-toggle="tooltip" data-placement="top" title="Please contact administrator !" class="red-tooltip">
            <span class="text-secondary">Forgot Password?</span>
            </a>
            </div>
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-block enter-btn mb-5">SIGN IN</button>
              <span>POS</span>
              <span>&copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</span>
            </div>

        </form>
    </div>
    </div>
	</div>




	<!--SCRIPT-->
		<script src="assets/vendor/jquery/jquery.min.js"></script>		
		<script src="assets/vendor/loading-modal/js/jquery.loadingModal.js"></script>

		<script src="assets/vendor/popper.js/umd/popper.min.js"> </script>
		<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
		<script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>

		<script src="assets/vendor/data-table/jquery.dataTables.min.js"></script>
		<script src="assets/vendor/data-table/dataTables.bootstrap.min.js"></script>
		
		<!-- Main File-->
		<script src="assets/js/front.js"></script>
		<script src="assets/vendor/autonumber/autoNumeric.js"></script>


		<script type="text/javascript">
			$(document).ready(function() {


					$('#username').blur(function(event) {
						var value = $(this).val();
						if(value == '') { error(this,'empty username'); }
						else { return success(this); }

					}).keyup(function(event) {
						var value = $(this).val();
						if(value == '') { return error(this,'empty username'); }
						else { return success(this); }
					});	


					$('#password').blur(function(event) {
						var value = $(this).val();
						if(value == '') { return error(this,'empty password'); }
						else { return success(this); }

					}).keyup(function(event) {
						var value = $(this).val();
						if(value == '') { return error(this,'empty password'); }
						else { return success(this); }
					});	


					$('#form-login').submit(function(event) {
							event.preventDefault();
							var valid = true;

							$(this).find('input').each(function() {
								if(!$(this).val()) {
									error(this,"Please complete the form");
									valid = false;
								}
								if ($(this).hasClass('is-invalid')){
				                	valid = false;
				            	}
							});

							if(valid) {
								
								$.ajax({
									url 	: 'auth.php?op=in',
									type 	: 'POST',
									data 	: $(this).serialize(),
									dataType: 'html',
									success : function(response) {
										var data = $.parseJSON(response);
										if(data.status == 'success') {
											window.location.href="index.php";
										}
										else {
											var txt ='';
												txt += "<div class='col-md-12 alert bg-red alert-dismissable'>"+data.msg;
												txt += " <a href='#' class='close' data-dismiss='alert' aria-label='close'> ×</a>";
												txt += "</div>";
												$('#login-failed').html(txt);
										}
									}
								});



							}
					});
			});
		</script>

</body>
</html>