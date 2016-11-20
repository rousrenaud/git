<?php
require_once 'inc/session.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php';
if(!$is_logged){
    header('Location: index.php');
}
elseif($_SESSION['perm'] < 2){
    header('Location: admin_main.php');
}

$post = [];
$errors = [];
$mimeTypeAllow = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
$dirUpload = 'pics/';
$formValid = false;
$pic1_Update = false;
$pic2_Update = false;
$pic3_Update =  false;

//Récupération des données pour affichage des valeurs dans les champs <input>
$select = $bdd->prepare('SELECT * FROM infos');
if($select->execute()){
	$info = $select->fetch(PDO::FETCH_ASSOC);
}

//Vérification du formulaire de mise à jour des coordonnées
if(!empty($_POST)){
	$post = array_map('trim', array_map('strip_tags', $_POST));

	if(!minAndMaxLength($post['carroussel_title1'], 2, 80)){
		$errors['carroussel_title1'] = 'Le premier champ "titre" doit faire entre 2 et 80 caractères';
	}

	if(!minAndMaxLength($post['carroussel_text1'], 2, 500)){
		$errors['carroussel_text1'] = 'Le premier champ "texte" doit faire entre 2 et 500 caractères';
	}

	if(!minAndMaxLength($post['carroussel_title2'], 2, 80)){
		$errors['carroussel_title2'] = 'Le deuxième champ "titre" doit faire entre 2 et 80 caractères';
	}

	if(!minAndMaxLength($post['carroussel_text2'], 2, 500)){
		$errors['carroussel_text2'] = 'Le deuxième champ "texte" doit faire entre 2 et 500 caractères';
	}

	if(!minAndMaxLength($post['carroussel_title3'], 2, 80)){
		$errors['carroussel_title3'] = 'Le troisième champ "titre" doit faire entre 2 et 80 caractères';
	}

	if(!minAndMaxLength($post['carroussel_text3'], 2, 500)){
		$errors['carroussel_text3'] = 'Le troisème champ "texte" doit faire entre 2 et 500 caractères';
	}

//Vérification de l'upload de photo 1
	if(is_uploaded_file($_FILES['photo1']['tmp_name']) || file_exists($_FILES['photo1']['tmp_name'])){
		
		$finfo = new finfo();
		$mimeType = $finfo->file($_FILES['photo1']['tmp_name'], FILEINFO_MIME_TYPE);
		
		if(in_array($mimeType, $mimeTypeAllow)){
			$pic1_Name = uniqid('photo1_');
			$pic1_Name.= '.'.pathinfo($_FILES['photo1']['name'], PATHINFO_EXTENSION);

			if(!is_dir($dirUpload)){
				mkdir($dirUpload, 0755);
			}


			if(!move_uploaded_file($_FILES['photo1']['tmp_name'], $dirUpload.$pic1_Name)){
				$errors['pic1'] = 'Le téléchargement de la première image a échoué';
			}
		$pic1_Update = true;
		}
		else{
			$errors['pic1'] = 'Le type de fichier est invalide. Uniquement jpg/gif/png.'; 
		}
	}
    
    //Vérification de l'upload de photo 2
	if(is_uploaded_file($_FILES['photo2']['tmp_name']) || file_exists($_FILES['photo2']['tmp_name'])){
		
		$finfo = new finfo();
		$mimeType = $finfo->file($_FILES['photo2']['tmp_name'], FILEINFO_MIME_TYPE);
		
		if(in_array($mimeType, $mimeTypeAllow)){
			$pic2_Name = uniqid('photo2_');
			$pic2_Name.= '.'.pathinfo($_FILES['photo2']['name'], PATHINFO_EXTENSION);

			if(!is_dir($dirUpload)){
				mkdir($dirUpload, 0755);
			}


			if(!move_uploaded_file($_FILES['photo2']['tmp_name'], $dirUpload.$pic2_Name)){
				$errors['pic2'] = 'Le téléchargement de la deuxième image a échoué';
			}
		$pic2_Update = true;
		}
		else{
			$errors['pic2'] = 'Le type de fichier est invalide. Uniquement jpg/gif/png.'; 
		}
	}

	//Vérification de l'upload de photo 3
	if(is_uploaded_file($_FILES['photo3']['tmp_name']) || file_exists($_FILES['photo3']['tmp_name'])){
		
		$finfo = new finfo();
		$mimeType = $finfo->file($_FILES['photo3']['tmp_name'], FILEINFO_MIME_TYPE);
		
		if(in_array($mimeType, $mimeTypeAllow)){
			$pic3_Name = uniqid('photo3_');
			$pic3_Name.= '.'.pathinfo($_FILES['photo3']['name'], PATHINFO_EXTENSION);

			if(!is_dir($dirUpload)){
				mkdir($dirUpload, 0755);
			}


			if(!move_uploaded_file($_FILES['photo3']['tmp_name'], $dirUpload.$pic3_Name)){
				$errors['pic3'] = 'Le téléchargement de la première image a échoué';
			}
		$pic3_Update = true;
		}
		else{
			$errors['pic3'] = 'Le type de fichier est invalide. Uniquement jpg/gif/png.'; 
		}
	}

	//Insertion des données dans la DB
	if(count($errors) === 0){
		$columnSql = 'carroussel_title1 = :carroussel_title1, carroussel_text1 = :carroussel_text1, carroussel_title2 = :carroussel_title2, carroussel_text2 = :carroussel_text2, carroussel_title3 = :carroussel_title3, carroussel_text3 = :carroussel_text3 ';

		if($pic1_Update){
			$columnSql.=', photo1 = :photo1';
		}

		if($pic2_Update){
			$columnSql.=', photo2 = :photo2';
		}

		if($pic3_Update){
			$columnSql.=', photo3 = :photo3';
		}

		$insert = $bdd->prepare('UPDATE infos SET '.$columnSql.' WHERE id=1');
			$insert->bindValue(':carroussel_title1', $post['carroussel_title1']);
			$insert->bindValue(':carroussel_title2', $post['carroussel_title2']);
			$insert->bindValue(':carroussel_title3', $post['carroussel_title3']);
			$insert->bindValue(':carroussel_text1', $post['carroussel_text1']);
			$insert->bindValue(':carroussel_text2', $post['carroussel_text2']);
			$insert->bindValue(':carroussel_text3', $post['carroussel_text3']);

		if($pic1_Update){
			$insert->bindValue(':photo1', 'admin/'.$dirUpload.$pic1_Name);
		}

		if($pic2_Update){
			$insert->bindValue(':photo2', 'admin/'.$dirUpload.$pic2_Name);
		}

		if($pic3_Update){
			$insert->bindValue(':photo3', 'admin/'.$dirUpload.$pic3_Name);
		}

		if($insert->execute()){
			$formValid = true;
		}
		else {
            $errors['db'] = 'Il y\'a eu un problème lors de l\'envoi des données';
		}
	}


}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mise à jour du carroussel</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
<?php include_once 'inc/navbar.php'; ?>

<main class="container">
	<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		<div class="col-md-12">
			<h2>Mise à jour du Carroussel</h2>
		</div>

	<!-- Encart carroussel 1 -->
		<div class="form-group">
            	<label class="col-md-4 control-label" for="carroussel_title1">Titre 1</label>  
            	<div class="col-md-6">
            		<input id="carroussel_title1" name="carroussel_title1" type="text"  class="form-control input-md" value="<?php echo $info['carroussel_title1'] ?>">
            		<?php if(isset($errors['carroussel_title1'])){ echo '<span style="color:red;">'.$errors['carroussel_title1'].'</span>';} ?>
            	</div>
        </div>

        <div class="form-group">
            	<label class="col-md-4 control-label" for="carroussel_text1">Texte 1</label>  
            	<div class="col-md-6">
            		<input id="carroussel_text1" name="carroussel_text1" type="text"  class="form-control input-md" value="<?php echo $info['carroussel_text1'] ?>">
            		<?php if(isset($errors['carroussel_text1'])){ echo '<span style="color:red;">'.$errors['carroussel_text1'].'</span>';} ?>
            	</div>
            </div>

        <div class="form-group">
          	<label class="col-md-4 control-label" for="photo1">Photo du carroussel 1</label>  
           	<div class="col-md-6">
           		<input id="photo1" name="photo1" type="file"  class="form-control input-md">
           	</div>
        </div>
           
	<!-- Encart carroussel 2 -->
		<div class="form-group">
            	<label class="col-md-4 control-label" for="carroussel_title2">Titre 2</label>  
            	<div class="col-md-6">
            		<input id="carroussel_title2" name="carroussel_title2" type="text"  class="form-control input-md" value="<?php echo $info['carroussel_title2'] ?>">
            		<?php if(isset($errors['carroussel_title2'])){ echo '<span style="color:red;">'.$errors['carroussel_title2'].'</span>';} ?>
            	</div>
        </div>

        <div class="form-group">
            	<label class="col-md-4 control-label" for="carroussel_text2">Texte 2</label>  
            	<div class="col-md-6">
            		<input id="carroussel_text2" name="carroussel_text2" type="text"  class="form-control input-md" value="<?php echo $info['carroussel_text2'] ?>">
            		<?php if(isset($errors['carroussel_text2'])){ echo '<span style="color:red;">'.$errors['carroussel_text2'].'</span>';} ?>
            	</div>
        </div>

        <div class="form-group">
           	<label class="col-md-4 control-label" for="photo2">Photo du carroussel 2</label>  
           	<div class="col-md-6">
           		<input id="photo2" name="photo2" type="file"  class="form-control input-md">
           	</div>
        </div>

	<!-- Encart carroussel 3 -->
		<div class="form-group">
            	<label class="col-md-4 control-label" for="carroussel_title3">Titre 3</label>  
            	<div class="col-md-6">
            		<input id="carroussel_title3" name="carroussel_title3" type="text"  class="form-control input-md" value="<?php echo $info['carroussel_title3'] ?>">
            		<?php if(isset($errors['carroussel_title3'])){ echo '<span style="color:red;">'.$errors['carroussel_title3'].'</span>';} ?>
            	</div>
        </div>

        <div class="form-group">
            	<label class="col-md-4 control-label" for="carroussel_text3">Texte 3</label>  
            	<div class="col-md-6">
            		<input id="carroussel_text3" name="carroussel_text3" type="text"  class="form-control input-md" value="<?php echo $info['carroussel_text3'] ?>">
            		<?php if(isset($errors['carroussel_text3'])){ echo '<span style="color:red;">'.$errors['carroussel_text3'].'</span>';} ?>
            	</div>
        </div>

        <div class="form-group">
           	<label class="col-md-4 control-label" for="photo3">Photo du carroussel 3</label>  
           	<div class="col-md-6">
           		<input id="photo3" name="photo3" type="file"  class="form-control input-md">
           	</div>
        </div>
            
	<!-- Submit -->
        <div class="form-group">
       	    <div class="col-md-4 col-md-offset-4">
			    <button id="" name="" class="btn btn-info btn-block">Editer</button>
            </div>
        </div>
</main>

</body>
</html>