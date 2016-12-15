<?php

// Require the configuration before any PHP code:
require ('./includes/config.inc.php');
// Include the header file:
include ('./includes/header.html');
// Require the database connection:
require (MYSQL);
// For storing errors:
$news_errors = array();

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Check for Magic Quotes:
	if (get_magic_quotes_gpc()) {
		$_POST['first_name'] = stripslashes($_POST['first_name']);
		// Repeat for other variables that could be affected.
	}

	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_POST['first_name'])) {
		$fn = addslashes($_POST['first_name']);
	} else {
		$news_errors['first_name'] = 'Please enter your first name!';
	}
	
	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $_POST['last_name'])) {
		$ln  = addslashes($_POST['last_name']);
	} else {
		$news_errors['last_name'] = 'Please enter your last name!';
	}
       // Check for an email address:
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$e = $_POST['email'];
		$_SESSION['email'] = $_POST['email'];
	} else {
		$news_errors['email'] = 'Please enter a valid email address!';
	}
    if (empty($news_errors)) { // If everything's OK...
		// Add the user to the database..
		// Call the stored procedure:
		$r = mysqli_query($dbc, "CALL add_newsletter('$fn', '$ln', '$e')");
		echo(mysqli_error($dbc));
			// Confirm that it worked:
		if ($r) {
			echo("<div style='color: white'>You've been signed up forever!</div>");
			// Retrieve the customer ID:
			$r = mysqli_query($dbc, 'SELECT @cid');
				if (mysqli_num_rows($r) > 0) {	
					// Redirect to the next page:
					
				}	
		} else {
			echo("<div style='color: white'>Something went wrong!");
		}
    } else {
    	echo("<div style='color: white'>Something went wrong! ");
    	echo("You had errors in the following places:<br />");
    	foreach ($news_errors as $error){
    		echo($error . "<br />");
    	}
    	echo("<br />Click <a href='/shop/goodies/'>here</a> to try again!");
    }
}

// Need the form functions script, which defines create_form_input():
require ('./includes/form_functions.inc.php');
?>

<form enctype="multipart/form-data" action="add_games.php" method="post" accept-charset="utf-8">
<?php
// Finish the page:
include ('./includes/footer.html');
?>
