<?php
include('prepare.php');
$user = new User($db, $_SESSION["id"]);
include('actions/load_projects.php');
?>
<div id="wrapper">

    <?php
    $i = 0;
    foreach ($projects as $project) {
        $p = new Project($db, $projects[$i]);
        print '<div class="float-left portalColumn text-center" style="background-color: #' . $p->getBackground() . ';">';
        $p->toString();
        print '<div id="photoshop_updates" class="updates"><p>Updates</p></div></div>';
        $i++;
        //Keep in mind that a PHP-array starts with zero (0), so there will be $i+1 cols.
        if ($i > 6) {
            break;
        }
    }
    ?>


    <div id="scrollbar_photoshop" class="scrollbar">
        <table>
            <?php
            $periode = 1;
            //include "portal_phptest.php";
            ?>
        </table>
    </div>


</div>
<?php include('parts/footer.php'); ?>