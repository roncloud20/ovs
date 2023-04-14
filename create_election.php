<style>
    input[type=text], select, input[type=email], input[type=datetime-local], input[type=password], input[type=date], textarea {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit], .btn {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
		text-decoration: none;
    }

    input[type=submit]:hover, .btn:hover {
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
    $title = "Create Election";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';
?>

<?php
    // Checking if the form has been submitted
    // if (isset($_POST['submit'])) {

        // Get the form data
        // $name = $_POST['name'];
        // $start_date = $_POST['start_date'];
        // $end_date = $_POST['end_date'];
        // $description = $_POST['description'];

        // // Insert the new election into the database
        // $sql = "INSERT INTO Election (name, start_date, end_date, description)
        //         VALUES ('$name', '$start_date', '$end_date', '$description')";

        // if (mysqli_query($conn, $sql)) {
        //     echo "Election created successfully";
        // } else {
        //     echo "Error creating election: " . mysqli_error($conn);
        // }

        // mysqli_close($conn);
    // }

?>
<center>
    <section align="center">
        <h1>Create Election</h1>
        <form action="submit_election.php" method="post">
            <!-- <label for="name">Election Name:</label> -->
            <input type="text" id="name" name="name" placeholder="Election Name:" required><br><br>
            <!-- <select name="name">
                <option value="President">President</option>
                <option value="Senate">Senate</option>
                <option value="Congress">House Of Representative</option>
            </select> <br/> -->

            <label for="start_date">Start Date:</label>
            <input type="datetime-local" id="start_date" name="start_date" required><br>

            <label for="end_date">End Date:</label>
            <input type="datetime-local" id="end_date" name="end_date" required><br>

            <!-- <label for="description">Description:</label> -->
            <textarea id="description" name="description" placeholder='Description'></textarea><br>

            <input type="submit" value="Create Election"/>
        </form>
    </section>
</center>


<?php 
    require_once "assets/footer.php";
?>