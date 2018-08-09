<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Chang Kwok Fei
 */
include_once 'Object/User.php';

interface userProfile {

    public function Create();
}

class CustomerRegistration implements userProfile {

    private $userID, $userType, $Address, $Phone, $Name, $Email, $creditLimit, $usedCredit, $overDue, $password;

    public function __construct(User $userinfo) {
        $this->userID = $userinfo->getUserID();
        $this->userType = $userinfo->getUserType();
        $this->Name = $userinfo->getName();
        $this->Address = $userinfo->getAddress();
        $this->Phone = $userinfo->getPhone();
        $this->Email = $userinfo->getEmail();
        $this->creditLimit = $userinfo->getCreditLimit();
        $this->usedCredit = $userinfo->getUsedCredit();
        $this->overDue = $userinfo->getOverDue();
        $this->password = $userinfo->getPassword();
    }

    function getUserID($userID) {
        $this->userID = $userID;
    }

    function getUserType($userType) {
        $this->userType = $userType;
    }

    function getAddress($Address) {
        $this->Address = $Address;
    }

    function getPhone($Phone) {
        $this->Phone = $Phone;
    }

    function getName($Name) {
        $this->Name = $Name;
    }

    function getEmail($Email) {
        $this->Email = $Email;
    }

    function getCreditLimit($creditLimit) {
        $this->creditLimit = $creditLimit;
    }

    function getUsedCredit($usedCredit) {
        $this->usedCredit = $usedCredit;
    }

    function getOverDue($overDue) {
        $this->overDue = $overDue;
    }

    function getPassword($password) {
        $this->password = $password;
    }

    public function Create() {
        // put your SQL here
        $query = "INSERT INTO users (userID, userType, Name, Address,Phone, Email, creditLimit, usedCredit, overDue, password)VALUES ('$this->userID','$this->userType','$this->Name','$this->Address','$this->Phone','$this->Email','$this->creditLimit','$this->usedCredit','$this->overDue','$this->password')";
        $conn = Database::getInstance();

        $create_result = $conn->query($query);
        
        if (!$create_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
    }

}

Class CorporateRegistration implements userProfile {

    private $userID, $userType, $Address, $Phone, $Name, $Email, $creditLimit, $usedCredit, $overDue, $password;

   public function __construct(User $userinfo) {
        $this->userID = $userinfo->getUserID();
        $this->userType = $userinfo->getUserType();
        $this->Name = $userinfo->getName();
        $this->Address = $userinfo->getAddress();
        $this->Phone = $userinfo->getPhone();
        $this->Email = $userinfo->getEmail();
        $this->creditLimit = $userinfo->getCreditLimit();
        $this->usedCredit = $userinfo->getUsedCredit();
        $this->overDue = $userinfo->getOverDue();
        $this->password = $userinfo->getPassword();
    }

    function getUserID($userID) {
        $this->userID = $userID;
    }

    function getUserType($userType) {
        $this->userType = $userType;
    }

    function getAddress($Address) {
        $this->Address = $Address;
    }

    function getPhone($Phone) {
        $this->Phone = $Phone;
    }

    function setName($Name) {
        $this->Name = $Name;
    }

    function getEmail($Email) {
        $this->Email = $Email;
    }

    function getCreditLimit($creditLimit) {
        $this->creditLimit = $creditLimit;
    }

    function getUsedCredit($usedCredit) {
        $this->usedCredit = $usedCredit;
    }

    function getOverDue($overDue) {
        $this->overDue = $overDue;
    }

    function getPassword($password) {
        $this->password = $password;
    }

    public function Create() {
        $query = "INSERT INTO users (userID, userType, Name, Address,Phone, Email, creditLimit, usedCredit, overDue, password)VALUES ('$this->userID','$this->userType','$this->Name','$this->Address','$this->Phone','$this->Email','$this->creditLimit','$this->usedCredit','$this->overDue','$this->password')";
        $conn = Database::getInstance();

        $create_result = $conn->query($query);
        
        if (!$create_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
    }

}

class CustomerFactory {

    public static function Register(User $userprofile) {
        // return new CustomerRegistration($userprofile);
        $newUser = new CustomerRegistration($userprofile);
        $newUser->Create();
        return null;
    }

}
class CorporateFactory {

    public static function Register(User $userprofile) {
        // return new CustomerRegistration($userprofile);
        $newUser = new CorporateRegistration($userprofile);
        $newUser->Create();
        return null;
    }

}
