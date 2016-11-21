<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
if(!$is_logged){
    header('Location: index.php');
}
if($_SESSION['perm'] < 2){
    header('Location: admin_main.php');
    die();
}

$searchSQL = '';
$get = [];

if(!empty($_GET)) {
	$get = array_map('trim', array_map('strip_tags', $_GET));

	if(isset($get['search']) && !empty($get['search'])) {
		$searchSQL = ' WHERE lastname LIKE :search';
	}
}

$query = $bdd->prepare('SELECT * FROM contact'.$searchSQL);
if(isset($get['search']) && !empty($get['search'])){
	$query->bindValue(':search', '%'.$get['search'].'%');
}

$select = $bdd->prepare('SELECT * FROM contact');
if($select->execute()){
	$contacts = $select->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste messages</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <?php include_once 'inc/navbar.php' ?>
    <main id="container">
        <h1>Messagerie</h1>

        <div>
            <form method="GET">
                <input type="text" id="search" name="search" placeholder="Chercher une recette..." value="<?=(isset($get['search']) && !empty($get['search'])) ? $get['search'] : ''; ?>">
                <button type="submit">Rechercher !</button>
            </form>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Lus/Non lus</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contacts as $contact): ?>
                        <tr>

                            <th scope="row"><!-- Trouver un moyen d'afficher le nom ou l'ID de la personne ayant publié la recette -->
                                <?=$contact['id'];?>
                            </td>
                            <td>
                                <?=$contact['lastname'];?>
                            </td>
                            <td>
                                <?=$contact['firstname'];?>
                            </td>
                            <td>
                                <?=$contact['mail'];?>
                            </td>
                            <td>
                                <?=$contact['mail_content'];?>
                            </td>
                            <td>
                                <?php if($contact['checked'] == 1){
                                echo 'Lu';
                                }
                                else{echo 'Non Lu';}?>
                                
                            </td>
                            <td>
                                <a href="view_message.php?id=<?=$contact['id'];?>" title="Voir la recette">Lire le message</a>
                                <a href="edit_message.php?id=<?=$contact['id'];?>" title="Voir la recette">Supprimer le message</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>