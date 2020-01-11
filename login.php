<?php
include('auth.php');
$error = true;
if ($_POST['login'] && $_POST['passwd']) {
    if (auth($_POST['login'], $_POST['passwd']))
        $error = false;
}
if ($error == false) {
    session_start();
    $_SESSION['loggued_on_user'] = $_POST['login'];
    header( "Location: home.php" );
}
else {
    ?><script>alert('les coordonnées n’est associé à aucun compte'); </script><?PHP
        header( "refresh:3; url=index.php" );
}
?>