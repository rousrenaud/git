<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="admin_main.php">Website</a>
		</div>

		<?php if($is_logged == true): ?>
			<p class="navbar-text navbar-left">
				<span class="text-primary">Bonjour <strong><?=$_SESSION['firstname'];?></strong></span>
			</p>
		<?php endif; ?>

    	<ul class="nav navbar-nav navbar-right">

      		<?php if($is_logged == true): ?>
      		    <?php if($_SESSION['perm'] >= 2): ?>
      			<li><a href="edit_info.php">Modifier les coordonnées</a></li> <!-- intégrer le lien de la page faite par Renaud et Antho -->
		        <li><a href="list_user.php">Liste des utilisateurs</a></li>
		        <li><a href="message.php">Messages</a></li>
		        <?php endif; ?>
		        <li><a href="list_recipe.php">Liste des recettes</a></li>
		        <li><a href="../../projet_novembre/home_page.php">Voir le site</a></li>
      			<li><a href="logout.php">Déconnexion</a></li>
      		<?php else: ?>
      		<?php endif; ?>
    	</ul>

  	</div>
</nav>