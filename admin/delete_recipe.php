<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';

$recipe = null;
if(isset($_GET['id']) && is_numeric($_GET['id'])){

	if(!empty($_POST)) {
		if(isset($_POST['delete'])){
			$delete = $bdd->prepare('DELETE FROM recipes WHERE id = :idRecipe');

			$delete->bindValue(':idRecipe', $_GET['id'], PDO::PARAM_INT);

			if($delete->execute()) {
				header('Location: list_recipe.php');
				die;
			}
		}
	}

	$select = $bdd->prepare('SELECT * FROM recipes WHERE id = :idRecipe');
	$select->bindValue(':idRecipe', $_GET['id'], PDO::PARAM_INT);
	if($select->execute()) {
		$recipe = $select->fetch(PDO::FETCH_ASSOC);
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Supprimer une recette</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<?php include_once 'inc/navbar.php' ?>

	<h1>Supprimer une recette</h1>
	
	<hr>

	<?php if(empty($recipe)): ?>
		<div class="alert alert-danger">
			Recette non trouvée !
		</div>
	
	<?php else: ?>
		<p>Voulez-vous vraiment supprimer la recette &laquo; <?=$recipe['recipe_title'];?> &raquo; ?</p>

		<form method="POST">
			<!-- Annuler -->
			<input type="button" onclick="history.back();" value="Annuler" class="btn btn-default">
			<!-- Valider -->
			<input type="submit" name="delete" value="Oui, je veux supprimer cette recette">
		</form>
	<?php endif;?>
	
</body>
</html>
