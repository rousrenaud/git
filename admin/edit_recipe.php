<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php';
if(!$is_logged){
    header('Location: index.php');
}

$post = [];
$errors = [];
$updatePhoto = false;
$mimeTypeAllow = ['image/jpg', 'image/jpeg', 'image/png'];
$dirUpload ='uploads/';

// Vérification des champs et déclaration des erreurs

if(!empty($_POST)){
	// nettoyage des données entrées
	$post = array_map('trim', array_map('strip_tags', $_POST));

    if(!minAndMaxLength($post['recipe_title'], 5, 50)){
		$errors['recipe_title'] = 'Le nom de votre recette doit comprendre entre 5 et 50 caractères';
	}

	if(!is_numeric($post['recipe_time']) || empty($post['recipe_time'])) {
		$errors['recipe_time'] = 'Le temps de préparation indiqué est incorrect';
	}

	if(!is_numeric($post['cook_time']) || empty($post['cook_time'])) {
		$errors['cook_time'] = 'Le temps de cuisson indiqué est incorrect';
	}	

	if(!is_numeric($post['people'])) {
		$errors['people'] = 'Le nombre de personnes indiqué est invalide';
	}

	if(!minAndMaxLength($post['ingredients'], 5, 5000)) {
		$errors['ingredients'] = 'Votre liste d\'ingrédients doit comprendre entre 5 et 5 000 caractères'; 
	}

	if(!minAndMaxLength($post['preparation'], 5, 10000)) {
		$errors['preparation'] = 'Votre liste d\'ingrédients doit comprendre entre 5 et 10 000 caractères'; 
	}

	if(!minAndMaxLength($post['advice'], 5, 500)) {
		$errors['advice'] = 'Les conseils doivent comprendre entre 5 et 500 caractères';
	}

	// vérification de l'upload de fichier et envoi au serveur SuperJay

	if(is_uploaded_file($_FILES['photo']['tmp_name']) || file_exists($_FILES['photo']['tmp_name'])){
		$finfo = new finfo();
		$mimeType = $finfo->file($_FILES['photo']['tmp_name'], FILEINFO_MIME_TYPE);

		if(in_array($mimeType, $mimeTypeAllow)){
			$photoName = uniqid('photo_');
			$photoName.= '.'.pathinfo($_FILES['photo']['tmp_name'], PATHINFO_EXTENSION);
			if(!is_dir($dirUpload)){
				mkdir($dirUpload, 0755);
			}

			if(!move_uploaded_file($_FILES['photo']['tmp_name'], $dirUpload.$photoName)) {
				$errors[] = 'Erreur lors de l\'envoi de votre photo';
			}
		}
		else {
			$errors[] = 'Le type de fichier est invalide. Uniquement jpg/jpeg/png.';
		}
		$updatePhoto = true;
	}

	// Vérification des erreurs et envoi en DB
	if(count($errors) === 0){

		$columnSQL = 'recipe_title = :recipe_title, recipe_time = :recipe_time, cook_time = :cook_time, people = :people, ingredients = :ingredients, preparation = :preparation, advice = :advice, date_publish = NOW()';

		// si la photo est modifiée
		if($updatePhoto) {
			$columnSQL.= ', photo = :photo';
		}


		$update = $bdd->prepare('UPDATE recipes SET '.$columnSQL.' WHERE id = :idRecipe');

        $update->bindValue(':idRecipe', $_GET['id'], PDO::PARAM_INT);
		$update->bindValue(':recipe_title', $post['recipe_title']);
		$update->bindValue(':recipe_time', $post['recipe_time']);
		$update->bindValue(':cook_time', $post['cook_time']);
		$update->bindValue(':people', $post['people']);
		$update->bindValue(':ingredients', $post['ingredients']);
		$update->bindValue(':preparation', $post['preparation']);
		$update->bindValue(':advice', $post['advice']);

		if($updatePhoto) {
			// update de la photo
			$update->bindValue(':photo', $dirUpload.$photoName);
		}

		if($update->execute()){
			$formValid = true;
		}
		else {
			var_dump($update->errorInfo());
		}
	}
}

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$select = $bdd->prepare('SELECT * FROM recipes WHERE id = :idRecipe');

	$select->bindValue(':idRecipe', $_GET['id'], PDO::PARAM_INT);

	if($select->execute()){
		$recipe = $select->fetch(PDO::FETCH_ASSOC);
	}
}

?>

<!-- ********** HTML ********** -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modifier une recette</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <?php include_once 'inc/navbar.php' ?>
    
    <main class="container">
        <?php if($is_logged && $_SESSION['perm'] >= 1): ?>   
            <h1>Ajouter une recette</h1>

            

            <?php if(isset($formValid) && $formValid == true): ?>
            <div class="alert alert-success">
                La recette a bien été ajoutée !
            </div>
            <?php endif; ?>
            <br>

            <form method="post" class="form-horizontal" enctype="multipart/form-data">
               
                <!-- Nom de la recette -->
                <div class="form-group">	
                    <label class="col-md-4 control-label" for="recipe_title">Nom de la recette : </label>
                     <div class="col-md-6">
                        <input type="text" name="recipe_title" id="recipe_title" class="form-control input-md" placeholder="ex: Magrets de canard au miel...">
                        <p id="title_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['recipe_title'])){echo $errors['recipe_title'];} ?>
                        </p>
                    </div>
                </div>

                <!-- Temps de préparation -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="recipe_time">Temps de préparation : </label>
                    <div class="col-md-6">
                        <select id="recipe_time" name="recipe_time">
                            <option>10</option>
                            <option>15</option>
                            <option>30</option>
                            <option>45</option>
                            <option>60</option>
                        </select>
                    </div>
                </div>  

                <!-- Temps de cuisson -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="cook_time">Temps de cuisson : </label>
                    <div class="col-md-6">
                        <select id="cook_time" name="cook_time">
                            <option>10</option>
                            <option>15</option>
                            <option>30</option>
                            <option>45</option>
                            <option>60</option>
                        </select>
                    </div>    
                </div>

                <!-- Nombre de personnes/plat -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="people">Nombre de personnes : </label>
                    <div class="col-md-6">
                        <input type="text" name="people" id="people" class="form-control input-md form-control-danger" placeholder="2">
                        <p id="people_Help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['people'])){echo $errors['people'];} ?>
                        </p>
                    </div>
                </div>

                <!-- Ingrédients -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="ingredients">Ingrédients : </label>
                    <div class="col-md-6">
                        <textarea name="ingredients" id="ingredients" class="form-control input-md" rows="6" placeholder="ex: 2 magrets de canard gras, 3 cuillères à soupe miel 'mille fleurs' ou autre, 3 cuillères à café de vinaigre balsamique, sel..."></textarea>
                        <p id="ingredients_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['ingredients'])){echo $errors['ingredients'];} ?>
                        </p>
                    </div>
                </div>

                <!-- Préparation -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="preparation">Préparation de la recette : </label>
                    <div class="col-md-6">
                        <textarea name="preparation" id="preparation" class="form-control input-md" rows="6" placeholder="ex: Inciser les magrets côté peau en quadrillage sans couper la viande. Cuire les magrets à feu vif dans une cocotte en fonte, en commençant par le côté peau..."></textarea>
                        <p id="preparation_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['preparation'])){echo $errors['preparation'];} ?>
                        </p>
                    </div>
                </div>

                <!-- Conseils -->
                <div class="form-group">    
                    <label class="col-md-4 control-label" for="advice">Conseils : </label>
                    <div class="col-md-6">
                        <textarea name="advice" id="advice" class="form-control input-md" rows="6" placeholder="ex: Boisson conseillée : Madiran, Chinon.."></textarea>
                        <p id="advice_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['advice'])){echo $errors['advice'];} ?>
                        </p>
                    </div>
                </div>

                <!-- Avatar --> 
                <div class="form-group">    
                    <label class="col-md-4 control-label" for="photo">Photo de votre recette : </label>
                    <div class="col-md-6">
                        <input id="photo" name="photo" class="form-control input-md" type="file" accept="image/*">
                        <p id="photo_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['photo'])){echo $errors['photo'];} ?>
                        </p>
                    </div>
                </div>

                <!-- Bouton d'envoi -->
                <div class="form-group">    
                    <div class="col-md-4 col-md-offset-4">
                        <button type="submit" class="btn btn-info btn-block">Publier !</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
        <?php if(!$is_logged){header('Location: index.php');} ?>   
    </main>
</body>
</html>