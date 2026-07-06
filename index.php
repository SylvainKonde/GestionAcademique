<?php
session_start();
require_once __DIR__ .'/vendor/autoload.php';

$requestUri = $_SERVER['REQUEST_URI'];

// Supprime les paramètres de requête, si présents
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// Table de routage (URI => fichier PHP à inclure)
$routesGetMethode = [
    '/' => __DIR__ . '/views/index.html',
    '/login' => __DIR__ . '/views/login.html',
    '/agence' => __DIR__ . '/views/agence/agence.php',
    '/home' => __DIR__ . '/views/home/home.php',
    '/client' => __DIR__ . '/views/client/client.php',
    '/bus' => __DIR__ . '/views/agence/agencemtm/bus.php',

    '/deconnexion' => __DIR__ . '/scripts/client/deconnexion.php',
    '/get_agence' => __DIR__ . '/scripts/agence/get_agence.php',
    '/get_client' => __DIR__ . '/scripts/client/get_client.php',
    '/get_bus' => __DIR__ . '/scripts/bus/get_bus.php',
    '/get_trajet' => __DIR__ . '/scripts/trajet/get_trajet.php',

];
$routesPostMethod = [
    '/login' => __DIR__ . '/scripts/client/login.php',
    '/add_client' => __DIR__ . '/scripts/client/add_client.php',
    '/delete_client' => __DIR__ . '/scripts/client/delete_client.php',

    '/add_achat' => __DIR__ . '/scripts/achat/add_achat.php',
    '/add_bus' => __DIR__ . '/scripts/bus/add_bus.php',
    '/add_trajet' => __DIR__ . '/scripts/trajet/add_trajet.php',
    '/add_vente' => __DIR__ . '/scripts/vente/add_vente.php',
];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if (array_key_exists($requestPath, $routesGetMethode)) {
        require $routesGetMethode[$requestPath];
    } else {
        http_response_code(404);
        echo "Page not found 404.";
    }   
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (array_key_exists($requestPath, $routesPostMethod)) {
        require $routesPostMethod[$requestPath];
    } else {
        http_response_code(404);
        echo "Page de scripts not found. Et non trouvé!";
    }
}else{
    echo "Méthode non autorisé";
}
