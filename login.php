<?php
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {
    // Get the username and password from the login form
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Query to get the hashed password from the database
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = PASSWORD('$password')";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;

        //If username and password are correct, they will be redirected
        header('Location: admin.php');
        exit();
    } else {
        echo "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Nails</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body style="display:flex; align-items:center; justify-content:center;">
  <div class="login-page">
    <div class="form">


      <form class="login-form" method="POST">
        <h2><i class="fas fa-lock"></i> Login</h2>
        <input type="text" placeholder="Username" name="username" required />
        <input type="password" placeholder="Password" name="password" required/>
        <button type="submit" name="submit">Login</button>
      </form>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/js/main.js"></script>
</body>
</html>
