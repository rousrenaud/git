<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
if(!$is_logged){
    header('Location: index.php');
}

$query = $bdd->prepare('SELECT * FROM users ORDER BY perm DESC');
if($query->execute()){
	$users = $query->fetchAll(PDO::FETCH_ASSOC);
}
else {
	var_dump($query->errorInfo());
	die;
}
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Liste des utilisateurs</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php include 'inc/navbar.php'; ?>
    
	<main class="container">
	
		<h1 class="text-center text-info">
			<i class="fa fa-users"></i> Liste des utilisateurs
		</h1>
		<?php if($is_logged && $_SESSION['perm'] >= 2): ?>
		<a href="add_user.php" title="Ajout utilisateur">Ajouter un utilisateur</a>
		<?php endif; ?>
		<hr>
		
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php if($user['perm'] >=2){echo'Admin';}else{echo'Editeur';}?></td>
					<td><?=$user['firstname'];?></td>
					<td><?=$user['lastname'];?></td>
					<td><?=$user['mail'];?></td>
					<td>
						<a href="view_user.php?id=<?=$user['id'];?>" title="Voir profil">Voir le Profil</a>
						<a href="edit_user.php?id=<?=$user['id'];?>" title="Modifier profil">Modifier</a>
						<a href="delete_user.php?id=<?=$user['id'];?>" title="Voir le profil">Supprimer</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</main>
</body>
</html>