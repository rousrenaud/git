<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
<<<<<<< HEAD
			<a class="navbar-brand" href="admin_main.php">O'FIFOU</a>
=======
			<a class="navbar-brand" href="admin_main.php">Azerquipe 3</a>
>>>>>>> origin/master
		</div>

		<?php if($is_logged == true): ?>
			<p class="navbar-text navbar-left">
				<span class="text-primary">Bonjour <strong><?=$_SESSION['firstname'];?></strong></span>
			</p>
		<?php endif; ?>

    	<ul class="nav navbar-nav navbar-right">

      		<?php if(isset($is_logged) && $is_logged == true): ?>
      		    <?php if($_SESSION['perm'] >= 2): ?>
      			<li><a href="edit_info.php">Modifier les coordonnées</a></li> <!-- intégrer le lien de la page faite par Renaud et Antho -->
		        <li><a href="list_user.php">Liste des utilisateurs</a></li>
		        <li><a href="message.php">Messages</a></li>
		        <?php endif; ?>
		        <li><a href="list_recipe.php">Liste des recettes</a></li>
		        <li><a target="_blank" href="../index.php">Voir le site</a></li>
      			<li><a href="logout.php">Déconnexion</a></li>
      		<?php else: ?>
      		<?php endif; ?>
    	</ul>

  	</div>
</nav>