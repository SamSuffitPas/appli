<?php

namespace App\Controller;

use App\Manager\ProductManager;

class StoreController {
    
    private $manager;

    public function __construct() {
        $this->manager = new ProductManager();
    }

    public function indexAction() {
        // On récupère les produits depuis le modèle
        $products = $this->manager->getAll();

        // Deviendra $response dans index.php
        return [
            "view" => "list.php",
            "data" => $products
        ];
    }

    public function voirAction($id) {

        $product = $this->manager->getOneById($id);

        return [
            "view" => "voir.php",
            "data" => $product
        ];
    }
}