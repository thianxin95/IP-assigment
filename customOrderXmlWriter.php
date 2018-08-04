<?php
    ini_set('display_errors', 1);
    include_once './Object/BouquetItem.php';
    include_once './customOrderDA.php';
    include_once './Controller/ProductController.php';

class customOrderXmlWriter {
    //put your code here
    //private $cusOrder = array();
    
    
    public function writeToXML($cusOrder){
        
        $bouquet = new BouquetItem('','','','');
        
        //$xml = new DOMDocument("1.0","UTF-8");
        $imp = new DOMImplementation;
        $dtd = $imp->createDocumentType('customizedOrder', '', 'customOrder.dtd');
        $dom = $imp->createDocument("","",$dtd);
        $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="customOrder.xsl"');
        
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        
        $xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="customOrder.xsl"');
        $dom->appendChild($xslt);
        
        $customOrder = $dom->createElement("customizedOrder");
        
        $dom-> appendChild($customOrder);
        
        foreach ($cusOrder as $order){
            $bouquet = $order;
            $getProd = new ProductController();
            $prod = $getProd->getProduct($bouquet->getProductCode());
            $product = $dom->createElement("product");
            
            $product ->setAttribute("productCode", $bouquet->getProductCode());
            $customOrder-> appendChild($product);
            
            $productName = $dom ->createElement("productName", $prod->getProductDes());
            $product ->appendChild($productName);
            
            $productType = $dom ->createElement("productType",$prod->getProductType());
            $product->appendChild($productType);
            
            $price = $dom->createElement("price",$bouquet->getUnitPrice());
            $product->appendChild($price);
            
            $quantity = $dom->createElement("quantity",$bouquet->getQuantity());
            $product->appendChild($quantity);
            
            
            
        }
        
        $dom->save("customOrder.xml");
       // $productName
        
        

    }
}
