<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : customOrder.xsl
    Created on : August 3, 2018, 11:27 PM
    Author     : Hibiki
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
                <title>customOrder.xsl</title>
            </head>
            <body>
                
                <h4>You select the following items :</h4>
                <table>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total (RM)</th>
                    </tr>
                    <xsl:for-each select="customizedOrder/product">
                        <tr>
                            <td><xsl:value-of select="@productCode"/></td>
                            <td><xsl:value-of select="productName"/></td>
                            <td><xsl:value-of select="price"/></td>
                            <td><xsl:value-of select="quantity"/></td>
                            <td><xsl:value-of select="price*quantity"/></td>    
                        </tr>
                    </xsl:for-each>
                    <xsl:variable name="totalQty" select="sum(//quantity)" />
                    <xsl:variable name="totalPrice" select="sum(//price)" />
                    <xsl:variable name="grandTotal" select="$totalQty * $totalPrice" />
                    <tr>
                        <td colspan='4'>Total Amount (RM) : </td>
                        <td><xsl:value-of select="$grandTotal" /></td>
                       
                    </tr>
                </table>
                <button>
                <a href="ScheduleDelivery.php">Next</a>
                </button>
                
                    
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
