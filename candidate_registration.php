<?php
    // Including the All Pages Header
    $title = "Register Candidate";
    require_once("assets/header.php");

    // including the database connect file
    require_once("assets/db_connect.php");
?>
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
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    width: 50%;
}
</style>
<!-- HTML form for user registration -->
<center>
    <section align="center">
        <h1><?php echo $title; ?></h1>
        <form method="POST">
            <!-- <label for="name">Name:</label> -->
            <input type="text" name="name" placeholder="Candidate Name" required><br><br>

            <label for="party">Party</label>
            <select name="party">
                <option value="AAC" >AAC</option>
                <option value="APC">APC</option>
                <option value="PDP">PDP</option>
                <option value="LP">LP</option>
            </select> <br/>

            <label for="position">position</label>
            <select name="position">
                <option value="President">President</option>
                <option value="Senate">Senate</option>
                <option value="Congress">House Of Representative</option>
            </select>
            <label for="election_id">Election:</label>
		<select name="election_id" id="election_id" required>
			<?php

			$sql = "SELECT * FROM Election WHERE end_date > NOW()";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<option value="'.$row['election_id'].'">'.$row['name'].'</option>';
				}
			} else {
				echo '<option value="">No Elections Available</option>';
			}
			?>
		</select><br><br>

        <input type="submit" name="submit" value="Register">
        </form>
        
    </section>
</center>

<div height="200px"></div>

<?php
    // Checking if the form has been submitted
    if (isset($_POST['submit'])) {
        // Sanitizing and validating input data
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $party = mysqli_real_escape_string($conn, $_POST['party']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $election_id = mysqli_real_escape_string($conn, $_POST['election_id']);
       
        // Inserting the user data into the database
        $query = "INSERT INTO candidate (name, party, position,election_id) VALUES ('$name', '$party', '$position', '$election_id')";

        // check if the query was successful
        if (mysqli_query($conn, $query)) {
            echo "Registration successful";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

<?php 
    require_once "assets/footer.php";
?>