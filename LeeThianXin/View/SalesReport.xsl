<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : SalesReport.xsl
    Created on : August 9, 2018, 11:36 PM
    Author     : Daniel
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:output method="html"/>
    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <html>
            <head>
                 <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
                <link rel="shortcut icon" href="images/favicon.png" />
                <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css"/>
                <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"/>
                <!-- endinject -->
                <!-- plugin css for this page -->
                <!-- End plugin css for this page -->
                <!-- inject:css -->
                <link rel="stylesheet" href="../../css/style.css"/>
                <!-- endinject -->
                <link rel="shortcut icon" href="images/favicon.png" />
    
                <title>Sales Record</title>
            </head>
            <body>
                <h1>Product Sales make</h1>
                <a class="navbar-brand brand-logo" href="../../Employee/index.php">Back to Main menu</a>
                <hr/>
           
                        
                <table border="1" style="border-collapse:collapse"  align="center">
                    <tr>
                        <th>#</th>
                        <th>Product Code</th>
                        <th>Number of quantity</th>
                        <th>Total Amount($)</th>
                    </tr>
                    <xsl:for-each select="SaleReport/record">
                        <xsl:sort select="productCode" order="ascending"/>
                        <tr>
                           <td><xsl:value-of select="@recordID" /></td>
                            <td><xsl:value-of select="productCode" /></td>
                            <td><xsl:value-of select="quantity" /></td>
                            <td><xsl:value-of select="totalAmount" /></td>
                           
                        </tr>
                    </xsl:for-each>
                                                              
                </table>
                
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
