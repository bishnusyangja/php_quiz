<?php

$db_hostname = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "quiz";


function run_query($query){
	$conn = new mysqli($hostname, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$conn->query($query);
	$conn->close();
}


function run_select_query($query){
	// Create connection
	$conn = new mysqli($hostname, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$result = $conn->query($query);

	if (!$result) {
	    die("Query failed: " . $conn->error);
	}

	$result_list = array();
	while ($row = $result->fetch_assoc()) {
	    array_push($result_list, $row);
	}

	// Close the result set
	$result->close();

	// Close the MySQL connection
	$conn->close();

	return result_list;
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
		"address" => "Pokhara",
		"uuid" => "some_rand_str"
	);
}

$user = get_user_detail($session_id);

?>