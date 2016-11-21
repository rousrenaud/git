<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';

$searchSQL = '';
$get = [];

if(!empty($_GET)) {
	$get = array_map('trim', array_map('strip_tags', $_GET));

	if(isset($get['search']) && !empty($get['search'])) {
		$searchSQL = ' WHERE recipe_title LIKE :search';
	}
}

$query = $bdd->prepare('SELECT * FROM recipes'.$searchSQL);
if(isset($get['search']) && !empty($get['search'])){
	$query->bindValue(':search', '%'.$get['search'].'%');
}

$select = $bdd->prepare('SELECT * FROM recipes');
if($select->execute()){
	$recipes = $select->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste des recettes</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <?php include_once 'inc/navbar.php' ?>
    <h1>Liste des Recettes</h1>
	<h3><a href="add_recipe.php">Ajouter une recette</a></h3> <!-- A décaler à droite, face au <h1> -->
	<hr>

	<div>
		<form method="GET">
			<input type="text" id="search" name="search" placeholder="Chercher une recette..." value="<?=(isset($get['search']) && !empty($get['search'])) ? $get['search'] : ''; ?>">
			<button type="submit">Rechercher !</button>
		</form>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Qui a publié?</th>
				<th>Titre</th>
				<th>Contenu</th>
				<th>Photo</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($recipes as $recipe): ?>
				<tr>
				    
					<th scope="row"><!-- Trouver un moyen d'afficher le nom ou l'ID de la personne ayant publié la recette -->
						<?=$recipe['id']?>
					</td>
					<td>
						<?=$recipe['recipe_title']?>
					</td>
					<td>
						<?=$recipe['preparation']?>
					</td>
					<td>
						<?=$recipe['photo']?>
					</td>
					<td>
						<a href="view_recipe.php?id=<?=$recipe['id'];?>" title="Voir la recette">Voir la recette</a>
						<a href="edit_recipe.php?id=<?=$recipe['id'];?>" title="Voir la recette">Editer la recette</a>
						<a href="delete_recipe.php?id=<?=$recipe['id'];?>" title="Voir la recette">Supprimer la recette</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

</body>
</html>