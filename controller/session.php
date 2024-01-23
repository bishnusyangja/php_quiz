<?php

$db_hostname = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "quiz";


function run_query($query){
	// Create connection
	$conn = new mysqli($hostname, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$query = "SELECT * FROM users";
	$result = $conn->query($query);

	if (!$result) {
	    die("Query failed: " . $conn->error);
	}

	while ($row = $result->fetch_assoc()) {
	    echo "User ID: " . $row['id'] . "<br>";
	    echo "Username: " . $row['username'] . "<br>";
	    echo "Email: " . $row['email'] . "<br>";
	    // Add other fields as needed
	    echo "<hr>";
	}

	// Close the result set
	$result->close();

	// Close the MySQL connection
	$conn->close();
}



session_start();

function logout(){
	echo "logout is called";
	// this code should be executed after the session is started to logout the user.
	$_SESSION = array();
	session_destroy();
}



$session_id = isset($_SESSION['session_id']) ? $_SESSION['session_id'] : '';
echo "session id is $session_id";

if (!$session_id){
	header("location: /login.php");
    exit();
}

function get_user_detail($session_id){
	// create a query to get user details from user email;
	return array(
		"email" => "something@gmail.com", 
		"name" => "ABCD",
		"address" => "Pokhara"
	);
}

$user = get_user_detail($session_id);

?>