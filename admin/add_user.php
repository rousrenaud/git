<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php';
require_once '../vendor/autoload.php';
if(!$is_logged){
    header('Location: index.php');
}
elseif($_SESSION['perm'] < 2){
    header('Location: admin_main.php');
}

$pwd = 'abcdefghiKLMNOPQR02468';
$post = [];
$errors = [];

if(!empty($_POST)){
	$post = array_map('trim', array_map('strip_tags', $_POST)); 

	if(!minAndMaxLength($post['firstname'], 3, 20)){
		$errors['firstname'] = 'Votre prénom doit comporter entre 3 et 20 caractères';
	}

	if(!minAndMaxLength($post['lastname'], 3, 20)){
		$errors['lastname'] = 'Votre nom doit comporter entre 3 et 20 caractères';
	}

	if(!preg_match('/[a-z\.\-]+@[a-z]+\.[a-z]{2,3}/i',$post['mail'])){
		$errors[] = 'Votre email est invalide';
	}

	elseif(isset($post['mail'])){
        $req = $bdd->prepare('SELECT mail FROM users WHERE mail = :mail');
        $req->bindValue(':mail', $post['mail']);
        if($req->execute()){
            if($req->rowCount() !=0){
                $errors[] = 'Le mail rentré existe déjà';
            }
        }
    }
    
    if(!isset($post['perm']) || !is_numeric($post['perm'])){
        $errors['perm'] = 'Il faut sélectionner un niveau de permissions';
    }
    
	if(count($errors) === 0){
		$insert = $bdd->prepare('INSERT INTO users (perm, firstname, lastname, mail, password) VALUES (:perm, :firstname, :lastname, :mail, :password)');
		
		$insert->bindValue(':perm', $post['perm']);
		$insert->bindValue(':firstname', $post['firstname']);
		$insert->bindValue(':lastname', $post['lastname']);
		$insert->bindValue(':mail', $post['mail']);
		$insert->bindValue(':password', password_hash($pwd, PASSWORD_DEFAULT));
        
		if($insert->execute()){
			$formValid = true;
            /*$monMessage = 'Vous avez reçu une invitation pour ajouter du contenu sur <b>O\'Fifou</b>.<br>Vous pouvez vous y connecter à partir du lien suivant:<br><a href="localhost/admin/index.php"<br>
            Vos coordonnées sont:<ul><li>Mail : '.$post['mail'].'</li><li>Mot de passe : '.$pwd.'</li>';
                
                $mail = new PHPMailer;
                
                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.mailgun.org';                       // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username = 'postmaster@dev.axw.ovh';             // SMTP username
                $mail->Password = 'WF3Phil0#3';                         // SMTP password
                $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                      // TCP port to connect to
                
                $mail->CharSet = 'UTF-8';
                
                $mail->setFrom('cpasbon@example.com', 'Mailer');
                $mail->addAddress($post['mail']);               // Name is optional
                
                $mail->Subject = 'Inscription o\'Fifou';
                $mail->Body = $monMessage ;
                $mail->AltBody = $monMessage;
                
                if(!$mail->send()) {
                    $errors[] = 'Le message n\'a pas été evoyé.';
                    $errors[] = 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $success = true;
                }*/
		}
		else {
			var_dump($insert->errorInfo());
		}
	}
    
}
if(isset($_GET['id']) && is_numeric($_GET['id'])){

	$select = $bdd->prepare('SELECT * FROM users WHERE id = :idUser');
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
	<title>Ajouter un utilisateur</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
	<?php include_once 'inc/navbar.php' ?>

	<main class="container">

		<h1 class="text-center text-info">
			<i class="fa fa-user-plus"></i> Ajouter un utilisateur
		</h1>
		
		<hr>

		<?php if(count($errors) > 0): ?>

			<div class="alert alert-danger">
				<?=implode('<br>', $errors);?>
			</div>

		<?php elseif(isset($formValid) && $formValid == true): ?>

			<div class="alert alert-success">
				L'utilisateur a bien été créé
			</div>
		<?php endif; ?>
		
		<?php if(!isset($formValid)): ?>
			<form method="POST" class="form-horizontal">
			
				<!-- Prénom -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="firstname">Prénom</label>  
					<div class="col-md-6">
						<input id="firstname" name="firstname" type="text" class="form-control input-md" placeholder="Son prénom..">
						<p id="firstname_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['firstname'])){echo $errors['firstname'];} ?>
                        </p>
					</div>
				</div>
				
				<!-- Nom de famille -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="lastname">Nom</label>  
					<div class="col-md-6">
						<input id="lastname" name="lastname" type="text" class="form-control input-md" placeholder="Son nom..">	  
						<p id="lastname_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['lastname'])){echo $errors['lastname'];} ?>
                        </p>  
					</div>
				</div>
				
				<!-- Email-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="mail">Email</label>  
					<div class="col-md-6">
						<input id="mail" name="mail" type="mail" class="form-control input-md" placeholder="Son Email..">
						<p id="mail_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['mail'])){echo $errors['mail'];} ?>
                        </p>
					</div>
				</div>
				
				<!-- Type d'utilisateur -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="perm">Type d'utilisateur</label>
					<div class="col-md-4">
						<select id="perm" name="perm" class="form-control">
							<option value="" selected disabled>Type d'utilisateur</option>
							</option>
							<option value="2" >Administrateur</option>
							</option>
							<option value="1" >Editeur</option>
							</option>
						</select>
						<p id="perm_help" class="form-text text-muted" style="color:red;">
                            <?php if(!empty($errors['perm'])){echo $errors['perm'];} ?>
                        </p>
					</div>
				</div>	
				
				<!-- Submit -->
				<div class="form-group">
					<div class="col-md-4 col-md-offset-4">
						<button id="" name="" class="btn btn-info btn-block">Ajouter !</button>
					</div>
				</div>
				
			</form>
		<?php endif; ?>
	</main>
</body>
</html>