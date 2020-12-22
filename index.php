<?php
    // Le front controller
    // C'est le seul fichier de dialogue avec l'utilisateur

require "vendor/autoload.php";
require "config.php";

use App\Service\RouterService;

session_start();
/*
    $response est le retour du contrôleur nécessaire à la requête du client {

        "view" => La vue à afficher au client
        "data" => Les données pour remplir la vue
    }

*/
$response = RouterService::handleRequest($_GET);

/*-----CHARGEMENT DE LA REPONSE AU CLIENT-----*/
// Tamporisation de sortie / output buffer
ob_start(); 
// Tous les affichages à partir de ob_start() se stockent dans un tampon de sortie
include TEMPLATE_DIR.$response["view"];

// Ici je récupèrece qu'il'y a dans le tampon et le met dans une variable
// (Au lieu de l'afficher directement)
$page = ob_get_contents();

// Je vide le tampon, qui ne me sert plus à rien depuis qu'on a stocké dans une variable
// Le contenu de celui-ci
ob_end_clean();

include TEMPLATE_DIR."layout.php";
