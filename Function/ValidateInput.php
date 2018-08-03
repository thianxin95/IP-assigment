<?php

class ValidateInput {

    function __construct() {
        
    }

    function getValidatedInput($content) {
        $content = trim($content);
        $content = stripslashes($content);
        $content = htmlspecialchars($content);
        //$content = mysql_real_escape_string($content);
        return $content;
    }

}
