<?php
/*
This page contains all of the functions that help make this entire website work!
*/

// CONNECT TO THE DB
function dbConnect(){
    $connection = new MySQLi('localhost', 'root', '', 'loomisfitness');
    return $connection;
}

// WILL COMBINE WITH THE MASTER QUERY FUNCTION LATER
// for now this just grabs all the data from the exercise table
function workoutQuery(){
	$sql = "SELECT * FROM exercises";

	$GLOBALS['result'] = dbConnect()->query($sql);
}

function getHighestSession($userID){
	$sql = "SELECT IFNULL(MAX(sessionID) + 1, 1) as newSessionID 
	FROM loomisfitness.workout 
	WHERE userID = $userID;";

	$sessionID = dbConnect()->query($sql);

	return $sessionID;
}

// save a workout, will have to use a WHILE or FOR loop
// to add many workouts to save typing
function saveWorkout($values){
	$miles = $values['miles'];
	$userID = $values['client'];
	$reps = $values['workout1_reps'];
	$weight = $values['workout1_weight'];
	$sets = $values['workout1_sets'];
	$cardioType = $values['aerobic_type'];
	$changeRepsNext = $values['increase_reps'];
	$changeWeightNext = $values['increase_weight'];
	$exerciseID = $values['Workout_1'];

	// FIGURE OUT A WAY TO DO THIS LATER
	$sessionID = $values['session'];

	$sql = "INSERT INTO `loomisfitness`.`workout`
	(
	`miles`,
	`cardioType`, #foreign key
	`exerciseID`, #foreign key
	`userID`, #foreign key
	`reps`,
	`weight`,
	`sets`,
	`changeRepsNext`,
	`changeWeightNext`,
	`sessionID` #get highest existing sessionID and +1
	)
	VALUES
	(
	'$miles','$cardioType','$exerciseID','$userID','$reps','$weight','$sets','$changeRepsNext','$changeWeightNext','$sessionID');";

	// execute the query
	dbConnect()->query($sql);

    echo(" Workout saved! (Not really)");
}

// adds an exercise (NOT a workout)
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

// saves the client edits
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

	// send the data to the db, really need to switch to PDO
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

	// execute
	dbConnect()->query($sql);

	echo("Changes saved!");
}

// this will be the master query command
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