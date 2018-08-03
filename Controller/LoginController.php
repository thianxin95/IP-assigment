<?php
include('databaseconn.php');
include('Object/User.php');

class LoginController{
    public function getLogin($Username, $Password){
        $sql = "SELECT * FROM users WHERE userID = '$Username' AND password = '$Password'";
        $conn = Database::getInstance();
        $login_result = $conn->query($sql);
        if (!$login_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        while ($row = $login_result->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($row["userID"],$row["userType"], $row["Name"], $row["Address"], $row["Phone"], $row["Email"], $row["creditLimit"], $row["usedCredit"], $row["overDue"], $row["password"]);
        }
        return $user;
    }
}