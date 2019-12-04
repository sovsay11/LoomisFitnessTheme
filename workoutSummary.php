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
$sql = "SELECT * FROM workout JOIN exercises ON workout.exerciseID = exercises.exerciseID WHERE userID = $clientID;";
$sqlName = "SELECT firstName FROM workout JOIN user ON workout.userID = user.userID WHERE user.userID = $clientID;";

// select by session
//$sql = "SELECT * FROM workout WHERE sessionID = $sessionID";
$GLOBALS['result'] = dbConnect()->query($sql);
$GLOBALS['nameResult'] = dbConnect()->query($sqlName);
$name=mysqli_fetch_array($nameResult);
//print_r($name);

// what do i want to display? keep it simple, just the most recent workout then
?>
<form>
<button type="submit" name="back" value="back" formaction=<?=site_url("lookup-client")?>>Back to Lookup</button>
</form>
<br>
<h1><?=$name[0]?>'s Report</h1>
    <table style="width:100%">
  <tr>
    <th>ID</th>    
	<th>Workout</th>
	<th>Miles</th>
    <th>Reps</th>
    <th>Weight</th>
    <th>Sets</th>
    <th>Date</th>
  </tr>
  <?php while($recentWorkout=mysqli_fetch_array($result)):?>
  <tr>
    <td><?=$recentWorkout[11]?></td>
	<td><?=$recentWorkout[14]?></td>
    <td><?=$recentWorkout[1]?></td>
    <td><?=$recentWorkout[5]?></td>
    <td><?=$recentWorkout[6]?></td>
    <td><?=$recentWorkout[7]?></td>
    <td><?=$recentWorkout[10]?></td>
  </tr>
  <?php endwhile?>
</table>

<?php get_footer(); ?>