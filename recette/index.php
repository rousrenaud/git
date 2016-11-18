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
                        <a class="page-scroll" href="../index.php">ACCUEIL</a>
                    </li>
                    <li class="active">
                        <a class="page-scroll" href="recette/index.php">RECETTE</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="contact/index.php">CONTACT</a>
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
<div class="container recette_select">
	<div class="recette_text">
		<p class="recette_text_align">Découvrez toutes nos recettes</p>
	</div>
	
	
	<div class="form-group">
		<div class="input-group">
		  <select class="form-control searchbar_taille">
		  <option>Nouveauté</option>
		  <option>Cuisine française</option>
		  <option>Cuisine asiatique</option>
		  <option>Crèpe</option>
		  <option>Soupe</option>
		  <option>Dessert</option>
		</select>
		  <div class="input-group-addon btn btn-danger">
			<i class="fa fa-search" aria-hidden="true"></i>	
		  </div>
		</div>
  	</div>	
</div>
	
<!--section d'example de recette-->
<div class="bs-example recettemargin" data-example-id="thumbnails-with-custom-content">
	<div class="row" style="margin: -80px;">
	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <img src="img/thai-food-518035_640.jpg" alt="nouveaute" class="recettehover">
		  <div class="caption">
			<h3 class="nouveaute_color">Recette Title</h3>
		  </div>
		</div>
	  </div>

	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <img src="img/pancakes-984439_640.jpg" alt="crepes" class="recettehover">
		  <div class="caption">
			<h3>Recette Title</h3>
		  </div>
		</div>
	  </div>

	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <img src="img/green-dragon-vegetable-1707089_640.jpg" alt="vegetable" class="recettehover">
		  <div class="caption">
			<h3>Recette Title</h3>
		  </div>
		</div>
	  </div>
		
	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <img src="img/green-dragon-vegetable-1707089_640.jpg" alt="vegetable" class="recettehover">
		  <div class="caption">
			<h3>Recette Title</h3>
		  </div>
		</div>
	  </div>
	</div>
</div>	
<!--footer-->
<div style="clear:both;"></div>
	
<div class="container footer">
	<p><i class="fa fa-copyright" aria-hidden="true"></i> Copyright - Azerquipe3</p>
</div>

</div>
</body>
</html>