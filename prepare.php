<?php

session_start();
include('parts/head.php');
if (isset($_SESSION['id'])) {
    include('conf/config.php');
    include('parts/auth/nav/navbar.php');
} else {
    include('parts/nav/navbar.php');
}
