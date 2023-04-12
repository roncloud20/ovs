<?php
    // Including the All Pages Header
    $title = "Display Election";
    require_once("assets/header.php");

    // including the database connect file
    require_once("assets/db_connect.php");
?>
<h1>Election Display Page</h1>

<?php
	// Get election information
	$sql = "SELECT * FROM Election WHERE end_date > NOW()";
	$result = mysqli_query($conn, $sql);

	// Check if any election is available
	if (mysqli_num_rows($result) > 0) {
		// Output available elections
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<h2>" . $row["name"] . "</h2>";
			echo "<p>Description: " . $row["description"] . "</p>";
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
                echo "<a href='vote.php?eid=".$row['election_id']."'>Go to Vote Page</a>";
				// echo "<input type='submit' value='Vote'>";
				echo "</form>";
			}
			else {
				echo "<p>You are not accredited to vote in this election.</p>";
			}
		}
	}
	else {
		echo "<p>No election is currently available.</p>";
	}

	// Close database connection
	mysqli_close($conn);
	?>

<?php 
    require_once "assets/footer.php";
?>