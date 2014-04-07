<?php

class File {
    /*
     * uploadFile()
     * 
     * Upload een bestand naar de server.
     * 
     * @param Array $file Het up te loaden bestand.
     * @return Array with arr[0]==true on success and path in arr[1].
     * @return Array with arr[0]==false || arr[0]==errCode and arr[1] description on error
     */

    public static function uploadFile($file) {
        if ($file["error"] > 0) {
            print "error-Er ging iets mis bij het uploaden van het bestand!";
        }
        $allowed_ext = Array("gif", "png", "jpeg", "jpg", "docx", "doc", "pdf", "xls", "xlsx", "mp3", "mp4", "webm", "avi", "wav", "wmv", "txt", "flv");
        if (!in_array(end(".", explode($file["name"])), $allowed_ext) || $file["size"] > 1024 * 1024 * 2) {
            print_r(array('false', 'Dit bestand heeft geen betandsextensie of is te groot!'));
        }
               print 'hefaljkhal;shdg'; 
        $tmp_file_name = $file["name"];
        $i = 1;
        while (file_exists('../uploads/' . $tmp_file_name)) {
            $tmp_file_name = preg_split(".", $tmp_file_name);
            $tmp_file_name[count($tmp_file_name) - 1] . $i;
        }
        $file["name"] = implode($tmp_file_name);
        move_uploaded_file($file["tmp_name"], '../uploads/' . $file["name"]);
        print(array(true, '../uploads/' . $file["name"]));
    }

}
