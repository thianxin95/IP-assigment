<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : GenerateOrderSales.xsl
    Created on : August 6, 2018, 1:37 PM
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
                <table border = "1">
                <title>GenerateOrderSales.xsl</title>
                <xsl:for-each select="OrderDetail">
                    <tr>
                        <td>
                            <xsl:value-of select="orderID"/>
                        </td>
                    </tr>
                </xsl:for-each>
                    </table>
            </head>
            <body>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
