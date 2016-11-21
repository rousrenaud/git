<?php
require_once 'inc/connect.php';


$itemsPerPage = 6;

if(!empty($_GET)) {
	$get = array_map('trim', array_map('strip_tags', $_GET));
	
	if(isset($get['search']) && !empty($get['search'])){
		$searchSQL = ' WHERE recipe_title LIKE :search';
	}
}

$select = $bdd->query('SELECT * FROM infos');
if($select->execute()){
	$info = $select->fetch(PDO::FETCH_ASSOC);
}

/*if(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])){
	$page = (int) $_GET['page'];
}
else {
	$page = 1;
}*/

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Azerquipe3</title>
	
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

<?php
    $search = $bdd->prepare('SELECT * FROM recipes LEFT JOIN users ON recipes.id_user=users.id');

    if($search->execute()){
    $recettename = $search->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        var_dump($recettename);
    }
?>	
	
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
                    <li class="active1">
                        <a class="page-scroll" href="index.php">ACCUEIL</a>
                    </li>
                    <li>
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
<div>
	<!--<img src="img/photodicouverte.jpg" class="img-responsive" alt="Responsive image">-->
	<div class="carousel slide" id="carousel-example-captions" data-ride="carousel">
		<ol class="carousel-indicators"> 
			<li data-target="#carousel-example-captions" data-slide-to="0" class=""></li> 
			<li data-target="#carousel-example-captions" data-slide-to="1" class=""></li> 
			<li data-target="#carousel-example-captions" data-slide-to="2" class="active"></li> 
		</ol> 
		<div class="carousel-inner" role="listbox"> 
			<div class="item"> 
				<img alt="1920x756" src="<?php echo $info['photo1']; ?>" data-holder-rendered="true"> 
				<div class="carousel-caption"> 
					<h3><?php echo $info['carroussel_title1']; ?></h3> 
					<p><?php echo $info['carroussel_text1']; ?></p> 
				</div> 
			</div> 
			<div class="item"> 
				<img alt="1920x756" src="<?php echo $info['photo2']; ?>" data-holder-rendered="true"> 
				<div class="carousel-caption"> 
					<h3><?php echo $info['carroussel_title2']; ?></h3> 
					<p><?php echo $info['carroussel_text2']; ?></p> 
				</div> 
			</div> 
			<div class="item active"> 
				<img alt="1920x756" src="<?php echo $info['photo3']; ?>" data-holder-rendered="true"> 
				<div class="carousel-caption"> 
					<h3><?php echo $info['carroussel_title3']; ?></h3> 
					<p><?php echo $info['carroussel_text3']; ?></p> 
				</div> 
			</div> 
		</div> 
		<a href="#carousel-example-captions" class="left carousel-control" role="button" data-slide="prev"> 
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
			<span class="sr-only">Previous</span> 
		</a> 
		<a href="#carousel-example-captions" class="right carousel-control" role="button" data-slide="next"> 
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
			<span class="sr-only">Next</span> 
		</a> 
	</div>	
</div>
	
<!--section d'example de recette-->
	
<!--section d'example de recette-->
<?php if(empty($recettename)): ?>
	<tr>
		<td colspan="5"><h1>Aucune recette trouvée!</h1></td>
	</tr>
		<?php else: ?>
<form method="get">	
	<div class="bs-example recettemargin" data-example-id="thumbnails-with-custom-content">
		<div class="row" style="margin: 0px;">
		  <?php foreach($recettename as $user): ?>
		  <div class="col-sm-6 col-md-4">
			<div class="thumbnail">
			  <img src="admin/<?=$user['photo'];?>" alt="nouveaute" class="recettehover">
			  <div class="caption">
				<h3 class="nouveaute_color"> - <?=$user['recipe_title'];?> - </h3>
				<p class="auteuralign"><?=$user['firstname'];?></p>
				<div class="btnalign">
					<a href="view_recette.php?id=<?=$recipe['id'];?>">
						<button type="button" class="btn btn-danger">En savoir + 
						</button>
					</a>
				</div>
			  </div>
			</div>
		  </div>
		  <?php endforeach;?>
		<?php endif; ?>
		</div>
	</div>
</form>
<!--Button pour tous des recettes-->
<div class="btnalign">
	<a href="list_recette.php">
		<button type="button" class="btn btn-danger1">Découvrez toutes nos recettes <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
		</button>
	</a>
</div>
	
<!--footer-->
<?php
include 'footer.php';	
?>
	
</body>
</html>