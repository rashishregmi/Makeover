<?php
session_start();
error_reporting(0);
include('../makeover_admin/includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];

        $query=mysqli_query($con,"select ID from tbladmin where  Email='$email' and MobileNumber='$contactno' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['contactno']=$contactno;
      $_SESSION['email']=$email;
     header('location: ../makeover_admin/reset-password.php');
    }
    else{
      $msg="Invalid Details. Please try again.";
    }
  }
  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Makeover-Forgot Page </title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="../makeover_admin/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="../makeover_admin/css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="../makeover_admin/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="../makeover_admin/js/jquery-1.11.1.min.js"></script>
<script src="../makeover_admin/js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="../makeover_admin/css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="../makeover_admin/js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="../makeover_admin/js/metisMenu.min.js"></script>
<script src="../makeover_adminjs/custom.js"></script>
<link href="../makeover_admin/css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		
		<!-- main content start-->
		<div id="page-wrapper" style="position: relative; max-height: 100vh;  padding-bottom: 150px; bottom:60px; ">
			<div class="main-page login-page ">
				<h3 class="title1">Forgot Page</h3>
				<div class="widget-shadow">
					<div class="login-top">
						<h4>Makeover</h4>
					</div>
					<div class="login-body">
						<form role="form" method="post" action="">
							<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
							<input type="text" name="email" class="lock" placeholder="Email" required="true">
							
							<input type="text" name="contactno" class="lock" placeholder="Mobile Number" required="true" maxlength="10" pattern="[0-9]+">
							
							<input type="submit" name="submit" value="Reset">
							<div class="forgot-grid">
								
								<div class="forgot">
									<a href="../makeover_admin/index.php">Already have an account</a>
								</div>
								<div class="clearfix"> </div>
							</div>
						</form>
					</div>
				</div>
				
				
			</div>
		</div>
		
	</div>
	<!-- Classie -->
		<script src="../makeover_admin/js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="../makeover_admin/js/jquery.nicescroll.js"></script>
	<script src="../makeover_admin/js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="../makeover_admin/js/bootstrap.js"> </script>
</body>
</html>