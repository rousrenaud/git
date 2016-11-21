<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php';
if($is_logged){
    header('Location: admin_main.php');
}

$post = [];
$errors = [];
$formValid = false;

if(!empty($_POST) && !$is_logged){
    $post = array_map('trim', array_map('strip_tags', $_POST));
    
    if(!emailExist($post['mail'], $bdd)){
        $errors['mail'] = 'L\'adresse rentrée est inconnue';
    }
    
    if(count($errors) === 0){
        $token = md5(uniqid(rand(), true));
		$insert = $bdd->prepare('UPDATE users SET pwd_token = :pwd_token WHERE mail = :mail');
		$insert->bindValue(':pwd_token', $token);
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
<div id="login">
    <main class="container" >
       
        <?php if($is_logged === true){ header('Location: admin_main.php');} ?>
        <?php if($formValid === true){ echo '<div class="alert alert-success">Vous allez recevoir un mail pour changer votre mot de passe</div>';} ?>
        <form method="POST" class="form-horizontal">
            <!-- Email-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="mail">Email</label>  
                <div class="col-md-4">
                    <input id="mail" name="mail" type="mail" class="form-control input-sd" placeholder="Votre@mail.fr">
                </div>
            </div>   
            <div class="form-group">
            	<div class="col-md-4 col-md-offset-4">
			    	<button id="" name="" class="btn btn-info btn-block">Envoyer</button>
                </div>
            </div>
        </form>
        <a href="index.php">Connexion</a>
    </main>
</div>
</body>
</html>