<?xml version="1.0"?>

<!--
    Document   : DailyOrderProcessedReport.xsl
    Created on : August 2, 2018, 9:17 PM
    Author     : leang
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" indent="yes"/>
    <xsl:template match="/">
        <html>
            <head>
                <!-- Required meta tags -->
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
                     <xsl:variable name="php"><![CDATA[<?php include('../NavBar.php') ?>]]></xsl:variable>
                    
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
        </div>
        <!-- partial -->
        <!-- Side Menu -->
        <!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- partial -->
        <!-- Side Menu -->
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- WRITE YOUR CODE HERE! -->
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daily Order Processed Report</h4>
                            <table class="table table-user-information">
                                <thead>
                                    <tr><th>Date :</th><td><xsl:value-of select="//Date"/></td></tr>
                                    <tr><th>Order Count :</th><td><xsl:value-of select="//OrderPaid"/></td></tr>
                                    <tr>
                                        <th>Order Canceled :</th>
                                        <td><xsl:value-of select="//OrderCanceled"/></td>
                                    </tr>
                                    <tr><th>Total Amount :</th><td><xsl:value-of select="//AmountPaid"/></td></tr>
                                    <tr><th>Delivery Count :</th><td><xsl:value-of select="//DeliveryCount"/></td></tr>
                                    <tr><th>Pickup Count :</th><td><xsl:value-of select="//PickupCount"/></td></tr>
                                </thead>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                   <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 All rights reserved. Integrative Assignment PHP</span>
                   </div>
                </footer>
                <!-- partial -->
            
            <!-- main-panel ends -->
        </div>
   </div>
        <!-- page-body-wrapper ends -->

        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../vendors/js/vendor.bundle.base.js"></script>
        <script src="../vendors/js/vendor.bundle.addons.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="../js/off-canvas.js"></script>
        <script src="../js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!-- End custom js for this page-->
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
