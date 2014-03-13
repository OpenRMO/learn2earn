<?php

class Database extends mysqli {

    private $host = "localhost";
    private $user = "learn2earn_admin";
    private $pass = "ItsW0rk1ng";
    private $db = "learn2earn";
    private $port = "3306";
    private $pre = "";
    private $query = "";

    public function __construct() {
        parent::__construct($this->host, $this->user, $this->pass, $this->db);
        if ($this->connect_errno != 0) {
            die('Connect Error (' . $this->connect_errno . ') '
                    . $this->connect_error);
        }
    }

    public function __destruct() {
        $this->close();
    }

    /*
     * close()
     * 
     * Closes the mysql connection.
     * 
     * @return Boolean
     */

    public function close() {
        return parent::close();
    }

    /*
     * insert()
     * 
     * Gegevens die worden geinsert naar de database.
     * 
     * @param String $table De naam van de tabel waarin wordt geinsert.
     * @param Array $values Alle waarden die worden geinsert.
     * @param Boolean $returnid Indien dit waar is, wordt het id van de nieuwe rij teruggegeven bij succes.
     * @return Boolean Afhankelijk van $returnid geeft dit de mysql id terug of true/false.
     */

    public function insert($table, $values, $returnid = false) {
        $table = $this->table_exists($table);
        if ($table === false) {
            return false;
        }
        if (!isset($values) || empty($values) || !is_array($values)) {
            return false;
        } else {
            $columns = "(";
            $db = " VALUES (";
            foreach ($values as $key => $value) {
                $columns .= "`" . $key . "`,";
                $db .= "'" . $this->real_escape_string($value) . "',";
            }
            $columns = rtrim($columns, ",") . ")";
            $db = rtrim($db, ",") . ")";
        }
        $this->query = "INSERT INTO `" . $table . "` " . $columns . "" . $db . ";";
        $var = $this->query($this->query);
        if ($var) {
            if ($returnid) {
                return $this->insert_id;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /*
     * select()
     * 
     * Selecteert gegevens uit de database
     * 
     * @param String $table De naam van de tabel waaruit moeten worden gelezen.
     * @param Mixed $columns Array met columns die moeten worden uitgelezen (accepteert ook string "*")
     * @param Array $where Geef de waarden op waar de select functie aan moet voldoen.
     * @param String $order Stelt in op welke column wordt gesorteerd.
     * @param String $limit Stelt in hoeveel rijen er worden opgevraagd en vanaf welke rij wordt gelezen.
     * @return Array Array met de resultaten of false indien er een fout is opgetreden.
     */

    public function select($table, $columns = NULL, $where = NULL, $order = NULL, $limit = NULL) {
        $table = $this->table_exists($table);
        if ($table === false) {
            return false;
        }
        $column = "";
        if (!isset($columns) || empty($columns) || !is_array($columns)) {
            $column = "*";
        } else {
            foreach ($columns as &$value) {
                $column .= "`" . $value . "`,";
            }
            $column = rtrim($column, ",");
        }
        if (!isset($order) || empty($order)) {
            $ord = "";
        } else {
            $ord = " ORDER BY " . $order;
        }
        if (!isset($limit) || empty($limit)) {
            $lim = "";
        } else {
            $lim = " LIMIT " . $order;
        }
        $whr = $this->where($where);
        $this->query = "SELECT " . $column . " FROM `" . $table . "` " . $whr . $ord . $lim . ";";
        $var = $this->query($this->query);
        if ($var && $var->num_rows > 0) {
            $returnarr = array();
            while ($row = $var->fetch_assoc()) {
                $returnarr[] = $row;
            }
            return $returnarr;
        } else {
            return false;
        }
    }

    /*
     * update()
     * 
     * Update gegevens in de database.
     * 
     * @param String $table De naam van de tabel waarin moet worden geupdate.
     * @param Array $values De waarden die moeten worden geupdate.
     * @param Array $where Geef de waarden op waar de rij die geupdate wordt aan moet voldoen.
     * @return Boolean Geeft true indien alles goed ging en false als alles kapot ging.
     */

    public function update($table, $values, $where = NULL) {
        $table = $this->table_exists($table);
        if ($table === false) {
            return false;
        }
        $update = "";
        if (!isset($values) || empty($values) || !is_array($values)) {
            return false;
        } else {
            foreach ($values as $key => $value) {
                $update .= "`" . $key . "`='" . $this->real_escape_string($value) . "',";
            }
            $update = rtrim($update, ",");
        }
        $whr = $this->where($where);
        $this->query = "UPDATE `" . $table . "` SET " . $update . " " . $whr . ";";
        $var = $this->query($this->query);
        if ($var) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * delete()
     * 
     * Verwijderd gegevens uit de database.
     * 
     * @param String $table De naam van de tabel waarin iets moet worden verwijderd.
     * @param Array $values De waarden die moeten worden geupdate.
     * @param Array $where Geef de waarden op waar de rij die geupdate wordt aan moet voldoen.
     * @return Boolean Geeft true indien alles goed ging en false als alles kapot ging.
     */

    public function delete($table, $where = NULL) {
        $table = $this->table_exists($table);
        if ($table === false) {
            return false;
        }
        $whr = $this->where($where);
        $this->query = "DELETE FROM `" . $table . "` " . $whr . ";";
        $var = $this->query($this->query);
        if ($var) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * filter_result()
     * 
     * Filtert een array van meerdere rijen naar een enkele rij 
     * indien er maar 1 rij als resultaat gegeven wordt.
     * 
     * @param Array $result Een array met MySQL resultaten van de database class.
     * @return Array Geeft de gewijzigde array of een ongewijzigde array terug.
     */

    public function filter_result($result) {
        if (is_array($result) && count($result) == 1) {
            return $result[0];
        } elseif (is_array($result) && count($result) > 1) {
            return $result;
        } else {
            return false;
        }
    }

    /*
     * updateJoin()
     * 
     * Maakt de MySQL koppeltabel up-to-date
     * 
     * @param String $table De naam van de tabel waarin moet worden geupdate.
     * @param String $id_field De kalomnaam van hoofdveld.
     * @param Integer $id De waarde van het hoofdveld die als basis genomen moet worden.
     * @param String $values_field De kalomnaam van het waardenveld.
     * @param Array $valeus Array met de up-to-date te maken values.
     * @return Boolean Geeft true indien alles goed ging en false als alles kapot ging.
     */

    public function updateJoin($table, $id_field, $id, $values_field, $values) {
        $raw = $this->select($table, array($values_field), array($id_field => $id));
        if ($raw == null) {
            $raw = array();
        } else {
            foreach ($raw as &$value) {
                $value = $value[$values_field];
                if (!in_array($value, $values)) {
                    $result = $this->delete($table, array($id_field => $id, $values_field => $value));
                    if ($result === false) {
                        return false;
                    }
                }
            }
        }
        unset($value);
        foreach ($values as $value) {
            if (!in_array($value, $raw)) {
                $result = $this->insert($table, array($id_field => $id, $values_field => $value));
                if ($result === false) {
                    return false;
                }
            }
        }
        return true;
    }

    /*
     * last_query()
     * 
     * Geeft de laatste uitgevoerde query door de MySQL class terug (voor debuggen).
     * 
     * @return String De laatst uitgevoerde SQL query als string.
     */

    public function last_query() {
        return $this->query;
    }

    /*
     * where()
     * 
     * Private functie die het SQL WHERE statement opbouwd.
     * 
     * @param Array $where Een array met alle where statements.
     * @return String Het SQL WHERE statement als string
     */

    private function where($where) {
        if (!isset($where) || empty($where)) {
            $whr = "";
        } elseif (isset($where['raw']) && !empty($where['raw'])) {
            $whr = "WHERE " . $where['raw'];
        } elseif (is_array($where)) {
            $whr = "";
            foreach ($where as $key => $value) {
                if (is_numeric($value)) {
                    $whr .= "`" . $key . "` = '" . $this->real_escape_string($value) . "' AND";
                } else {
                    $whr .= "`" . $key . "` LIKE '" . $this->real_escape_string($value) . "' AND";
                }
            }
            $whr = "WHERE " . rtrim($whr, "AND");
        } else {
            return "";
        }
        return $whr;
    }

    /*
     * table_exists()
     * 
     * Private functie die controleert of een MySQL tabel bestaat in de huidige context
     * 
     * @param String $table De te controleren tabelnaam.
     * @return Boolean Een boolean die true teruggeeft als tabel bestaat, anders wordt false teruggegeven.
     */

    private function table_exists($table) {
        if (!isset($table) || empty($table)) {
            return false;
        }
        $table = $this->pre . $table;
        $var = $this->query("SHOW TABLES FROM " . $this->db . " LIKE '" . $table . "';");
        if ($var) {
            if ($var->num_rows == 1) {
                return $table;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
