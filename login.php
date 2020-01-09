<?php
include('auth.php');
session_start();
$error = true;
if ($_POST['login'] && $_POST['passwd']) {
    if (auth($_POST['login'], $_POST['passwd']))
        $error = false;
}
if ($error == false) {
    $_SESSION['loggued_on_user'] = $_POST['login'];
?>
<html>
    <body>
        
    </body>
</html>
<?php
}
else {
    $_SESSION['loggued_on_user'] = "";
    echo "ERROR\n";
}
?>