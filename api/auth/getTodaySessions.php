<?php
require_once '../../config/db.php';


$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->thekuppiya;
$sessionsCollection = $db->sessions;

$startOfToday = new MongoDB\BSON\UTCDateTime((new DateTime('today'))->getTimestamp() * 1000);

$todaySessions = $sessionsCollection->find(
    ['date' => ['$gte' => $startOfToday]],
    ['sort' => ['time' => 1], 'limit' => 3]
);

foreach ($todaySessions as $session) {
    $sessionTime = $session['time'];
    $sessionDay = (new DateTime())->format('Y-m-d') === $session['date']->toDateTime()->format('Y-m-d') ? 'Today' : $session['date']->toDateTime()->format('M d');
    $host = explode('-', $session['hostedBy'])[0] ?? 'Unknown';

    echo "
    <div class='session-card'>
      <div class='session-time'>
        <span class='time'>{$sessionTime}</span>
        <span class='day'>{$sessionDay}</span>
      </div>
      <div class='session-info'>
        <h4>{$session['topic']}</h4>
        <p><i class='fas fa-user-tie'></i> {$host}</p>
       
      </div>
      <a href='{$session['meetingLink']}' target='_blank'><button class='join'>Join Now</button></a>
    </div>";
}
?>
