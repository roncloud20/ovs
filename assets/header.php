<?php
    // // Start session
    session_start();
    // if (!isset($_SESSION['voter_id'])) {
    //   header('Location: login.php');
    //   exit;
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
</head>
<body>
    <style>
        html, body {
            padding: 0;
            margin: 0;
        }
        header {
            padding: 20px;
            background-color: #004400BA;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header > nav > ul {
            display: flex;
            gap: 20px
        }

        header > nav > ul > li {
            list-style: none; 
        }

        header > nav > ul > li > a {
            text-decoration: none;
            color: #fff;
        }
    </style>
    
    <header>
        <img src="assets/inec.png" alt="Inec Logo" height="50"/>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="result.php">Election Result</a></li>
                <?php if(isset($_SESSION["login_type"]) && $_SESSION["login_type"] == "voter") { ?>
                    <li><a href="vote.php">Voting</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else if(isset($_SESSION["login_type"]) && $_SESSION["login_type"] == "admin") { ?>
                    <li><a href="candidate_registration.php">Register Candidate</a></li>
                    <li><a href="create_election.php">Create Election</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else if(!isset($_SESSION["login_type"])) { ?>
                    <li><a href="voter_registration.php">Sign In/Up</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>