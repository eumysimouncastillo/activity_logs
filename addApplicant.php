<?php
require_once 'core/handleForms.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Add New Applicant</h1>

<form action="core/handleForms.php" method="POST">
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="phone_number" placeholder="Phone Number" required><br>
    <input type="text" name="address" placeholder="Address" required><br>
    <input type="text" name="city" placeholder="City" required><br>
    <input type="text" name="state" placeholder="State" required><br>
    <input type="text" name="country" placeholder="Country" required><br>
    <input type="text" name="job_position" placeholder="Job Position" required><br> <br>

    <button type="submit" name="insertApplicantBtn">Add Applicant</button>
</form>

<form action="index.php" method="POST">
        <button type="submit">Back</button>
</form>

</body>
</html>
