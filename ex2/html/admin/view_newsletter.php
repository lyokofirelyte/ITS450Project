<?php

// Require the configuration before any PHP code as configuration controls error reporting
require ('../includes/config.inc.php');
// Set the page title and include the header
$page_title = 'ADMIN – Customer Information';
include ('./includes/header.html');
// Verify authorization
if (!isset($_SESSION["admin_auth"])){
	echo("Not authorized!");
	exit();
}

// Require database connection
require(MYSQL);

?>

<div style="background-color: rgba(0, 0, 0, 0.5); padding: 10px; color: white;">

<?php

// Table to display customer info
echo '<h3>Newsletter Current Signups</h3><table border="0" width="100%" cellspacing="4" cellpadding="4">
<thead>
	<tr>
    <th align="left">Customer Name</th>
    <th align="left">Email Address</th>
  </tr></thead>
<tbody>';

// Define MySQL query for customer info
$customer_data = 'SELECT news_first_name, news_last_name, CONCAT(news_first_name, " ", news_last_name) AS name, news_email FROM newsletter ORDER BY name';

// Query MySQL database
$r = mysqli_query ($dbc, $customer_data); // 'dbc' is set in /var/www/ex2/mysql.inc.php
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
    // Place queried customer info into table
	echo '<tr>
    <td align="left">' . $row['name'] .'</td>
    <td align="left">' . $row['news_email'] .'</td>
    </tr>';
}

echo '</tbody></table></div>';

// Include footer file to complete the template
include ('./includes/footer.html');

?>
