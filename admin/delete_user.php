<?php

require_once 'inc/session.php';
require_once 'inc/connect.php';

$user = null;
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    if($_SESSION['perm'] < 2 || $_SESSION['id'] != $_GET['id']){
        header('Location: admin_main.php');
        die();
    }
    
	if(!empty($_POST)) {
		if(isset($_POST['delete'])){
			$delete = $bdd->prepare('DELETE FROM users WHERE id = :idUser');

			$delete->bindValue(':idUser', $_GET['id'], PDO::PARAM_INT);

			if($delete->execute()) {
				header('Location: list_user.php');
				die;
			}
		}
	}

	$select = $bdd->prepare('SELECT * FROM users WHERE id = :idUser');
	$select->bindValue(':idUser', $_GET['id'], PDO::PARAM_INT);
	if($select->execute()) {
		$user = $select->fetch(PDO::FETCH_ASSOC);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Supprimer un utilisateur</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
	
	<?php include_once 'inc/navbar.php' ?>
	
	<h1>Supprimer un utilisateur</h1>
	
	<hr>

	<?php if(empty($user)): ?>
		<div class="alert alert-danger">
			Utilisateur inconnu !
		</div>
	<?php else: ?>
		<p>Voulez-vous vraiment supprimer l'utilisateur &laquo; <?=$user['firstname'];?> &raquo; ?</p>

		<form method="POST">
			<!-- Annuler -->
			<input type="button" onclick="history.back();" value="Annuler" class="btn btn-default">
			<!-- Valider -->
			<input type="submit" name="delete" value="Oui, je veux supprimer cet utilisateur">
		</form>
	<?php endif;?>
	
</body>
</html>
