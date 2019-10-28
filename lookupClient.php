<?php /* Template Name: Lookup Client*/

include("databaseConnection.php");

// don't need this here, I think
if ( ! empty( $_POST ) ) {
    echo("Client lookup!");
    echo($_POST['client']);
}

get_header();
?>

<form method="post" action=<?=site_url("edit-client")?>>
    <fieldset>
		<legend>Client Info</legend>
		<label for="client">Select Client</label>

		<select name="client">
		<?php
		clientQuery("all", "none");
        while ($testArray=mysqli_fetch_array($result))
        {
            echo "<option value='".$testArray['userID']."'>".$testArray['firstName'].' '.$testArray['lastName']."</option>";
        }
		?>
        </select>

        <br>

        <button type="submit" value="ClientSelect">Choose Client</button>

    </fieldset>
</form>

<?php get_footer(); ?>