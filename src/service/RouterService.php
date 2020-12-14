<?php

namespace App\Service;

abstract class RouterService {

    /**
     * prise en charge des paramètres d'une requête GET
     * 
     * @param array $params Les paramètres de l'uri ($params)
     * @return array La réponse correspondante au return d'un contrôleur
     */
    public static function handleRequest($params) :array {

        /*-----APPEL DU CONTROLEUR-----*/
    $class = "Store"; // Contrôleur par défaut
    
    if(isset($params['ctrl'])) { // ctrl = admin
        $uri_class = ucfirst($params['ctrl']); // $uri_class = "Admin"
        // On vérifie que App\Controller\AdminController existe
        if(class_exists("App\Controller\\".$uri_class."Controller")) {
            // Le contrôleur à appeler devient la classe contenue dans l'uri (uri = url + request parameters)
            $class = $uri_class;
        }
    }
    // ucfirst($params['ctrl']) => Store
            $class = ucfirst($class);
    // App\Controller\StoreController => Fully Qualified Class Name (FQCN)
    $className = "App\Controller\\".$class."Controller";

    $controller = new $className(); // App\Controller\StoreController

/*-----APPEL DE LA METHODE DANS LE CONTROLEUR-----*/    
    $method = "indexAction"; // Méthode par défaut

    if(isset($params['action'])) { // action = list

        $uri_method = $params['action']."Action"; // $uri_method = "listAction"
        // On vérifie si la méthode listAction est une méthode du contrôleur
        if(method_exists($controller, $uri_method)) {
            // La méthode à appeler est celle provenant de l'uri
            $method = $uri_method;
        }
    }

/*-----PRISE EN CHARGE DU PARAMETRE OPTIONNEL $params['id']-----*/
    $id = null; // Pas d'id par défaut

    if(isset($params['id'])) {
        $id = $params['id'];
    }    
    // StoreController::listAction()
    return $controller->$method($id);// Appel de la méthode du contrôleur
    }
}