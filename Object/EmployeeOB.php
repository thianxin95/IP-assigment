<?php
class Employee{
    private $userID;
    private $userType;
    private $Address;
    private $Phone;
    private $Name;
    private $Email;
    private $creditLimit;
    private $usedCredit;
    private $overDue;
    private $password;
    
    
    public function Employee($userID, $userType,$Name,$Address,$Phone,$Email, $creditLimit, $usedCredit, $overDue,$password){
        $this->userID = $userID;
        $this->userType = $userType;
        $this->Name = $Name;
        $this->Address=$Address;
        $this->Phone=$Phone;
        $this->Email = $Email;
        $this->creditLimit = $creditLimit;
        $this->usedCredit = $usedCredit;
        $this->overDue = $overDue;
        $this->password= $password;
    }
   
    function getUserID() {
        return $this->userID;
    }

    function getUserType() {
        return $this->userType;
    }

    function getAddress() {
        return $this->Address;
    }

    function getPhone() {
        return $this->Phone;
    }

    function getName() {
        return $this->Name;
    }

    function getEmail() {
        return $this->Email;
    }

    function getCreditLimit() {
        return $this->creditLimit;
    }

    function getUsedCredit() {
        return $this->usedCredit;
    }

    function getOverDue() {
        return $this->overDue;
    }

    function getPassword() {
        return $this->password;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setUserType($userType) {
        $this->userType = $userType;
    }

    function setAddress($Address) {
        $this->Address = $Address;
    }

    function setPhone($Phone) {
        $this->Phone = $Phone;
    }

    function setName($Name) {
        $this->Name = $Name;
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }

    function setCreditLimit($creditLimit) {
        $this->creditLimit = $creditLimit;
    }

    function setUsedCredit($usedCredit) {
        $this->usedCredit = $usedCredit;
    }

    function setOverDue($overDue) {
        $this->overDue = $overDue;
    }

    function setPassword($password) {
        $this->password = $password;
    }


}

