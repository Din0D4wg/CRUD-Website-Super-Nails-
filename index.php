<?php 
session_start(); // Start the session

include 'connection.php';

// Check if the user is logged in before allowing them to add a client
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}


if(isset($_POST['submit'])) {
    
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
    $phone_number=$_POST['phone_number'];
    $time_of_appointment=$_POST['time_of_appointment'];
    $date_of_appointment=$_POST['date_of_appointment'];

     // Initialize the client time and date of appointment variables
     $time_of_appointment = isset($_POST['time_of_appointment']) ? $_POST['time_of_appointment'] : '';  // Time of appointment
     $date_of_appointment = isset($_POST['date_of_appointment']) ? $_POST['date_of_appointment'] : '';  // Date of appointment
 

    $sql = "INSERT INTO clients_data (first_name, last_name, email, phone_number, time_of_appointment, date_of_appointment) 
    VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$time_of_appointment', '$date_of_appointment')";
    $results=mysqli_query($conn,$sql);
    if($results) {
        //echo "Data Submitted Successfully!";
        header('location:admin.php');
    }else{
        die("Connection failed:" . $conn->connect_error);
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Nails</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Client Information</h2>
        <form method="post">
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Enter Clients Name" name="first_name" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" class="form-control" placeholder="Enter Clients Name" name="last_name" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" class="form-control" placeholder="Enter Clients Email" name="email" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Phone Number</label>
                <input type="tel" class="form-control" placeholder="Enter Clients Mobile" name="phone_number" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Time of Appointment</label>
                <input type="time" class="form-control" placeholder="Enter Clients Time of Appointment" name="time_of_appointment" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Date of Appointment</label>
                <input type="date" class="form-control" placeholder="Enter Clients Date of Appointment" name="date_of_appointment" autocomplete="off">
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>

        

    </div>
</body>
</html>