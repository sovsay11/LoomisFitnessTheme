<?php /* Template Name: Edit Client*/

// connect to the DB
include("databaseConnection.php");

// check the post from the previous page
if ( ! empty( $_POST ) ) {
    // checks which client is selected
    /*
    foreach($_POST as $key=>$post_data){
        echo "You posted:" . $key . " = " . $post_data . "<br>";
    }
    */

    // show all the POST info, useful for other requests
    // print_r($_POST);

    // sets the client id
    $clientID = $_POST['client'];

    // check if the submit button is hit, then save the data
    if(array_key_exists('clientConfirm',$_POST)){
        saveClientChanges();
     }
}

//clientQuery();
//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
//printf ("%s (%s)\n",$row["userID"],$row["firstName"]);
//echo($row['firstName'].$row['lastName']);

get_header();
?>

<form method="post">
    <fieldset>
		<legend>Client Info</legend>
		<label for="client">Select Client</label>

		<select name="client">
		<?php
        clientQuery("specific", $clientID);
        
        $mainArray = array();

        // grab the data from the 
        while ($testArray=mysqli_fetch_array($result))
        {
            $mainArray[] = $testArray;
            // select option, will remove later
            echo "<option value='".$testArray['userID']."'>".$testArray['firstName'].' '.$testArray['lastName']."</option>";
            // this sets the user id value to the html side
            if ($testArray['userID'] == $clientID) {
                $test = $testArray['firstName'].' '.$testArray['lastName'];
            }
        }

        // might want to create a function for this
        // this sets the values
        $name = $mainArray[0]['firstName'].' '.$mainArray[0]['lastName'];
        $email = $mainArray[0]['Email'];
        $phone = $mainArray[0]['phoneNumber'];
        $hFeet = $mainArray[0]['heightFeet'];
        $hInches = $mainArray[0]['heightInches'];
        $weight = $mainArray[0]['uWeight'];
        $bodyFat = $mainArray[0]['bodyFat'];
		?>
		</select>

        <br>
        <label for="clientName">Name:</label>
        <input type="text" name="clientName" id="clientName" value="<?=$name?>">
        <br>

        <label for="clientEmail">Email:</label>
        <input type="email" name="clientEmail" id="clientEmail" value="<?=$email?>">
        <br>
        
        <label for="clientPhone">Phone:</label>
        <input type="text" name="clientPhone" id="clientPhone" value="<?=$phone?>">
        <br>

        <label for="heightFeet">Height (feet):</label>
        <input type="number" name="heightFeet" id="heightFeet" value="<?=$hFeet?>">
        <br>

        <label for="heightInches">Height (inches):</label>
        <input type="number" name="heightInches" id="heightInches" value="<?=$hInches?>">
        <br>

        <label for="weight">Weight:</label>
        <input type="number" name="weight" id="weight" value="<?=$weight?>">
        <br>

        <label for="bodyFat">Body fat:</label>
        <input type="number" name="bodyFat" id="bodyFat" value="<?=$bodyFat?>">
        <br>

        <label for="clientName">Client Name:</label>
        <button type="submit" name="clientConfirm" value="clientConfirm">Confirm Changes</button>
        <br>

    </fieldset>
</form>

<?php get_footer(); ?>