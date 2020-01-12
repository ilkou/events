<?PHP
session_start();
if (!$_SESSION['loggued_on_user'])
	header("Location: index.php");
include 'db_connect.php';
if ($_GET['submit']) {
    $login = $_SESSION['loggued_on_user'];
	$conn = OpenCon();
	if ($conn->connect_error) {
		?><script>alert('can\'t connect to database: <?= $conn->connect_error ?>')</script><?php
        header( "refresh:0; url=index.php" );
        exit();
    }
	$query = "select * from evenement";
	$result = mysqli_query($conn, $query);
	if(!$result)
		echo "riens";
	$i = 1;
	while($row = mysqli_fetch_assoc($result))
	{
        if ($i == $_GET['event']) {
            $checkUserQuery = "SELECT * FROM interested WHERE user='$login' AND evnt='".$row["id"]."'";
            $checkUserResult = mysqli_query($conn, $checkUserQuery);
            if (mysqli_num_rows($checkUserResult) == 1) {
                ?><script>alert('vous êtes déjà inscrit !')</script><?php
                header( "refresh:0; url=index.php" );
                exit();
            }
            $sql = "INSERT INTO interested(user, evnt) VALUES ('$login', '".$row["id"]."')";
            if ($conn->query($sql) === TRUE) {
                mysqli_query( $conn, "
                UPDATE evenement 
                SET nbrUser = nbrUser + 1
                WHERE id = '".$row["id"]."'
                ");
            }
            break ;
        }
        $i++;
	}
    CloseCon($conn);
    header("Location: home.php");
}
?>
