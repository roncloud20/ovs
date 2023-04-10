<?php
    //Adding the header file
    $title = "Create Election";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';
?>

<h1>Create Election</h1>
<form action="create_election.php" method="post">
    <label for="name">Election Name:</label>
    <select name="name">
        <option value="President">President</option>
        <option value="Senate">Senate</option>
        <option value="Congress">House Of Representative</option>
    </select> <br/>

    <label for="start_date">Start Date:</label>
    <input type="datetime-local" id="start_date" name="start_date" required><br>

    <label for="end_date">End Date:</label>
    <input type="datetime-local" id="end_date" name="end_date" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description"></textarea><br>

    <input type="submit" value="Create Election">
</form>

<?php
    // Checking if the form has been submitted
    if (isset($_POST['submit'])) {

        // Sanitizing and validating input data
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        // Inserting the user data into the database
        $query = "INSERT INTO election (name, start_date, end_date, description) VALUES ('$name', '$start_date', '$end_date', '$description')";

        // check if the query was successful
        if (mysqli_query($conn, $query)) {
            echo "Election created successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

<?php 
    require_once "assets/footer.php";
?>