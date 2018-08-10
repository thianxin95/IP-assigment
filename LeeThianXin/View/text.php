<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of text
 *
 * @author Daniel
 */
    $xml = new DOMDocument('1.0');
    $xml->formatOutput=true;
    
//    $saleReport=$xml->createElement("SaleRecord");  
//    $xml->appendChild($saleReport);   
    
    $record=$xml->createElement("record");
    $record->setAttribute("recordID", "RCD1");
    $xml->appendChild($record);
    
    $productCode=$xml->createElement("productCode", "hello");
    $record->appendChild($productCode);
    
    $record=$xml->createElement("record");
    $record->setAttribute("recordID", "RCD1");
    $xml->appendChild($record);
    
    $productCode=$xml->createElement("productCode", "hello");
    $record->appendChild($productCode);
    echo "<xmp>".$xml->saveXML()."<xmp>";
    
    

?>