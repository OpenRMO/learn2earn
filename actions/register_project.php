<?php

require '../conf/config.php';
require '../lib/util.php';

$dataArray = getFriendlyData($_POST['form']);

if (!isset($dataArray['name']) || !isset($dataArray['period']) || !isset($dataArray['max_xp']) || !isset($dataArray['background']) || !isset($dataArray['cluster'])) {
    die(print 'error-Niet alle waarden zijn ingevuld!');
}
$project = new Project($db, Project::add($db, $dataArray['name'], $dataArray['description'], $dataArray['max_xp'], $dataArray['period'], $dataArray['cluster'], $dataArray['background']));
print 'info-Toegevoegd!';
?>