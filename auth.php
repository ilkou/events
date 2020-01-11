<?php
include 'db_connect.php';
function auth($login, $passwd) {
    $conn = OpenCon();
    if ($conn->connect_error) {
        ?><script>alert('can\'t connect to database: <?= $conn->connect_error ?>')</script><?php
        header( "refresh:0; url=index.php" );
        exit();
    }
    $passwd = hash('whirlpool', $passwd);
    $checkUserQuery = "SELECT * FROM user WHERE pseudo='$login' AND psswd='$passwd'";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);
    if (mysqli_num_rows($checkUserResult) == 1)
        return true;
    return (false);
}
?>