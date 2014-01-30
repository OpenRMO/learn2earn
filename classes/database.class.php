<?php
class Database extends mysqli {
	/* Project itsWorking 
	   © Ons 2013-2014
	   Mysqli Database Class, versie 30-1-2014 19:48 */

	private $host = "localhost";
	private $user = "learn2earn_admin";
	private $pass = "ItsW0rk1ng";
	private $db = "learn2earn";
	private $port = "3306";
	private $pre = "";
	
	private $query = "";

	public function __construct() {
		parent::__construct($this->host, $this->user, $this->pass, $this->db);
		if($this->connect_errno != 0) {
			die('Connect Error (' . $this->connect_errno . ') '
            . $this->connect_error);
		}
	}
	
	public function __destruct() {
		$this->close();
	}
	
	public function close() {
		parent::close();
	}
	
	public function insert($table, $values, $returnid = false, $where = NULL) {
		$table = $this->table_exists($table);
		if($table === false) {
			return false;
		}
		if(!isset($values) || empty($values) || !is_array($values)) {
			return false;
		} else {
			$columns = "(";
			$db = " VALUES (";
			foreach ($values as $key => $value) {
				$columns .= "`".$key."`,";
				$db .= "'".$this->real_escape_string($value)."',";
			}
			$columns = rtrim($columns, ",").")";
			$db = rtrim($db, ",").")";
		}
		$whr = $this->where($where);
		$this->query = "INSERT INTO `".$table."` ".$columns."".$db." ".$whr.";";
		$var=$this->query($this->query);
		if($var) {
			if($returnid) {
				return $this->insert_id;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	
	public function select($table, $columns = NULL, $where = NULL, $order = NULL, $limit = NULL) {
		$table = $this->table_exists($table);
		if($table === false) {
			return false;
		}
		if(!isset($columns) || empty($columns) || !is_array($columns)) {
			$column = "*";
		} else {
			$column = "";
			foreach ($columns as $key => $value) {
				$column .= "`".$value."`,";
			}
			$column = rtrim($column, ",");
		}
		if(!isset($order) || empty($order)) {
			$ord = "";
		} else {
			$ord = " ORDER BY ".$order;
		}
		if(!isset($limit) || empty($limit)) {
			$lim = "";
		} else {
			$lim = " LIMIT ".$order;
		}
		$whr = $this->where($where);
		$this->query = "SELECT ".$column." FROM `".$table."` ".$whr.$ord.$lim.";";
		$var=$this->query($this->query);
		if($var) {
			if($var->num_rows < 1) {
				return false;
			} elseif($var->num_rows == 1) {
				return $var->fetch_assoc();
			} else {
				$returnarr = array();
				while($row=$var->fetch_assoc()) {
					$returnarr[] = $row;
				}
				return $returnarr;
			}
		} else {
			return false;
		}
	}
	
	public function update($table, $values, $where = NULL) {
		$table = $this->table_exists($table);
		if($table === false) {
			return false;
		}
		if(!isset($values) || empty($values) || !is_array($values)) {
			return false;
		} else {
			$update = "";
			foreach ($values as $key => $value) {
				$update .= "`".$key."`='".$this->real_escape_string($value)."',";
			}
			$update = rtrim($update, ",");
		}
		$whr = $this->where($where);
		$this->query = "UPDATE `".$table."` SET ".$update." ".$whr.";";
		$var=$this->query($this->query);
		if($var) {
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($table, $where = NULL) {
		$table = $this->table_exists($table);
		if($table === false) {
			return false;
		}
		$whr = $this->where($where);
		$this->query = "DELETE FROM `".$table."` ".$whr.";";
		$var=$this->query($this->query);
		if($var) {
			return true;
		} else {
			return false;
		}
	}
	
	public function last_query() {
		return $this->query;
	}
	
	private function where($where) {
		if(!isset($where) || empty($where)) {
			$whr = "";
		} elseif(isset($where['raw']) && !empty($where['raw'])) {
			$whr = "WHERE ".$where['raw'];
		} elseif(is_array($where)) {
			$whr = "";
			foreach($where as $key => $value) {
				if(is_numeric($value)) {
					$whr .= "`".$key."` = '".$this->real_escape_string($value)."' AND";
				} else {
					$whr .= "`".$key."` LIKE '".$this->real_escape_string($value)."' AND";
				}
			}
			$whr = "WHERE ".rtrim($whr, "AND");
		} else {
			return "";
		}
		return $whr;
	}
	
	private function table_exists($table) {
		if(!isset($table) || empty($table)) {
			return false;
		}
		$table = $this->pre.$table;
		$var=$this->query("SHOW TABLES FROM ".$this->db." LIKE '".$table."';");
		if($var) {
			if($var->num_rows == 1) {
				return $table;
			} else {
				return false;
			}
		} else {
			return false;
		}
    }  
}