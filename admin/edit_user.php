<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php';
if(!$is_logged){
    header('Location: index.php');
}

$post = [];
$errors = [];
$updateAvatar = false;
$updatePassword = false;

if(!empty($_POST)){
	$post = array_map('trim', array_map('strip_tags', $_POST)); 

	if(!minAndMaxLength($post['firstname'], 2, 20)){
		$errors[] = 'Votre prénom doit comporter entre 3 et 20 caractères';
	}

	if(!minAndMaxLength($post['lastname'], 2, 20)){
		$errors[] = 'Votre nom doit comporter entre 3 et 20 caractères';
	}

	if(!filter_var($post['mail'], FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Votre email est invalide';
	}

	if(!empty($post['password']) || $_SESSION['perm'] < 2){
		$updatePassword = true;
		if(!minAndMaxLength($post['password'], 8, 20)){
			$errors[] = 'Votre mot de passe doit comporter entre 8 et 20 caractères';
		}
	}

	if(count($errors) === 0){


		$columnSQL = 'firstname = :firstname, lastname = :lastname, mail = :mail ';

		if($updatePassword){
			$columnSQL.= ', password = :password';
		}

		$update = $bdd->prepare('UPDATE users SET '.$columnSQL.' WHERE id = :idUser');
		$update->bindValue(':idUser', $_GET['id'], PDO::PARAM_INT);
		$update->bindValue(':firstname', $post['firstname']);
		$update->bindValue(':lastname', $post['lastname']);
		$update->bindValue(':mail', $post['mail']);
		
		if($updatePassword){
			$update->bindValue(':password', password_hash($post['password'], PASSWORD_DEFAULT));
		}

		if($update->execute()){
			$formValid = true;
		}
		else {
			var_dump($update->errorInfo());
		}
	}

}

if(isset($_GET['id']) && is_numeric($_GET['id'])){

	$select = $bdd->prepare('SELECT * FROM users WHERE id = :idUser');
	$select->bindValue(':idUser', $_GET['id'], PDO::PARAM_INT);
	if($select->execute()){
		$user = $select->fetch(PDO::FETCH_ASSOC);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mettre à jour l'utilisateur</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>

	<?php include_once 'inc/navbar.php'; ?>

	<main class="container">
    <?php if($_SESSION['perm'] >=2 || $_SESSION['id'] === $_GET['id']): ?>
		<h1 class="text-center text-info">
			<i class="fa fa-user-plus"></i> Mettre à jour l'utilisateur
		</h1>
		
		<hr>

		<?php if(empty($user)): ?>
			<div class="alert alert-danger">
				Utilisateur inconnu !
			</div>
		<?php elseif(count($errors) > 0): ?>
			<div class="alert alert-danger">
				<?=implode('<br>', $errors);?>
			</div>		
		<?php elseif(isset($formValid) && $formValid == true): ?>
			<div class="alert alert-success">
				L'utilisateur a bien été mis à jour
			</div>
		<?php endif; ?>


		<?php if(!isset($formValid) && !empty($user)): ?>
			<form method="post" class="form-horizontal" enctype="multipart/form-data">

				<!-- Prénom -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="firstname">Prénom</label>  
					<div class="col-md-6">
						<input id="firstname" name="firstname" type="text" class="form-control input-md" value="<?=$user['firstname'];?>">
					</div>
				</div>

				<!-- Nom de famille -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="lastname">Nom</label>  
					<div class="col-md-6">
						<input id="lastname" name="lastname" type="text" class="form-control input-md" value="<?=$user['lastname'];?>">	    
					</div>
				</div>

				<!-- Email-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="mail">Email</label>  
					<div class="col-md-6">
						<input id="mail" name="mail" type="mail" class="form-control input-md" value="<?=$user['mail'];?>">
					</div>
				</div>

				<?php if($_SESSION['perm'] < 2): ?>
				<!-- Password -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="password">Mot de passe</label>
					<div class="col-md-6">
						<input id="password" name="password" type="password" class="form-control input-md">
					</div>
				</div>
				<?php endif; ?>

				<!-- Type d'utilisateur -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="user_type">Type d'utilisateur</label>
					<div class="col-md-2">
						<select id="user_type" name="user_type" class="form-control">
							<option value="" selected disabled>Type d'utilisateur</option>
							</option>
							<option value="2" >Administrateur</option>
							</option>
							<option value="1" >Editeur</option>
							</option>
						</select>
					</div>
				</div>	

				<!-- Submit -->
				<div class="form-group">
					<div class="col-md-4 col-md-offset-4">
						<button id="" name="" class="btn btn-info btn-block">Mettre à jour</button>
					</div>
				</div>
				
			</form>
		<?php endif; ?>
    <?php endif; ?>
	</main>

</body>
</html>