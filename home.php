<?php

include "controller/session.php";
include "base.php";


if ($_SERVER["REQUEST_METHOD"] == "GET"){
	$param = isset($_GET['param']) ? $_GET['param'] : '';
	
	if ($param == "run"){
		$query = "INSERT INTO user (name, email, uuid) VALUES ('example_user', 'user@example.com', 'hashed_password'); ";
		// run_query($query);
		$query = "select name, email, uuid from user";
		$result = run_select_query($query);
		foreach ($result as $key => $value){
			echo $index . "<br/>";
			echo "name is : " . $value['name'] . "<br/>";
			echo "email is : " . $value['email'] . "<br/>";
			echo "uuid is : " . $value['uuid'] . "<br/>";

		}
	}
}



?>

<div>
	If you want to play quiz you need to follow the rules. To understand all the rules press next button below.
	<form action="quiz_rules.php">
		<input type="submit" value="Next"/>
	</form>
</div>