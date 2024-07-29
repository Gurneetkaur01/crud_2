<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header>
    <h1>CRUD Application</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="create.php">Create</a>
        <a href="read.php">View All</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Links for logged-in users -->
         
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <!-- Links for users not logged in -->
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<main>
