<?php

class Project {

    private $_db;
    private $_id;
    private $_name;
    private $_icon;
    private $_maxXP;
    private $_description;
    private $_background;
    private $_clusters = array();

    public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;
        
        $result = $db->select("projects", "*", array("id" => $this->_id));
        $clusters = $this->_db->select("clusters_projects", array("cluster_id"), array("project_id" => $this->_id));
        
        $this->setName($result[0]["name"]);
        $this->setIcon($result[0]["icon"]);
        $this->setMaxXP($result[0]["max_xp"]);
        $this->setDescription($result[0]["description"]);
        $this->setBackground($result[0]["background"]);
        
        foreach ($clusters as $value) {
            $this->_clusters[] = $value['cluster_id'];
        }
    }

    /*
     * update()
     * 
     * Update de gegevens naar de database.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function update() {
        $result = $this->_db->updateJoin("clusters_projects", "project_id", $this->_id, "cluster_id", $this->_clusters);
        if ($result == false) {
            return false;
        }
        return $this->_db->update("projects", array(
            "name" => $this->_name,
            "icon" => $this->_icon,
            "max_xp" => $this->_maxXP,
            "description" => $this->_description,
            "background" => $this->_background
                ), array("id" => $this->_id));
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

    public function delete() {
        $result = $this->_db->updateJoin("clusters_projects", "project_id", $this->_id, "cluster_id", array());
        if ($result == false) {
            return false;
        }
        $result = $this->_db->delete("projects", array("id" => $this->_id));
        if ($result == false) {
            return false;
        }
        
        unset($this->_id);
        unset($this->_db);
        unset($this->_background);
        unset($this->_clusters);
        unset($this->_description);
        unset($this->_icon);
        unset($this->_maxXP);
        unset($this->_name);
        return true;
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
     * addUsers()
     * 
     * Voegt clusters toe aan het project van de huidige context.
     * 
     * @param Array $clusters Een array met cluster objects voor in het project.
     */

    public function addUsers($clusters) {
        foreach ($clusters as $value) {
            if (!in_array($value->getID(),$this->_clusters)) {
                $this->_clusters[] = $value->getID();
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

    public function deleteClusters($clusters) {
        foreach ($clusters as $value) {
            if (in_array($value->getID(),$this->_clusters)) {
                unset($this->_clusters[array_search($value->getID(), $this->_clusters)]);
            }
        }
    }

    /*
     * getClusters()
     * 
     * Verkrijg de clusters die in het project van de huidige context zitten.
     * 
     * @result Array De array met cluster objecten van clusters uit het project.
     */

    public function getClusters() {
        $clusters = Array();
        foreach ($this->_clusters as $value) {
            $clusters[] = new Cluster($this->_db, $value);
        }
        return $clusters;
    }

    /*
     * getName()
     * 
     * Verkrijg de naam van het project uit de huidige context.
     * 
     * @return String De naam van het project.
     */

    public function getName() {
        return $this->_name;
    }

    /*
     * getMaxXP()
     * 
     * Verkrijg de maximale XP van het project uit de huidige context.
     * 
     * @return String De XP van het project.
     */

    public function getMaxXP() {
        return $this->_maxXP;
    }

    /*
     * getDescription()
     * 
     * Verkrijg de beschrijving van het project uit de huidige context.
     * 
     * @return String De beschrijving van het project.
     */

    public function getDescription() {
        return $this->_description;
    }

    /*
     * getIcon()
     * 
     * Verkrijg het icoon van het project uit de huidige context.
     * 
     * @return String De bestandsnaam van het icoon van het huidige project.
     */

    public function getIcon() {
        return $this->_icon;
    }

    /*
     * getBackground()
     * 
     * Verkrijg het achtergrond van het project uit de huidige context
     * 
     * @return String De bestandsnaam van de achtergrond van het huidige project.
     */

    public function getBackground() {
        return $this->_background;
    }

    /*
     * setName()
     * 
     * Stelt een nieuwe naam in voor het project van de huidige context.
     * 
     * @param String $name De nieuwe naam voor het project.
     */

    public function setName($name) {
        $this->_name = $name;
    }

    /*
     * setDescription()
     * 
     * Stelt een nieuwe beschrijving in voor het project van de huidige context.
     * 
     * @param String $description De nieuwe beschrijving voor het project.
     */

    public function setDescription($description) {
        $this->_description = $description;
    }

    /*
     * setIcon()
     * 
     * Stelt een nieuw iccon in voor het project van de huidige context.
     * 
     * @param String $icon De bestandsnaam van het nieuwe icoon.
     */

    public function setIcon($icon) {
        $this->_icon = $icon;
    }

    /*
     * setMaxXP()
     * 
     * Stelt de nieuwe maximale XP in voor de huidige context.
     * 
     * @param String $xp De nieuwe XP.
     */

    public function setMaxXP($xp) {
        $this->_maxXP = $xp;
    }

    /*
     * setBackground()
     * 
     * Stelt een nieuwe achtergrond in voor het huidige project.
     * 
     * @param String $xp De nieuwe achtergrond.
     */

    public function setBackground($bg) {
        $this->_background = $bg;
    }

}
