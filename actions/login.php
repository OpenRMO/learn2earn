<?php

require '../conf/config.php';
require '../lib/util.php';
$dataArray = getFriendlyData($_POST['form']);
$db = new Database();
if (User::login($db, $dataArray['username'], $dataArray['password'])) {
    print 'relocate-portal.php';    
} else {
    print 'info-Het inloggen is mislukt!';
}
?>

