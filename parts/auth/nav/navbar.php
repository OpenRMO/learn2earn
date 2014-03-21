<body>
<div id="navbar">
    <span class="float-left devider">Welkom, <?php $u = new User($db, $_SESSION['id']); print $u->getFirstName(); ?>!</span>
    <ul>
        <li><a href="<?php parse_link('portal.php');?>">Home</a></li>
        <li><a href="<?php parse_link('manage.php');?>">Beheer</a></li>
        <li><a href="<?php parse_link('logout.php');?>">Log uit</a></li>
    </ul>
</div>