<?php
class Project
{
	private $_db;
	private $_id;

	public function __construct($db, $id)
	{
		$this->_db = $db;
		$this->_id = $id;
	}
	
	public static function add($db, $name, $desc, $periode, $clusters)
	{
		//Voeg project toe aan project tabel en aan clusters_projects koppeltabel
		$project_id = $db->insert("projects", array("name"=>$name, "description"=>$desc, "period"=>$periode), true);
		foreach($clusters as $value)
		{
			$db->insert("clusters_projects", array("project_id"=>$project_id, "cluster_id"=>$value));
		}
		return $project_id;
	}
	
	public static function delete()
	{
		$this->_db->delete("projects", array("id"=>$this->_id));
	}
        
        public function getID()
	{
                return $this->_id;
	}
	
	public function getName()
	{
                $name = $this->_db->select("projects", "name", array("id"=>$this->_id));
		return $name[0]["name"];
	}
	
	public function getDescription()
	{
                $desc = $this->_db->select("projects", "description", array("id"=>$this->_id));
		return $desc[0]["description"];
	}
	
	public function getIcon()
	{
		$icon = $this->_db->select("projects", "icon", array("id"=>$this->_id));
		return $icon[0]["icon"];
	}
        
	public function setName($name)
	{
		$this->_db->update("projects", array("name"=>$name), array("id"=>$this->_id));
	}
	
	public function setDescription($description)
	{
		$this->_db->update("projects", array("description"=>$description), array("id"=>$this->_id));
	}
}
