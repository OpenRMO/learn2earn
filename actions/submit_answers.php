<?php
require '../conf/config.php';
require '../lib/util.php';
$db = new Database();
if (!isset($_SESSION['id'])) {
    die('relocate-index.php');    
}

print 'info-';
//$formdata = getFriendlyData($_POST, true);
print_r($_POST);
$db->update('users_courses', array('description_inlever'=>$formdata['description_inlever'], 'file'=>$formdata['file']), array('user_id'=>$_SESSION['user_id'], 'course_id'=>$formdata['course']));

?>