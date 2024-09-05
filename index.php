  <?php
	include_once 'include/paging.php';
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	if (!isset($_SESSION['pos-username'])) {
		header("location:login.php");
	}

	$page = !empty($_GET['page']) ? $_GET['page'] : "home";
	$sub  = !empty($_GET['sub']) ? $_GET['sub'] : "view"; 

	$pecah 		= explode("@", $_SESSION['pos-username']);
	$operator 	= $pecah[0];
?>

<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>POS</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="robots" content="all,follow">
		<!-- <link rel="shortcut icon" href="img/favicon.ico"> -->
		
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/fontastic.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">		
		<link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">

		<link rel="stylesheet" href="assets/css/custom.css">	
		<link rel="stylesheet" href="assets/vendor/loading-modal/css/jquery.loadingModal.css">		
		<link rel="stylesheet" href="assets/vendor/croppie/croppie.css" />
		<link rel="stylesheet" href="assets/vendor/datetime-picker/jquery.datetimepicker.min.css">

		<script src="assets/vendor/jquery/jquery.min.js"></script>

		<script src="include/function.js"></script>
		<script src="include/validation.js"></script>

		<script type="text/javascript">
            var timerStart = Date.now();
        </script>

</head>
<body>
	
	<div class="page">

		<!-- <div class="preloader">
			<div class="loading">
			<img src="image/assets/loading.gif" width="80">
			<p>Harap Tunggu</p>
			</div>
		</div> -->

		<div class="page-content d-flex align-items-stretch"> 
		<nav class="side-navbar shrinked" style="bottom: 1px;">
			<!--profile
				<div class="sidebar-header d-flex align-items-center">
					<div class="avatar"><img src="assets/img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
					<div class="title">
					<h1 class="h4">Tomy Anwar</h1>
					<p>Engineer</p>
					</div>
				</div>
				<span class="heading">Menu</span> -->

			<ul class="list-unstyled">
				<li <?php if($page == 'home') { echo 'class="active"';} ?>>
				<a href="index.php?page=home"><i class="icon-home"></i>Home</a>
				</li>

				<li <?php if($page == 'order') { echo 'class="active"';} ?>>
				<a href="index.php?page=order&sub=order"><i class="icon-padnote""></i>Order</a>
				</li>

				<li <?php if($page == 'menu' || $page == 'submenu') { echo 'class="active"';} ?>>
					<a href="#menu" aria-expanded="false" data-toggle="collapse">
					<i class="icon-grid"></i>Category</a>
					<ul id="menu" class="collapse list-unstyled">
						<li><a href="index.php?page=menu&sub=view">Menu</a></li>
						<li><a href="index.php?page=submenu&sub=view">Submenu</a></li>
					</ul>
				</li>

				<!--PRODUCT-->
				<?php 
					$db_menu_product 	= model('M_menu');
					$page_menu_product	= $db_menu_product->view_menu();
					$page_menu_count	= $page_menu_product['row'];
					$page_menu_data 	= $page_menu_product['data'];

					if($page_menu_count < 1) {
					}
					else 
					{	
						$product_get = !empty($_GET['product']) ? $_GET['product'] : ""; 			
						foreach ($page_menu_data as $value) { ?>
							
							<li <?php if($page == 'product' && $product_get == $value['menu']) { echo 'class="active"'; } ?>>
								<a href="index.php?page=product&sub=view&product=<?php echo $value['menu']; ?>">
								<img src="image/upload/<?php echo $value['icon']; ?>" alt="..." class="img-fluid rounded-circle" width="30">
								<br><?php echo $value['menu']; ?></a>
							</li>
					<?php } 
					}	
				?>

				<li <?php if($page == 'settings') { echo 'class="active"';} ?>>
					<a href="index.php?page=settings">
					<i class="fa fa-cog"></i>Settings</a>
				</li>

				<li <?php if($page == 'promo') { echo 'class="active"';} ?>>
				<a href="index.php?page=promo&sub=promo"> <i class="icon-padnote"></i>Promo</a>
				</li>

				<li <?php if($page == 'report') { echo 'class="active"';} ?>>
				<a href="index.php?page=report">
				<i class="fa fa-bar-chart"></i>Report</a>
				</li>				

				<li>
					<a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">
					<i class="icon-interface-windows"></i>Example dropdown </a>
					<ul id="exampledropdownDropdown" class="collapse list-unstyled ">
						<li><a href="#">Page</a></li>
						<li><a href="#">Page</a></li>
						<li><a href="#">Page</a></li>
					</ul>
				</li>
				<li><a href="login.html">Login page </a></li>
			</ul>
		</nav>

		<div class="content-inner active">
		
			<header class="header">
			<nav class="navbar">
				<div class="search-box">
					<button class="dismiss"><i class="icon-close"></i></button>
					<form id="searchForm" action="#" role="search">
					<input type="search" placeholder="What are you looking for..." class="form-control">
					</form>
				</div>

				<div class="container-fluid">
				<div class="navbar-holder d-flex align-items-center justify-content-between">			
					<!--app tittle-->
					<div class="navbar-header">
						<a href="index.php" class="navbar-brand d-none d-sm-inline-block">
						<div class="brand-text d-none d-lg-inline-block"><span>ATI</span><strong>POINT OF SALE</strong></div>
						<div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>AP</strong></div></a>
						<!-- <a id="toggle-btn" href="#" class="menu-btn"><span></span><span></span><span></span></a> -->
					</div>
					<!--navbar menu-->
					<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
						<li class="nav-item logout">
							<a href="" class="nav-link logout" id="logout"> 
							<span class="d-none d-sm-inline"><?php echo $operator; ?></span><i class="fa fa-sign-out"></i>
							</a>
						</li>
					</ul>
				</div>
				</div>
			</nav>
			</header>
		
		<?php 
			switch ($page) { 
					case ('home'):
						include_once 'view/home/home.php';;
						break;

					case ('menu'):
						if($sub == 'view') 	{ include_once 'view/menu/view.php'; }
						if($sub == 'add') 	{ include_once 'view/menu/add.php'; }
						if($sub == 'edit') 	{ include_once 'view/menu/edit.php'; }
						break;

					case ('submenu'):
						if($sub == 'view')	{ include_once 'view/submenu/view.php'; }
						if($sub == 'add') 	{ include_once 'view/submenu/add.php'; }
						if($sub == 'edit') 	{ include_once 'view/submenu/edit.php'; }
						break;

					case('product'):
						if($sub == 'view')	{ include_once 'view/product/view.php'; }
						if($sub == 'add') 	{ include_once 'view/product/add.php'; }
						if($sub == 'edit') 	{ include_once 'view/product/edit.php'; }
						break;					

					case ('settings'):
						include_once 'view/setting/setting.php';;
						break;

					case ('promo'):
						if($sub == 'promo')			{ include_once 'view/promo/promo.php'; }
						if($sub == 'detail') 		{ include_once 'view/promo/detail.php'; }
						if($sub == 'detail_add') 	{ include_once 'view/promo/detail_add.php'; }
						break;	
					case ('report'):
						include_once 'view/report/report.php';
						// include_once 'view/report/reportdate.html';
						break;

					case ('order'):
						if($sub == 'order') { include_once 'view/order/order.php'; }
						break;

					default:
						echo "gak ada";
						break;
				}	
		?>
		</div>
		

		</div>
	</div>







	<!--modal confirm logout-->
	<div class="modal fade" id="modal_confirm_logout" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">CONFIRM</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h6>Apakah anda yakin ingin keluar ?</span></h6>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary" id="confirm_yes_logout">Yes</button>		
			</div>
		</div>
		</div>
	</div>

	<div class="notify"></div>


	<!--SCRIPT-->
		<script src="assets/vendor/jquery/jquery.min.js"></script>		
		<script src="assets/vendor/loading-modal/js/jquery.loadingModal.js"></script>
		<script src="assets/vendor/croppie/croppie.js"></script>

		<script src="assets/vendor/popper.js/umd/popper.min.js"> </script>
		<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/vendor/jquery.cookie/jquery.cookie.js"> </script>		
		<script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
		<!-- <script src="assets/vendor/chart.js/Chart.min.js"></script> -->
		<!-- <script src="assets/js/charts-home.js"></script> -->

		<script src="assets/vendor/data-table/jquery.dataTables.min.js"></script>
		<script src="assets/vendor/data-table/dataTables.bootstrap.min.js"></script>
		
		<!--notify -->
		<script src="assets/vendor/notify/notify.js"></script>
		<script src="assets/vendor/notify/mynotify.js"></script>


		<script src="assets/vendor/datetime-picker/jquery.datetimepicker.full.min.js"></script>

		
		<!-- Main File-->
		<script src="assets/js/front.js"></script>
		<script src="assets/vendor/autonumber/autoNumeric.js"></script>


		<script type="text/javascript">
			

			$(document).ready(function() {
					$('#logout').click(function(event) {
							event.preventDefault();    
							$('#modal_confirm_logout').modal('show');
					});

					$('#confirm_yes_logout').click(function(event) {
							clearCookie();
							event.preventDefault();
							window.location.href='auth.php?op=out';
					});

					// $(".preloader").fadeOut();


			});
		</script>

	<!-- <script type="text/javascript">
		$(document).ready(function() {
                console.log("Time until DOMready: ", Date.now()-timerStart);
        }); 
	</script> -->

</body>
</html>