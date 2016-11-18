<?php

/**
 * Vérifie que la longueur d'une chaine se situe entre $min et $max caractères
 * @param string $str - La chaine à vérifier
 * @param int $min - La longueur minimale
 * @param int $max - La longueur maximale
 * @return bool - TRUE si la longueur est ok, FALSE sinon
 */
function minAndMaxLength($str, $min = 2, $max = 255){

	// On vérifie que la chaine soit remplie et bien de type string, sinon on retourne un message d'erreur
	if(empty($str) || !is_string($str)){
		return trigger_error('Le paramètre $str est invalide', E_USER_WARNING);
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
