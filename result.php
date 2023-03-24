<?php
    //Adding the header file
    $title = "Submit Result";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';

    // // Check if the email and password are valid
    // $query = "SELECT * FROM candidate";
    // $result = mysqli_query($conn, $query);
    // if (isset($_GET["position"])) {
    //     // $elect1 = mysqli_fetch_assoc($result);
    //     // Get the position from the URL parameter
    //     $position = $_GET["position"];
    //     // $_SESSION['voter_id'] = $voter['voter_id'];
    //     // $_SESSION['login_type'] = $voter['login_type'];
    //     // header('Location: index.php');
    //     // exit;
    //     // }
    // }

    

// Query the total number of votes for each candidate in the position
$sql = "SELECT Candidate.name AS candidate_name, COUNT(Vote.vote_id) AS vote_count
        FROM Candidate
        LEFT JOIN Vote ON Candidate.candidate_id = Vote.candidate_id
        WHERE Candidate.position = 'President'
        GROUP BY Candidate.candidate_id
        ORDER BY vote_count DESC";
$result = mysqli_query($conn, $sql);

// Display the election results in a table
echo "<h1>President Results</h1>";
echo "<table>";
echo "<tr><th>Candidate</th><th>Vote Count</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
  $candidate_name = $row["candidate_name"];
  $vote_count = $row["vote_count"];
  echo "<tr><td>$candidate_name</td><td>$vote_count</td></tr>";
}
echo "</table>";

// Close the database connection
mysqli_close($conn);


    // // Get the election ID for the current election
    // $election_id = "President"; // Set the election ID for the current election

    // // Get the list of candidates for the current election
    // $sql = "SELECT * FROM candidate WHERE position = $election_id";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     // Initialize an array to store the vote count for each candidate
    //     $vote_count = array();

    //     // Loop through the list of candidates and get the vote count for each one
    //     while ($row = $result->fetch_assoc()) {
    //         $candidate_id = $row['candidate_id'];
    //         $sql = "SELECT COUNT(*) AS count FROM vote WHERE candidate_id = $candidate_id AND election_id = $election_id";
    //         $result2 = $conn->query($sql);
    //         $row2 = $result2->fetch_assoc();
    //         $vote_count[$row['name']] = $row2['count'];
    //     }

    //     // Sort the array by vote count in descending order
    //     arsort($vote_count);

    //     // Display the results
    //     echo "<h2>Election Results</h2>";
    //     foreach ($vote_count as $candidate_name => $count) {
    //         echo "<p>" . $candidate_name . ": " . $count . " votes</p>";
    //     }
    // } else {
    //     echo "No candidates found for this election";
    // }

    // $conn->close();
?>
