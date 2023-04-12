<?php
    //Adding the header file
    $title = "Voter Accreditation";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';

    // Check if the voter is logged in
    if (!isset($_SESSION['voter_id'])) {
        header("Location: login.php"); // Redirect to login page if voter is not logged in
        exit();
    }

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $voter_id = $_SESSION['voter_id'];
        $election_id = $_POST['election_id'];
        
        // Check if the voter is already accredited for this election
        $query = "SELECT * FROM Accreditation WHERE voter_id = '$voter_id' AND election_id = '$election_id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $message = "You are already accredited for this election.";
        } else {
            // Insert a new accreditation record into the database
            $query = "INSERT INTO Accreditation (voter_id, election_id) VALUES ('$voter_id', '$election_id')";
            if (mysqli_query($conn, $query)) {
                $message = "You have been accredited for the election!";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        }
    }

    // Retrieve the list of available elections
    $query = "SELECT * FROM election WHERE end_date > NOW()";
    $result = mysqli_query($conn, $query);

    // Close the database connection
    mysqli_close($conn);
?>

<h1>Accreditation</h1>
<h2>Election Participation</h2>
  
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
  
<form method="post">
    <label for="election_id">Select an election:</label>
    <select name="election_id" id="election_id">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <option value="<?php echo $row['election_id']; ?>"><?php echo $row['name']; ?></option>
      <?php endwhile; ?>
    </select>
    <br>
    <input type="submit" value="Accredit">
</form>

<?php 
    require_once "assets/footer.php";
?>
