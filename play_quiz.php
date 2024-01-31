<?php

include "controller/session.php";

$page_header = "You are Playing Quiz Now";

include "base.php";
include "controller/quiz_controller.php";

$data = json_decode($json_response, true);
$question = $data["question"];
$options = $data["options"];


function get_option_val($idx){
	$option_val = array("a", "b", "c", "d");
	return $option_val[$idx];	
}


?>

<form method="post" action="/controller/quiz_controller.php">
	<div class="main-content">
		<div class="margin-panel">
			<p class="question-text">  <?php echo $question ?> </p>
		    
		    <ul class="no-list option-list">
		    	<?php
		    		foreach ($options as $index => $option) {
				      $list_tag = '<li class="keep-margin"> <input type="radio" id="id_option_' . get_option_val($index) . '" name="selected_option" value="' . get_option_val($index) . '"> <label class="highlight-green" for="id_option_' . get_option_val($index) . '">' . $option . '</label></li>';
				      echo $list_tag;
					}
		    	?>
		    </ul>
		</div>

	</div>
    <input class="submit-button" type="submit" value="Submit" />
</form>
	