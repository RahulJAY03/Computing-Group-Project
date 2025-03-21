<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    if ($action === 'getCategories') {
        $categoriesCollection = $db->categories;
        $categories = $categoriesCollection->find();
        
        $categoriesList = [];
        foreach ($categories as $category) {
            $categoriesList[] = [
                'id' => (string) $category['_id'],
                'name' => $category['categoryName']
            ];
        }
        echo json_encode($categoriesList);
    } elseif ($action === 'getModules') {
        $modulesCollection = $db->modules;

        $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';

        if (!empty($categoryId)) {
            try {
                // Ensure categoryId is stored as ObjectId in MongoDB
                $objectId = new MongoDB\BSON\ObjectId($categoryId);
                $query = ['categoryId' => $objectId]; 
            } catch (Exception $e) {
                // If ObjectId conversion fails, fallback to string match
                $query = ['categoryId' => $categoryId]; 
            }
            $modules = $modulesCollection->find($query);
        } else {
            $modules = $modulesCollection->find();
        }
        
        $modulesList = [];
        foreach ($modules as $module) {
            $modulesList[] = [
                'id' => (string) $module['_id'],
                'name' => $module['moduleName']
            ];
        }

        if (empty($modulesList)) {
            echo json_encode(["error" => "No modules found for categoryId: $categoryId"]);
        } else {
            echo json_encode($modulesList);
        }
    } else {
        echo json_encode(['error' => 'Invalid action']);
    }
}
?>
