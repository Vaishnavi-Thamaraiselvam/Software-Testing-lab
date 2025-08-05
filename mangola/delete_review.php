<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include "includes/dbconnect.php"; // MySQLi connection

if (isset($_GET['review_id'])) {
    $review_id = intval($_GET['review_id']); // sanitize

    $stmt = $connection->prepare("DELETE FROM reviews WHERE review_id = ?");
    $stmt->bind_param("i", $review_id);

    if ($stmt->execute()) {
        header("Location: admin.php?msg=review_deleted");
    } else {
        header("Location: admin.php?msg=review_delete_failed");
    }

    $stmt->close();
} else {
    header("Location: admin.php?msg=invalid_review_id");
}

$connection->close();
?>
