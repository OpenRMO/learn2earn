<?php

require '../conf/config.php';
require '../lib/util.php';

if (!isset($_POST['filename']) || !isset($_POST['course_id']) || !isset($_FILES)) {
    die(print 'Ja, dit mag dus niet eh?!');
}
$file = new File($_FILES['file']);
$file->setFilename($_POST['filename']);
$file->uploadFile() or die(print 'Er is een fout: ' . $file->getError());
$course_id = $db->real_escape_string($_POST['course_id']);

$file_id = $db->insert('files', array("filename" => $file->getFilename(), "filepath" => $file->getPath()), true);
$db->insert("files_courses", array('file_id' => $file_id, 'course_id' => $course_id));

header('Location: http://learn2earn.veluwscollege.net/manage.php');