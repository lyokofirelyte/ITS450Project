<?php

// Require the configuration before any PHP code as configuration controls error reporting.
require ('../includes/config.inc.php');
// Set the page title and include the header:
$page_title = 'ADMIN – Customer Information';
include ('./includes/header.html');

// MySQL
require(MYSQL);

// Include the footer file to complete the template.
include ('./includes/footer.html');

?>