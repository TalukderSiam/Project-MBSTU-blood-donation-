<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body id="bodyy">
    <center>
        <form action="login.php" method="POST">
            <h1>WELCOME FOR LOGIN</h1>
            <table>
                <tr>
                    <td><b>Email</b></td>
                    <td><input type="email" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td><b>Password</b></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="login" id="login" value="Login"></td>
                </tr>
            </table>
            <p>Not registered? <a href="register.html">Register</a></p>
        </form>
    </center>
</body>
</html>

<?php
$conn = new mysqli("localhost", "root", "", "bloodbank");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);  // Use mysqli_real_escape_string to prevent SQL injection
    $password = mysqli_real_escape_string($conn, $_POST['password']);  // Use mysqli_real_escape_string to prevent SQL injection

    $query = "SELECT * FROM blood WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $total = mysqli_num_rows($result);

    if ($total == 1) {
        header('location: blood_group_name_page.php');
        exit;  // It's a good practice to exit after a header redirect
    } else {
    
       // echo "Invalid email or password";  // You can provide a message or redirect to a login error page
       echo '<script type="text/javascript">';
       echo 'alert("Invalid email or password");';
       echo 'window.location.href = "login.php";';  // Redirect to the login page
       echo '</script>';
    
    }
}
?>

