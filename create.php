<?php

include 'db_connect.php';

if ($_POST['submit'] === "OK") {
    $conn = OpenCon();
    if ($conn->connect_error) {
        ?><script>alert('can\'t connect to database: <?= $conn->connect_error ?>')</script><?php
        header( "refresh:0; url=index.php" );
        exit();
    }
    $login = $_POST['login'];
    $passwd = hash('whirlpool', $_POST['passwd']);
    $phone = $_POST['phone'];
    $mail = $_POST['email'];
    $isAdmin = 0;
    $isOrgan = 0;
    $checkUserQuery = "SELECT * FROM user  WHERE pseudo ='$login'";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);
    if (mysqli_num_rows($checkUserResult) > 0) {
        ?><script>alert('Error: USER existe déjà'); </script><?PHP
        header( "refresh:0; url=create.html" );
        exit();
    }
    $sql = "INSERT INTO user(pseudo, psswd, phone, mail, isAdmin, isOrgan) VALUES ('$login', '$passwd', '$phone','$mail', '$isAdmin', '$isOrgan')";
    if ($conn->query($sql) === TRUE) {
        ?><script>alert('Félicitations ! Votre nouveau compte a été créé avec succès !'); </script><?PHP
        CloseCon($conn);
        header( "refresh:0; url=index.php" );
    } else {
        ?><script>let msg = "<?php print($conn->error); ?>"; alert('Error: ' + msg); </script><?PHP
        CloseCon($conn);
        header( "refresh:0; url=create.html" );
    }
    CloseCon($conn);
}
else {
    ?><script>alert('press submit !!'); </script><?PHP
    header( "refresh:0; url=create.html" );
}
?>