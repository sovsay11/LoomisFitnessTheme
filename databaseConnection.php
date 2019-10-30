<?php
// this will connect to the db
function dbConnect(){
    $connection = new MySQLi('localhost', 'root', '', 'loomisfitness');
    return $connection;
}

// connect to the DB
function workoutQuery(){
	$sql = "SELECT * FROM exercises";

	$GLOBALS['result'] = dbConnect()->query($sql);
}

function saveWorkout($miles){
    echo($miles);
    echo(" Workout saved! (Not really)");
    // update statement goes here
}

function saveClientChanges(){
    echo("Changes saved! (Not really)");
    // update statement goes here
}

function clientQuery($command, $constraint){
    if ($command == "all") {
        $sql = "SELECT * FROM user";    
    }
    elseif ($command == "specific") {
        $sql = "SELECT * FROM user WHERE userID = $constraint";
    }

    $GLOBALS['result'] = dbConnect()->query($sql);
}
?>