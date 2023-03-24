<style>
    .voting-card {
        background-color: #f5f5f5;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        height: 300px;
        justify-content: center;
        padding: 20px;
        text-align: center;
        width: 200px;
    }

    .voting-card h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .voting-card p {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .voting-card input[type=submit] {
        background-color: #45a049;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        padding: 10px 20px;
    }

    .voting-card input[type=submit]:hover {
        background-color: #006d8f;
    }

    section {
        padding: 20px;
        gap:20px;
        display: flex;
        justify-content: space-between;
    }
</style>
<?php
    //Adding the header file
    $title = "Voter";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';

    // Check if the voter is eligible to vote
    $eligible_to_vote = true;

    $voter_id = $_SESSION['voter_id'];

    // Assuming that the voter ID is passed as a GET parameter
    if (isset($_SESSION['voter_id'])) {
        $sql = "SELECT date_of_birth FROM voter WHERE voter_id = $voter_id";
        $result = $conn->query($sql);

        // Check if email already exists
        $sql = "SELECT * FROM vote WHERE voter_id='$voter_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "Error: You have already voted";
            exit();
        }
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $date_of_birth = $row['date_of_birth'];
            $today = date("Y-m-d");
            $diff = date_diff(date_create($date_of_birth), date_create($today));
            $age = $diff->format('%y');
            
            if ($age < 18) {
                $eligible_to_vote = false;
            }
        }
    }

    // Display the available candidates
    if ($eligible_to_vote) {
        $sql = "SELECT * FROM Candidate";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<section>";
            while ($row = $result->fetch_assoc()) {
                $candidate_id = $row['candidate_id'];
                $name = $row['name'];
                $party = $row['party'];
                $position = $row['position'];
                
                echo "<div class='voting-card'>";
                echo "<h2>$name</h2>";
                echo "<p>$party</p>";
                echo "<p>$position</p>";
                echo "<form action='submit_vote.php' method='post'>";
                echo "<input type='hidden' name='voter_id' value='$voter_id'>";
                echo "<input type='hidden' name='candidate_id' value='$candidate_id'>";
                echo "<input type='submit' value='Vote'>";
                echo "</form>";
                echo "</div>";
            }
            echo "</section>";
        } else {
            echo "No candidates found";
        }
    } else {
        echo "Sorry, you are not eligible to vote yet";
    }

    $conn->close();
?>
