<?php

// This is the adminstrative home page.
// This script is created in Chapter 11.

// Require the configuration before any PHP code as configuration controls error reporting.
require ('../includes/config.inc.php');

// Set the page title and include the header:
$page_title = 'Mist – Administration';
include ('./includes/header.html'); // The header file begins the session.

if (isset($_POST["admin_login_post"])){
	if ($_POST["admin_login_post"] == "its450"){
		$_SESSION["admin_auth"] = "true";
	}
}

if (!isset($_SESSION["admin_auth"])){
	?>
	<style>
		form, h1 {
			margin: auto;
			text-align: center;
		}
	</style>
	<h1>Enter Admin Password</h1>
	<form class="admin_login" method="POST" action="index.php">
		<div class="admin_password">
			<input type="password" name="admin_login_post" /><br /><br />
			<button type="submit" class="button">Submit</button>
		</div>
	</form>
	<?php
} else {
	?>
		<h1>Welcome to Admin!</h1>
	<?php
}

?>