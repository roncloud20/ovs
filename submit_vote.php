<?php
    //Adding the header file
    $title = "Submit Result";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';

// Get the voter ID and candidate ID from the form submission
if (isset($_POST['voter_id']) && isset($_POST['candidate_id'])) {
    $voter_id = $_POST['voter_id'];
    $candidate_id = $_POST['candidate_id'];
    
    // Insert the vote into the Vote table
    $sql = "INSERT INTO vote (voter_id, candidate_id) VALUES ($voter_id, $candidate_id)";
    
    if ($conn->query($sql) === TRUE) {
        echo "Vote submitted successfully";
    } else {
        echo "Error submitting vote: " . $conn->error;
    }
} else {
    echo "Invalid form submission";
}

$conn->close();
?>

