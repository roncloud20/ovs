<?php
    // Including the All Pages Header
    $title = "Display Election";
    require_once("assets/header.php");

    // including the database connect file
    require_once("assets/db_connect.php");
?>
<h1 align="center">All Available Elections</h1>
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
	// Get election information
	$sql = "SELECT * FROM Election WHERE end_date > NOW()";
	$result = mysqli_query($conn, $sql);

	// Check if any election is available
	if (mysqli_num_rows($result) > 0) {
		
		// Output available elections
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<center>";
    		echo "<section align='center'>";
			echo "<h2 class='success'>" . $row["name"] . "</h2>";
			echo "<h3 class='success'>Description: " . $row["description"] . "</h3>";
			echo "<p>Start date: " . $row["start_date"] . "</p>";
			echo "<p>End date: " . $row["end_date"] . "</p>";

			// Check if voter is accredited for this election
			$accredited = false;
			if (isset($_SESSION["voter_id"])) {
				$sql2 = "SELECT * FROM Accreditation WHERE voter_id = " . $_SESSION["voter_id"] . " AND election_id = " . $row["election_id"];
				$result2 = mysqli_query($conn, $sql2);
				if (mysqli_num_rows($result2) > 0) {
					$accredited = true;
				}
			}

			// Display vote button if voter is accredited for this election
			if ($accredited) {
				echo "<form method='post' action='submit_vote.php'>";
				echo "<input type='hidden' name='election_id' value='" . $row["election_id"] . "'>";
				// echo "<label>Select candidate:</label>";
				// echo "<select name='candidate_id'>";
				// $sql3 = "SELECT * FROM candidate WHERE election_id = " . $row["election_id"];
				// $result3 = mysqli_query($conn, $sql3);
                // $row3 = mysqli_fetch_assoc($result3);
				// while ($row3 = mysqli_fetch_assoc($result3)) {
					// echo "<option value='" . $row3["candidate_id"] . "'>" . $row3["name"] . "</option>";
				// }
				// echo "</select>";
				echo "<br>";
                echo "<a class='btn' href='vote.php?eid=".$row['election_id']."'>Go to Vote Page</a>";
				// echo "<input type='submit' value='Vote'>";
				echo "</form>";
			}
			else {
				echo "<p class='error'>You are not accredited to vote in this election.</p>";
				echo "<p>Click <a href='voter_accreditation.php'>here</a> to get accredited</p>";
			}
			echo "</section>";
			echo "</center>";
		}
	}
	else {
		echo "<p class='error'>No election is currently available.</p>";
	}

	// Close database connection
	mysqli_close($conn);
?>
<div class="divider"></div>
<?php 
    require_once "assets/footer.php";
?>