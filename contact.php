<?php
require_once 'inc/connect.php';
require_once 'inc/functions.php';

$errors = [];

if(!empty($_POST)){
	$post = array_map('trim', array_map('strip_tags', $_POST));

	if(!minAndMaxLength($post['firstname'], 3, 20)){
		$errors[] = 'Votre prénom doit comporter entre 3 et 20 caractères';
	}

	if(!minAndMaxLength($post['lastname'], 3, 20)){
		$errors[] = 'Votre nom doit comporter entre 3 et 20 caractères'; 
	}

	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Votre email est invalide';
	}

	if(!minAndMaxLength($post['message'], 10, 5000)){
		$errors[] = 'Votre message doit comporter entre 10 et 5000 caractères';
	}


	if(count($errors) === 0){
		$insert = $bdd->prepare('INSERT INTO contact(firstname, lastname, mail, mail_content) VALUES(:firstname, :lastname, :mail, :mail_content)'); 

		$insert->bindValue(':firstname', $post['firstname']); 
		$insert->bindValue(':lastname', $post['lastname']); 
		$insert->bindValue(':mail', $post['email']); 
		$insert->bindValue(':mail_content', $post['message']);

		if($insert->execute()){
			$formValid = true;
		}
		else {
			var_dump($insert->errorInfo());
			die;
		}
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact</title>
	
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
                    <li>
                        <a class="page-scroll" href="list_recette.php">RECETTE</a>
                    </li>
                    <li class="active1">
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
	<img src="img/contactback.jpg" class="img-responsive" alt="Responsive image">
</div>
	
<br><br>
<!--Contact form-->
<?php if(count($errors) > 0): ?>
			<div class="alert alert-danger">
				<?=implode('<br>', $errors);?>
			</div>
		
		<?php elseif(isset($formValid) && $formValid == true): ?>

			<div class="alert alert-success">
				Votre message a bien été envoyé
			</div>
		<?php endif; ?>
	
<div class="container" id="formmargin">
	<form class="form-horizontal" method="post">
	  <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">Nom</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" placeholder="Nom" name="lastname" id="lastname">
		</div>
	  </div>
	  <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">Prénom</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" placeholder="Prénom" name="firstname" id="firstname">
		</div>
	  </div>
	  <div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" placeholder="Email" name="email" id="email">
    </div>
	  </div>
	  <div class="form-group">
		<label for="message" class="col-sm-2 control-label">Message</label>
		<div class="col-sm-10">
		  <textarea class="form-control" rows="10" name="message" id="message"></textarea>
		</div>
	  </div>
	  
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <div class="btnalign">
				<a href="view_recette.php?id=">
					<button type="submit" class="btn btn-danger" name="submit" id="submit">Envoyer 
					</button>
				</a>
			</div>
		</div>
	  </div>
	</form>
</div>
	
<br><br><br><br><br><br><br><br>
<!--footer-->
<?php
include 'footer.php';	
?>
</div>
</body>
</html>