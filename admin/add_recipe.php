<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php';
if(!$is_logged){
    header('Location: index.php');
}
/*ta mere*/
$post = [];
$errors = [];
$mimeTypeAllow = ['image/jpg', 'image/jpeg', 'image/png'];
$dirUpload ='uploads/';

// Vérification des champs et déclaration des erreurs

if(!empty($_POST) && $is_logged){
    // nettoyage des données entrées
    $post = array_map('trim', array_map('strip_tags', $_POST));
    
    if(!preg_match('/[(\w+\s)]{5,140}/i',$post['recipe_title'])){
        $errors[] = 'Le nom de votre recette doit comprendre entre 5 et 
        140 caractères';
    }

    if(!is_numeric($post['recipe_time']) || empty($post['recipe_time'])) {
        $errors[] = 'Le temps de préparation indiqué est incorrect';
    }

    if(!is_numeric($post['cook_time']) || empty($post['cook_time'])) {
        $errors[] = 'Le temps de cuisson indiqué est incorrect';
    }   

    if(!is_numeric($post['people'])) {
        $errors[] = 'Le nombre de personnes indiqué est invalide';
    }

    if(!minAndMaxLength($post['ingredients'], 5, 5000)) {
        $errors[] = 'Votre liste d\'ingrédients doit comprendre entre 5 et 5 000 caractères'; 
    }

    if(!preg_match('/[(\w+\s)]{5,140}/i',$post['preparation'])) {
        $errors[] = 'Votre recette doit comprendre entre 5 et 10 000 caractères'; 
    }

    if(!minAndMaxLength($post['advice'], 5, 500)) {
        $errors = 'Les conseils doivent comprendre entre 5 et 500 caractères';
    }

    // vérification de l'upload de fichier et envoi au serveur 
    if(!is_uploaded_file($_FILES['photo']['tmp_name']) || !file_exists($_FILES['photo']['tmp_name'])){
        $errors[] = 'Vous devez ajouter une photo de votre recette';
    }
    else{
        $finfo = new finfo();
        $mimeType = $finfo->file($_FILES['photo']['tmp_name'], FILEINFO_MIME_TYPE);

        if(in_array($mimeType, $mimeTypeAllow)){
            $photoName = uniqid('photo_');
            $photoName.= '.'.pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

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
    }
    // Vérification des erreurs et envoi en DB
    if(count($errors) === 0){
        $insert = $bdd->prepare('INSERT INTO recipes(id_user, recipe_title, recipe_time, cook_time, people, ingredients, preparation, advice, photo, date_publish) VALUES(:id_user, :recipe_title, :recipe_time, :cook_time, :people, :ingredients, :preparation, :advice, :photo, NOW())');
        
        $insert->bindValue(':id_user', $_SESSION['id']);
        $insert->bindValue(':recipe_title', $post['recipe_title']);
        $insert->bindValue(':recipe_time', $post['recipe_time']);
        $insert->bindValue(':cook_time', $post['cook_time']);
        $insert->bindValue(':people', $post['people']);
        $insert->bindValue(':ingredients', $post['ingredients']);
        $insert->bindValue(':preparation', $post['preparation']);
        $insert->bindValue(':advice', $post['advice']);
        $insert->bindValue(':photo', $dirUpload.$photoName);

        if($insert->execute()){
            $formValid = true;
        }
        else {
            var_dump($insert->errorInfo());
        }
    }
}




?>

<!-- ********** HTML ********** -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouter une recette</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <?php include_once 'inc/navbar.php' ?>
    
    <main class="container">
        <?php if($is_logged && $_SESSION['perm'] >= 1): ?>   
            <h1>Ajouter une recette</h1>

            <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?=implode('<br>', $errors);?>
            </div>

            <?php elseif(isset($formValid) && $formValid == true): ?>
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
                        <input type="text" name="people" id="people" class="form-control input-md" placeholder="2">
                    </div>
                </div>

                <!-- Ingrédients -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="ingredients">Ingrédients : </label>
                    <div class="col-md-6">
                        <textarea name="ingredients" id="ingredients" class="form-control input-md" rows="6" placeholder="ex: 2 magrets de canard gras, 3 cuillères à soupe miel 'mille fleurs' ou autre, 3 cuillères à café de vinaigre balsamique, sel..."></textarea>
                    </div>
                </div>

                <!-- Préparation -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="preparation">Préparation de la recette : </label>
                    <div class="col-md-6">
                        <textarea name="preparation" id="preparation" class="form-control input-md" rows="6" placeholder="ex: Inciser les magrets côté peau en quadrillage sans couper la viande. Cuire les magrets à feu vif dans une cocotte en fonte, en commençant par le côté peau..."></textarea>
                    </div>
                </div>

                <!-- Conseils -->
                <div class="form-group">    
                    <label class="col-md-4 control-label" for="advice">Conseils : </label>
                    <div class="col-md-6">
                        <textarea name="advice" id="advice" class="form-control input-md" rows="6" placeholder="ex: Boisson conseillée : Madiran, Chinon.."></textarea>
                    </div>
                </div>

                <!-- Photo recette --> 
                <div class="form-group">    
                    <label class="col-md-4 control-label" for="photo">Photo de votre recette : </label>
                    <div class="col-md-6">
                        <input id="photo" name="photo" class="form-control input-md" type="file" accept="image/*">
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