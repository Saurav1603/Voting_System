<?php
include 'db_connect.php';
session_start();

header('Content-Type: application/json'); // Ensure JSON response

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_POST['candidate']) || empty($_POST['candidate'])) {
    echo json_encode(["status" => "error", "message" => "Invalid candidate selection."]);
    exit();
}

$candidate_id = intval($_POST['candidate']);

$query = "SELECT voted FROM users WHERE id='$user_id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($row && $row['voted'] == 0) {
    $updateVote = $conn->query("UPDATE candidates SET votes = votes + 1 WHERE id='$candidate_id'");
    $insertVote = $conn->query("INSERT INTO votes (user_id, candidate_id) VALUES ('$user_id', '$candidate_id')");
    $markVoted = $conn->query("UPDATE users SET voted=1 WHERE id='$user_id'");

    if ($updateVote && $insertVote && $markVoted) {
        echo json_encode(["status" => "success", "message" => "✅ Vote cast successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Error: Could not process your vote."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "⚠️ You have already voted."]);
}
?>
