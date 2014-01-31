<?php
class Cluster
{
	private $db;
	private $id;

	public function __construct($db, $id)
	{
		$this->db = $db;
		$this->id = $id;
	}
	
	public static function addNewCluster($db, $name, $users)
	{
		//Voeg cluster toe aan clusters tabel en aan users_clusters koppeltabel
		$cluster_id = $db->insert("clusters", array("name"=>$name), true);
		foreach($users as $value)
		{
			$db->insert("users_clusters", array("cluster_id"=>$cluster_id, "user_id"=>$value));
		}
		return $cluster_id;
	}
	
	public static function modifyCluster($db, $id, $name)
	{
		$db->update("clusters", array("name"=>$name), array("id"=>$id));
	}
	
	public static function deleteCluster($db, $id)
	{
		$db->delete("clusters", array("id"=>$id));
	}
	
	public static function addNewUsersToCluster($db, $cluster_id, $users)
	{
		foreach($users as $value)
		{
			$db->insert("users_clusters", array("cluster_id"=>$cluster_id, "user_id"=>$value));
		}
	}
	
	public static function deleteUsersFromCluster($db, $cluster_id, $users)
	{
		foreach($users as $value)
		{
			$db->delete("users_clusters", array("cluster_id"=>$cluster_id, "user_id"=>$value));
		}
	}
	
	public function getName()
	{
		return $this->db->filter_result($this->db->select("clusters", "name", array("id"=>$this->id)));
	}
	
	public function setName($name)
	{
		$this->db->update("clusters", array("name"=>$name), array("id"=>$this->id));
	}
}
?>