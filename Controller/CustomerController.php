<?php



/**
 * Description of CustomerController
 *
 * @author Daniel
 */
include_once '../../databaseconn.php';
include_once '../../Object/User.php';
class CustomerController {
    public function updateUserUsedCredit($userID, $usedCredit){
          $conn = Database::getInstance();
        $query = "UPDATE users SET usedCredit = '$usedCredit' WHERE userID = '$userID'";
        $updateResult = $conn->query($query);
        if (!$updateResult) {
            trigger_error('Invalid Query : ' . $conn->error);
        }
    }
}
