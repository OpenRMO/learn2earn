<?php
class Project
{
	private $db;
	private $id;

	public function __construct($db, $id)
	{
		$this->db = $db;
		$this->id = $id;
	}
	
	public static function addNewProject($db, $name, $description, $clusters)
	{
		//Voeg project toe aan project tabel en aan clusters_projects koppeltabel
		$project_id = $db->insert("projects", array("name"=>$name, "description"=>$description), true);
		foreach($clusters as $value)
		{
			$db->insert("clusters_projects", array("project_id"=>$project_id, "cluster_id"=>$value));
		}
		return $project_id;
	}
	
	public static function modifyProject($db, $id, $name, $description)
	{
		$db->update("projects", array("name"=>$name, "description"=>$description), array("id"=>$id));
	}
	
	public static function deleteProject($db, $id)
	{
		$db->delete("projects", array("id"=>$id));
	}
	
	public function getName()
	{
		return $this->db->filter_result($this->db->select("projects", "name", array("id"=>$this->id)));
	}
	
	public function getDescription()
	{
		return $this->db->filter_result($this->db->select("projects", "description", array("id"=>$this->id)));
	}
        
	public function setName($name)
	{
		$this->db->update("projects", array("name"=>$name), array("id"=>$this->id));
	}
	
	public function setDescription($description)
	{
		$this->db->update("projects", array("description"=>$description), array("id"=>$this->id));
	}
}
