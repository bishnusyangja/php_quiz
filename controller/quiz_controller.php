<?php

$response = array(
        "question" => "How old are you ?", 
        "options" => ["I am 20", "I am 25", "I am 26", "I am 27"]
    );

$json_response = json_encode($response);


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $answer_submitted = isset($_POST['correct_answer']) ? $_POST['correct_answer'] : '';

}
    
?>
