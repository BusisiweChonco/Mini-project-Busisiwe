<?PHP

$user_name = "root";
$password = "";
$database = "fms";
$server = "localhost";

// Create connection
$conn = mysqli_connect($server, $user_name, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
