<?php

class Customer {

    public $userID;
    public $userType;
    public $Address;
    public $Phone;
    public $Name;
    public $Email;
    public $creditLimit;
    public $usedCredit;
    public $overDue;
    public $password;

    public function Customer($userID, $userType,$Name,$Address,$Phone,$Email, $creditLimit, $usedCredit, $overDue,$password) {
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

    function getName() {
        return $this->Name;
    }
     function getAddress() {
        return $this->Address;
    }
     function getPhone() {
        return $this->Phone;
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

}
