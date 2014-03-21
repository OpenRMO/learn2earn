<?php

class User {

    private $_db;
    private $_id;
    private $_birthdate;
    private $_email;
    private $_firstname;
    private $_lastname;
    private $_student_number;
    private $_username;
    private $_last_login;

    public function __construct($db, $id) {
        $this->_db = $db;
        $this->_id = $id;

        $result = $db->select("users", "*", array("id" => $this->_id));

        $this->setBirthDate($result[0]["birth_date"]);
        $this->setEmail($result[0]["email"]);
        $this->setFirstName($result[0]["first_name"]);
        $this->setLastLogin($result[0]["last_login"]);
        $this->setLastName($result[0]["last_name"]);
        $this->setStudentNumber($result[0]["student_number"]);
        $this->setUsername($result[0]["username"]);
    }

    public function __destruct() {
        $this->update();
    }

    /*
     * login();
     * 
     * Een functie de een gebruiker probeert in te loggen door een sessie aan te maken.
     * 
     * @param Database $db Een database object geschikt voor de huidige context.
     * @param String $username De gebruikersnaam van de gebruiker die wil inloggen.
     * @param String $password Het wachtwoord van de gebruiker die wil inloggen.
     * @return Integer De foutcode of succescode van de inlogpoging (1 = succesvol, al het andere is een foutcode).
     */

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
     * register();
     * 
     * Een functie die een nieuwe gebruiker registreert.
     * 
     * @param Database $db Een database object geschikt voor de huidige context.
     * @param String $username Een string met de nieuwe gebruikersnaam.
     * @param String $password1 Het nieuwe wachtwoord van de gebruiker.
     * @param String $password2 Het nieuwe wachtwoord van de gebruiker ter controle.
     * @param String $first_name De nieuwe voornaam van de nieuwe gebruiker.
     * @param String $last_name De nieuwe achternaam van de nieuwe gebruiker.
     * @param String $student_number Het nieuwe studentennummer van de nieuwe gebruiker.
     * @param String $birth_date De nieuwe geboortedatum van de nieuwe gebruiker.
     * @param String $email Het nieuwe e-mailadres van de nieuwe gebruiker.
     * @return Integer De foutcode of succescode van de registratie (1 = succesvol, al het andere is een foutcode).
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

    /*
     * delete()
     * 
     * Verwijder de gebruiker van de huidige context.
     * 
     * @return Boolean Succesvol of niet.
     */

    public function delete() {
        $result = $this->_db->delete("users", array("id" => $this->_id));
        if ($result == false) {
            return false;
        }

        unset($this->_db);
        unset($this->_id);
        unset($this->_username);
        unset($this->_student_number);
        unset($this->_lastname);
        unset($this->_last_login);
        unset($this->_firstname);
        unset($this->_email);
        unset($this->_birthdate);
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
        return $this->_db->update("users", array(
                    "birth_date" => $this->_birthdate,
                    "email" => $this->_email,
                    "first_name" => $this->_firstname,
                    "last_name" => $this->_lastname,
                    "last_login" => $this->_last_login,
                    "student_number" => $this->_student_number,
                    "username" => $this->_username
                        ), array("id" => $this->_id));
    }

    /*
     * getID()
     * 
     * Verkrijg het ID van de gebruiker in de huidige context
     * 
     * @return Integer Het ID van het cluster.
     */

    public function getID() {
        return $this->_id;
    }

    /*
     * logout()
     * 
     * Log de huidige gebruiker uit.
     * 
     * @return Boolean Succesvol of niet.
     */

    public static function logout() {
        session_destroy();
        return true;
    }

    /*
     * getUsername()
     * 
     * Verkrijg de gebruikersnaam van de gebruiker uit de huidige context.
     * 
     * @return String De gebruikersnaam van de gebruiker.
     */

    public function getUsername() {
        return $this->_username;
    }

    /*
     * getFirstName()
     * 
     * Verkrijg de voornaam van de gebruiker uit de huidige context.
     * 
     * @return String De voornaam van de gebruiker.
     */

    public function getFirstName() {
        return $this->_firstname;
    }

    /*
     * getLastName()
     * 
     * Verkrijg de familienaam van de gebruiker uit de huidige context.
     * 
     * @return String De familienaam van de gebruiker.
     */

    public function getLastName() {
        return $this->_lastname;
    }

    /*
     * getStudentNumber()
     * 
     * Verkrijg het studentennummer van de gebruiker uit de huidige context.
     * 
     * @return String Het studentennummer van de gebruiker.
     */

    public function getStudentNumber() {
        return $this->_student_number;
    }

    /*
     * getBirthDate()
     * 
     * Verkrijg de geboortedatum van de gebruiker uit de huidige context.
     * 
     * @return String De geboortedatum van de gebruiker.
     */

    public function getBirthDate() {
        return $this->_birthdate;
    }

    /*
     * getEmail()
     * 
     * Verkrijg het e-mailadres van de gebruiker uit de huidige context.
     * 
     * @return String Het e-mailadres van de gebruiker.
     */

    public function getEmail() {
        return $this->_email;
    }

    /*
     * getLastLogin()
     * 
     * Verkrijg de datum en tijd van de laatste login van de gebruiker uit de huidige context.
     * 
     * @return Integer De laatste login van de gebruiker.
     */

    public function getLastLogin() {
        return $this->_last_login;
    }

    /*
     * setUsername()
     * 
     * Stelt een nieuwe gebruikersnaam in voor de gebruiker van de huidige context.
     * 
     * @param String $username De nieuwe gebruikersnaam voor de gebruiker.
     */

    public function setUsername($username) {
        $this->_username = $username;
    }

    /*
     * setPassword()
     * 
     * Stelt een nieuw wachtwoord in voor de gebruiker van de huidige context.
     * 
     * @param String $password Het nieuwe wachtwoord voor de gebruiker.
     */

    public function setPassword($password) {
        $this->_db->update("users", array("password" => $password), array("id" => $this->_id));
    }

    /*
     * setFirstName()
     * 
     * Stelt een nieuwe voornaam in voor de gebruiker van de huidige context.
     * 
     * @param String $firstName De nieuwe voornaam voor de gebruiker.
     */

    public function setFirstName($firstName) {
        $this->_firstname = $firstName;
    }

    /*
     * setLastName()
     * 
     * Stelt een nieuwe familienaam in voor de gebruiker van de huidige context.
     * 
     * @param String $lastName De nieuwe familienaam voor de gebruiker.
     */

    public function setLastName($lastName) {
        $this->_lastname = $lastName;
    }

    /*
     * setStudentNumber()
     * 
     * Stelt een nieuw studentennummer in voor de gebruiker van de huidige context.
     * 
     * @param String $studentNumber Het nieuwe studentennummer voor de gebruiker.
     */

    public function setStudentNumber($studentNumber) {
        $this->_student_number = $studentNumber;
    }

    /*
     * setBirthDate()
     * 
     * Stelt een nieuwe geboortedatum in voor de gebruiker van de huidige context.
     * 
     * @param String $birthDate De nieuwe geboortedatum voor de gebruiker.
     */

    public function setBirthDate($birthDate) {
        $this->_birthdate = $birthDate;
    }

    /*
     * setEmail()
     * 
     * Stelt een nieuw e-mailadres in voor de gebruiker van de huidige context.
     * 
     * @param String $email Het nieuwe e-mailadres voor de gebruiker.
     */

    public function setEmail($email) {
        $this->_email = $email;
    }

    /*
     * setLastLogin()
     * 
     * Stelt de nieuwe laatste login in voor de gebruiker van de huidige context.
     * 
     * @param String $lastLogin De nieuwe laatste login voor de gebruiker.
     */

    public function setLastLogin($lastLogin) {
        $this->_last_login = $lastLogin;
    }

}