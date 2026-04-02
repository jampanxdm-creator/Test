<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND role='admin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $username;
            header("Location: dashboard.php");
        } else {
            echo "Wrong password";
        }
    } else {
        echo "Admin not found";
    }
}
?>

<form method="POST">
  <input name="username" placeholder="Admin Username">
  <input type="password" name="password" placeholder="Password">
  <button type="submit">Login</button>
</form>