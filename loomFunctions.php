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

function saveWorkout($values){
	// some way to set the sessionID?

	$miles = $values['miles'];

	$sql = "INSERT INTO workout
	(
	'miles',
	'cardioType',
	'exerciseID', 
	'userID',
	'reps',
	'weight',
	'sets',
	'changeRepsNext',
	'changeWeightNext',
	'sessionID'
	)
	VALUES
	(
	1,0,0,4,20,25,3,0,0,1)";

	print_r($values);

    echo(" Workout saved! (Not really)");
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
function saveClientChanges($values){
	// set the values, since I can't use arrays in mysql, boohoo
	$NameArray = explode(" ", $values['clientName']);
	$userID = $values['client'];
	$firstName = $NameArray[0];
	$lastName = $NameArray[1];
	$email = $values['clientEmail'];
	$phone = $values['clientPhone'];
	$heightFt = $values['heightFeet'];
	$heightIn = $values['heightInches'];
	$weight = $values['weight'];
	$bodyfat = $values['bodyFat'];

	// send the data to the db, really need to switch to PDO O.O
	$sql = "UPDATE user
	SET
	firstName = '$firstName',
	lastName = '$lastName',
	Email = '$email',
	phoneNumber = $phone,
	Trainer = 0,
	heightFeet = $heightFt,
	heightInches = $heightIn,
	uWeight = $weight,
	bodyFat = $bodyfat
	WHERE
	userID = $userID";

	dbConnect()->query($sql);

	echo("Changes saved! (Not really)");
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