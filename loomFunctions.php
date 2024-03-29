<?php
/*
This page contains all of the functions that help make this entire website work!
*/

// CONNECT TO THE DB
function dbConnect() {
	$connection=new MySQLi('localhost', 'root', '', 'loomisfitness');
	return $connection;
}

//Get muscle group to fill dropdown
function musclegroupQuery() {
	$sql="SELECT * FROM musclegroup";
	//$sql2 = "SELECT mgID FROM musclegroup";

	$GLOBALS['mgresult']=dbConnect()->query($sql);
	//$GLOBALS['mgID'] = dbConnect()->query($sql2);
}

// WILL COMBINE WITH THE MASTER QUERY FUNCTION LATER
// for now this just grabs all the data from the exercise table
function workoutQuery() {
	$sql="SELECT * FROM exercises;";

	$GLOBALS['result']=dbConnect()->query($sql);
}

function getHighestSession($userID) {
	$sql="SELECT IFNULL(MAX(sessionID) + 1, 1) as newSessionID 
FROM loomisfitness.workout WHERE userID=$userID;
	";

	$sessionID=dbConnect()->query($sql);

	return $sessionID;
}

function getRecentSession($userID) {
	$sql="SELECT IFNULL(MAX(sessionID), 0) as newSessionID 
	FROM loomisfitness.workout WHERE userID=$userID;
	";

	$sessionID=dbConnect()->query($sql);

	return $sessionID;
}

// save a workout, will have to use a WHILE or FOR loop
// to add many workouts to save typing
function saveWorkout($values) {
	// this will remain constant and only occurs once
	$sessionID=$values['session'];
	$userID=$values['client'];

	// occurs only once
	$cardioType=$values['aerobic_type'];
	$miles=$values['miles'];
	$workoutAmount = $values['workoutAmount'];

	for ($i=0; $i < $workoutAmount; $i++) {
		// this is good
		$curNum = $i+1;
		// these values will be changing... should they be in the loop? Yeah... probably
		$exerciseID=$values['Workout'.$curNum];
		$weight=$values['workout_weight'.$curNum];
		$reps=$values['workout_reps'.$curNum];
		$sets=$values['workout_sets'.$curNum];
		// increases for the exercises
		$changeReps=$values['increase_reps'.$curNum];
		$changeWeight=$values['increase_weight'.$curNum];
		$changeSets=$values['increase_weight'.$curNum];

		// insert into the workouts table
		$sql="INSERT INTO `loomisfitness`.`workout`
		(`miles`,
		`cardioType`,
		`exerciseID`,
		`userID`,
		`reps`,
		`weight`,
		`sets`,
		`changeRepsNext`,
		`changeWeightNext`,
		`date`,
		`sessionID`)
		VALUES
		('$miles' ,
		'$cardioType',
		'$exerciseID',
		'$userID' ,
		'$reps' ,
		'$weight',
		'$sets' ,
		'$changeReps',
		'$changeWeight',
		current_timestamp(),
		'$sessionID');
		";

		dbConnect()->query($sql);
	}

	// these values will be changing... should they be in the loop? Yeah... probably
	// $exerciseID=$values['Workout_1'];
	// $weight=$values['workout1_weight'];
	// $reps=$values['workout1_reps'];
	// $sets=$values['workout1_sets'];
	// // increases for the exercises
	// $changeReps=$values['increase_reps'];
	// $changeWeight=$values['increase_weight'];
	// $changeSets=$values['increase_weight'];

	// I will have to put this in a while or for loop to repeat itself
	$sql="INSERT INTO `loomisfitness`.`workout`
	(`miles`,
		`cardioType`, #foreign key `exerciseID`, #foreign key `userID`, #foreign key `reps`,
		`weight`,
		`sets`,
		`changeRepsNext`,
		`changeWeightNext`,
		`sessionID` #get highest existing sessionID and +1) VALUES ('$miles', '$cardioType', '$exerciseID', '$userID', '$reps', '$weight', '$sets', '$changeRepsNext', '$changeWeightNext', '$sessionID');
	";

	// execute the query, also in the while
	//dbConnect()->query($sql);

	// may take this out
	// echo(" Workout saved!");
}

// adds an exercise (NOT a workout)
function addExerciseName($exercise, $muscleID) {

	// query prep
	$sql="INSERT INTO exercises
(exerciseName, musclegroupID) values ('$exercise', '$muscleID')";

	// send the query to the database
	dbConnect()->query($sql);

	// yay
	echo("Exercise added!");
}

// saves the client edits
function saveClientChanges($values) {
	// set the values, since I can't use arrays in mysql, boohoo
	$NameArray=explode(" ", $values['clientName']);
	$userID=$values['client'];
	$firstName=$NameArray[0];
	$lastName=$NameArray[1];
	$email=$values['clientEmail'];
	$phone=$values['clientPhone'];
	$heightFt=$values['heightFeet'];
	$heightIn=$values['heightInches'];
	$weight=$values['weight'];
	$bodyfat=$values['bodyFat'];

	// send the data to the db, really need to switch to PDO
	$sql="UPDATE user
SET firstName='$firstName',
	lastName='$lastName',
	Email='$email',
	phoneNumber=$phone,
	Trainer=0,
	heightFeet=$heightFt,
	heightInches=$heightIn,
	uWeight=$weight,
	bodyFat=$bodyfat WHERE userID=$userID";

	// execute
	dbConnect()->query($sql);

	echo("Changes saved!");
}

// this will be the master query command
function showAll($command, $constraint) {
	if ($command=="all") {
		$sql="SELECT * FROM user";
	}

	elseif ($command=="specific") {
		$sql="SELECT * FROM user WHERE userID = $constraint";
	}

	$GLOBALS['result']=dbConnect()->query($sql);
}

function setArchive($values, $status) {
	if ($status=="unarchive") {
		// update to unarchive
		$userID=$values['ClientUnarchive'];
		$sql="UPDATE user SET archive = 0 WHERE userID = $userID";
		dbConnect()->query($sql);

		// redirect
		$url=site_url("admin-main-page");
		wp_redirect($url);
		exit();
	}
	elseif ($status=="archive") {
		$userID=$values['client'];
		$sql="UPDATE user SET archive = 1 WHERE userID = $userID";
		dbConnect()->query($sql);

		// redirect
		$url=site_url("admin-main-page");
		wp_redirect($url);
		exit();
	}
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