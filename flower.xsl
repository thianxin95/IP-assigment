<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : flower.xsl
    Created on : July 31, 2018, 9:59 PM
    Author     : User
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
                <title>flower.xsl</title>
            </head>
            <body>
                <hr/>
                <table border="1">
                    <tr>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Price</th>
                    </tr>
                    <xsl:for-each select="catalogs/catalog">
                    <tr>
                        <td><xsl:value-of select="code"/></td>
                        <td><xsl:value-of select="type"/></td>
                        <td><xsl:value-of select="description"/></td>
                        <td><xsl:value-of select="stock"/></td>
                        <td><xsl:value-of select="price"/></td>
                    </tr>
                    </xsl:for-each>  
                </table>
                <hr/>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
