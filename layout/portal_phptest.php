<?php
require_once "../config/config.inc.php";

	$temp = $db->select("courses", array("course_id"), array("project_id"=>$projects[$periode-1]));
	
	if($temp != null)
	{

		$numberOfCourses = count($temp);

		if($periode===1)
		{
		echo "<col id='column_lesson_photoshop'/>
			  <col span='2' id='column_progress_photoshop'/>";
		}
		else if($periode===2)
		{
			echo "<col id='column_lesson_html_css'/>
				  <col span='2' id='column_progress_html_css'/>";
		}
		else if($periode===3)
		{
			echo "<col id='column_lesson_flash'/>
					<col span='2' id='column_progress_flash'/>";
		}
		else if($periode===4)
		{
			echo "<col id='column_lesson_premiere_pro'/>
					<col span='2' id='column_progress_premiere_pro'/>";
		}
		for($i=0;$i<$numberOfCourses;$i++)
		{
			$les = $temp[$i]["course_id"];
			echo "<tr>
				 <td> <a href='lessons.php?l=$les'>les ".($i + 1)."</a></td>
				 <td>
				 <div class='progress_bar'>
				 <div class='progress' style='width: ";
			//Output progress
			$progress = $db->select("users_courses", array("xp_earned"), array("course_id"=>$temp[$i]["course_id"], "user_id"=>$_SESSION["id"]));
			if($progress[0]["xp_earned"] != null)
			{
				echo $progress[0]["xp_earned"];
			}
			else
			{
				echo "0";
			}
			
			echo "%;'>
				 </div>
				 </div>
				 </td>
			 </tr>";
		}
	}
?>