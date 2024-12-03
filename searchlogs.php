<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Activity Logs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div>
        <h1>Search Activity Logs</h1>
        <table>
            <tr>
                <th>Log ID</th>
                <th>Search Query</th>
                <th>Username</th>
                <th>Timestamp</th>
            </tr>
            <?php 
                // Assuming you have a function to fetch all search activity logs
                $getAllSearchLogs = getAllSearchLogs($pdo); 
            ?>
            <?php foreach ($getAllSearchLogs as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['search_query']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['timestamp']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
