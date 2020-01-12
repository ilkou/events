<?php
    session_start();
    if (!$_SESSION['loggued_on_user'])
        header("Location: index.php");

include 'db_connect.php';

$conn = OpenCon();

if ($conn->connect_error) {
    ?><script>alert('can\'t connect to database: <?= $conn->connect_error ?>')</script><?php
    header( "refresh:0; url=index.php" );
    exit();
}
$msg = "";
$target_dir = "img/";
if ($_POST["submit"] == "OK") {
    // Get image name
    $image = $_FILES['image']['name'];
    // image file directory
    $target = "img/".basename($image);
    $titre = mysqli_real_escape_string($conn, $_POST["titre"]);
    $dataDebut = mysqli_real_escape_string($conn, $_POST["dateDebut"]);
    $dataFin = mysqli_real_escape_string($conn, $_POST["dateFin"]);
    $users = 0;
    $details = mysqli_real_escape_string($conn, $_POST["details"]);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        ?><script>console.log("Image uploaded successfully");</script><?PHP
    }else{
        ?><script>console.log("Failed to upload image");</script><?PHP
    }
    $sql = "INSERT INTO evenement (titre, dateDebut, dateFin, nbrUser, details, img, imgPath) 
            VALUES ('$titre','$dataDebut','$dataFin','$users','$details','$image','$target')";
    if ($conn->query($sql) === TRUE) {
        ?><script>alert('Félicitations ! Votre nouveau compte a été créé avec succès !'); </script><?PHP
        CloseCon($conn);
        header( "refresh:0; url=index.php" );
    }
    else {
        echo "$conn->error";
        CloseCon($conn);
        header( "refresh:0; url=addEvent.html" );
        exit();
    }
    CloseCon($conn);
    header('Location: home.php');
}
?>