    <style>
        footer {
            position: fixed;
            /* width:100%; */
            bottom:0px;
            right: 0px;
            left: 0px;
            padding: 20px;
            background-color: #004400BA;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color:white;
        }
        footer > nav > ul {
            display: flex;
            gap: 20px
        }

        footer > nav > ul > li {
            list-style: none; 
        }

        footer > nav > ul > li > a {
            text-decoration: none;
            color: #fff;
        }
    </style>
    
    <footer>
        <p> &copy; Independent National Electoral Commission 2023</p>
        <!-- <p>Developed By Matthew Onilude</p>  -->
        <nav>
            <ul>
                <!-- <li><a href="index.php">Home</a></li> -->
                <li><a href="faq.php">FAQs</a></li>
                <!-- <li><a href="result.php">Election Result</a></li> -->
                <?php if(isset($_SESSION["login_type"]) && $_SESSION["login_type"] == "voter") { ?>
                    <!-- <li><a href="vote.php">Voting</a></li> -->
                    <!-- <li><a href="logout.php">Logout</a></li> -->
                <?php } else if(isset($_SESSION["login_type"]) && $_SESSION["login_type"] == "admin") { ?>
                    <!-- <li><a href="candidate_registration.php">Register Candidate</a></li> -->
                    <!-- <li><a href="create_election.php">Create Election</a></li> -->
                    <!-- <li><a href="logout.php">Logout</a></li> -->
                <?php } else if(!isset($_SESSION["login_type"])) { ?>
                    <li><a href="voter_registration.php">Sign In/Up</a></li>
                <?php } ?>
            </ul>
        </nav>
        <p>Developed By Matthew Onilude</p> 
    </footer>
    </body>
</html>
