<?php
require_once 'inc/connect.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])){

	$select = $bdd->prepare('SELECT * FROM recipes WHERE id = :idUser');
	$select->bindValue(':idUser', $_GET['id'], PDO::PARAM_INT);
	if($select->execute()){
		$user = $select->fetch(PDO::FETCH_ASSOC);
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mon Recette</title>
	
	<!--fontawesome-->
	<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
	
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
	<link href="css/style.css" rel="stylesheet" type="text/css">
	
	<!--mediaquery-->
	<link type="text/css" rel="stylesheet" href="css/mediaquery.css">
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- mon JavaScript -->
    <script src="js/style.js"></script>
	
	<style>
		/*font-face*/
			@font-face {
			font-family: 'courgetteregular';
			font-style: normal;
			src: url(fonts/Courgette-Regular.ttf);
			}
		
	</style>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="wrap">
<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php"><h1 class="logomargin"><i class="fa fa-globe fa-1x" aria-hidden="true"></i> Azerquipe3</h1>
				</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php">ACCUEIL</a>
                    </li>
                    <li class="active1">
                        <a class="page-scroll" href="list_recette.php">RECETTE</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="contact.php">CONTACT</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


<!--Photo couverture-->
<div class="">
	<img src="img/recettedetailback.jpg" class="img-responsive" alt="Responsive image">
</div>
	
<!--Recette detail-->
<?php if(empty($user)): ?>
	<div class="alert alert-danger">
		Oups! Recette non trouvée!
	</div>
<?php endif; ?>	

<div class="container">
	<div class="row" style="margin: 0;">
		<div class="col-lg-12">
			<h1><?=$user['recipe_title'];?></h1>
			<p><?=$user['recipe_author'];?></p>
		</div>
	</div>
	
	<div class="row" style="margin: 0;">
		<div class="col-md-6">
			<img src="admin/<?=$user['photo'];?>" alt="soup" class="img-thumbnail img-responsive">
		</div>
		<div class="col-md-6">
			<p class="detailcolor">Temps de préparation : <?=$user['cook_time'];?><span> minutes</span></p>	
			<p class="detailcolor">Temps de cuisson : <?=$user['recipe_time'];?><span> minutes</span></p>
			<p class="detailcolor">Ingrédients (pour <?=$user['people'];?><span></span> personnes) : </p>
			<ul>
				<li><?=$user['ingredients'];?></li>
			</ul>
			<p class="detailcolor1">Préparation de la recette :</p>
			<p><?=$user['preparation'];?></p>
			<p class="detailcolor1">Conseils :</p>
			<p><?=$user['advice'];?></p>
		</div>
	</div>
</div>
	
<br><br><br><br><br><br><br><br>
<!--footer-->
<?php
include 'footer.php';	
?>
</div>
</body>
</html>