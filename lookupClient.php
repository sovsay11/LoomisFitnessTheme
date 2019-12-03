<?php /* Template Name: Lookup Client*/

// essential functions
include("loomFunctions.php");

if(array_key_exists('ClientDelete',$_POST)){
	$values = $_POST;
    //saveWorkout($values);
    print_r($values);
}

get_header();
?>

<form method="post">
    <fieldset>
		<legend>Client Info</legend>
		<label for="client">Select Client</label>

		<select name="client">
		<?php
        // just grab the data from the users table, first and last name
		showAll("all", "none");
        while ($testArray=mysqli_fetch_array($result))
        {
            echo "<option value='".$testArray['userID']."'>".$testArray['firstName'].' '.$testArray['lastName']."</option>";
        }
		?>
        </select>

        <br>
        <br>

        <button type="submit" value="ClientEdit" formaction=<?=site_url("edit-client")?>>Edit Client</button>
        <br>
        <br>
        <button type="submit" value="ClientSummary" formaction=<?=site_url("workout-summary")?>>View Summary</button>
        <br>
        <br>
        <button type="submit" value="ClientWorkout" formaction=<?=site_url("add-workout")?>>Add Workout</button>
        <br>
        <br>
        <button type="submit" value="ClientDelete" name="ClientDelete">Delete Client</button>

    </fieldset>
</form>
<?php get_footer(); ?>