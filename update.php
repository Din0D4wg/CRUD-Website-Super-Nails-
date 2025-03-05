<?php 
session_start(); // Start the session

include 'connection.php';

// Check if the user is logged in before allowing them to add a client
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}


if (isset($_GET['updateid'])) {
    $customer_id = $_GET['updateid'];

    // Fetch current client data
    $sql = "SELECT * FROM `crud_website`.clients_data WHERE customer_id = $customer_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $phone_number = $row['phone_number'];
        $time_of_appointment = $row['time_of_appointment'];
        $date_of_appointment = $row['date_of_appointment'];
    } else {
        echo "Client not found!";
        exit;
    }

    // Form submission when admin updates data
    if (isset($_POST['submit'])) {
        
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $time_of_appointment = $_POST['time_of_appointment'];
        $date_of_appointment = $_POST['date_of_appointment'];

        // Update query
        $sql = "UPDATE `crud_website`.clients_data SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                email = '$email', 
                phone_number = '$phone_number', 
                time_of_appointment = '$time_of_appointment', 
                date_of_appointment = '$date_of_appointment' 
                WHERE customer_id = $customer_id";
        
        $results = mysqli_query($conn, $sql);
        
        if ($results) {
            header('location:admin.php');
        } else {
            die("Connection failed: " . $conn->connect_error);
        }
    }
} else {
    echo "Update ID is missing!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Nails</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Update Client Information</h2>
        <form method="post">
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Enter Client's First Name" name="first_name" value="<?php echo $first_name; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" class="form-control" placeholder="Enter Client's Last Name" name="last_name" value="<?php echo $last_name; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" class="form-control" placeholder="Enter Client's Email" name="email" value="<?php echo $email; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Phone Number</label>
                <input type="tel" class="form-control" placeholder="Enter Client's Phone Number" name="phone_number" value="<?php echo $phone_number; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Time of Appointment</label>
                <input type="time" class="form-control" placeholder="Enter Client's Time of Appointment" name="time_of_appointment" value="<?php echo $time_of_appointment; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Date of Appointment</label>
                <input type="date" class="form-control" placeholder="Enter Client's Date of Appointment" name="date_of_appointment" value="<?php echo $date_of_appointment; ?>" autocomplete="off">
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
