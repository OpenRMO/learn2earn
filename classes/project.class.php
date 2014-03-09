<?php

class Project {

    private $_db;
    private $_id;

    public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;
    }

    /*
     * add()
     * 
     * Maakt een nieuw project.
     * 
     * @param Database $db Een database object geschikt voor de huidige context.
     * @param String $name Naam van het nieuwe project.
     * @param String $desc De beschrijving van het nieuwe project.
     * @param Integer $periode De periode van het nieuwe project.
     * @param Array $clusters De objecten van de clusters die toegang krijgen tot het nieuwe project.
     * @return Integer Het ID van het nieuwe project.
     */

    public static function add($db, $name, $desc, $periode, $clusters) {
        $project_id = $db->insert("projects", array("name" => $name, "description" => $desc, "period" => $periode), true);
        foreach ($clusters as $value) {
            $test = $this->_db->select("clusters_projects", array("cluster_id", "project_id"), array("project_id" => $this->_id, "cluster_id" => $value->getID()));
            if (count($test) == 0) {
                $db->insert("clusters_projects", array("project_id" => $project_id, "cluster_id" => $value->getID()));
            }
        }
        return $project_id;
    }

    /*
     * delete()
     * 
     * Verwijder het project van de huidige context.
     * 
     * @return Boolean Succesvol of niet.
     */

    public static function delete() {
        return $this->_db->delete("projects", array("id" => $this->_id));
    }

    /*
     * getID()
     * 
     * Verkrijg het ID van het project in de huidige context
     * 
     * @return Integer Het ID van het project.
     */

    public function getID() {
        return $this->_id;
    }

    /*
     * addClusters()
     * 
     * Voegt clusters toe aan het project in de huidige context.
     * 
     * @param Array $clusters Een array met cluster objects voor in het project.
     */

    public function addClusters($clusters) {
        foreach ($clusters as $value) {
            $test = $this->_db->select("clusters_projects", array("cluster_id", "project_id"), array("project_id" => $this->_id, "cluster_id" => $value->getID()));
            if (count($test) == 0) {
                $db->insert("clusters_projects", array("project_id" => $project_id, "cluster_id" => $value->getID()));
            }
        }
    }

    /*
     * deleteClusters()
     * 
     * Verwijderen van clusters uit het project van de huidige context.
     * 
     * @param Array $clusters Een array met cluster objects die uit het project verwijderd moeten worden.
     */

    public function deleteUsers($users) {
        foreach ($clusters as $value) {
             $test = $this->_db->select("clusters_projects", array("cluster_id", "project_id"), array("project_id" => $this->_id, "cluster_id" => $value->getID()));
            if (count($test) > 0) {
                $this->_db->delete("clusters_projects", array("project_id" => $this->_id, "cluster_id" => $value->getID()));
            }
        }
    }

    /*
     * getName()
     * 
     * Verkrijg de naam van het project uit de huidige context.
     * 
     * @return String De naam van het project.
     */

    public function getName() {
        $name = $this->_db->select("projects", "name", array("id" => $this->_id));
        return $name[0]["name"];
    }

    /*
     * getDescription()
     * 
     * Verkrijg de beschrijving van het project uit de huidige context.
     * 
     * @return String De beschrijving van het project.
     */

    public function getDescription() {
        $desc = $this->_db->select("projects", "description", array("id" => $this->_id));
        return $desc[0]["description"];
    }

    /*
     * getIcon()
     * 
     * Verkrijg het icoon van het project uit de huidige context.
     * 
     * @return String De bestandsnaam van het icoon van het huidige project.
     */

    public function getIcon() {
        $icon = $this->_db->select("projects", "icon", array("id" => $this->_id));
        return $icon[0]["icon"];
    }

    /*
     * setName()
     * 
     * Stelt een nieuwe naam in voor het project van de huidige context.
     * 
     * @param String $name De nieuwe naam voor het project.
     */

    public function setName($name) {
        $this->_db->update("projects", array("name" => $name), array("id" => $this->_id));
    }

    /*
     * setDescription()
     * 
     * Stelt een nieuwe beschrijving in voor het project van de huidige context.
     * 
     * @param String $description De nieuwe beschrijving voor het project.
     */

    public function setDescription($description) {
        $this->_db->update("projects", array("description" => $description), array("id" => $this->_id));
    }

    /*
     * setIcon()
     * 
     * Stelt een nieuw iccon in voor het project van de huidige context.
     * 
     * @param String $icon De bestandsnaam van het nieuwe icoon.
     */

    public function setIcon($icon) {
        $this->_db->update("projects", array("icon" => $icon), array("id" => $this->_id));
    }

}
