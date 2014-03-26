<?php
header('Access-Control-Allow-Origin: http://learn2earn.veluwscollege.net');
function parse_link($href, $return = false) {
    if ($return) {
        return '' . $href;
    }
    echo '' . $href;
}

include(parse_link('lib/util.php', true));
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

function __autoload($n) {
    if (file_exists($n . ".class.php")) {
        include($n . ".class.php");
    } elseif (file_exists("classes/" . $n . ".class.php")) {
        include("classes/" . $n . ".class.php");
    } elseif (file_exists("../classes/" . $n . ".class.php")) {
        include("../classes/" . $n . ".class.php");
    } elseif (file_exists("../../classes/" . $n . ".class.php")) {
        include("../../classes/" . $n . ".class.php");
    } else {
        trigger_error("Cannot find class " . $n, E_ERROR);
    }
}

if(file_exists("../.htaccess")) {
    $_CONFIG['base_dir'] = str_replace($_SERVER['DOCUMENT_ROOT'], "", realpath(dirname("../.htaccess")));
} else {
    $_CONFIG['base_dir'] = "";
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $_CONFIG['base_url'] = "https://".$_SERVER['HTTP_HOST'] . $_CONFIG['base_dir'] . "/";
} else {
    $_CONFIG['base_url'] = "http://".$_SERVER['HTTP_HOST'] . $_CONFIG['base_dir'] . "/";
}
session_start();
$db = new Database();
?>