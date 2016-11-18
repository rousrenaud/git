<?php

session_start();

//Permet de vérifier que la session existe et donc que l'utilisateur est connecté.
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
    $is_logged = true;
}
else{
    $is_logged = false;
}