<?php //IDEA:
    require_once("config/db.class.php");
    class User{
        public $userID;
        public $userName;
        public $email;
        public $password;
        public function save(){
            $db = new Db();
            $sql = "INSERT INTO users (UserName, Email, Password) VALUES ('".mysql_real_escape_string($db->connect(), 
            $this->userName)."','".mysql_real_escape_string($db->connect(),
            $this->email)."','".md5(mysql_real_escape_string($db->connect(), $this->password))."')";
            $result = $db->query_execute($sql);
            return $result;
        }

        public static function checkLogin($username, $password){
            $password = md5($password);
            $db= new Db();
            $sql = "SELECT * FROM users where UserName='$username' AND Password = '$password'";
            $result = $db->query_execute($sql);
            return $result;
        }
    }
    ?>