<?php /* Template Name: Add Workout*/

// some essential functions
include("loomFunctions.php");

// set the clientID (so we know who we're adding the workout to), this is also the only post value passed
$clientID = $_POST['client'];

// set values, can't alter post for some reason
$values = $_POST;

// check if the save button is hit, then save the workout
if(array_key_exists('saveWorkout',$_POST)){
	//saveWorkout($values);
	print_r($values);
}
elseif(array_key_exists('setWorkoutAmount',$_POST)){
	print_r($values);
	//print($values['workoutAmount']);
}

// get the highest sessionID value
$sessionQuery = getHighestSession($clientID);
$sessionArray = (mysqli_fetch_array($sessionQuery));
$sessionID = $sessionArray['newSessionID'];

// url setter
get_header();

?>
<form method="post">
	<button type="submit" name="back" value="back" formaction=<?=site_url("lookup-client")?>>Back to Lookup</button>
	<br>
	<br>

	<button type="submit" name="setWorkoutAmount" onclick="show()">Set workout amount</button>
	<select name="workoutAmount">
		<?php for ($i=1; $i < 11; $i++)
		{
			echo "<option value='".$i."'>".$i."</option>";
		}
		?>
	</select>
	<br>
	<br>

	<label for="session_num" display="none">Session Number:</label>
	<input type=int name="session" id="session_num" value="<?=$sessionID?>">
	<!--Need to code in the dauto incrementing session number to be automatically filled out-->
	<br>
	<br>
	<label for="miles">Aerobic Miles:</label>
	<input type="number" name="miles" id="miles">

	<label for="aerobic_type">Aerobic Type:
		<input type="radio" name="aerobic_type" value="0" id="running">
		<label for="running">Running</label>
		<input type="radio" name="aerobic_type" value="1" id="biking">
		<label for="biking">Biking</label>
	</label>
	<br>
	<br>

	<!--where i cut it out-->

	<?php for ($i=0; $i < $values['workoutAmount']; $i++): $curNum = $i+1?>
	<fieldset>
		<legend>Workout <?=$curNum?>:</legend>

		<label for="workout1">Workout <?=$curNum?>:</label>

		<select name="Workout<?=$curNum?>">
			<?php
		workoutQuery();
        while ($testArray=mysqli_fetch_array($result))
        {
            echo "<option value='".$testArray['exerciseID']."'>".$testArray['exerciseName']."</option>";
        }
        // use as template
        // echo "<option value='something'>working!</option>";
		?>
		</select>

		<br>
		<br>
		<label for="workout_weight">Workout <?=$curNum?> Weight:</label>
		<input type="number" name="workout_weight<?=$curNum?>" id="workout_weight">
		<!--Increase weight next session?-->
		<input type="checkbox" name="increase_weight<?=$curNum?>" id="increase_weight" value="1">
		<label for="increase_weight">Increase weight next workout session</label>
		<br>
		<br>
		<label for="workout1_reps">Workout <?=$curNum?> Reps:</label>
		<input type="number" name="workout1_reps<?=$curNum?>" id="workout1_reps">
		<!--Increase reps next session?-->
		<input type="checkbox" name="increase_reps<?=$curNum?>" id="increase_reps" value="1">
		<label for="increase_reps">Increase reps next workout session</label>
		<br>
		<br>
		<label for="workout1_sets">Workout <?=$curNum?> Sets:</label>
		<input type="number" name="workout1_sets<?=$curNum?>" id="workout1_sets">
		<!--Increase reps next session?-->
		<input type="checkbox" name="increase_sets<?=$curNum?>" id="increase_sets" value="1">
		<label for="increase_sets">Increase sets next workout session</label>
	</fieldset>
	<br>
	<br>
	<?php endfor?>

	<!--client id save and workout save-->
	<input id="client" name="client" type="hidden" value=<?=$clientID?>>
	<button type="submit" value="saveWorkout" name="saveWorkout">Save Workout</button>

</form>
<?php get_footer();

/*
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
            echo "<option value='".$testArray['exerciseID']."'>".$testArray['exerciseName']."</option>";
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
		<input type="checkbox" name="increase_weight" id="increase_weight" value="1">
		<label for="increase_weight">Increase weight next workout session</label>
		<br>
		<br>
		<label for="workout1_reps">Workout 1 Reps:</label>
		<input type="number" name="workout1_reps" id="workout1_reps">
		<!--Increase reps next session?-->
		<input type="checkbox" name="increase_reps" id="increase_reps" value="1">
		<label for="increase_reps">Increase reps next workout session</label>
		<br>
		<br>
		<label for="workout1_sets">Workout 1 Sets:</label>
		<input type="number" name="workout1_sets" id="workout1_sets">
		<!--Increase reps next session?-->
		<input type="checkbox" name="increase_sets" id="increase_sets" value="1">
		<label for="increase_sets">Increase sets next workout session</label>

	</fieldset>
	<br>
	<br>
<!--WORKOUT 2-->
	<fieldset>
		<legend>Workout 2:</legend>
		<input type="checkbox" name="workout_complete" id="workout_complete">

		<label for="workout2">Workout 2:</label>

		<select name="workout2">
			<?php
			workoutQuery();
			while ($testArray=mysqli_fetch_array($result))
			{
				echo "<option value='".$testArray['exerciseName']."'>".$testArray['exerciseName']."</option>";
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

<br>
<br>
<label for="workout2_sets">Workout 2 Sets:</label>
<input type="number" name="workout2_sets" id="workout2_sets">
<!--Increase reps next session?-->
<input type="checkbox" name="increase_sets" id="increase_sets">
<label for="increase_sets">Increase sets next workout session</label>
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
			workoutQuery();
			while ($testArray=mysqli_fetch_array($result))
			{
				echo "<option value='".$testArray['exerciseName']."'>".$testArray['exerciseName']."</option>";
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

	<br>
	<br>
	<label for="workout3_sets">Workout 3 Sets:</label>
	<input type="number" name="workout3_sets" id="workout3_sets">
	<!--Increase reps next session?-->
	<input type="checkbox" name="increase_sets" id="increase_sets">
	<label for="increase_sets">Increase sets next workout session</label>
</fieldset>
<br>
<br>
<label for="final_weight">Ending Body Weight:</label>
<input type="number" name="ending_weight" id="ending_weight">
<br>
<br>

<!--client id save-->
<input id="client" name="client" type="hidden" value=<?=$clientID?>>


<button type="submit" value="saveWorkout" name="saveWorkout">Save Workout</button>
*/
?>
<!--MAJOR ISSUE: JAVASCRIPT WILL BE NEEDED TO DYNAMICALLY ADD WORKOUTS TO THE SESSION. UNTIL THEN
THE DATABASE QUERIES FOR THE WORKOUTS MUST BE KEPT TO A MINIMUM-->