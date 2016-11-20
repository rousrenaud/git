<?php
/**
 * Vérifie que la longueur d'une chaine se situe entre $min et $max caractères
 * @param string $str La chaine à vérifier
 * @param int $min La longueur minimale
 * @param int $max La longueur maximale
 * @return bool TRUE Si la longueur est ok, FALSE sinon
 */
function minAndMaxLength($str, $min = 2, $max = 255){

	// On vérifie que la chaine soit remplie et bien de type string, sinon on retourne un message d'erreur
	if(empty($str) || !is_string($str)){
		return false;
	}

	// On effectue la vérification sur la longueur de la chaine
	if(strlen($str) >= $min && strlen($str) <= $max){
		// Ici la longueur est ok
		return true;
	}
	else {
		// Ici la longueur n'est pas bonne
		return false;
	}
}



/** 
 * Vérifie l'existence d'une adresse email
 * @param string $email L'adresse email qu'on souhaite vérifier
 * @param obj $bdd La connexion à PDO
 * @return bool TRUE si l'email existe, false sinon
 */
function emailExist($email, $bdd){

	// On vérifie que $email & $bdd ne soient pas vides
	if(!empty($email) && !empty($bdd)){

		// On effectue la requete
		$check = $bdd->prepare('SELECT * FROM users WHERE mail = :mail');
		$check->bindValue(':mail', $email);
		if($check->execute()){
			if($check->fetchColumn() > 0){
				return true;
			}
		}
	}

	return false;
}