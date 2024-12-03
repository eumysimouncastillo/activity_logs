<?php
require_once 'core/handleForms.php';
require_once 'core/models.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php 
$getApplicantID = getApplicantByID($pdo, $_GET['id']); 
$applicant = $getApplicantID['querySet'];
?>

<h1>Edit Applicant Information</h1>

<form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
    <input type="text" name="first_name" value="<?= $applicant['first_name']; ?>" required><br>
    <input type="text" name="last_name" value="<?= $applicant['last_name']; ?>" required><br>
    <input type="email" name="email" value="<?= $applicant['email']; ?>" required><br>
    <input type="text" name="phone_number" value="<?= $applicant['phone_number']; ?>" required><br>
    <input type="text" name="address" value="<?= $applicant['address']; ?>" required><br>
    <input type="text" name="city" value="<?= $applicant['city']; ?>" required><br>
    <input type="text" name="state" value="<?= $applicant['state']; ?>" required><br>
    <input type="text" name="country" value="<?= $applicant['country']; ?>" required><br>
    <input type="text" name="job_position" value="<?= $applicant['job_position']; ?>" required><br>

    <button type="submit" name="editApplicantBtn">Update Applicant</button>
</form>

</body>
</html>
