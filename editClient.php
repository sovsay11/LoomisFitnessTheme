<?php /* Template Name: Edit Client*/

// some essential functions
include("loomFunctions.php");

// check the post from the previous page (lookup client)
if ( ! empty( $_POST ) ) {

    // sets the client id from the lookup client page
    $clientID = $_POST['client'];

    // check if the submit button is hit, then save the data
    if(array_key_exists('clientConfirm',$_POST)){
        $values = $_POST;
        saveClientChanges($values);
    }
}

get_header();
?>
<form method="post">
    <fieldset>
        <br>
        <button type="submit" name="back" value="back" formaction=<?=site_url("lookup-client")?>>Back to Lookup</button>
		<legend>Client Info</legend>

		<?php
        showAll("specific", $clientID);
        
        $mainArray = array();

        // grab the data from the 
        while ($testArray=mysqli_fetch_array($result))
        {
            $mainArray[] = $testArray;
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
        <input type="number" step=".01" name="bodyFat" id="bodyFat" value="<?=$bodyFat?>">
        <br>
        <br>

        <button type="submit" name="clientConfirm" value="clientConfirm">Confirm Changes</button>
        <br>

        <input id="client" name="client" type="hidden" value=<?=$clientID?>>

    </fieldset>
</form>

<?php get_footer(); ?>