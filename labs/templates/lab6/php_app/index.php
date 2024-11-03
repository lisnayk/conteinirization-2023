<?php
// Database connection settings
$host = getenv("DB_HOST");
$dbname = getenv("DB_NAME");
$username = getenv("DB_USER");
$password = getenv("DB_PASS");;

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the users table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$response = [];

if ($result->num_rows > 0) {
	// Fetch all rows as an associative array
	while ($row = $result->fetch_assoc()) {
		$response[] = $row;
	}
} else {
	$response['message'] = "No users found.";
}

// Set the content type to JSON
header('Content-Type: application/json');

// Output the response in JSON format
echo json_encode($response);

// Close the database connection
$conn->close();
?>
