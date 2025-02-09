<?php
include_once 'functions/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];
    $transaction_id = $_POST['transaction_id'];

    // Validate input
    if (is_numeric($rating) && $rating >= 1 && $rating <= 5) {
        // Prepare SQL statement
        $sql = "INSERT INTO ratings (transaction_id, rating, comments) VALUES (:transaction_id, :rating, :comments)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':transaction_id', $transaction_id);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comments', $comments);

        

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert rating.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid rating.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>