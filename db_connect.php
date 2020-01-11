<?php
function OpenCon() {
	$dbhost = "127.0.0.1";
	$dbuser = "root";
	$dbpass = "pwdpwd";
	$db = "event";

	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
	return $conn;
}

function CloseCon($conn) {
	$conn->close();
}

?>
