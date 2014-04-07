<?php
require '../conf/config.php';
require '../lib/util.php';

if(!isset($_POST['filename']) || !isset($_FILES)){
    die(print 'Ja, dit mag dus niet eh?!');
}
print_r($_FILES['file']);
$fileUpload = File::uploadFile($_FILES['file']);
$fileUrl = $fileUpload[1];
print $fileUrl;