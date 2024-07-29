<?php
include 'includes/header.php'; 
include 'db.php'; 
//session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>You must be logged in to view this page. <a href='login.php'>Login here</a></p>";
    include 'includes/footer.php';
    exit;
}

// Delete logic here
$id = $_GET['id'];
$sql = "DELETE FROM records WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

echo "<p>Record deleted successfully. <a href='read.php'>Go back</a></p>";
include 'includes/footer.php';
?>
