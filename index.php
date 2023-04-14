<!-- <link rel="stylesheet" href="assets/style.css">     -->
<?php 
    $title = "Online Voting System";
    require_once "assets/header.php";
?>

<h1>Hello World</h1>

<?php
// Start the session and check if the user is logged in
// session_start();
if (!isset($_SESSION['voter_id'])) {
  // header('Location: index.php');
  // exit;
  echo "<h1>Welcome!!!</h1>";
} else {

// Connect to MySQL database
require_once 'assets/db_connect.php';

// Get the user's details from the database
$voter_id = $_SESSION['voter_id'];
$query = "SELECT * FROM voter WHERE voter_id = $voter_id";
$result = mysqli_query($conn, $query);
$voter = mysqli_fetch_assoc($result);

?>

<!-- HTML landing page -->
<h1>Welcome, <?php echo $voter['name']; ?>!</h1>
<p>Your email address is: <?php echo $voter['email']; ?></p>
<p>Click <a href="voter_accreditation.php">here</a> to get accredited</p>
<?php }?>


<?php 
    require_once "assets/footer.php";
?>