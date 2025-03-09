<?php
require_once __DIR__ . '/../vendor/autoload.php';
// If vendor is in the parent directory
; // Ensure MongoDB driver is loaded

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->thekuppiya; // Replace with your database name
?>
