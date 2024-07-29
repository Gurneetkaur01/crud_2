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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    
    // Fetch the current record
    $sql = "SELECT image FROM records WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $current_image = $stmt->fetchColumn();

    // Handle image upload
    if ($image) {
        // New image is uploaded
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } else {
        // No new image uploaded, keep the existing image
        $image = $current_image;
    }

    // Update record in the database
    $sql = "UPDATE records SET title = ?, content = ?, image = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $content, $image, $id]);

    echo "<p>Record updated successfully. <a href='read.php'>Go back to records</a></p>";
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

// Fetch the record to update
$id = $_GET['id'];
$sql = "SELECT * FROM records WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$record = $stmt->fetch();

if (!$record) {
    echo "<p>Record not found.</p>";
    include 'includes/footer.php';
    exit;
}
?>

<h2>Update Record</h2>
<form action="update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">
    
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($record['title']); ?>" required>
    
    <label for="content">Content:</label>
    <textarea id="content" name="content" required><?php echo htmlspecialchars($record['content']); ?></textarea>
    
    <label for="image">Image:</label>
    <input type="file" id="image" name="image">
    <?php if ($record['image']): ?>
        <p>Current Image:</p>
        <img src="images/<?php echo htmlspecialchars($record['image']); ?>" alt="Image" style="width: 300px; height: auto;">
    <?php endif; ?>
    
    <button type="submit">Update Record</button>
</form>
<?php include 'includes/footer.php'; ?>
