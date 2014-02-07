<?php
class Cluster
{
	private $_db;
	private $_id;

	public function __construct($db, $id)
	{
		$this->_db = $db;
		$this->_id = $id;
	}
	
	public static function add($db, $name, $users)
	{
		//Voeg cluster toe aan clusters tabel en aan users_clusters koppeltabel
		$cluster_id = $db->insert("clusters", array("name"=>$name), true);
		foreach($users as $value)
		{
			$db->insert("users_clusters", array("cluster_id"=>$cluster_id, "user_id"=>$value));
		}
		return $cluster_id;
	}
	
	public function delete()
	{
		$this->_db->delete("clusters", array("id"=>$this->_id));
	}
	
	public function addUsers($users)
	{
		foreach($users as $value)
		{
			$this->_db->insert("users_clusters", array("cluster_id"=>$this->_id, "user_id"=>$value));
		}
	}
	
	public function deleteUsers($users)
	{
		foreach($users as $value)
		{
			$this->_db->delete("users_clusters", array("cluster_id"=>$this->_id, "user_id"=>$value));
		}
	}
	
	public function getName()
	{
		return $this->_db->filter_result($this->_db->select("clusters", "name", array("id"=>$this->_id)));
	}
	
	public function setName($name)
	{
		$this->_db->update("clusters", array("name"=>$name), array("id"=>$this->_id));
	}
}
