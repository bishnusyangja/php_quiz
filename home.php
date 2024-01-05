<?php

include "controller/quiz_controller.php";
include "controller/session.php";

echo $user_email;

$data = json_decode($json_response, true);
$question = $data["question"];
$options = $data["options"];
$page_header = "Welcome to Quiz Program";

include "base.php";

echo $base;

?>
