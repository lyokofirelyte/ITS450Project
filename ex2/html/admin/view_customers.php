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
echo '<h3>Customer Directory</h3><table border="0" width="100%" cellspacing="4" cellpadding="4">
<thead>
	<tr>
    <th align="left">Customer Name</th>
    <th align="left">Email Address</th>
    <th align="right">Address</th>
    <th align="right">City</th>
    <th align="center">State</th>
    <th align="center">ZIP</th>
  </tr></thead>
<tbody>';

// Define MySQL query for customer info
$customer_data = 'SELECT last_name, first_name, CONCAT(last_name, ", ", first_name) AS name, email, address1, city, state, zip FROM customers ORDER BY name';

// Query MySQL database
$r = mysqli_query ($dbc, $customer_data); // 'dbc' is set in /var/www/ex2/mysql.inc.php
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
    // Place queried customer info into table
	echo '<tr>
    <td align="left">' . $row['name'] .'</td>
    <td align="left">' . $row['email'] .'</td>
    <td align="right">' . $row['address1'] .'</td>
    <td align="right">' . $row['city'] .'</td>
    <td align="center">' . $row['state'] .'</td>
    <td align="center">' . $row['zip'] .'</td>
    </tr>';
}

echo '</tbody></table></div>';

// Include footer file to complete the template
include ('./includes/footer.html');

?>