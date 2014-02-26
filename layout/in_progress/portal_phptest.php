<?php
require_once "../../config/config.inc.php";

	$temp = $db->select("courses", array("course_id"), array("project_id"=>$projects[$periode-1]));
	
	if($temp != null)
	{

		$numberOfCourses = 0;

		foreach($temp as $value)
		{
			$numberOfCourses++;
		}

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
		for($i=1;$i<=$numberOfCourses;$i++)
		{
			echo "<link rel='stylesheet' type='text/css' href='styles/teststyle.php' />";
			echo "<tr>
				 <td> les ".$i."</td>
				 <td>
				 <div style='background-color: #cbcbcb;
							 border-radius: 13px; padding: 3px;'>
				 <div style='background-color: #51A6E2;
							 width: ";
			//Output progress
			$progress = $db->select("users_courses", array("xp_earned"), array("course_id"=>$temp[$i-1]["course_id"], "user_id"=>$_SESSION["id"]));
			if($progress[0]["xp_earned"] != null)
			{
				echo $progress[0]["xp_earned"];
			}
			else
			{
				echo "0";
			}
			
			echo "%;
							 height: 20px;
							 border-radius: 10px;'>
				 </div>
				 </div>
				 </td>
			 </tr>";
		}
	}
?>