<?php require_once 'header.php'; ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

mysqli_select_db( $conn,"inventory");



$result = mysqli_query( $conn, "SELECT * FROM items");
if (false === $result) {
    echo mysqli_error();
}
$row = mysqli_fetch_array($result, MYSQL_BOTH);

     print_r($row);

echo "Fetched data successfully\n";
?>
<?php require_once 'footer.php';?>