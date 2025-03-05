<?php 
session_start(); // Start the session

include 'connection.php';

// Check if the user is logged in before allowing them to add a client
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

    if(isset($_GET['deleteid'])) {
        $customer_id=$_GET['deleteid'];

        $sql="delete from `crud_website`.clients_data where customer_id=$customer_id";
        $result=mysqli_query($conn,$sql);

        if($result) {
            header('location:admin.php');
        }else{
            die("Connection failed:" . $conn->connect_error);
        }

    }
?>