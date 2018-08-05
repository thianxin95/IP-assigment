<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : customOrder.xsl
    Created on : August 3, 2018, 11:27 PM
    Author     : Hibiki
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" indent="yes"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <html>
            <head>
                <meta charset="UTF-8"/>
                <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
                <xsl:text disable-output-escaping="yes">
                    <![CDATA[<?php include_once 'PageTitle.php' ?>]]>
                </xsl:text>
                <!--<?php include('PageTitle.php') ?>-->
                <!-- plugins:css -->
                <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css" />
                <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"/>
                <!-- endinject -->
                <!-- plugin css for this page -->
                <!-- End plugin css for this page -->
                <!-- inject:css -->
                <link rel="stylesheet" href="css/style.css" />
                <!-- endinject -->
                <link rel="shortcut icon" href="images/favicon.png" />
                <title></title>
            </head>
            <body>
                <div class="container-scroller">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="index.php">Fiore Flowershop</a>
                  </div>
                  <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <div class="search-field d-none d-md-block">
                      <form class="d-flex align-items-center h-100" action="#">

                      </form>
                    </div>
                    <!-- nav bar -->
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black"><?php echo($Username) ?></p>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="customerProfile.php">
                                    <i class="mdi mdi-cached mr-2 text-success"></i>
                                    Profile Maintanance
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="mdi mdi-logout mr-2 text-primary"></i>
                                    Log Out
                                </a>
                            </div>
                        </li>
                    </ul>
                <!--<xsl:variable name="nav"></xsl:variable>-->
               <!--<?php include('NavBar.php') ?>-->
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                  <span class="mdi mdi-menu"></span>
                </button>
              </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
              <!-- Side Menu -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <span class="menu-title">Dashboard</span>
                                <i class="mdi mdi-home menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                                <span class="menu-title">Orders</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-medical-bag menu-icon"></i>
                            </a>
                            <div class="collapse" id="general-pages">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="LeeThianXin/View/OrderMenu.php"> New Order </a></li>
                                    <li class="nav-item"> <a class="nav-link" href="OrderList.php"> Order List </a></li>
                                    <li class="nav-item"> <a class="nav-link" href="Invoices.php"> Invoices </a></li>
                                </ul>
                            </div>
                        </li> 
                        <li class="nav-item">
                              <a class="nav-link" href="selectFlower.php">
                                  <span class="menu-title">Customize Order</span>
                                  <i class="mdi mdi-flower menu-icon"></i>
                              </a>
                        </li>
                    </ul>
                </nav>
              <!-- Side Menu -->
              <div class="main-panel">
                <div class="content-wrapper">
                    <!-- WRITE YOUR CODE HERE! -->
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class=" col-md-9 col-lg-9 "> 
                
                <h4>You select the following items :</h4>
                <table class="table">
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Price (RM)</th>
                        <th>Quantity</th>
                        <th>Total (RM)</th>
                    </tr>
                    <xsl:for-each select="customizedOrder/product">
                        <tr>
                            <td><xsl:value-of select="@productCode"/></td>
                            <td><xsl:value-of select="productName"/></td>
                            <td><xsl:value-of select="price"/></td>
                            <td><xsl:value-of select="quantity"/></td>
                            <td><xsl:value-of select="format-number(price*quantity,'#.00')"/></td>    
                            <xsl:variable name="count" select="price*quantity" />
                        </tr>
                    </xsl:for-each>
                   <!-- <xsl:variable name="totalQty" select="sum(//quantity)" />
                    <xsl:variable name="totalPrice" select="sum(//price)" />
                    <xsl:variable name="grandTotal" select="sum(price*quantity)" />
                    
                    <xsl:variable name="total">
                        <xsl:for-each select="*">
                            <value>
                                <xsl:value-of select="price * quantity" />
                            </value>
                        </xsl:for-each>
                    </xsl:variable>
                    <xsl:variable name="amt" select="exsl:node-set($total)/value" />-->
                    
                    <!--<tr>
                        <td colspan='4'>Total Amount (RM) : </td>
                        <td><xsl:value-of select="sum($amt)" /></td>
                    </tr>-->
                    <tr>
                        <td>
                            <button class="btn btn-gradient-primary btn-fw">
                                <a href="selectDesign.php" style="text-decoration:none;color:white;">Back</a></button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-gradient-primary btn-fw">
                                <a href="ScheduleDelivery.php" style="text-decoration:none;color:white;">Next</a>
                            </button></td>
                    </tr>
                    
                </table>
                
                </div>
              </div>
                </div>
            </div>
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 All rights reserved. Integrative Assignment PHP</span>
                </div>
            </footer>

            <!--<xsl:variable name="foot"></xsl:variable>-->
          <!--<?php include('Footer.php') ?>-->
                    </div>
               </div>
     
           </div>
         <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>

        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

                    
            </body>
            
        </html>
    </xsl:template>

</xsl:stylesheet>
