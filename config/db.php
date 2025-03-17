<?php
header("Cross-Origin-Opener-Policy: same-origin-allow-popups");
header("Cross-Origin-Embedder-Policy: require-corp");
header("Access-Control-Allow-Origin: *"); // Or specify allowed domains
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


require_once __DIR__ . '/../vendor/autoload.php';
// If vendor is in the parent directory
; // Ensure MongoDB driver is loaded

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->thekuppiya; // Replace with your database name
?>
