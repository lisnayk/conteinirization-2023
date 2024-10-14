<?php
$host = "db";

exec("ping -c 4 " . $host, $output, $result);
if ($result == 0)
	echo "Ping successful!\n";
else
	echo "Ping unsuccessful!\n";

$servername = "db";
$username = "root";
$password = "mysql";
// Connection
$conn = new mysqli($servername, $username, $password);
// For checking if connection is
// successful or not
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully\n";
?>
