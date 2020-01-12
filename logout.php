<?php
session_start();
unset($_SESSION['loggued_on_user']);
unset($_SESSION['is_admin']);
header("Location: index.php");
?>