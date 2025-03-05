<?php 
session_start();
include 'connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="dashboard">

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">SUPER NAILS</div>
      <ul>
        <li class="active"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="content my-5">
      <h2>Client Information</h2>
      <br>
      <a class="btn btn-primary my-5" href="index.php" role="button">Add New Client</a>

      <!-- Client Table -->
      <table>
        <thead>
          <tr class="table-info">
            <th scope="col">Customer ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Time of Appointment</th>
            <th scope="col">Date of Appointment</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `crud_website`.clients_data";
          $result = mysqli_query($conn, $sql);
          if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['customer_id'];
                  $firstName = $row['first_name'];
                  $lastName = $row['last_name'];
                  $email = $row['email'];
                  $phone_number = $row['phone_number'];
                  $time_of_appointment = $row['time_of_appointment'];
                  $date_of_appointment = $row['date_of_appointment'];
                  $created_at = $row['created_at'];
                  $updated_at = $row['updated_at'];
                  $name = $firstName . ' ' . $lastName;

                  echo '<tr>
                  <th scope="row">'.$id.'</th>
                  <td>'.$name.'</td>
                  <td>'.$email.'</td>
                  <td>'.$phone_number.'</td>
                  <td>'.$time_of_appointment.'</td>
                  <td>'.$date_of_appointment.'</td>
                  <td>'.$created_at.'</td>
                  <td>'.$updated_at.'</td>
                  <td> 
                  <div class="button-group">
                  <a class="btn btn-warning" href="update.php?updateid='.$id.'">Update</a>
                  <a class="btn btn-danger" href="delete.php?deleteid='.$id.'">Delete</a>
                  </div>
                  </td>
                  </tr>';
              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
