<?php /* Template Name: Archived Clients*/
include("loomFunctions.php");

$getArchived = "SELECT * FROM user WHERE archive = 1";
$GLOBALS['result'] = dbConnect()->query($getArchived);

if(array_key_exists('ClientUnarchive',$_POST)){
    $values = $_POST;
    setArchive($values, "unarchive");
    print_r($values);
}

get_header();

// $mydb = new wpdb('root', 'password', 'loomisfitness', 'localhost');
// $clients = $mydb->get_results("SELECT * FROM user WHERE archive = 0");
// print_r($clients);

/*
<?php foreach ($archivedClients as $client): ?>
<tr>
<td width="400"><?=$client[1]?></td>
<td width="400"><?=$client[2]?></td>
<td width="400"><?=$client[3]?></td>
<td><a href="../lookup-client.php">Unarchive</a></td>
</tr>
<?php endforeach; ?>
*/

?>

<div class="wrap">
<div id="primary" class="content-area">
<main id="main" class="site--main" role="main">
<h1>All Archived Clients</h1>
<form method="post">
<table style="border:solid 1px black;">
<tr>
<td>First Name</td>
<td>Last Name</td>
<td>Email</td>
<td>Phone Number</td>
<td>Unarchive</td>
</tr>

<?php while ($archivedClients=mysqli_fetch_array($result)):?>
<tr>
<td width="250"><?=$archivedClients[1]?></td>
<td width="250"><?=$archivedClients[2]?></td>
<td width="250"><?=$archivedClients[3]?></td>
<td width="250"><?=$archivedClients[4]?></td>
<td width="250"><button type="submit" value="<?=$archivedClients[0]?>" name="ClientUnarchive">Unarchive</button></td>
</tr>
<?php endwhile?>

</table>
</form>

<?php get_footer(); ?>