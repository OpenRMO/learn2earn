<?php

class File {

    private $_name;
    private $_path;
    private $_error;
    private $_size;
    private $_extension;
    private $_tmpFilename;

    /*
     * uploadFile()
     * 
     * Upload een bestand naar de server.
     * 
     * @param Array $file Het up te loaden bestand.
     * @return Array with arr[0]==true on success and path in arr[1].
     * @return Array with arr[0]==false || arr[0]==errCode and arr[1] description on error
     */

    public function File($file) {
        $this->setFilename($file['name']);
        $this->setError($file['error']);
        $this->setSize($file['size']);
        $this->setTmpFilename($file['tmp_name']);
        $extension = explode('.', $this->_name);
        $this->setExtension($extension[count($extension) - 1]);
        unset($extension);
    }

    public function uploadFile() {
        if ($this->_error != 0) {
            return false;
        }
        $allowedExts = Array("gif", "png", "jpeg", "jpg", "docx", "doc", "pdf", "xls", "xlsx", "mp3", "mp4", "webm", "avi", "wav", "wmv", "txt", "flv");
        if (($this->_size < 1024 * 1024 * 25) && in_array($this->_extension, $allowedExts)) {
            if ($this->_error > 0) {
                return false;
            } else {
                if (file_exists("../uploads/" . $this->_name . '.' . $this->_extension)) {
                    $this->setError('Dit bestand bestaat reeds op de server!');
                    return false;
                } else {
                    move_uploaded_file($this->_tmpFilename, "../uploads/" . $this->_name . '.' . $this->_extension);
                    $this->setPath("uploads/" . $this->_name . '.' . $this->_extension);
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    /*
     * setFilename
     * @param $name without extension!
     */

    public function setFilename($name) {
        $this->_name = $name;
    }

    public function setError($errno) {
        $this->_error = $errno;
    }

    public function setSize($size) {
        $this->_size = $size;
    }

    public function setPath($path) {
        $this->_path = $path;
    }

    public function setTmpFilename($tmpFilename) {
        $this->_tmpFilename = $tmpFilename;
    }

    public function setExtension($extension) {
        $this->_extension = $extension;
    }

    /*
     * getFilename()
     * 
     * @return $filename, WITHOUT extension
     */
    public function getFilename() {
        return $this->_filename;
    }

    public function getError() {
        return $this->_error;
    }

    public function getSize() {
        return $this->_size;
    }

    public function getPath() {
        return $this->_path;
    }
    
    public function getTmpFilename(){
        return $this->_tmpFilename;
    }

}

?>