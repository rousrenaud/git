<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
if(!$is_logged){
    header('Location: index.php');
}

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    
	$select = $bdd->prepare('SELECT * FROM contact WHERE id = :idMessage');
	$select->bindValue(':idMessage', $_GET['id'], PDO::PARAM_INT);
	if($select->execute()) {
		$contacts = $select->fetchAll(PDO::FETCH_ASSOC);
		echo 'tamere';
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
	<title>Affichage message</title>
</head>
<body>
    <?php include_once 'inc/navbar.php' ?>
    <main class="container">
        <h1>Message</h1>
        
        <?php if(empty($contacts)): ?>
            <div class="alert alert-danger">
                Message non trouvée !
            </div>
        <?php endif; ?>
        
        <?php if(!empty($contacts)): ?>
            <?php foreach($contacts as $contact): ?>
            <h1>Message : <?=$contact['lastname'];?></h1>
            
            <hr>
            
            <div>
                <ul>
                        <li>Nom : <?=$contact['lastname'];?></li>
                        <li>Prénom <?=$contact['firstname'];?></li>
                        <li>Message : <?=$contact['mail_content']?></li>
                        <li>Email : <?=$contact['mail']?></li>
                </ul>
            </div>
            
            <div>
                <a href="message.php?id=<?=$recipe['id'];?>">Retour</a>
                <a href="delete_message.php?id=<?=$recipe['id'];?>">Supprimer le message</a>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>