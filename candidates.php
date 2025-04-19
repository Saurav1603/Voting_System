<?php
include 'db_connect.php';
$query = "SELECT * FROM candidates";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    echo "<p><strong>ID:</strong> {$row['id']} | <strong>Name:</strong> {$row['name']} | <strong>Votes:</strong> {$row['votes']}</p>";
}
?>