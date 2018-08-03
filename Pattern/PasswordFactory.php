<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasswordFactory
 *
 * @author leang
 */
interface PasswordInterface {
    public function getHashedPassword($plainPassword);
    public function getSaltedPassword($plainPassword);
}
class PasswordFactory implements PasswordInterface{
    //put your code here
    private $plain_password;
    private $salt = "GuBWkcx6LAkOf5pQmJ3JnfCfaLx9thpv"; // Random Letters + Numbers
    public function getHashedPassword($plainPassword) {
        $sha1hash = sha1($plainPassword);
        return $sha1hash;
    }

    public function getSaltedPassword($plainPassword) {
       $pass_gen = new PasswordFactory();
       $sha1pass = $pass_gen->getHashedPassword($plainPassword);
       $ShaAndSalt = (sha1($sha1pass).sha1($this->salt)); //Secure enough, reverse lookup is IMPOSSIBLE(NEARLY) Cant guarantee tho.
       return $ShaAndSalt;
    }

}
