<?php
class User
{
	private $db;
	private $id;

	public function __construct($db, $id)
	{
		$this->db = $db;
		$this->id = $id;
	}

	public static function login($db, $username, $password)
	{
		$logged_in=false;
		$dbpass = $db->select("users",array("password"),array("username"=>$username));
		$password_hash_entered = hash("sha1", $password);
		if($dbpass["password"] == $password_hash_entered)
		{
			$logged_in=true;
		}
		
		if($logged_in)
		{
			$query = $db->select("users",array("id"),array("username"=>$username));
			$_SESSION['id']=$query['id'];
			echo "Je bent ingelogd!";
		}
		else
		{
			echo "Uw combinatie van gebruikersnaam en wachtwoord komt helaas niet voor in onze database...";
		}
	}
	
	public static function register($db, $username, $password1, $password2, $first_name, $last_name, $student_number, $birth_date, $email) {
		echo "Username: ".$username."<br/>";
		echo "Password1: ".$password1."<br/>";
		echo "Password2: ".$password2."<br/>";
		echo "First name: ".$first_name."<br/>";
		echo "Last name: ".$last_name."<br/>";
		echo "Student number: ".$student_number."<br/>";
		echo "Birth date: ".$birth_date."<br/>";
		echo "Email: ".$email."<br/><br/>";

		$failed = false;

        // controle username
        if (strlen($username) > 20 || strlen($username) < 0) {
            echo ("Je gebruikersnaam voldoet niet aan de lengte. <br/>");
            $failed = true;
        } else {
            $username = trim($username);
        }

        // controle password
        if ($password1 == $password2) { // vergelijken wachtwoorden
            if (strlen($password1) <=8) { // is de minimale lengte gehaald?
                echo ("Je wachtwoord heeft niet de goede lengte. <br/>");
                $failed = true;
            }
        } else {
            echo ("De beide wachtwoorden komen niet overeen. <br/>");
            $failed = true;
        }

        // controle first_name
        if (strlen($first_name) > 20 || strlen($first_name) < 0) {
            echo ("Je voornaam heeft niet de goede lengte.");
            $failed = true;
        } else {
            $first_name = trim($first_name);
            $first_name = ucfirst($first_name);
        }

        // controle last name
        if (strlen($last_name) > 20 || strlen($last_name) < 0){
            echo ("Je achternaam heeft niet de goede lengte. <br/>");
            $failed = true;
        } else {
            $last_name = trim($last_name);
            $last_name = ucfirst($last_name);
        }

        // controle geboorte datum

        // controle email adres
        if (strlen($email) > 0 && strlen($email) < 50){
            if (!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/',$email)){
                echo ("Er is geen geldig email adres ingevoerd. <br/>");
                $failed = true;
            }
        } else {
            echo ("Het email adres is niet ingevuld of te lang. <br/>");
            $failed = true;
        }
		
		if (!$failed) {
            // username toevoegen aan database
            if ($db->insert('users', array('username'=>$username, 'password'=>sha1($password1), 'first_name'=>$first_name, 'last_name'=>$last_name, 'student_number'=>$student_number, 'birth_date'=>$birth_date, 'email'=>$email))) {
                echo ("Alles klopt");
            } else {
                echo ("Database insert error");
            }
        } else {
            echo ("Er klopt iets niet");
        }
	}
	
	public static function logout()
	{
		session_destroy();
		Header("Location: index.php");
	}
	
	public function getUsername()
	{
		$this->db->select("users",array("username"),array("id"=>$this->$id));
	}
	
	public function getPassword()
	{
		$this->db->select("users",array("password"),array("id"=>$this->$id));
	}
	
	public function getFirstName()
	{
		$this->db->select("users",array("first_name"),array("id"=>$this->$id));
	}
	
	public function getLastName()
	{
		$this->db->select("users",array("last_name"),array("id"=>$this->$id));
	}
	
	public function getStudentNumber()
	{
		$this->db->select("users",array("student_number"),array("id"=>$this->$id));
	}
	
	public function getBirthDate()
	{
		$this->db->select("users",array("birth_date"),array("id"=>$this->$id));
	}
	
	public function getEmail()
	{
		$this->db->select("users",array("email"),array("id"=>$this->$id));
	}
	
	public function getLastLogin()
	{
		$this->db->select("users",array("last_login"),array("id"=>$this->$id));
	}
	
	public function setUsername($username)
	{
		$this->db->update("users",array("username"=>$username),array("id"=>$this->id));
	}
	
	public function setPassword($password)
	{
		$this->db->update("users",array("password"=>$password),array("id"=>$this->id));
	}
	
	public function setFirstName($firstName)
	{
		$this->db->update("users",array("first_name"=>$firstName),array("id"=>$this->id));
	}
	
	public function setLastName($lastName)
	{
		$this->db->update("users",array("last_name"=>$lastName),array("id"=>$this->id));
	}
	
	public function setStudentNumber($studentNumber)
	{
		$this->db->update("users",array("student_number"=>$studentNumber),array("id"=>$this->id));
	}
	
	public function setBirthDate($birthDate)
	{
		$this->db->update("users",array("birth_date"=>$birthDate),array("id"=>$this->id));
	}
	
	public function setEmail($email)
	{
		$this->db->update("users",array("email"=>$email),array("id"=>$this->id));
	}
	
	public function setLastLogin($lastLogin)
	{
		$this->db->update("users",array("last_login"=>$lastLogin),array("id"=>$this->id));
	}
}
?>