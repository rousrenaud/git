<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
if(!$is_logged){
    header('Location: index.php');
}

if(isset($_GET['id']) && is_numeric($_GET['id'])) {

	$select = $bdd->prepare('SELECT * FROM recipes WHERE id = :idRecipe');
	$select->bindValue(':idRecipe', $_GET['id'], PDO::PARAM_INT);
	if($select->execute()) {
		$recipes = $select->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Votre Recette</title>
</head>
<body>

	<?php include_once 'inc/navbar.php' ?>
    <main class="container">
        <?php foreach($recipes as $recipe): ?>
        <h1>Recette : <?=$recipe['recipe_title'];?></h1>
        
        <hr>
        
        <?php if(empty($recipes)): ?>
            <div class="alert alert-danger">
                Recette non trouvée !
            </div>
        <?php endif; ?>
        
        <div>
            <ul>
                    <li>Auteur : <?=$recipe['recipe_author'];?></li>
                    <li>Titre : <?=$recipe['recipe_title'];?></li>
                    <li>Temps de préparation : <?=$recipe['recipe_time']?> min</li>
                    <li>Temps de cuisson : <?=$recipe['cook_time']?> min</li>
                    <li>Pour <?=$recipe['people'];?> personne(s)</li>
                    <li>Ingrédients : <?=$recipe['ingredients'];?></li>
                    <li>Préparation : <?=$recipe['preparation'];?></li>
                    <li>Conseils : <?=$recipe['advice'];?></li>
                    <li>Photo : <img src="<?=$recipe['photo'];?>"></li>
            </ul>
        </div>
        
        <div>
            <a href="edit_recipe.php?id=<?=$recipe['id'];?>">Editer la recette</a>
            <a href="delete_recipe.php?id=<?=$recipe['id'];?>">Supprimer la recette</a>
        </div>
        <?php endforeach; ?>
    </main>
</body>
</html>