<?php /* Template Name: Add Workout Copy*/

include("databaseConnection.php");

if ( ! empty( $_POST ) ) {
	// definitely need to do additional data scrubbing here, will handle later
	// echo($_POST["miles"]);
	saveWorkout($_POST["miles"]);
    echo("Session saved!");
}

get_header();
?>

<form method="post">
	<label for="session_num">Session Number:</label>
	<input type="date" name="session" id="session_num">
	<!--Need to code in the date or auto incrementing session number to be automatically filled out, drop down calendar works for now.-->
	<br>
	<br>
	<label for="miles">Aerobic Miles:</label>
	<input type="number" name="miles" id="miles">

	<label for="aerobic_type">Aerobic Type:
		<input type="radio" name="aerobic_type" id="running">
		<label for="running">Running</label>
		<input type="radio" name="aerobic_type" id="biking">
		<label for="biking">Biking</label>
	</label>
	<br>
	<br>

	<!--WORKOUT 1-->
	<fieldset>
		<legend>Workout 1:</legend>

		<input type="checkbox" name="workout_complete" id="workout_complete">

		<label for="workout1">Workout 1:</label>

		<select name="Workout 1">
		<?php
		workoutQuery();
        while ($testArray=mysqli_fetch_array($result))
        {
            echo "<option value='".$testArray['workout_name_ID']."'>".$testArray['workout_name']."</option>";
        }
        // use as template
        // echo "<option value='something'>working!</option>";
		?>
		</select>

		<br>
		<br>
		<label for="workout1_weight">Workout 1 Weight:</label>
		<input type="number" name="workout1_weight" id="workout1_weight">
		<!--Increase weight next session?-->
		<input type="checkbox" name="increase_weight" id="increase_weight">
		<label for="increase_weight">Increase weight next workout session</label>
		<br>
		<br>
		<label for="workout1_reps">Workout 1 Reps:</label>
		<input type="number" name="workout1_reps" id="workout1_reps">
		<!--Increase reps next session?-->
		<input type="checkbox" name="increase_reps" id="increase_reps">
		<label for="increase_reps">Increase reps next workout session</label>
</form>

<?php get_footer(); ?>