<?php
require '../conf/config.php';
require '../lib/util.php';

$dataArray = getFriendlyData($_POST['form']);

$project = new Project($db, $dataArray['add_to_project']);

Course::add($db, $dataArray['name'], $project, $dataArray['deadline'], $dataArray['youtube'], $dataArray['description_course'], $dataArray['deadline'], $dataArray['max_xp']);

print 'info-Les toegevoegd!';
?>