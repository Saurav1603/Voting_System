<?php
include 'db_connect.php';

$query = "SELECT id, name, votes FROM candidates ORDER BY votes DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['votes']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No votes yet.</td></tr>";
}
?>
