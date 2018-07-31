<?php

class Customer {

    public $userID;
    public $userType;
    public $Name;
    public $Email;
    public $creditLimit;
    public $usedCredit;
    public $overDue;

    public function Customer($userID, $userType, $Name, $Email, $creditLimit, $usedCredit, $overDue) {
        $this->userID = $userID;
        $this->userType = $userType;
        $this->Name = $Name;
        $this->Email = $Email;
        $this->creditLimit = $creditLimit;
        $this->usedCredit = $usedCredit;
        $this->overDue = $overDue;
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

}
