<?php
require_once 'core/handleForms.php';
require_once 'core/models.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Are you sure you want to delete this user?</h1>

    <?php 
    $getApplicantID = getApplicantByID($pdo, $_GET['id']); 
    $applicant = $getApplicantID['querySet'];
    ?>
	<div class="container">
		<h2>First Name: <?php echo $applicant['first_name']; ?></h2>
		<h2>Last Name: <?php echo $applicant['last_name']; ?></h2>
		<h2>Email: <?php echo $applicant['email']; ?></h2>
		<h2>Phone: <?php echo $applicant['phone_number']; ?></h2>
		<h2>Address: <?php echo $applicant['address']; ?></h2>
		<h2>City: <?php echo $applicant['city']; ?></h2>
		<h2>State: <?php echo $applicant['state']; ?></h2>
		<h2>Country: <?php echo $applicant['country']; ?></h2>
        <h2>Job Position: <?php echo $applicant['job_position']; ?></h2>
    

    <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <button type="submit" name="deleteApplicantBtn">Delete</button>
    </form>
    <form action="index.php" method="POST">
        <button type="submit">Back</button>
    </form>
</body>
</html>