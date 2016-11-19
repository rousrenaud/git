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
    
    $mailExist = $bdd->prepare('SELECT * FROM users WHERE mail= :mail');
    $mailExist->bindValue(':mail', $post['mail']);
    if($mailExist->execute()){
        if($mailExist->fetchColumn() === 0){
            $errors['mail'] = 'Mail Incorrect';
        }
        else{
            $check = $bdd->prepare('SELECT * FROM users WHERE mail =:mail');
            $check->bindValue(':mail', $post['mail']);
            if($check->execute()){
                $checked = $check->fetch(PDO::FETCH_ASSOC);
                
                if(!password_verify($post['password'], $checked['password'])){
                    $errors["password"] = 'Mot de passe incorrect';
                }
                
                if(count($errors) === 0){
                    $_SESSION = [
                        'id'            => $checked['id'],
                        'firstname'     => $checked['firstname'],
                        'perm'          => $checked['perm']
                    ];
                    $formValid = true;
                }
                
                else{
                    $errors[] = 'Il y\'a eu un problème pendant la connexion';
                }
            }
        }
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
<div>
    <main class="container" id="login">
        <?php if($formValid === true || $is_logged === true){ header('Location: admin_main.php');} ?>
        <form method="POST" class="form-horizontal">
            <!-- Email-->
            <div class="form-group">
				<label class="col-md-4 control-label" for="mail">Email</label>  
				<div class="col-md-4">
				    <input id="mail" name="mail" type="mail" class="form-control input-sd" placeholder="Entrez votre mail">
				</div>
            </div>
               
            <!-- Password -->
            <div class="form-group">
				<label class="col-md-4 control-label" for="password">Mot de passe</label>
				<div class="col-md-4">
				    <input id="password" name="password" type="password" class="form-control input-md" placeholder="********">
				</div>
            </div>
               
            <div class="form-group">
				<div class="col-md-4 col-md-offset-4">
				    <button id="" name="" class="btn btn-info btn-block">Se connecter</button>
				</div>
            </div>
            
        </form>
        <a href="pwd_forgot.php">Mot de passe oublié</a>
    </main>
</div>
</body>
</html>