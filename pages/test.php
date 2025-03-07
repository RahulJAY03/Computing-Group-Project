<?php
require __DIR__ . '/../vendor/autoload.php'; // Load MongoDB Library

try {
    // Connect to MongoDB
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");

    // Select the database
    $database = $mongoClient->thekuppiya;

    // Print success message
    echo "<h2>✅ Connected to MongoDB successfully!</h2>";

    // List all collections in the database
    $collections = $database->listCollections();
    echo "<h3>Available Collections:</h3><ul>";
    foreach ($collections as $collection) {
        echo "<li>" . $collection->getName() . "</li>";
    }
    echo "</ul>";

} catch (Exception $e) {
    echo "<h2>❌ Connection Failed: " . $e->getMessage() . "</h2>";
}
?>
