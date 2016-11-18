<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
if(!$is_logged){
    header('Location: index.php');
}

if(isset($_GET['id']) && is_numeric($_GET['id'])) {

	$select = $bdd->prepare('SELECT * FROM users WHERE id = :idUser');
	$select->bindValue(':idUser', $_GET['id'], PDO::PARAM_INT);
	if($select->execute()) {
		$user = $select->fetch(PDO::FETCH_ASSOC);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profil utilisateur</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
	<?php include_once 'inc/navbar.php' ?>
	<main class="container">
        <h1>Profil de l'utilisateur <?=$user['firstname'];?></h1>

        <hr>

        <?php if(empty($user)): ?>
            <div class="alert alert-danger">
                Utilisateur non trouvée !
            </div>
        <?php endif; ?>

        <div>
            <ul> 
                <li>Prenom : <?=$user['firstname'];?></li>
                <li>Nom : <?=$user['lastname'];?></li>
                <li>Email : <?=$user['mail']?></li>
            </ul>
        </div>

        <div>
            <a href="edit_user.php?id=<?=$user['id'];?>">Modifier le mot de passe</a>
            <a href="delete_user.php?id=<?=$user['id'];?>">Supprimer l'utilisateur</a>
        </div>
	</main>
</body>
</html>