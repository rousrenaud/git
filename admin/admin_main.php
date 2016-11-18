<?php 
require_once 'inc/session.php';
if(!$is_logged){
    header('Location: index.php');
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Accueil administration</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <?php include_once 'inc/navbar.php'; ?>
    <main class="container">
        <h1>Bonjour <?=$_SESSION['firstname']?></h1>
        <h2>Bienvenue sur la session "administration" de votre site web !</h2>

        <p>
            Vous êtes sur la page d'administration de votre site web.<br> Vous pouvez, à l'aide la barre de navigation en haut de page, gérer le contenu de votre site :
            <ul>
                <li><a href="edit_info.php"> Modifier les coordonnées de votre commerce</a></li>
                <li><a href="list_user.php">Gérer vos utilisateurs</a></li>
                <li><a href="list_recipe.php">Gérer vos recettes</a></li>
                <li><a href="contact.php"> Lire les messages qui vous ont été envoyés dans la session "Contact"</a></li>
            </ul>
            Merci de votre confiance !
        </p>
    </main>
</body>
</html>