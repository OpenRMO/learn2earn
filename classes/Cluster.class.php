<?php

class Cluster {

    private $_db;
    private $_id;
    private $_name;
    private $_users = Array();

    public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;

        $result = $this->_db->select("clusters", "*", array("id" => $this->_id));
        $users = $this->_db->select("users_clusters", array("user_id"), array("cluster_id" => $this->_id));

        $this->setName($result[0]["name"]);

        foreach ($users as $value) {
            $this->_users[] = $value['user_id'];
        }
    }

    public function __destruct() {
        $this->update();
    }

    /*
     * add()
     * 
     * Maakt een nieuw cluster.
     * 
     * @param Database $db Een database object geschikt voor de huidige context.
     * @param String $name Naam van het nieuwe cluster
     * @param Array $users Een array met user objects voor in het nieuwe cluster.
     * @return Integer Cluster ID van het nieuwe cluster.
     */

    public static function add($db, $name, $users) {
        $cluster_id = $db->insert("clusters", array("name" => $name), true);
        foreach ($users as $value) {
            $test = $this->_db->select("users_clusters", array("cluster_id", "user_id"), array("cluster_id" => $this->_id, "user_id" => $value->getID()));
            if (count($test) == 0) {
                $db->insert("users_clusters", array("cluster_id" => $cluster_id, "user_id" => $value->getID()));
            }
        }
        return $cluster_id;
    }

    /*
     * update()
     * 
     * Update de gegevens naar de database.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function update() {
        $result = $this->_db->updateJoin("users_clusters", "cluster_id", $this->_id, "user_id", $this->_users);
        if ($result == false) {
            return false;
        }
        return $this->_db->update("clusters", array(
                    "name" => $this->_name
                        ), array("id" => $this->_id));
    }

    /*
     * delete()
     * 
     * Verwijder het cluster van de huidige context.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function delete() {
        $result = $this->_db->updateJoin("users_clusters", "cluster_id", $this->_id, "user_id", array());
        if ($result == false) {
            return false;
        }
        $result = $this->_db->delete("clusters", array("id" => $this->_id));
        if ($result == false) {
            return false;
        }

        unset($this->_db);
        unset($this->_id);
        unset($this->_name);
        unset($this->_users);
        return true;
    }

    /*
     * getID()
     * 
     * Verkrijg het ID van het cluster in de huidige context
     * 
     * @return Integer Het ID van het cluster.
     */

    public function getID() {
        return $this->_id;
    }

    /*
     * addUsers()
     * 
     * Voegt gebruikers toe aan het cluster van de huidige context.
     * 
     * @param Array $users Een array met user objects voor in het cluster.
     */

    public function addUsers($users) {
        foreach ($users as $value) {
            if (!in_array($value->getID(), $this->_users)) {
                $this->_users[] = $value->getID();
            }
        }
    }

    /*
     * deleteUsers()
     * 
     * Verwijderen van gebruikers uit het cluster van de huidige context.
     * 
     * @param Array $users Een array met user objects die uit het cluster verwijderd moeten worden.
     */

    public function deleteUsers($users) {
        foreach ($users as $value) {
            if (in_array($value->getID(), $this->_users)) {
                unset($this->_users[array_search($value->getID(), $this->_users)]);
            }
        }
    }

    /*
     * getUsers()
     * 
     * Verkrijg de gebruikers die in het cluster van de huidige context zitten.
     * 
     * @result Array De array met user objecten van gebruikers uit het cluster.
     */

    public function getUsers() {
        $users = Array();
        foreach ($this->_users as $value) {
            $users[] = new User($this->_db, $value);
        }
        return $users;
    }

    /*
     * getName()
     * 
     * Verkrijg de naam van het cluster uit de huidige context.
     * 
     * @return String De naam van het cluster.
     */

    public function getName() {
        return $this->_name;
    }

    /*
     * setName()
     * 
     * Stelt een nieuwe naam in voor het cluster van de huidige context.
     * 
     * @param String $name De nieuwe naam voor het cluster.
     */

    public function setName($name) {
        $this->_name = $name;
    }

}
