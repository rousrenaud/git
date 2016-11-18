<?php
require_once 'inc/connect.php';
require_once 'inc/datas.php';

$searchdetail = $_GET['search'];

if(!empty($_GET)) {
	$get = array_map('trim', array_map('strip_tags', $_GET));
	
	if(isset($get['search']) && !empty($get['search'])){
		$searchSQL = ' WHERE recipe_title LIKE :search';
	}
	
	if(isset($get['search']) && !empty($get['search'])) {
		echo $get['search'];
	}else {
		echo '';
	}
}

$query = $bdd->prepare('SELECT * FROM recipes' . $searchSQL);
if(isset($get['search']) && !empty($get['search'])){
	$query->bindValue(':search', $get['search']);
}

if($query->execute()){
	$users = $query->fetchAll(PDO::FETCH_ASSOC);
}
else {
	// A des fins de debug si la requète SQL est en erreur
	var_dump($query->errorInfo());
	die;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mes Recettes</title>
	
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
                <a class="navbar-brand page-scroll" href="home_page.php"><h1 class="logomargin"><i class="fa fa-globe fa-1x" aria-hidden="true"></i> Azerquipe3</h1>
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
                        <a class="page-scroll" href="home_page.php">ACCUEIL</a>
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
<div class="recetteback">
	<img src="img/recetteback.jpg" class="img-responsive" alt="Responsive image">
</div>
	
<!--search bar-->
<?php
    $namerecette = $_GET['search'];
    $search = $bdd->prepare("SELECT * FROM recipes where recipe_title like '%$namerecette%'");

    if($search->execute()){
    $recettename = $search->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<form method="get">
<div class="container recette_select">
	<div class="recette_text">
		<p class="recette_text_align">Découvrez toutes nos recettes</p>
	</div>
	
	
	<div class="form-group">
		<div class="input-group">
		  <input type="text" class="form-control" placeholder="Cherchez vos recettes" name="search" id="search" value="<?=(isset($get['search']) && !empty($get['search'])) ? $get['search'] : ''; ?>">
		  <!--<div class="input-group-addon btn btn-danger">
			<i class="fa fa-search" aria-hidden="true"></i>	
		  </div>-->
		  <div class="input-group-addon btn btn-danger">
		  <button type="submit" name="submit" id="submit" style="background:transparent;border:none;">
			<i class="fa fa-search" aria-hidden="true"></i>	
		  </button>
	      </div>
		</div>
  	</div>	
</div>
	
<!--section d'example de recette-->
<?php if(empty($recettename)): ?>
	<tr>
		<td colspan="5"><h1>Aucun recette trouvé!</h1></td>
	</tr>
		<?php else: ?>
	
<div class="bs-example recettemargin" data-example-id="thumbnails-with-custom-content">
	<div class="row" style="margin: -80px;">
	  <?php foreach($recettename as $user): ?>
	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <img src="admin/<?=$user['photo'];?>" alt="nouveaute" class="recettehover">
		  <div class="caption">
			<h3 class="nouveaute_color"><?=str_replace($searchdetail, '<span style="background:yellow;">' . $searchdetail . '</span>', $user['recipe_title']);?></h3>
			<p class="auteuralign"><?=$user['recipe_author'];?></p>
			<div class="btnalign">
				<a href="view_recette.php?id=<?=$user['id'];?>">
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
	
<br><br><br><br><br><br><br><br>
<!--footer-->
<?php
include 'footer.php';	
?>
</div>
</body>
</html>