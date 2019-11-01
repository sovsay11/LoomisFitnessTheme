<?php
// this will connect to the db
function dbConnect(){
    $connection = new MySQLi('localhost', 'root', '', 'loomisfitness');
    return $connection;
}

// should combine this with something...
function workoutQuery(){
	$sql = "SELECT * FROM exercises";

	$GLOBALS['result'] = dbConnect()->query($sql);
}

function saveWorkout($miles){
	// ok... this will be a doozy

	$sql = "INSERT INTO workout
	(
	'miles',
	'cardioType', # foreign key
	'exerciseID', # foreign key
	'userID', # foreign key
	'reps',
	'weight',
	'sets',
	'changeRepsNext',
	'changeWeightNext',
	'sessionID' # get highest existing sessionID and +1
	)
	# replace these values with variables
	VALUES
	(
	2,0,0,4,20,25,3,0,0,1)";

    // echo(" Workout saved! (Not really)");
}

// this adds an exercise name, will rename later
function addExerciseName($exercise){

	// query prep
	$sql = "INSERT INTO exercises
	(exerciseID, exerciseName)
	values (1, '$exercise')";

	// send the query to the database
	dbConnect()->query($sql);

	// yay
	echo("Exercise added!");
}

// need to alter this
function saveClientChanges(){
	$sql = "UPDATE 'user'
	(
	'firstName',
	'lastName',
	'Email',
	'phoneNumber', #change to varchar
	'Trainer',
	'heightFeet',
	'heightInches',
	'uWeight',
	'bodyFat')
	# replace these values with variables
	VALUES
	(
	'Test',
	'User',
	'testuser@email.com',
	5555555555,
	0,
	6,
	2,
	175,
	'.09')";

	// echo("Changes saved! (Not really)");
    // update statement goes here
}

function showAll($command, $constraint){
    if ($command == "all") {
        $sql = "SELECT * FROM user";    
    }
    elseif ($command == "specific") {
        $sql = "SELECT * FROM user WHERE userID = $constraint";
    }

    $GLOBALS['result'] = dbConnect()->query($sql);
}

/**
*Add exercise name to exercise table
*/
/*
function saveExerciseName($exerciseName){
	global $connection;
	$query = 'INSERT INTO exercises(exerciseName)
	VALUES(:exerciseName)';
	$statement = $connection->prepare($query);
	$statement->bindParam(':exerciseName', $exerciseName);
	$statement->execute();
	$statement->closeCurser();

	if($statement->num_rows > 0){
		echo 'New exercise name submitted successfully!';
	}else{
		
		echo 'Error submitting new exercise name. No change saved.';
		echo ($exerciseName);
	}
}
*/


?>