<?php 
include 'includes/header.php'; 
//session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }
        .container {
            max-width: 800px;
        }
        .card {
            margin-bottom: 20px;
        }
        .btn {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- <h1 class="text-center">CRUD Application</h1> -->

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Create Record</h5>
                        <p class="card-text">Add new records to the database.</p>
                        <a href="create.php" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">View All Records</h5>
                        <p class="card-text">View and manage all records.</p>
                        <a href="read.php" class="btn btn-info">View Records</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <h5 class="card-title">Logout</h5>
                            <p class="card-text">You are logged in.</p>
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                        <?php else: ?>
                            <h5 class="card-title">Login</h5>
                            <p class="card-text">Login to manage records.</p>
                            <a href="login.php" class="btn btn-success">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include 'includes/footer.php'; ?>
