<?php

require 'templates/activitystream.php';

// Проверка входных данных
if (!isset($_POST['userid']) || !isset($_POST['projectid']) || !isset($_POST['from']) || !isset($_POST['to']) || !isset($_POST['type'])) {
    die('Missing required POST parameters');
}

$user_id = (int)$_POST['userid'];
$project_id = (int)$_POST['projectid'];
$from = (int)$_POST['from'];
$to = (int)$_POST['to'];
$type = filter_var($_POST['type'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

$result = $this->getTicketsActivityStream($user_id, $project_id, $from, $to);

// Отладка результата
// var_dump($result);

if ($user_id == 0 && !empty($result)) {
    activityForeach($result, 0);
} elseif ($type === true && !empty($result['mine'])) {
    activityForeach($result['mine'], 0);
} elseif ($type === false && !empty($result['other'])) {
    activityForeach($result['other'], 0);
}
?>