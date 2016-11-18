<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php';
if($is_logged){
    header('Location: index.php');
}

$errors = [];
$formValid = false;

if(isset($_GET['token']) && !empty($_GET['token'])){
    $token_get = $bdd->prepare('SELECT * FROM users WHERE pwd_token = :pwd_token');
	$token_get->bindValue(':pwd_token', $_GET['token'], PDO::PARAM_STR);
	if($token_get->execute()){
        if($token_get->rowCount() !=1){
            $errors['null'] = '';
        }
        
        elseif(($token_get->rowCount() == 1) && !empty($_POST)){
            $post = array_map('trim', array_map('strip_tags', $_POST));
            
            if(!minAndMaxLength($post['password'], 8, 20)){
                $errors['password'] = 'Le mot de passe doit faire entre 8 et 20 caractères';
            }
            
            if(count($errors) === 0){
            $update = $bdd->prepare('UPDATE users SET password = :password, pwd_token = :pwd_reset WHERE pwd_token = :pwd_token');
            $update->bindValue(':password', password_hash($post['password'], PASSWORD_DEFAULT));
            $update->bindValue(':pwd_reset', '', PDO::PARAM_STR);
            $update->bindValue(':pwd_token', $_GET['token']);
            if($update->execute()){
                $formValid = true;
            }
            else{
                echo 'erreur 2';
            }
            }
        }
    }
    else{
        echo 'erreur db';
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
    <main class="container">
        <?php if(isset($formValid) && $formValid): ?>

			<div class="alert alert-success">
				Vous pouvez maintenant vous connecter avec votre vrai mot de passe: <a href="index.php">ICI</a>
			</div>
		<?php endif; ?>
        
        <?php if(isset($_GET['token']) && !isset($errors['null']) && !$formValid): ?>
        <form method="POST" class="form-horizontal">
            <!-- Email-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Mot de passe</label>  
                <div class="col-md-4">
                    <input id="password" name="password" type="password" class="form-control input-sd" placeholder="********">
                </div>
            </div>   
            <div class="form-group">
            	<div class="col-md-4 col-md-offset-4">
			    	<button id="" name="" class="btn btn-info btn-block">Envoyer</button>
                </div>
            </div>
        </form>
        <?php endif; ?>
        <?php if(!isset($_GET['token']) || isset($errors['null'])): ?>
            <div class="alert alert-danger">
				La page demandée n'existe pas !
			</div>
        <?php endif; ?>
    </main>
</div>
</body>
</html>