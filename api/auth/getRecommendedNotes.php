<?php
require_once '../../config/db.php';


$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->thekuppiya;
$notesCollection = $db->notes;
$modulesCollection = $db->modules;

$sevenDaysAgo = new MongoDB\BSON\UTCDateTime((new DateTime('-7 days'))->getTimestamp() * 1000);

$topNotes = $notesCollection->find(
    ['created_at' => ['$gte' => $sevenDaysAgo]],
    ['sort' => ['totalLikes' => -1], 'limit' => 4]
);

foreach ($topNotes as $note) {
    $moduleName = 'Unknown Module';
    if (isset($note['moduleId']) && $note['moduleId']) {
        try {
            $moduleId = new MongoDB\BSON\ObjectId($note['moduleId']);
            $module = $modulesCollection->findOne(['_id' => $moduleId]);
            $moduleName = $module['moduleName'] ?? 'Unknown Module';
        } catch (Exception $e) {
            $moduleName = 'Invalid Module ID';
        }
    }
    
    

    $updatedAt = $note['created_at']->toDateTime()->format("M d, Y");
    $fileUrl = "/cgp-sara/uploads/notes/" . basename($note['file_path']);


    echo "
    <div class='note-card'>
      <div class='note-tag'>{$moduleName}</div>
      <h3>{$note['title']}</h3>
      <p>{$note['description']}</p>
      <div class='note-meta'>
        <span><i class='far fa-clock'></i> Updated {$updatedAt}</span>
        <span><i class='fas fa-heart text-danger'></i> {$note['totalLikes']} likes</span>
      </div>
      <div class='actions'>
        <a href='{$fileUrl}' target='_blank'><button class='view'><i class='far fa-eye'></i> View</button></a>
        <a href='{$fileUrl}' download><button class='download'><i class='fas fa-download'></i> Download</button></a>
      </div>
    </div>";
}
?>
