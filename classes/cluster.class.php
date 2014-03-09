<?php

class Cluster {

    private $_db;
    private $_id;

    public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;
    }

    /*
     * add()
     * 
     * Maakt een nieuw cluster.
     * 
     * @param Database $db Een database object geschikt voor de huidige context.
     * @param String $name Naam van het nieuwe cluster
     * @param Array $users Een array met user ID's voor in het nieuwe cluster.
     * @return Integer Cluster ID van het nieuwe cluster.
     */

    public static function add($db, $name, $users) {
        //Voeg cluster toe aan clusters tabel en aan users_clusters koppeltabel
        $cluster_id = $db->insert("clusters", array("name" => $name), true);
        foreach ($users as $value) {
            $db->insert("users_clusters", array("cluster_id" => $cluster_id, "user_id" => $value));
        }
        return $cluster_id;
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
     * delete()
     * 
     * Verwijder het cluster van de huidige context.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function delete() {
        return $this->_db->delete("clusters", array("id" => $this->_id));
    }

    /*
     * addUsers()
     * 
     * Voegt gebruikers toe aan het cluster van de huidige context.
     * 
     * @param Array $users Een array met user ID's voor in het cluster.
     */

    public function addUsers($users) {
        foreach ($users as $value) {
            $this->_db->insert("users_clusters", array("cluster_id" => $this->_id, "user_id" => $value));
        }
    }

    /*
     * deleteUsers()
     * 
     * Verwijderen van gebruikers uit het cluster van de huidige context.
     * 
     * @param Array $users Een array met user ID's die uit het cluster verwijderd moeten worden.
     */

    public function deleteUsers($users) {
        foreach ($users as $value) {
            $this->_db->delete("users_clusters", array("cluster_id" => $this->_id, "user_id" => $value));
        }
    }

    /*
     * getName()
     * 
     * Verkrijg de naam van het cluster uit de huidige context.
     * 
     * @return String De naam van het cluster.
     */

    public function getName() {
        $name = $this->_db->filter_result($this->_db->select("clusters", "name", array("id" => $this->_id)));
        return $name[0]["name"];
    }

    /*
     * setName()
     * 
     * Stelt een nieuwe naam in voor het cluster van de huidige context.
     * 
     * @param String $name De nieuwe naam voor het cluster.
     */

    public function setName($name) {
        $this->_db->update("clusters", array("name" => $name), array("id" => $this->_id));
    }

}
