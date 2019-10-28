<?php
// this will connect to the db
function dbConnect(){
    $connection = new MySQLi('localhost', 'root', '', 'loomisfitness');
    return $connection;
}

// connect to the DB
function workoutQuery(){
	$sql = "SELECT * FROM wp_workout_names";
	
	$GLOBALS['result'] = dbConnect()->query($sql);
}

function saveWorkout($miles){
    echo($miles);
    // insert statement goes here
}
?>