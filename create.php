<?php 
include 'includes/header.php'; 
include 'db.php'; 
//session_start(); // Ensure this is the only call to session_start()

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     echo "<p>You must be logged in to view this page. <a href='login.php'>Login here</a></p>";
//     echo '<p>Redirecting in <span id="countdown">3</span> seconds...</p>';
//     echo '<script>
//         var countdown = 3;
//         var interval = setInterval(function() {
//             countdown--;
//             document.getElementById("countdown").textContent = countdown;
//             if (countdown <= 0) {
//                 clearInterval(interval);
//                 window.location.href = "login.php";
//             }
//         }, 1000);
//     </script>';
//     include 'includes/footer.php';
//     exit;
// }

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];

    // Handle image upload
    if ($image) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    // Insert record into the database
    $sql = "INSERT INTO records (title, content, image) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $content, $image]);

    echo "<p>Record created successfully. <a href='read.php'>Go back to records</a></p>";
    
    echo '<p>Redirecting in <span id="countdown">5</span> seconds...</p>';
    echo '<script>
        var countdown = 5;
        var interval = setInterval(function() {
            countdown--;
            document.getElementById("countdown").textContent = countdown;
            if (countdown <= 0) {
                clearInterval(interval);
                window.location.href = "read.php";
            }
        }, 1000);
    </script>';
    include 'includes/footer.php';
    exit;
}
?>
<h2>Create Record</h2>
<form action="create.php" method="post" enctype="multipart/form-data">
    <label for="title">Student Name:</label>
    <input type="text" id="title" name="title" required>
    
    <label for="content">Course Detail:</label>
    <textarea id="content" name="content" required></textarea>
    
    <label for="image">Image:</label>
    <input type="file" id="image" name="image">
    
    <button type="submit">Create Record</button>
</form>
<?php include 'includes/footer.php'; ?>
