<?php /* Template Name: Workout Summary*/

// essential functions
include("loomFunctions.php");

get_header();

// check post value
//print_r($_POST);

// should show the most recent session stuff
$clientID = $_POST['client'];
$sessionQuery = getRecentSession($clientID);
$sessionArray = (mysqli_fetch_array($sessionQuery));
$sessionID = $sessionArray['newSessionID'];

//echo ($sessionID);

//select by client id
$sql = "SELECT * FROM workout WHERE userID = $clientID";

// select by session
//$sql = "SELECT * FROM workout WHERE sessionID = $sessionID";
$GLOBALS['result'] = dbConnect()->query($sql);
//$recentWorkout=mysqli_fetch_array($result);
//print_r($recentWorkout);

// what do i want to display? keep it simple, just the most recent workout then
?>
    <table style="width:100%">
  <tr>
    <th>ID</th>
    <th>Miles</th>
    <th>Reps</th>
    <th>Weight</th>
    <th>Sets</th>
    <th>Date</th>
  </tr>
  <?php while($recentWorkout=mysqli_fetch_array($result)):?>
  <tr>
    <td><?=$recentWorkout[11]?></td>
    <td><?=$recentWorkout[1]?></td>
    <td><?=$recentWorkout[5]?></td>
    <td><?=$recentWorkout[6]?></td>
    <td><?=$recentWorkout[7]?></td>
    <td><?=$recentWorkout[10]?></td>
  </tr>
  <?php endwhile?>
</table>

<?php get_footer(); ?>