<?php

require '../conf/config.php';
require '../lib/util.php';
$dataArray = getFriendlyData($_POST['form']);

	$pieces = explode("-", $dataArray['birth_date']);
	//echo 'info-'. $pieces[0] . $pieces[1] . $pieces[2]; // piece3

	if ($pieces[0] < 1900 || $pieces[0] > date('Y')){
		echo 'info-'.'U bent te oud of bestaat nog niet!';
	}
	
	if ($pieces[1] < 1 || $pieces[1] > 12){
		echo 'info-'.'De maand waar u in geboren bent, kennen we niet op aarde!';
	}
	
	if ($pieces[2] < 1 || $pieces[2] > 31){
		echo 'info-'.'De dag heeft niet de goede waarde!';
	}
	
	if ($pieces[2] == 31 && $pieces[1] == 4){
		echo 'info-'.'Deze maand heeft niet zoveel dagen!';
	}
	
	if ($pieces[2] == 31 && $pieces[1] == 6){
		echo 'info-'.'Deze maand heeft niet zoveel dagen!';
	}
	
	if ($pieces[2] == 31 && $pieces[1] == 9){
		echo 'info-'.'Deze maand heeft niet zoveel dagen!';
	}
        
	if ($pieces[2] == 31 && $pieces[1] == 11){
		echo 'info-'.'Deze maand heeft niet zoveel dagen!';
	}
	
	if ($pieces[2] > 29 && $pieces[1] == 2){
		echo 'info-'.'U bent geboren op een rare dag!';
	}
	
	
$return = User::register($db, $dataArray['username'], $dataArray['password1'], $dataArray['password2'], $dataArray['first_name'], $dataArray['last_name'], $dataArray['student_number'], $dataArray['birth_date'], $dataArray['email'], $dataArray['avatar_url']);
if ($return === true) {
    print 'info-Gebruiker geregistreerd!';
} else {
    print 'error-'.$return;
}