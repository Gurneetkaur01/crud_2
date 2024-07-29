<?php 
include 'includes/header.php'; 
include 'db.php'; 
//session_start();

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

// Handle deletion of record
if (isset($_GET['delete_id'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<p>You must be logged in to delete a record. <a href='login.php'>Login here</a></p>";
        echo '<p>Redirecting in <span id="countdown">3</span> seconds...</p>';
        echo '<script>
            var countdown = 3;
            var interval = setInterval(function() {
                countdown--;
                document.getElementById("countdown").textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = "login.php";
                }
            }, 1000);
        </script>';
        include 'includes/footer.php';
        exit;
    }
    
    $id = $_GET['delete_id'];
    // Prepare and execute the SQL statement to delete the record
    $sql = "DELETE FROM records WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: read.php");
    exit;
}

// Fetch records from the database
$sql = "SELECT * FROM records";
$stmt = $pdo->query($sql);
$records = $stmt->fetchAll();
?>

<h2>Records</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Course Detail</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($records): ?>
            <?php $serial_number = 1; ?>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?php echo $serial_number++; ?></td>
                    <td><?php echo htmlspecialchars($record['title']); ?></td>
                    <td><?php echo htmlspecialchars($record['content']); ?></td>
                    <td>
                        <?php if ($record['image']): ?>
                            <img class="responsive-image" src="images/<?php echo htmlspecialchars($record['image']); ?>" alt="Image" style="width: 300px; height: auto;">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="update.php?id=<?php echo $record['id']; ?>">Update</a> |
                        <a href="#" onclick="confirmDelete(<?php echo $record['id']; ?>); return false;">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No records found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        window.location.href = 'read.php?delete_id=' + id;
    }
}
</script>

<?php include 'includes/footer.php'; ?>
