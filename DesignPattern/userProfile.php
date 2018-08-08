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
interface userProfile {
   public function CustomerType();
}
   
   class Customer implements userProfile {
    private $userID,$userType,$Address,$Phone,$Name,$Email,$creditLimit,$usedCredit,$overDue,$password;
    
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

    public function CustomerType($userType) {
    }

}

     


Class Corporate implements userProfile{
         
    private $userID,$userType,$Address,$Phone,$Name,$Email,$creditLimit,$usedCredit,$overDue,$password;
    
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

    public function CustomerType() {
        
    }

}

 class CustomerFactory{
     public function __construct() {
        
    }
    
    public static function Create($type){
        
    }
 }

     
    



   

