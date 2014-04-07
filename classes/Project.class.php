<?php

class Project {

    private $_db;
    private $_id;
    private $_name;
    private $_icon;
    private $_description;
    private $_background;
    private $_clusters = array();
    private $_courses = array();

    public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;

        $result = $db->select("projects", "*", array("id" => $this->_id));
        $clusters = $this->_db->select("clusters_projects", array("cluster_id"), array("project_id" => $this->_id));
        $courses  = $this->_db->select("courses", array("course_id"), array("project_id" => $this->_id));

        $this->setName($result[0]["name"]);
        $this->setIcon($result[0]["icon"]);
        $this->setDescription($result[0]["description"]);
        $this->setBackground($result[0]["background"]);
        
        if($clusters != null) {
            foreach ($clusters as $value) {
                $this->_clusters[] = $value['cluster_id'];
            }
        }
        if($courses != null) {
            foreach ($courses as $value) {
                $this->_courses[] = $value['course_id'];
            }
        }
    }

    public function __destruct() {
        $this->update();
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

    public static function add($db, $name, $desc, $icon, $clusters, $background) {
        $project_id = $db->insert("projects", array("name" => $name, "description" => $desc, "icon" => $icon, "background" => $background), true);
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
            if (!in_array($value->getID(), $this->_clusters)) {
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
            if (in_array($value->getID(), $this->_clusters)) {
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
     * getCourses()
     * 
     * Verkrijg de lessen die bij het project van de huidige context horen.
     * 
     * @result Array De array met course objecten van lessen uit het project.
     */

    public function getCourses() {
        $courses = Array();
        foreach ($this->_courses as $value) {
            $courses[] = new Course($this->_db, $value);
        }
        return $courses;
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
        $courses = $this->getCourses();
        $maxxp = 0;
        foreach($courses as $course) {
            $maxxp += $course->getMaxXP();
        }
        return $maxxp;
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
     * setBackground()
     * 
     * Stelt een nieuwe achtergrond in voor het huidige project.
     * 
     * @param String $xp De nieuwe achtergrond.
     */

    public function setBackground($bg) {
        $this->_background = $bg;
    }
    
    /*
     * toString()
     * 
     * Print het huidige project.
     */
    public function toString() {
        print '<h1>' . $this->getName() . '</h1></h1><p><img class="projectIcon" src="' . parse_link('public/img/icons/' . $this->getIcon(), true) . '" alt="Icoon - ' . $this->getIcon() . '" /></p><p>' . $this->getDescription() . '</p><p><a href="http://www.learn2earn.veluwscollege.net/lessons.php?project_id=' . $this->_id . '">Ga naar project</a></p>';
    }
}
