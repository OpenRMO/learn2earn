<?php
include('prepare.php');
$user = new User($db, $_SESSION["id"]);
include('actions/check_login.php');
include('actions/load_projects.php');
?>

<div id="wrapper">

    <?php
    $i = 0;
    foreach ($projects as $project) {
        $p = new Project($db, $project);
        print '<div class="float-left portalColumn portalColumnVisible text-center" style="background-color: #' . $p->getBackground() . ';">';
        $p->toString();
        print '<div id="photoshop_updates" class="updates"><p>Updates</p>';
		$courses = $p->getCourses();
		$lesson = 0;
		echo "<table class=\"lessons\">";
		foreach ($courses as $val) {
                $lesson++;
				$course_id = $val->getID();
                echo "<tr>"
                . "<td>"."<a href='lessons.php?course=".$course_id."'>Les " . $lesson . "</a></td>"
                . "<td>"
                . "<div class=\"progressbar\" class=\"width:100%;\" data-color=\"#".$p->getBackground()."\" data-value=\"".$val->getUserXP($user)."\" data-max=\"".$val->getMaxXP()."\"></div>"
                . "</td>"
                . "</tr>";
				
            }
            echo "</table></div></div>";
        $i++;
        //Keep in mind that a PHP-array starts with zero (0), so there will be $i+1 cols.
        if ($i > 6) {
            break;
        }
    }
    ?>


    <div id="scrollbar_photoshop" class="scrollbar">
        <table>
		
        </table>
    </div>


</div>
<?php include('parts/footer.php'); ?>