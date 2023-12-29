<?php

if (isset($_GET['error'])){
    $error_message = urldecode($_GET['error']);
}
if (isset($_GET['success'])){
    $success_message = urldecode($_GET['success']);
}
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
	<a href="index.php">Home</a>
	<form method="post" action="/controller/login_controller.php">
        <p style="color:red;"><?php echo $error_message ?></p>
        <p style="color:green;"><?php echo $success_message ?></p>
        <label for="email">Email:</label>
        <input type="text" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Submit">
	</form>

	
</body>
</html>

