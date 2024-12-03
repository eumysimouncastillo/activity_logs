<?php  
require_once 'dbConfig.php';

function insertAnActivityLog($pdo, $operation, $applicant_id, $first_name, 
		$last_name, $email, $phone_number, $address, $city, $state, $country, $job_position, $username) {

	$sql = "INSERT INTO activity_logs (operation, applicant_id, first_name, 
		last_name, email, phone_number, address, city, state, country, job_position, username) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $applicant_id, $first_name, 
    $last_name, $email, $phone_number, $address, $city, $state, $country, $job_position, $username]);

	if ($executeQuery) {
		return true;
	}

}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs 
			ORDER BY date_added DESC";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

// Get all applicants
function getAllApplicants($pdo) {
    $sql = "SELECT * FROM job_applicants ORDER BY date_applied DESC";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        return ['message' => 'Applicants fetched successfully', 'statusCode' => 200, 'querySet' => $stmt->fetchAll()];
    }
    return ['message' => 'Query failed', 'statusCode' => 400];
}

// Get applicant by ID
function getApplicantByID($pdo, $id) {
    $sql = "SELECT * FROM job_applicants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        return ['message' => 'Applicant fetched successfully', 'statusCode' => 200, 'querySet' => $stmt->fetch()];
    }
    return ['message' => 'Query failed', 'statusCode' => 400];
}

// Insert a new applicant
function insertNewApplicant($pdo, $first_name, $last_name, $email, $phone_number, $address, $city, $state, $country, $job_position) {
    $sql = "INSERT INTO job_applicants (first_name, last_name, email, phone_number, address, city, state, country, job_position) 
            VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$first_name, $last_name, $email, $phone_number, $address, $city, $state, $country, $job_position])) {

        $applicant_id = $pdo->lastInsertId(); 
        $findApplicantSQL = "SELECT * FROM job_applicants WHERE id = ?";
        $stmtFindApplicant = $pdo->prepare($findApplicantSQL);
        $stmtFindApplicant->execute([$applicant_id]);
        $applicant = $stmtFindApplicant->fetch();

        $insertAnActivityLog = insertAnActivityLog(
            $pdo, 
            "INSERT", 
            $applicant['id'], 
            $applicant['first_name'], 
            $applicant['last_name'], 
            $applicant['email'], 
            $applicant['phone_number'], 
            $applicant['address'], 
            $applicant['city'], 
            $applicant['state'], 
            $applicant['country'], 
            $applicant['job_position'], 
            $_SESSION['username'] 
        );

        if ($insertAnActivityLog) {
            return ['message' => 'Applicant added and activity log inserted successfully', 'statusCode' => 200];
        } else {
            return ['message' => 'Applicant added, but failed to insert activity log', 'statusCode' => 400];
        }
    }

    return ['message' => 'Query failed', 'statusCode' => 400];
}


// Edit an applicant
function editApplicant($pdo, $first_name, $last_name, $email, $phone_number, $address, $city, $state, $country, $job_position, $id) {
    $sql = "UPDATE job_applicants 
            SET first_name = ?, last_name = ?, email = ?, phone_number = ?, address = ?, city = ?, state = ?, country = ?, job_position = ? 
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$first_name, $last_name, $email, $phone_number, $address, $city, $state, $country, $job_position, $id])) {

        $findApplicantSQL = "SELECT * FROM job_applicants WHERE id = ?";
        $stmtFindApplicant = $pdo->prepare($findApplicantSQL);
        $stmtFindApplicant->execute([$id]);
        $applicant = $stmtFindApplicant->fetch();

        $insertAnActivityLog = insertAnActivityLog(
            $pdo, 
            "UPDATE", 
            $applicant['id'], 
            $applicant['first_name'], 
            $applicant['last_name'], 
            $applicant['email'], 
            $applicant['phone_number'], 
            $applicant['address'], 
            $applicant['city'], 
            $applicant['state'], 
            $applicant['country'], 
            $applicant['job_position'], 
            $_SESSION['username'] 
        );

        if ($insertAnActivityLog) {
            return ['message' => 'Applicant updated and activity log inserted successfully', 'statusCode' => 200];
        } else {
            return ['message' => 'Applicant updated, but failed to insert activity log', 'statusCode' => 400];
        }
    }

    return ['message' => 'Query failed', 'statusCode' => 400];
}

// Delete an applicant
function deleteApplicant($pdo, $id) {
    $findApplicantSQL = "SELECT * FROM job_applicants WHERE id = ?";
    $stmtFindApplicant = $pdo->prepare($findApplicantSQL);
    $stmtFindApplicant->execute([$id]);
    $applicant = $stmtFindApplicant->fetch();

    $sql = "DELETE FROM job_applicants WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$id])) {

        $insertAnActivityLog = insertAnActivityLog(
            $pdo, 
            "DELETE", 
            $applicant['id'], 
            $applicant['first_name'], 
            $applicant['last_name'], 
            $applicant['email'], 
            $applicant['phone_number'], 
            $applicant['address'], 
            $applicant['city'], 
            $applicant['state'], 
            $applicant['country'], 
            $applicant['job_position'], 
            $_SESSION['username']
        );

        if ($insertAnActivityLog) {
            return ['message' => 'Applicant deleted and activity log inserted successfully', 'statusCode' => 200];
        } else {
            return ['message' => 'Applicant deleted, but failed to insert activity log', 'statusCode' => 400];
        }
    }

    return ['message' => 'Query failed', 'statusCode' => 400];
}


// Search for applicants
/*
function searchApplicants($pdo, $searchQuery) {
    $sql = "SELECT * FROM job_applicants WHERE CONCAT(first_name, last_name, email, phone_number, address, city, state, country, job_position) LIKE ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(["%$searchQuery%"])) {
        return ['message' => 'Search results fetched successfully', 'statusCode' => 200, 'querySet' => $stmt->fetchAll()];
    }
    return ['message' => 'Query failed', 'statusCode' => 400];
}
*/

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_accounts";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllSearchLogs($pdo) {
    $sql = "SELECT * FROM search_activity_logs ORDER BY timestamp DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Step 1: Insert the search keyword into the activity log
function logSearchQuery($pdo, $searchQuery, $username) {
    $sql = "INSERT INTO search_activity_logs (search_query, username) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$searchQuery, $username]);
}

// Step 2: Modify the searchApplicants function to include logging
function searchApplicants($pdo, $searchQuery) {
    // Log the search query
    $logSearch = logSearchQuery($pdo, $searchQuery, $_SESSION['username']); // Assuming username is stored in session

    // Check if the logging was successful (optional, can be logged separately)
    if (!$logSearch) {
        return ['message' => 'Failed to log search query', 'statusCode' => 400];
    }

    // Step 3: Perform the search
    $sql = "SELECT * FROM job_applicants WHERE CONCAT(first_name, last_name, email, phone_number, address, city, state, country, job_position) LIKE ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(["%$searchQuery%"])) {
        return ['message' => 'Search results fetched successfully', 'statusCode' => 200, 'querySet' => $stmt->fetchAll()];
    }

    // If search failed
    return ['message' => 'Query failed', 'statusCode' => 400];
}


?>
