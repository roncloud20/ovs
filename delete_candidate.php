<?php
  //Adding the header file
  $title = "Submit Result";
  require_once 'assets/header.php'; 

  // Connect to MySQL database
  require_once 'assets/db_connect.php';

// Check if a candidate ID was provided
if (!isset($_GET["candidate_id"])) {
    die("No candidate ID provided.");
}

$candidate_id = $_GET["candidate_id"];

// Delete the candidate from the database
$sql = "DELETE FROM Candidate WHERE candidate_id = $candidate_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error deleting candidate: " . mysqli_error($conn));
}

echo "Candidate deleted successfully.";

// Close the database connection
mysqli_close($conn);
?>

<?php 
    require_once "assets/footer.php";
?>
