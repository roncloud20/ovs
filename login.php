<?php
    //Adding the header file
    $title = "User Login";
    require_once 'assets/header.php'; 
?>
<?php
    // Start the session and check if the user is already logged in
    // session_start();
    if (isset($_SESSION['voter_id'])) {
    header('Location: index.php');
    exit;
    }

       // Connect to MySQL database
       require_once 'assets/db_connect.php';

    // Check if the login form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email and password are valid
    $query = "SELECT * FROM voter WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $voter = mysqli_fetch_assoc($result);
        if (password_verify($password, $voter['password'])) {
        // Login successful, save the user ID in the session
        $_SESSION['voter_id'] = $voter['voter_id'];
        $_SESSION['login_type'] = $voter['login_type'];
        header('Location: index.php');
        exit;
        }
    }

    // Login failed, show an error message
    $error = 'Invalid email or password.';
    }

    // Close the database connection
    mysqli_close($conn);
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
        <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>
            <br>
            <label>Password:</label>
            <input type="password" name="password" required>
            <br>
            <input type="submit" value="Log in"/>
        </form>
    </section>
</center>

<?php 
    require_once "assets/footer.php";
?>