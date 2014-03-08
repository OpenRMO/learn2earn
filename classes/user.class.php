<?php

class User {

    private $db;
    private $id;

    public function __construct($db, $id) {
        $this->db = $db;
        $this->id = $id;
    }

    public static function login($db, $username, $password) {
        $logged_in = false;
        if (!empty($username) && !empty($password)) {
            $dbpass = $db->select("users", array("password"), array("username" => $username));
            $password_hash_entered = hash("sha1", $password);
            if ($dbpass[0]["password"] === $password_hash_entered) {
                $logged_in = true;
            }
            if ($logged_in) {
                $query = $db->select("users", array("id"), array("username" => $username));
                $_SESSION['id'] = $query[0]["id"];
                return 1;
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }

    /*
     * register
     * 
     * @param Array $user_row Een array die alle userdata bevat. Werd eerder in losse vars doorgegeven.
     * @return 
     */

    public static function register($db, $username, $password1, $password2, $first_name, $last_name, $student_number, $birth_date, $email) {

        // controle username
        if (strlen($username) > 20 || strlen($username) < 0) {
            return 2;
        } else {
            $username = trim($username);
        }

        // controle password
        if ($password1 === $password2) { // vergelijken wachtwoorden
            if (strlen($password1) <= 8) { // is de minimale lengte gehaald?
                return 3;
            }
        } else {
            return 4;
        }

        // controle first_name
        if (strlen($first_name) > 20 || strlen($first_name) < 0) {
            return 5;
        } else {
            $first_name = trim($first_name);
            $first_name = ucfirst($first_name);
        }

        // controle last name
        if (strlen($last_name) > 20 || strlen($last_name) < 0) {
            return 6;
        } else {
            $last_name = trim($last_name);
            $last_name = ucfirst($last_name);
        }

        // controle geboorte datum
        // controle email adres
        if (strlen($email) > 0 && strlen($email) < 50) {
            if (!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)) {
                return 7;
            }
        } else {
            return 8;
        }

        // username toevoegen aan database
        if ($db->insert('users', array('username' => $username, 'password' => sha1($password1), 'first_name' => $first_name, 'last_name' => $last_name, 'student_number' => $student_number, 'birth_date' => $birth_date, 'email' => $email))) {
            return true;
        } else {
            return 9;
        }
    }

    public function getID() {
        return $this->_id;
    }

    public static function logout() {
        session_destroy();
        Header("Location: index.php");
    }

    public function getUsername() {
        $username = $this->db->select("users", array("username"), array("id" => $this->id));
        return $username[0]["username"];
    }

    public function getPassword() {
        $password = $this->db->select("users", array("password"), array("id" => $this->id));
        return $password[0]["password"];
    }

    public function getFirstName() {
        $firstName = $this->db->select("users", array("first_name"), array("id" => $this->id));
        return $firstName[0]["first_name"];
    }

    public function getLastName() {
        $lastName = $this->db->select("users", array("last_name"), array("id" => $this->id));
        return $lastName[0]["last_name"];
    }

    public function getStudentNumber() {
        $studentNumber = $this->db->select("users", array("student_number"), array("id" => $this->id));
        return $studentNumber[0]["student_number"];
    }

    public function getBirthDate() {
        $birthDate = $this->db->select("users", array("birth_date"), array("id" => $this->id));
        return $birthDate[0]["birth_date"];
    }

    public function getEmail() {
        $email = $this->db->select("users", array("email"), array("id" => $this->id));
        return $email[0]["email"];
    }

    public function getLastLogin() {
        $lastLogin = $this->db->select("users", array("last_login"), array("id" => $this->id));
        return $lastLogin[0]["last_login"];
    }

    public function setUsername($username) {
        $this->db->update("users", array("username" => $username), array("id" => $this->id));
    }

    public function setPassword($password) {
        $this->db->update("users", array("password" => $password), array("id" => $this->id));
    }

    public function setFirstName($firstName) {
        $this->db->update("users", array("first_name" => $firstName), array("id" => $this->id));
    }

    public function setLastName($lastName) {
        $this->db->update("users", array("last_name" => $lastName), array("id" => $this->id));
    }

    public function setStudentNumber($studentNumber) {
        $this->db->update("users", array("student_number" => $studentNumber), array("id" => $this->id));
    }

    public function setBirthDate($birthDate) {
        $this->db->update("users", array("birth_date" => $birthDate), array("id" => $this->id));
    }

    public function setEmail($email) {
        $this->db->update("users", array("email" => $email), array("id" => $this->id));
    }

    public function setLastLogin($lastLogin) {
        $this->db->update("users", array("last_login" => $lastLogin), array("id" => $this->id));
    }

}

?>
