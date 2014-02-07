<?php
class Course
{
	private $db;
	private $id;

	public function __construct($db, $id)
	{
		$this->db = $db;
		$this->id = $id;
	}
	
	public static function addNewCourse($db, $name, $description, $max_xp, $project)
	{
		//Voeg course toe aan course tabel
		$course_id = $db->insert("courses", array("project_id"=>$project, "name"=>$name, "description"=>$description, "max_xp"=>$max_xp), true);
		return $course_id;
	}
	
	public static function modifyCourse($db, $id, $name, $description, $max_xp)
	{
		$db->update("courses", array("name"=>$name, "description"=>$description, "max_xp"=>$max_xp), array("course_id"=>$id));
	}
	
	public static function deleteCourse($db, $id)
	{
		$db->delete("courses", array("course_id"=>$id));
	}
	
	public function getName()
	{
		return $this->db->filter_result($this->db->select("courses", "name", array("course_id"=>$this->id)));
	}
	
	public function getDescription()
	{
		return $this->db->filter_result($this->db->select("courses", "description", array("course_id"=>$this->id)));
	}
	
	public function getMaxXP()
	{
		return $this->db->filter_result($this->db->select("courses", "max_xp", array("course_id"=>$this->id)));
	}
	
	public function getProjectID()
	{
		return $this->db->filter_result($this->db->select("courses", "project_id", array("course_id"=>$this->id)));
	}
	
	public function setName($name)
	{
		$this->db->update("courses", array("name"=>$name), array("course_id"=>$this->id));
	}
	
	public function setDescription($description)
	{
		$this->db->update("courses", array("description"=>$description), array("course_id"=>$this->id));
	}
	
	public function setMaxXP($maxXP)
	{
		$this->db->update("courses", array("max_xp"=>$maxXP), array("course_id"=>$this->id));
	}
	
	public function setProjectID($projectID)
	{
		$this->db->update("courses", array("project_id"=>$projectID), array("course_id"=>$this->id));
	}
}
