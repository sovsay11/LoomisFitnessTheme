<?php /* Template Name: Add Workout Copy*/

function connect(){
	$connection = new MySQLi('localhost', 'root', '', 'loomisfitness');

	$sql = "SELECT * FROM wp_workout_names";
	
	$GLOBALS['result'] = $connection->query($sql);
}

get_header();
?>

<form>
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
		connect();
        while ($testArray=mysqli_fetch_array($result))
        {
            echo "<option value='".$testArray['workout_name_ID']."'>".$testArray['workout_name']."</option>";
            // $select.='<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
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

	</fieldset>
	<br>
	<br>
	<!--WORKOUT 2-->
	<fieldset>
		<legend>Workout 2:</legend>
		<input type="checkbox" name="workout_complete" id="workout_complete">
		<!--This workout complete checkbox is not important for the backend 
			and I don't think it will need to be saved. It is just so the Trainer can keep track of the workouts while they are in session.-->

		<label for="workout2">Workout 2:</label>

		<select name="workout2">
			<?php
			connect();
			while ($testArray=mysqli_fetch_array($result))
			{
				echo "<option value='".$testArray['workout_name_ID']."'>".$testArray['workout_name']."</option>";
				// $select.='<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
			}
			// use as template
			// echo "<option value='something'>working!</option>";
			?>
		</select>
		<br>
		<br>
		<label for="workout2_weight">Workout 2 Weight:</label>
		<input type="number" name="workout2_weight" id="workout2_weight">
		<!--Increase weight next session?-->
		<input type="checkbox" name="increase_weight" id="increase_weight">
		<label for="increase_weight">Increase weight next workout session</label>
		<br>
		<br>
		<label for="workout2_reps">Workout 2 Reps:</label>
		<input type="number" name="workout2_reps" id="workout2_reps">
		<!--Increase reps next session?-->
		<input type="checkbox" name="increase_reps" id="increase_reps">
		<label for="increase_reps">Increase reps next workout session</label>
	</fieldset>
	<br>
	<br>
	<!--WORKOUT 3-->
	<fieldset>
		<legend>Workout 3:</legend>
		<input type="checkbox" name="workout_complete" id="workout_complete">
		<!--This workout complete checkbox is not important for the backend 
			and I don't think it will need to be saved. It is just so the Trainer can keep track of the workouts while they are in session.-->

		<label for="workout3">Workout 3:</label>

		<select name="workout3">
			<?php
			connect();
			while ($testArray=mysqli_fetch_array($result))
			{
				echo "<option value='".$testArray['workout_name_ID']."'>".$testArray['workout_name']."</option>";
				// $select.='<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
			}
			// use as template
			// echo "<option value='something'>working!</option>";
			?>
		</select>
		<br>
		<br>
		<label for="workout3_weight">Workout 3 Weight:</label>
		<input type="number" name="workout3_weight" id="workout3_weight">
		<!--Increase weight next session?-->
		<input type="checkbox" name="increase_weight" id="increase_weight">
		<label for="increase_weight">Increase weight next workout session</label>
		<br>
		<br>
		<label for="workout3_reps">Workout 3 Reps:</label>
		<input type="number" name="workout3_reps" id="workout3_reps">
		<!--Increase reps next session?-->
		<input type="checkbox" name="increase_reps" id="increase_reps">
		<label for="increase_reps">Increase reps next workout session</label>
	</fieldset>
	<br>
	<br>
	<label for="final_weight">Ending Body Weight:</label>
	<input type="number" name="ending_weight" id="ending_weight">
	<br>
	<br>
	<!--Need to program the button "onclick" still-->
	<button type="button" onclick="SAVE EVERYTHING TO DATABASE">Save Workout</button>
</form>

<?php get_footer(); ?>
<!--The exercise name, weight, # of sets, # of reps should be side by side to each other.
She needs some way to mark that she is going to be increasing either the weight, reps, or both, on the next time that person does that exercise.
She then needs to mark the day that she actually increases the weight, reps, or both. 
She needs to be able to do this for any of the exercises that person is doing any given session. 
We’ll have to brainstorm this one, because I haven’t figured out a good solution for it yet.

Need a checkbox next to each exercise line so that she can mark when it has been completed during the session.-->