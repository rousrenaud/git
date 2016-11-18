<?php
require_once 'inc/session.php';
if(!$is_logged){
    header('Location: index.php');
}

$post = [];

if(!empty($_POST)){
	$post = array_map('trim', array_map('strip_tags', $_POST));

	if($post['disconnect'] === 'yes'){
		// Je supprime uniquement l'entrée user de la session. Utile dans le e-commerce par exemple pour garder un panier en mémoire
		// http://php.net/manual/fr/function.unset.php
		unset($_SESSION['id']);
		header('Location: index.php');
		die;

		// Je supprime toute la session
		/*
		$_SESSION = [];
		session_destroy();
		*/
	}
	if($post['disconnect'] === 'no'){
		// On redirige vers mon profil
		header('Location: index.php');
		die;
	}
}

?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Connexion utilisateur</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<?php include_once 'inc/navbar.php'; ?>
	
	<main class="container">
		<h1 class="text-center text-info">
			<i class="fa fa-sign-out"></i> Déconnexion
		</h1>
		
		<hr>
		
		<form method="post" class="form-horizontal">
		
			<h3>Voulez-vous vous déconnecter ?</h3>
			
			<button class="btn btn-default" name="disconnect" value="no">Non</button>
			
			&nbsp; 
			
			<button class="btn btn-info" name="disconnect" value="yes">Oui</button>
			
		</form>
		
	</main>
	
</body>
</html>