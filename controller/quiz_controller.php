<?php


function check_answer($answer_submitted){
    // check with db query the right answer is;
}

$quiz_id = null;
$last_question_id = null;

function get_question_id_and_quiz_id_from_asked_question_id($asked_question_id){
    global $quiz_id, $last_question_id;
    $query = "select question_id, quiz_id form asked_question where id=" .$asked_question_id . ";";
    $query_result = run_select_query($query);
    $quiz_id = $query_result["quiz_id"];
    $last_question_id = $query_result["question_id"];
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $answer_submitted = isset($_POST['selected_option']) ? $_POST['selected_option'] : '';
    $asked_question_id= isset($_POST['asked_question_id']) ? $_POST['asked_question_id'] : null;
    check_answer($answer_submitted);
    // if $quiz_id assign here .
}


function get_random_int($min, $max, $exclusion_list) {
    do {
        $random_int = random_int($min, $max);
    } while (in_array($random_int, $exclusion_list));

    return $random_int;
}

function find_max_id_of_question(){
    $query = "select max(id) as max_id from question;";
    $query_result = run_select_query($query, $single=true);
    return $query_result["max_id"];
}

function generate_random_string($length = 18) {
    $randomBytes = random_bytes(ceil($length / 2));
    return substr(bin2hex($randomBytes), 0, $length);
}

function get_asked_question_list($user_id, $quiz_id){
    $id_array = array();
    if ($quiz_id == null){
        return $id_array;
    }
    $query = "select id from asked_question where user_id='" . $user_id . "' and quiz_id='" . $quiz_id . "';" ;
    $query_result = run_select_query($query, $single=true);
    
    foreach ($query_result as $row){
        array_push($id_array, $row["id"]);
    }
    return $id_array;
}

function save_question_into_the_quiz($question_id, $user_id){
    global $quiz_id;
    $asked_question_uuid = generate_random_string();

    if ($quiz_id == null) {
	$quiz_uuid = generate_random_string();
    	$query = "insert into quiz (question_id, user_id, uuid) values(" .$question_id . ", " .$user_id .", " .$quiz_uuid .  ");";
    	run_query($query);

	$quiz_id_query = "select id from quiz where uuid='" . $quiz_uuid . "';";
	$quiz_query_result = run_select_query($quiz_id_query, $single=true);
	$quiz_id = $quiz_query_result["id"];
    }	
    
    $asked_question_query = "insert into asked_question (question_id, quiz_id, uuid) values(" . $question_id . ", " .$quiz_id . ", " .$asked_question_uuid .");";
    run_query($query);
    return $asked_question_uuid;
}


$minValue = 1;
$maxValue = find_max_id_of_question();
$user_id = 1;
$exclusion_list = get_asked_question_list($user_id, $quiz_id);

$random_number = get_random_int($minValue, $maxValue, $exclusion_list);

function get_question_details($question_id){
    $query = "select question_text, option_a, option_b, option_c, option_d from question where id='" . $question_id . "';" ;
    $query_result = run_select_query($query, $single=true);
    
    $question_item = array(
        "question" => $query_result["question_text"], 
        "options" => [$query_result["option_a"], $query_result["option_b"], $query_result["option_c"], $query_result["option_d"]],
        "quiz_id" => "abcdfdf"
    );
    return $question_item;
}

$response = get_question_details($random_number);

$json_response = json_encode($response);
// send question number to if the question number is max_num return to score page;


?>
