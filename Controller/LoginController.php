<!-- Author     : leang -->
<?php
include('databaseconn.php');
include('Object/User.php');
include('Pattern/PasswordFactory.php');
class LoginController{
    public function getLogin($Username, $Password){
        $passgen = new PasswordFactory();
        $saltedPass = $passgen->getSaltedPassword($Password);
        $sql = "SELECT * FROM users WHERE userID = '$Username' AND password = '$saltedPass'";
        $conn = Database::getInstance();
        $login_result = $conn->query($sql);
        $user = new User("","","","","","","","","","");
        if (!$login_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        while ($row = $login_result->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($row["userID"],$row["userType"], $row["Name"], $row["Address"], $row["Phone"], $row["Email"], $row["creditLimit"], $row["usedCredit"], $row["overDue"], $row["password"]);
        }
        
        return $user;
    }
}