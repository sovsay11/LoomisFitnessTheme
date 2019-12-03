<?php /* Template Name: Add Exercise*/

// include some vital functions
include("loomFunctions.php");

// header baby
get_header();

// check if the save button was pressed
if(array_key_exists('saveExerciseName',$_POST)){
	// function that saves the exercise info
	print_r($_POST);
	addExerciseName($_POST['exerciseName'], $_POST['musclegroup']);
}

//musclegroupQuery();
//print_r(mysqli_fetch_array($mgresult));

?>
<!-- Add new exercise name into excercise table-->
<form method="post">
	<label for="musclegroupName">Muscle Group:</label>
	<br>
	<select name="musclegroup">
		<!--just grab the names from the musclegroup table-->

		<?php
		musclegroupQuery();
        while($mgArray=mysqli_fetch_array($mgresult))
        {
			echo '<option value="'.$mgArray['mgID'].'">'.$mgArray['mgName'].'</option>';
        }
		?>
	</select>
	<br>
	<br>
	<label for="exerciseName">Exercise Name:</label>
	<input type="text" name="exerciseName" id="exerciseNameID" />
	<br>
	<br>
	<button type="submit" value="saveExerciseName" name="saveExerciseName">Submit Exercise</button>
</form>


<?php get_footer(); ?>