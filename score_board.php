<?php

if (isset($_GET['error'])){
    $error_message = urldecode($_GET['error']);
}
if (isset($_GET['success'])){
    $success_message = urldecode($_GET['success']);
}

$page_header = "Quiz Score Board";

include "controller/db_controller.php";

$page_header = "You are Playing Quiz Now";

include "base.php";


function get_last_quiz($user_id){
	$query = "select id from quiz where user_id=" . $user_id . " order by id desc limit 1;" ;
	$query_result = run_select_query($query, $single=true);
}
function get_score_from_quiz($user_id){
	$quiz_id = get_last_quiz($user_id);
	$query = "select score from quiz where quiz_id=" . $quiz_id . ";";
	$query_result = run_select_query($query, $single=true);
	if ($query_result["score"] == null){
		$score_sum_query = "";
	}
	return $query_result["score"];

}

$score = get_score_from_quiz($user["id"]);
	
?>

<div class="score-board">
	Your score is <span> <?php echo $score ?> </span>	

</div>