<?php
    //Adding the header file
    $title = "Create Election";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';
?>

<h1>Create Election</h1>
<form action="" method="post">
    <label for="name">Election Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <!-- <select name="name">
        <option value="President">President</option>
        <option value="Senate">Senate</option>
        <option value="Congress">House Of Representative</option>
    </select> <br/> -->

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
    // if (isset($_POST['submit'])) {

        // Get the form data
        $name = $_POST['name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $description = $_POST['description'];

        // Insert the new election into the database
        $sql = "INSERT INTO Election (name, start_date, end_date, description)
                VALUES ('$name', '$start_date', '$end_date', '$description')";

        if (mysqli_query($conn, $sql)) {
            echo "Election created successfully";
        } else {
            echo "Error creating election: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    // }

?>

<?php 
    require_once "assets/footer.php";
?>