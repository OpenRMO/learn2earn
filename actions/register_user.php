<?php

require '../conf/config.php';
require '../lib/util.php';
$dataArray = getFriendlyData($_POST['form']);

$pieces = explode("-", $dataArray['birth_date']);
echo 'info-'. $pieces[0] . $pieces[1] . $pieces[2]; // piece3

$return = User::register($db, $dataArray['username'], $dataArray['password1'], $dataArray['password2'], $dataArray['first_name'], $dataArray['last_name'], $dataArray['student_number'], $dataArray['birth_date'], $dataArray['email']);
if ($return === true) {
    print 'info-Gebruiker geregistreerd!';
} else {
    print 'error-'.$return;
}