<?php
include("config/config.inc.php");
echo "B'naan";
print_r("<pre>");
print_r($db->select("users"));
User::login($db,"Thomas Goudbeek","test");
print_r($db->last_query());
print_r("</pre>");
?>