<?php
session_start();
session_unset();
session_destroy();
header('location: ../makeover/makeover_admin/js/index.php');

?>