<?php

// Insert 

$baseUrl = 'http://'.$_SERVER['HTTP_HOST'].'/?q=';
$code = uniqid();

$filterUrl = htmlspecialchars($_GET['target'], ENT_QUOTES, 'UTF8');
$filterUrl = filter_var($filterUrl,FILTER_VALIDATE_URL);
var_dump($filterUrl);

$query = $database->prepare('INSERT INTO urls (code, target) VALUES (:code, :target)');
$query->execute([
	':code' => $code,
	':target' => $filterUrl
]);

// On retourne une url constituée de l'adresse de base + le code généré
// en cliquant sur celle-ci, on peut accéder au site

header('Content-Type: application/json');
die(json_encode([
	'url' => $baseUrl.$code
]));