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
			<br>
			<a href="#" data-toggle="modal" data-target="#createAccountModal" class="create-account">
					<span class="text-secondary">Create Account</span>
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

	<!-- Create Account Modal -->
	<div class="modal fade" id="createAccountModal" tabindex="-1" role="dialog" aria-labelledby="createAccountModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="createAccountModalLabel">Create Account</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form id="form-create-account" role="form" method="POST">
				<div class="form-group">
					<input type="text" id="new-username" class="form-control" placeholder="Username" name="new-username">
					<span class="text-danger"></span>
				</div>
				<div class="form-group">
					<input type="password" id="new-password" class="form-control" placeholder="Password" name="new-password" autocomplete="off">
					<span class="text-danger"></span>
				</div>
				<div class="form-group">
					<input type="password" id="confirm-password" class="form-control" placeholder="Confirm Password" name="confirm-password" autocomplete="off">
					<span class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Status</label><br>
					<label class="radio-inline"><input type="radio" name="status" value="T"> T</label>
					<label class="radio-inline"><input type="radio" name="status" value="F"> F</label>
				</div>
				<div class="form-group">
					<label>Level</label><br>
					<label class="radio-inline"><input type="radio" name="level" value="admin"> Admin</label>
					<label class="radio-inline"><input type="radio" name="level" value="user"> User</label>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-block">CREATE ACCOUNT</button>
				</div>
			</form>
			</div>
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


		<!-- COBA HASH PASSWORD -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
		<script type="text/javascript">


        $(document).ready(function() {
        // LOGIN ACCOUNT    
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
                    if (!$(this).val()) {
                        error(this, "Please complete the form");
                        valid = false;
                    }
                    if ($(this).hasClass('is-invalid')) {
                        valid = false;
                    }
                });

                if (valid) {
                    console.log('Username:', $('#username').val());
                    console.log('Password:', $('#password').val());

                    $.ajax({
                        url: 'auth.php?op=in',
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'html', // Ensure the dataType is set to 'html'
                        success: function(response) {
                            console.log("Raw Response: " + response); // Log the raw response
                            try {
                                var data = $.parseJSON(response); // Attempt to parse JSON
                                console.log(data);
                                if (data.status == 'success') {
                                    window.location.href = "index.php";
                                } else {
                                    var txt = '';
                                    txt += "<div class='col-md-12 alert bg-red alert-dismissable'>" + data.msg;
                                    txt += " <a href='#' class='close' data-dismiss='alert' aria-label='close'> ×</a>";
                                    txt += "</div>";
                                    $('#login-failed').html(txt);
                                }
                            } catch (e) {
                                console.error("Error parsing JSON:", e);
                                $('#login-failed').html("<div class='col-md-12 alert bg-red alert-dismissable'>Invalid response from server. Please try again later.</div>");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error in AJAX request:", status, error);
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

			// CREATE ACCOUNT 
			$('#form-create-account').submit(function(event) {
                event.preventDefault();

                var newUsername = $('#new-username').val();
                var newPassword = $('#new-password').val();
                var confirmPassword = $('#confirm-password').val();
                var status = $('input[name="status"]:checked').val();
                var level = $('input[name="level"]:checked').val();

                if (newPassword !== confirmPassword) {
                    alert('Passwords do not match!');
                    return;
                }

                // var hashedPassword = CryptoJS.MD5(newPassword).toString();
                $.ajax({
                    url: 'auth.php?op=create',
                    type: 'POST',
                    data: {
                        username: newUsername,
                        password: newPassword,
                        status: status,
                        level: level
                    },
                    success: function(response) {
                        var data = $.parseJSON(response);
                        console.log("Response from server:", data); // Tambahkan ini untuk debug
                        if (data.status == 'success') {
                            $('#createAccountModal').modal('hide');
                            alert('Account created successfully! Please sign in.');
                        } else {
                            alert(data.msg);
                        }
                    }
                });		
            });
			});
	</script>
</body>
</html> 