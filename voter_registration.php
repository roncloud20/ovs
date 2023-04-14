<?php
    // Including the All Pages Header
    $title = "Register to become a voter";
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
    // Checking if the form has been submitted
    if (isset($_POST['submit'])) {
        // Sanitizing and validating input data
        $name = mysqli_real_escape_string($conn, $_POST['firstname'] . " " . $_POST['surname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);

        // Validate form data
        // Checking the password
        if ($password != $confirm_password) {
            echo "<h1 class='error'>Error: Passwords do not match</h1>";
            exit();
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        }

        // Check if email already exists
        $sql = "SELECT * FROM voter WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<h1 class='error'>Error: Email address is already registered</h1>";
            exit();
        }

        // Inserting the user data into the database
        $query = "INSERT INTO voter (name, email, password, date_of_birth, login_type, is_verified) VALUES ('$name', '$email', '$hashed_password', '$dob', 'voter', true)";

        // check if the query was successful
        if (mysqli_query($conn, $query)) {
            echo "<h1 class='success'>Registration successful</h1>";
            echo "<p align='center'>click <a href='login.php'>here</a> to login</p>";
        } else {
            echo "<h1 class='error'>Error: </h1>" . mysqli_error($conn);
        }
    }
?>
<!-- HTML form for user registration -->
<center>
    <section align="center">
        <h1><?php echo $title; ?></h1>
        <form method="POST">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="surname" placeholder="Surname" required><br><br>

            <input type="email" name="email" placeholder="E-Mail Address" required><br><br>

            <input type="password" name="password" placeholder="Password" required><br><br>

            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br><br>
            <label for="dob">
            <input type="date" name="dob" required><br><br>

            <input type="submit" name="submit" value="Register">
        <p>Already have an account? click <a href="login.php">here</a> to login</p>
        </form>
    </section>
    <div class="divider"></div>
</center>
<!-- 
if (mysqli_query($conn, $query)) {
    // send verification email
    $to = $email;
    $subject = 'Verify your email';
    $message = 'Please click the following link to verify your email address: https://onlinevotingsystem.com/verify.php?email=' . urlencode($email);
    $headers = 'From: verification@onlinevotingsystem.com' . "\r\n" .
                'Reply-To: verification@onlinevotingsystem.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    $sent = mail($to, $subject, $message, $headers);

    // display success message
    if ($sent) {
        echo "<p>Registration successful! A verification email has been sent to your email address.</p>";
    } else {
        echo "<p>Error sending verification email.</p>";
    }
    } else {
    echo "<p>Error: " . $db->error . "</p>";
    } -->

<?php 
    require_once "assets/footer.php";
?>