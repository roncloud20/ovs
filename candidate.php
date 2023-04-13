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
    $title = "Show all Candidate";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';

    // Retrieve all candidates from the database
    $sql = "SELECT * FROM candidate  ORDER BY position";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error retrieving candidates: " . mysqli_error($conn));
    }

    // Display the candidates in an HTML table
    echo "<center>";
    echo "<section align='center'>";
    echo "<p>click <a href='candidate_registration.php'>here</a> to register candidate</p>";
    echo "<h1>All Candidate</h1>";
    echo "<center>";
    echo "<table class='styled-table'>";
    echo "<tr><th>ID</th><th>Name</th><th>Party</th><th>Position</th><th>Action</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["candidate_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["party"] . "</td>";
        echo "<td>" . $row["position"] . "</td>";
        echo "<td><a href=\"delete_candidate.php?candidate_id=" . $row["candidate_id"] . "\">Delete</a></td>";
        echo "</tr>";
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
