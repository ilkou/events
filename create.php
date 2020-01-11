<?php

include 'db_connect.php';

if ($_POST['submit'] === "OK") {
    $conn = OpenCon();
    if ($conn->connect_error) {
        ?><script>alert('Error: ' +  '<?PHP print($conn->error);?>')</script><?php
        echo "conn";
    }
    $login = $_POST['login'];
    $passwd = hash('whirlpool', $_POST['passwd']);
    $phone = $_POST['phone'];
    $mail = $_POST['email'];
    $isAdmin = 0;
    $isOrgan = 0;

    $sql = "INSERT INTO user(pseudo, pswd, phone, mail, isAdmin, isOrgan) VALUES ('$login', '$passwd', '$phone','$mail', '$isAdmin', '$isOrgan')";
    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">alert("' . "Félicitations ! Votre nouveau compte a été créé avec succès !" . '")</script>';
        header('Location: index.php');
    } else {
        ?><script>alert('Error: ')</script><?php
        header('Location: create.html');
    }
    
    CloseCon($conn);
}
else {
    header('Location: create.html');
    echo '<script type="text/javascript">alert("' . "press submit" . '")</script>';
}
?>