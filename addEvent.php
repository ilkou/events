<?php
    session_start();
    if (!$_SESSION['loggued_on_user'])
        header("Location: index.php");
?>
<?php
include 'db_connect.php';
$conn = OpenCon();

// Check connection
if ($conn->connect_error) {
    ?><script>alert('can\'t connect to database: <?= $conn->connect_error ?>')</script><?php
    header( "refresh:3; url=index.php" );
    exit();
}
$msg = "";
$target_dir = "img/";
if($_POST["submit"] == "OK") {
    // Get image name
    $image = $_FILES['image']['name'];
    // image file directory
    $target = "img/".basename($image);
    $titre = $_POST["titre"];
    $dataDebut = $_POST["dateDebut"];
    $dataFin = $_POST["dateFin"];
    $users = 0;
    $details = $_POST["details"];
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
     
    $query = "INSERT INTO evenement (titre, dateDebut, dateFin, nbrUser, details, img, imgPath) 
            VALUES ('$titre','$dataDebut','$dataFin','$users','$details','$image','$target')";
    $result = mysqli_query($conn, $query);
       
        if(!$result){
            ?><script>alert('Error: ')</script><?php
            header( "refresh:3; url=index.php" );
            exit();
        }
    }
    header('Location: index.php');
?>