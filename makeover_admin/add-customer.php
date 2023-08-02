<?php
session_start();
error_reporting(0);
include('../makeover_admin/includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location: ../makeover_admin/logout.php');

} else {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobilenum = $_POST['mobilenum'];
        $details = $_POST['details'];

        $query = mysqli_query($con, "INSERT INTO tblcustomers (Name, Email, MobileNumber, Details) VALUES ('$name', '$email', '$mobilenum', '$details')");

        if ($query) {
            echo "<script>alert('Customer has been added.');</script>";
            echo "<script>window.location.href = '../makeover_admin/add-customer.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Makeover-Add Services</title>

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
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
    <script src="../makeover_admin/js/custom.js"></script>
    <link href="../makeover_admin/css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('../makeover_admin/includes/sidebar.php'); ?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('../makeover_admin/includes/header.php'); ?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Add Customer</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Parlour Customer:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                                            echo $msg;
                                                                                        } ?> </p>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobilenum" name="mobilenum" placeholder="Mobile Number" value="" required="true" maxlength="10" pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Details</label>
                                    <textarea type="text" class="form-control" id="details" name="details" placeholder="Details" required="true" rows="12" cols="4"></textarea>
                                </div>

                                <button type="submit" name="submit" class="btn btn-default">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('../makeover_admin/includes/footer.php'); ?>
        </div>
        <!-- Classie -->
        <script src="../makeover_admin/js/classie.js"></script>
        <script>
            var menuLeft = document.getElementById('cbp-spmenu-s1'),
                showLeftPush = document.getElementById('showLeftPush'),
                body = document.body;

            showLeftPush.onclick = function() {
                classie.toggle(this, 'active');
                classie.toggle(body, 'cbp-spmenu-push-toright');
                classie.toggle(menuLeft, 'cbp-spmenu-open');
                disableOther('showLeftPush');
            };

            function disableOther(button) {
                if (button !== 'showLeftPush') {
                    classie.toggle(showLeftPush, 'disabled');
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
<?php } ?>
