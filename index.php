<?php
require_once 'core/handleForms.php';

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<?php if (isset($_SESSION['message'])) { ?>
    <h1 class="message-box">	
        <?php echo $_SESSION['message']; ?>
    </h1>
	<?php } unset($_SESSION['message']); ?>

<h1>Job Application System - Healthcare Worker Position</h1>


<form method="GET" action="index.php">
    <input type="text" name="searchInput" placeholder="Search applicants" value="<?= isset($_GET['searchInput']) ? $_GET['searchInput'] : ''; ?>"> 
    <button type="submit" name="searchBtn">Search</button>
</form>
<form action="index.php" method="POST">
        <button type="submit">Clear Search</button>
</form>
<form action="addApplicant.php" method="POST">
        <button type="submit">Insert Applicant</button>
</form>



<?php
if (isset($_GET['searchBtn'])) {
    $searchQuery = $_GET['searchInput'];
    $response = searchApplicants($pdo, $searchQuery);
    if ($response['statusCode'] == 200) {
        echo "<table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Job Position</th>
                <th>Actions</th>
            </tr>";
        foreach ($response['querySet'] as $row) {
            echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['address']}</td>
                <td>{$row['city']}</td>
                <td>{$row['state']}</td>
                <td>{$row['country']}</td>
                <td>{$row['job_position']}</td>
                <td>
                    <a href='editApplicant.php?id={$row['id']}'>Edit</a>
                    <a href='deleteApplicant.php?id={$row['id']}'>Delete</a>
                </td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No results found.</p>";
    }
} else {
    $response = getAllApplicants($pdo);
    if ($response['statusCode'] == 200) {
        echo "<table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Job Position</th>
                <th>Actions</th>
            </tr>"; 
        foreach ($response['querySet'] as $row) {
            echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['address']}</td>
                <td>{$row['city']}</td>
                <td>{$row['state']}</td>
                <td>{$row['country']}</td>
                <td>{$row['job_position']}</td>
                <td>
                    <a href='editApplicant.php?id={$row['id']}'>Edit</a>
                    <a href='deleteApplicant.php?id={$row['id']}'>Delete</a>
                </td>
            </tr>";
        } 
        echo "</table>";
    }
}
?>
<br>

</body>
</html>
