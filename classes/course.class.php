<?php

class Course {

    private $_db;
    private $_id;

    public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;
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
     * Verwijder de course van de huidige context.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function delete($db, $id) {
        return $this->_db->delete("courses", array("course_id" => $id));
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
        $name = $this->_db->select("courses", "name", array("course_id" => $this->_id));
        return $name[0]["name"];
    }

    /*
     * getDescription()
     * 
     * Verkrijg de beschrijving van de course uit de huidige context.
     * 
     * @return String De beschrijving van de course.
     */

    public function getDescription() {
        $desc = $this->_db->select("courses", "description", array("course_id" => $this->_id));
        return $desc[0]["description"];
    }

    /*
     * getMaxXP()
     * 
     * Verkrijg de maximaal te halen XP van de course uit de huidige context.
     * 
     * @return Integer De maximale XP van de course.
     */

    public function getMaxXP() {
        $maxXP = $this->_db->select("courses", "max_xp", array("course_id" => $this->_id));
        return $maxXP[0]["max_xp"];
    }

    /*
     * getProjectID()
     * 
     * Verkrijg het ID van het bijbehorende Project van de course uit de huidige context.
     * 
     * @return String Het bijbehorende project ID van de course.
     */

    public function getProjectID() {
        $project_id = $this->_db->select("courses", "project_id", array("course_id" => $this->_id));
        return $project_id[0]["project_id"];
    }

    /*
     * setName()
     * 
     * Stelt een nieuwe naam in voor de course van de huidige context.
     * 
     * @param String $name De nieuwe naam voor de course.
     */

    public function setName($name) {
        $this->_db->update("courses", array("name" => $name), array("course_id" => $this->_id));
    }

    /*
     * setDescription()
     * 
     * Stelt een nieuwe beschrijving in voor de course van de huidige context.
     * 
     * @param String $description De nieuwe beschrijving voor de course.
     */

    public function setDescription($description) {
        $this->_db->update("courses", array("description" => $description), array("course_id" => $this->_id));
    }

    /*
     * setMaxXP()
     * 
     * Stelt de nieuwe maximale te behalen XP in voor de course van de huidige context.
     * 
     * @param Integer $maxXP De nieuwe maximale XP voor de course.
     */

    public function setMaxXP($maxXP) {
        $this->_db->update("courses", array("max_xp" => $maxXP), array("course_id" => $this->_id));
    }

    /*
     * setProjectID()
     * 
     * Stelt een nieuw bijbehorend project in voor de course van de huidige context.
     * 
     * @param Integer $projectID Het ID van het nieuwe bijbehorende project.
     */

    public function setProjectID($projectID) {
        $this->_db->update("courses", array("project_id" => $projectID), array("course_id" => $this->_id));
    }

}
