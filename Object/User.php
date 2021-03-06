<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author leang
 */
class User {
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

    public function __construct($userID, $userType,$Name,$Address,$Phone,$Email, $creditLimit, $usedCredit, $overDue,$password) {
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
