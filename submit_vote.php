<style>
    .error{
        color: red;
        text-align: center;
    }
    .success{
        color: green;
        text-align: center;
    }
</style>
<?php
    //Adding the header file
    $title = "Submit Result";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';

// Get the voter ID and candidate ID from the form submission
if (isset($_POST['voter_id']) && isset($_POST['candidate_id']) && isset($_POST['election_id'])) {
    $voter_id = $_POST['voter_id'];
    $candidate_id = $_POST['candidate_id'];
    $election_id = $_POST['election_id'];
    
    // Insert the vote into the Vote table
    $sql = "INSERT INTO vote (election_id, voter_id, candidate_id) VALUES ($election_id, $voter_id, $candidate_id)";
    
    if ($conn->query($sql) === TRUE) {
        echo "<h1 class='success'>Vote submitted successfully</h1>";
    } else {
        echo "Error submitting vote: " . $conn->error;
    }
} else {
    echo "<h1 class='error'>Invalid form submission</h1>";
}

$conn->close();
?>

