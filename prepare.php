<?php

include('parts/head.php');
include('conf/config.php');
if (isset($_SESSION['id'])) {
    include('parts/auth/nav/navbar.php');
} else {
    include('parts/nav/navbar.php');
}
