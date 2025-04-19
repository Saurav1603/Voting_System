<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($query) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>
