<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_website";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn) {
    echo" " ;
}else{
    die("Connection failed:" . $conn->connect_error);
}


?>