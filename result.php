<style>
  section {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    width: 50%;
  }
  .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  }

  .styled-table th {
    background-color: #45a049;
    color: #ffffff;
    text-align: left;
  }

  .styled-table th,
  .styled-table td {
    padding: 12px 15px;
  }

  .styled-table tr {
    border-bottom: 1px solid #dddddd;
  }

.styled-table tr:nth-of-type(even) {
    background-color: #f3f3f3;
  }

.styled-table tr:last-of-type {
    border-bottom: 2px solid #009879;
  }

  .styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
  }
</style>
<?php
  //Adding the header file
  $title = "Submit Result";
  require_once 'assets/header.php'; 

  // Connect to MySQL database
  require_once 'assets/db_connect.php';
    
  // Query the total number of votes for each candidate in the position
  $sql = "SELECT Candidate.name AS candidate_name, COUNT(Vote.vote_id) AS vote_count
          FROM Candidate
          LEFT JOIN Vote ON Candidate.candidate_id = Vote.candidate_id
          WHERE Candidate.position = 'President'
          GROUP BY Candidate.candidate_id
          ORDER BY vote_count DESC";
  $result = mysqli_query($conn, $sql);

  // Display the election results in a table
  echo "<center>";
  echo "<section align='center'>";
  echo "<h1>President Results</h1>";
  echo "<center>";
  echo "<table class='styled-table'>";
  echo "<tr><th>Candidate</th><th>Vote Count</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    $candidate_name = $row["candidate_name"];
    $vote_count = $row["vote_count"];
    echo "<tr><td>$candidate_name</td><td>$vote_count</td></tr>";
  }
  echo "</table>";
  echo "</center>";
  echo "</section>";
  echo "</center>";

  // Close the database connection
  mysqli_close($conn);
?>


<?php 
    require_once "assets/footer.php";
?>
