<?php

class File {
    /*
     * uploadFile()
     * 
     * Upload een bestand naar de server.
     * 
     * @param String $file Het up te loaden bestand.
     */

    public static function uploadFile($file) {
        if ($file["error"] > 0) {
            return false;
        }

        $allowed_ext = Array("gif", "png", "jpeg", "jpg", "docx", "doc", "pdf", "xls", "xlsx", "mp3", "mp4", "webm", "avi", "wav", "wmv", "txt", "flv");
        if (!in_array(end(explode($file["name"], "."))) || $file["size"] > 1024 * 1024 * 2) {
            return false;
        }

        $tmp_file_name = $file["name"];
        $i = 1;
        while (file_exists('../uploads/' . $tmp_file_name)) {
            $tmp_file_name = preg_split(".", $tmp_file_name);
            $tmp_file_name[count($tmp_file_name) - 1] . $i;
        }
        $file["name"] = implode($tmp_file_name);
        move_uploaded_file($file["tmp_name"], '../uploads/' . $file["name"]);
        return '../uploads/' . $file["name"];
    }

}
