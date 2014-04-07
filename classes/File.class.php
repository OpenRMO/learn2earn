<?php

class File {
	private $_id;
	private $_db;
	private $_filename;
	private $_filepath;
	
	public function __construct($db, $id) {
		$this->_db = $db;
        $this->_id = $id;

        $result = $this->_db->select("files", "*", array("id" => $this->_id));
		
        $this->_filename = $result[0]["filename"];
		$this->_filepath = $result[0]["filepath"];
	}
	
    /*
     * uploadFile()
     * 
     * Upload een bestand naar de server.
     * 
     * @param String $file Het up te loaden bestand.
     * @return Array with arr[0]==true on success and path in arr[1].
     * @return Array with arr[0]==false || arr[0]==errCode and arr[1] description on error
     */

    public static function uploadFile($file) {
        if ($file["error"] > 0) {
            return "error-Er ging iets mis bij het uploaden van het bestand!";
        }

        $allowed_ext = Array("gif", "png", "jpeg", "jpg", "docx", "doc", "pdf", "xls", "xlsx", "mp3", "mp4", "webm", "avi", "wav", "wmv", "txt", "flv");
        if (!in_array(end(explode($file["name"], "."))) || $file["size"] > 1024 * 1024 * 2) {
            return array('false', 'Dit bestand heeft geen betandsextensie!');
        }

        $tmp_file_name = $file["name"];
        $i = 1;
        while (file_exists('../uploads/' . $tmp_file_name)) {
            $tmp_file_name = preg_split(".", $tmp_file_name);
            $tmp_file_name[count($tmp_file_name) - 1] . $i;
        }
        $file["name"] = implode($tmp_file_name);
        move_uploaded_file($file["tmp_name"], '../uploads/' . $file["name"]);
        return array(true, 'uploads/' . $file["name"]);
    }
	
	/*
     * getID()
     * 
     * Verkrijg het ID van het bestand in de huidige context
     * 
     * @return Integer Het ID van het bestand.
     */
	public function getID() {
		return $this->_id;
	}
	
	/*
     * getFile()
     * 
     * Verkrijg het pad naar het bestand op de server.
     * 
     * @return Integer De locatie naar het bestand in de server.
     */
	public function getFile() {
		return $this->_filepath.$this->filename;
	}

}
