<?php

require '../conf/config.php';
require '../lib/util.php';

$dataArray = getFriendlyData($_POST['form']);

echo "error-";
die(print_r($dataArray['clusters']));

if (!isset($dataArray['name']) || !isset($dataArray['priority']) || !isset($dataArray['description']) || !isset($dataArray['background']) || !isset($dataArray['cluster'])) {
    die(print 'error-Niet alle waarden zijn ingevuld!');
}

$dataArray['background'] = ltrim($dataArray['background'],'#');
$project = new Project($db, Project::add($db, $dataArray['name'], $dataArray['description'], "", $dataArray['priority'], $dataArray['background'], array()));
print 'info-Toegevoegd!';
?>