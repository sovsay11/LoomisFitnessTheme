<?php /* Template Name: Add Exercise*/

// include some vital functions
include("loomFunctions.php");

// header baby
get_header();

// check if the save button was pressed
if(array_key_exists('saveExerciseName',$_POST)){
	// function that saves the exercise info
	addExerciseName($_POST['exerciseName']);
}

?>
<!-- Add new exercise name into excercise table-->
<form method="post">
	<label for="exerciseName">Exercise Name:</label>
	<input type="text" name="exerciseName" id="exerciseNameID"/>
	<br>
	<br>
	<button type="submit" value="saveExerciseName" name="saveExerciseName">Submit Exercise Name</button>
</form>


<?php get_footer(); ?>
