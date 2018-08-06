<?php
    include_once './Object/BouquetItem.php';
    include_once './databaseconn.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bouquetItemControl.php
 *
 * @author Chan Jeng Yang
 */
class bouquetItemControl {
    private $tableName = "bouquetitem";


    public function insertRecord(BouquetItem $bouquetItem){
        $data= [
            'custOrderID' => $bouquetItem->getCustOrderID(),
            'productCode' => $bouquetItem->getProductCode(),
            'quantity' => $bouquetItem->getQuantity(),
            'unitPrice' => $bouquetItem->getUnitPrice()
        ];
        
        $connection = Database::getInstance(); 
        $query = "INSERT INTO $this->tableName (custOrderID,productCode,quantity,unitPrice)"
                . "VALUES (:custOrderID,:productCode,:quantity,:unitPrice)";
        $stmt = $connection->prepare($query);
        $stmt -> execute($data);
        $connection->close();
                
    }
}
