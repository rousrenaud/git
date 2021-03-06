<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php';
if(!$is_logged){
    header('Location: index.php');
}
elseif($_SESSION['perm'] < 2){
    header('Location: admin_main.php');
}

$post = [];
$errors = [];
$mimeTypeAllow = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
$dirUpload = 'pics/';
$formValid = false;
$pic1_Update = false;
$pic2_Update = false;
$pic3_Update =  false;

//Récupération des données pour affichage des valeurs dans les champs <input>
$select = $bdd->prepare('SELECT * FROM infos');
if($select->execute()){
	$info = $select->fetch(PDO::FETCH_ASSOC);
}

//Vérification du formulaire de mise à jour des coordonnées
if(!empty($_POST)){
	$post = array_map('trim', array_map('strip_tags', $_POST));

	if(!minAndMaxLength($post['name'], 2)){
		$errors['name'] = 'Le nom du Restaurant doit faire minimum 2 caractères';
	}

	if(!minAndMaxLength($post['adress'], 2)){
		$errors['adress'] = 'L\'adresse doit faire minimum 2 caractères';
	}

	if(!filter_var($post['mail'], FILTER_VALIDATE_EMAIL)){
		$errors['mail'] = 'Le mail est invalide';
	}

	if(!minAndMaxLength($post['phone'], 8)){
		$errors['phone'] = 'Le téléphone doit faire minimum 8 caractères';
	}
    
    
    
    //Insertion des données dans la DB
	if(count($errors) === 0){
		$columnSql = 'name = :name, phone = :phone, adress = :adress, mail = :mail ';


		$insert = $bdd->prepare('UPDATE infos SET '.$columnSql.' WHERE id=1');

		$insert->bindValue(':name', $post['name']);
		$insert->bindValue(':phone', $post['phone']);
		$insert->bindValue(':adress', $post['adress']);
		$insert->bindValue(':mail', $post['mail']);

		if($insert->execute()){
			$formValid = true;
		}
		else {
            $errors['db'] = 'Il y\'a eu un problème lors de l\'envoi des données';
		}
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mise à Jour Coordonnées</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <?php include_once 'inc/navbar.php' ?>
    <main class="container">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
            <div class="col-md-12">
				<h2>Mise à jour des coordonnées</h2>
				<?php if(isset($formValid) && $formValid == true): ?>
                    <div class="alert alert-success">
                        La recette a bien été modifiée
                    </div>
                <?php endif; ?>
                
				<a href="edit_carroussel.php">Changer le contenu du carroussel</a>
            </div>
            
            <!-- Nom du restaurant -->
            <div class="form-group">
            	<label class="col-md-4 control-label" for="name">Restaurant</label>  
            	<div class="col-md-6">
            		<input id="name" name="name" type="text"  class="form-control input-md" value="<?php echo $info['name'] ?>">
            		<?php if(isset($errors['name'])){ echo '<span style="color:red;">'.$errors['name'].'</span>';} ?>
            	</div>
            </div>
            
            <!-- Adresse du restaurant -->
            <div class="form-group">
            	<label class="col-md-4 control-label" for="adress">Adresse</label>  
            	<div class="col-md-6">
            		<input id="adress" name="adress" type="text"  class="form-control input-md" value="<?php echo $info['adress'] ?>">
            		<?php if(isset($errors['adress'])){ echo '<span style="color:red;">'.$errors['adress'].'</span>';} ?>	    
            	</div>
            </div>
            
			<!-- Tel -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="phone">Téléphone</label>  
				<div class="col-md-6">
					<input id="phone" name="phone" type="phone"  class="form-control input-md" value="<?php echo $info['phone'] ?>">
					<?php if(isset($errors['phone'])){ echo '<span style="color:red;">'.$errors['phone'].'</span>';} ?>
				</div>
            </div>
            
			<!-- Email -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="mail">Email</label>  
				<div class="col-md-6">
					<input id="mail" name="mail" type="text"  class="form-control input-md" value="<?php echo $info['mail'] ?>">
					<?php if(isset($errors['mail'])){ echo '<span style="color:red;">'.$errors['mail'].'</span>';} ?>
				</div>
			</div>
			
			<!-- Submit -->

       <div class="form-group">
           <div class="col-md-4 col-md-offset-4">
                <button id="" name="" class="btn btn-info btn-block">Editer</button>
           </div>

       </div>
        </form>
	</main>
</body>
</html>
