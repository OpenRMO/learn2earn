<?php

class Course {

    private $_db;
    private $_id;
    private $_project_id;
    private $_name;
    private $_max_xp;
    private $_description;

    public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;
        
        $result = $db->select("courses", "*", array("id" => $this->_id));
        
        $this->setName($result[0]["name"]);
        $this->setMaxXP($result[0]["max_xp"]);
        $this->setDescription($result[0]["description"]);
        $this->setProjectID($result[0]["project_id"]);
    }

    /*
     * add()
     * 
     * Maakt een nieuwe course.
     * 
     * @param Database $db Een database object geschikt voor de huidige context.
     * @param String $name Naam van de nieuwe course.
     * @param Integer $project Het ID van het bijbehorende project.
     * @return Integer Course ID van het nieuwe cluster.
     */

    public static function add($db, $name, $project) {
        //Voeg course toe aan course tabel
        $course_id = $db->insert("courses", array("project_id" => $project, "name" => $name), true);
        return $course_id;
    }

    /*
     * delete()
     * 
     * Verwijder de gebruiker van de huidige context.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function delete() {
        $result = $this->_db->delete("courses", array("course_id" => $this->_id));
        if ($result == false) {
            return false;
        }

        unset($this->_db);
        unset($this->_id);
        unset($this->_description);
        unset($this->_max_xp);
        unset($this->_name);
        unset($this->_project_id);
        return true;
    }
    
    /*
     * update()
     * 
     * Update de gegevens naar de database.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function update() {
        return $this->_db->update("courses", array(
            "project_id" => $this->_project_id,
            "name" => $this->_name,
            "max_xp" => $this->_max_xp,
            "description" => $this->_description
                ), array("course_id" => $this->_id));
    }

    /*
     * getID()
     * 
     * Verkrijg het ID van de course in de huidige context
     * 
     * @return Integer Het ID van de course.
     */

    public function getID() {
        return $this->_id;
    }

    /*
     * getName()
     * 
     * Verkrijg de naam van de course uit de huidige context.
     * 
     * @return String De naam van de course.
     */

    public function getName() {
        return $this->_name;
    }

    /*
     * getDescription()
     * 
     * Verkrijg de beschrijving van de course uit de huidige context.
     * 
     * @return String De beschrijving van de course.
     */

    public function getDescription() {
        return $this->_description;
    }

    /*
     * getMaxXP()
     * 
     * Verkrijg de maximaal te halen XP van de course uit de huidige context.
     * 
     * @return Integer De maximale XP van de course.
     */

    public function getMaxXP() {
        return $this->_max_xp;
    }

    /*
     * getProjectID()
     * 
     * Verkrijg het ID van het bijbehorende Project van de course uit de huidige context.
     * 
     * @return String Het bijbehorende project ID van de course.
     */

    public function getProjectID() {
        return $this->_project_id;
    }

    /*
     * setName()
     * 
     * Stelt een nieuwe naam in voor de course van de huidige context.
     * 
     * @param String $name De nieuwe naam voor de course.
     */

    public function setName($name) {
        $this->_name = $name;
    }

    /*
     * setDescription()
     * 
     * Stelt een nieuwe beschrijving in voor de course van de huidige context.
     * 
     * @param String $description De nieuwe beschrijving voor de course.
     */

    public function setDescription($description) {
        $this->_description = $description;
    }

    /*
     * setMaxXP()
     * 
     * Stelt de nieuwe maximale te behalen XP in voor de course van de huidige context.
     * 
     * @param Integer $maxXP De nieuwe maximale XP voor de course.
     */

    public function setMaxXP($maxXP) {
        $this->_max_xp = $maxXP;
    }

    /*
     * setProjectID()
     * 
     * Stelt een nieuw bijbehorend project in voor de course van de huidige context.
     * 
     * @param Integer $projectID Het ID van het nieuwe bijbehorende project.
     */

    public function setProjectID($projectID) {
        $this->_project_id = $projectID;
    }

}
