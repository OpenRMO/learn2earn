<?php

require '../conf/config.php';
require '../lib/util.php';

$dataArray = getFriendlyData($_POST['form']);

if (!isset($dataArray['name']) || !isset($dataArray['priority']) || !isset($dataArray['description']) || !isset($dataArray['background']) || !isset($dataArray['clusters'])) {
    die(print 'error-Niet alle waarden zijn ingevuld!');
}

$dataArray['background'] = ltrim($dataArray['background'],'#');
$icon = File::uploadFile($dataArray['file']);
$icon = $icon[1];
$project = new Project($db, Project::add($db, $dataArray['name'], $dataArray['description'], "", array(),  $dataArray['background'], $dataArray['priority']));
print 'info-Toegevoegd!';
?>