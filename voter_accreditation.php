<style>
    input[type=text], select, input[type=email], input[type=password], input[type=date] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    section {
        margin-top: 30px;
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        width: 50%;
    }
    .divider {
        height:100px;
    }
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
            $message = "<h2 class='error'>You are already accredited for this election.</h2>";
        } else {
            // Insert a new accreditation record into the database
            $query = "INSERT INTO Accreditation (voter_id, election_id) VALUES ('$voter_id', '$election_id')";
            if (mysqli_query($conn, $query)) {
                $message = "<h2 class='success'>You have been accredited for the election!</h2>";
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
<center>
    <section align='center'>
        <h1 class='success'>Accreditation</h1>
        <h2 class='success'>Election Participation</h2>
  
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
    </section>
</center>
<?php 
    require_once "assets/footer.php";
?>
