<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
if(!$is_logged){
    header('Location: index.php');
}
elseif($_SESSION['perm'] < 2){
    header('Location: admin_main.php');
}

$contact = null;
if(isset($_GET['id']) && is_numeric($_GET['id'])){

	if(!empty($_POST)) {
		if(isset($_POST['delete'])){
			$delete = $bdd->prepare('DELETE FROM contact WHERE id = :idContact');

			$delete->bindValue(':idContact', $_GET['id'], PDO::PARAM_INT);

			if($delete->execute()) {
				header('Location: message.php');
				die;
			}
		}
	}

	$select = $bdd->prepare('SELECT * FROM contact WHERE id = :idContact');
	$select->bindValue(':idContact', $_GET['id'], PDO::PARAM_INT);
	if($select->execute()) {
		$contact = $select->fetch(PDO::FETCH_ASSOC);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
	<title>Supprimer un message</title>
</head>
<body>
	<?php include_once 'inc/navbar.php' ?>
	<main class="container">
	<h1>Supprimer le message</h1>
	
	<hr>

	<?php if(empty($contact)): ?>
		<div class="alert alert-danger">
			Message inconnu !
		</div>
	<?php else: ?>
		<p>Voulez-vous vraiment supprimer le message de &laquo; <?=$contact['firstname'];?> &raquo; ?</p>

		<form method="POST">
			<!-- Annuler -->
			<input type="button" onclick="history.back();" value="Annuler" class="btn btn-default">
			<!-- Valider -->
			<input type="submit" name="delete" value="Oui, je veux supprimer ce message" class="btn btn-danger">
		</form>
	<?php endif;?>
	</main>
</body>
</html>
