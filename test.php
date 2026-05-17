<?php
$user_name = "root";
$password = "";
$database = "alias";
$server = "localhost";

// Create connection
$conn = mysqli_connect($server, $user_name, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql =" SELECT c.customerID ,o.orderID
FROM customer AS c, orders AS o
WHERE c.customerID= customer_name AND c.customerID=o.customerID";
$result = mysqli_query($conn, $sql);



?>