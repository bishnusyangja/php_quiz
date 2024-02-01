<?php

$is_score_board = false;
$quiz_id = null;
$last_question_id = null;
$asked_question_id = null;

$default_question_type = "first_round";
$question_number_counter = null;


$quiz_rules = array(
    "first_round" => 2,
    "second_round" => 8
);



function check_answer($answer_submitted){
    // check with db query the right answer is;
}


function get_question_id_and_quiz_id_from_asked_question_uuid($asked_question_uuid){
    global $quiz_id, $last_question_id;
    $query = "select id, question_id, quiz_id from asked_question where uuid='" . $asked_question_uuid . "';";
    $query_result = run_select_query($query, $single=true);
    $quiz_id = $query_result["quiz_id"];
    $last_question_id = $query_result["question_id"];
    $asked_question_id = $query_result["id"];

}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $answer_submitted = isset($_POST['selected_option']) ? $_POST['selected_option'] : '';
    $asked_question_uuid = isset($_POST['uuid']) ? $_POST['uuid'] : null;
    if ($asked_question_uuid){
        check_answer($answer_submitted);
        get_question_id_and_quiz_id_from_asked_question_uuid($asked_question_uuid);    
    }
    
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


function get_question_type($quiz_id){
    global $default_question_type, $quiz_rules, $question_number_counter;
    if ($quiz_id == null){
        $question_number_counter = 1;
        return $default_question_type;
    }
    $query = "select count(*) as row_count from asked_question where quiz_id='" . $quiz_id . "';";
    $query_result = run_select_query($query, $single=true);
    $asked_ques_count = $query_result["row_count"];
    $rulewise_ques_count = 0;
    $question_number_counter = $asked_ques_count+1;
    foreach ($quiz_rules as $key => $val){
        $rulewise_ques_count += $val;
    	if ($asked_ques_count < $rulewise_ques_count){
    	    return $key;
    	}else{
    	    continue;
    	}
    	
    }
    return null;
    
}

function save_question_into_the_quiz($question_id, $question_type, $user_id){
    global $quiz_id;
    $asked_question_uuid = generate_random_string();

    if ($quiz_id == null) {
        $quiz_uuid = generate_random_string();
        $query = "insert into quiz (user_id, uuid) values(" .$user_id .", '" .$quiz_uuid .  "');";
    	run_query($query);

	   $quiz_id_query = "select id from quiz where uuid='" . $quiz_uuid . "';";
	   $quiz_query_result = run_select_query($quiz_id_query, $single=true);
	   $quiz_id = $quiz_query_result["id"];
    }	
    $asked_question_query = "insert into asked_question (question_id, quiz_id, question_type, uuid) values(" . $question_id . ", " .$quiz_id . ", '" .$question_type . "', '"  .$asked_question_uuid ."');";
    run_query($asked_question_query);
    return $asked_question_uuid;
}


function get_question_details($question_id){

    $query = "select question_text, option_a, option_b, option_c, option_d from question where id='" . $question_id . "';" ;
    $query_result = run_select_query($query, $single=true);
    
    $question_item = array(
        "question" => $query_result["question_text"], 
        "options" => [$query_result["option_a"], $query_result["option_b"], $query_result["option_c"], $query_result["option_d"]],
    );
    return $question_item;
}

$minValue = 1;
$maxValue = find_max_id_of_question();
$user_id = $user["id"];
$exclusion_list = get_asked_question_list($user_id, $quiz_id);
$question_type = get_question_type($quiz_id); 

if ($question_type == null){
    $is_score_board = true;
}

$random_ques_number = get_random_int($minValue, $maxValue, $exclusion_list);
$asked_question_uuid = save_question_into_the_quiz($random_ques_number, $question_type, $user["id"]);
$response = get_question_details($random_ques_number);
$response['is_score_board'] = $is_score_board;
$response['uuid'] = $asked_question_uuid;
$response['question_type'] = $question_type;
$response['question_number'] = $question_number_counter;
$json_response = json_encode($response);


?>
