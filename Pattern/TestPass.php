<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
<!-- Author     : leang -->
-->
<?php
include_once 'PasswordFactory.php';
if (isset($_POST['submit'])) {
    $plainpass = $_POST['Password'];
    $passwordFac = new PasswordFactory();
    $encpass = $passwordFac->getSaltedPassword($plainpass);
    $shapass = $passwordFac->getHashedPassword($plainpass);
    echo "Salted Password = ". $encpass;
    echo "<br/>Hash Password = ".$shapass;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="TestPass.php">
            <input type="password" name="Password" id="Password" />
            <button type="submit" id="submit" name="submit">Submit</button>
        </form>
    </body>
</html>
