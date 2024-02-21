<?php
$host="db";

exec("ping -c 4 " . $host, $output, $result);

print_r($output);

if ($result == 0)

	echo "Ping successful!";

else

	echo "Ping unsuccessful!";

$servername = "db";
$username = "root";
$password = "mysql";
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
