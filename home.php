<?php

include "controller/quiz_controller.php";

$data = json_decode($json_response, true);
$question = $data["question"];
$options = $data["options"];
$page_header = "Welcome to Quiz Program";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST Request Example</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
	<h2><?php echo $page_header ?></h2>
	<form method="post" action="/controller/quiz_controller.php">
		<p>  <?php echo $question ?> </p>
	    
	    <ul class="no-list">
	    	<?php
	    		foreach ($options as $index => $option) {
			      echo '<li>';
			      echo '<input type="radio" id="option_' . ($index + 1) . '" name="selected_option" value="option_' . ($index + 1) . '">';
			      echo '<label for="option_' . ($index + 1) . '">' . $option . '</label>';
			      echo '</li>';
    			}
	    	?>
	    </ul>
	    <input type="submit" value="Submit" />
	</form>

</body>
</html>