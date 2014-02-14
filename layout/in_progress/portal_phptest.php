<?php
require_once "../../config/config.inc.php";

$temp = $db->select("users_clusters", array("cluster_id"), array("user_id"=>$_SESSION["id"]));
$clusterOfUser = $temp[0]["cluster_id"];
$temp = $db->select("clusters_projects", array("project_id"), array("cluster_id"=>$clusterOfUser));
if($temp != null)
{
	$projects = array();
	foreach($temp as $value)
	{
		array_push(&$projects, $value["project_id"]);
	}
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
			echo "<tr>
				 <td> les ".$i."</td>
				 <td> voortgang</td>
			 </tr>";
		}
	}
}

?>