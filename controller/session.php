<?php

session_start();

function logout(){
	// this code should be executed after the session is started to logout the user.
	$_SESSION = array();
	session_destroy();
}


$session_id = isset($_SESSION['session_id']) ? $_SESSION['session_id'] : '';

if (!$session_id){
	header("location: /login.php");
    exit();
}

function get_user_email_from_session_id($session_id) {
	// write a query select email from user where session_id=uuid;
	$user_email = "useremail@gmail.com";
	return $user_email;
}


function get_user_detail($session_id){
	// create a query to get user details from user email;
	return array(
		"email" => "something@gmail.com", 
		"name" => "ABCD",
		"address" => "Pokhara"
	);
}

$user = get_user_detail($user_email);

?>