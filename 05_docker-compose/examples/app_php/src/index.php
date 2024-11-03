<?php
$host="mysql";
print_r($host);
print_r(getenv("MYSQL_DATABASE"));
print_r(getenv("MYSQL_PASSWORD"));
$servername = getenv("MYSQL_DATABASE");
$username = "root";
$password = getenv("MYSQL_PASSWORD");
print_r([$servername, $username, $password]);
// Connection
$conn = new mysqli($servername,	$username, $password);

// For checking if connection is
// successful or not
if ($conn->connect_error) {
	die("Connection failed: "
		. $conn->connect_error);
}
echo "Connected successfully";
?>
