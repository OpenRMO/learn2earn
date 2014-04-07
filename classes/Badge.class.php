<?php

class Badge {
	
	private $_id;
	private $_db;
	private $_image;
	
	public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;
		
        $result = $db->select("badges", "*", array("id" => $this->_id));

        $this->setImage($result[0]["image"]);
    }
	
	/*
     * add()
     * 
     * Maakt een nieuwe badge.
     * 
     * @param Database $db Een database object geschikt voor de huidige context.
     * @param String $image De nieuwe Image URL van de badge.
     * @return Integer Badge ID van de nieuwe badge.
     */

    public static function add($db, $image) {
        $id = $db->insert("badges", array("image" => $image), true);
        return $id;
    }

    /*
     * delete()
     * 
     * Verwijder de badge van de huidige context.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function delete() {
        $result = $this->_db->delete("badges", array("id" => $this->_id));
        if ($result == false) {
            return false;
        }

        unset($this->_db);
        unset($this->_id);
        unset($this->_image);
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
        return $this->_db->update("badges", array(
                    "image" => $this->_image
                        ), array("id" => $this->_id));
    }
	
	/*
     * getID()
     * 
     * Verkrijg het ID van de badge in de huidige context
     * 
     * @return Integer Het ID van de badge.
     */

    public function getID() {
        return $this->_id;
    }
	
	/*
     * getImage()
     * 
     * Verkrijg de image URL van de badge uit de huidige context.
     * 
     * @return Integer De image URL van de badge.
     */

    public function getImage() {
        return $this->_image;
    }
	
	/*
     * setImage()
     * 
     * Stelt een nieuwe Image URL in voor de badge van de huidige context.
     * 
     * @param String $image De nieuwe image URL voor de badge.
     */

    public function setImage($image) {
        $this->_image = $image;
    }
}