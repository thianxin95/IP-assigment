<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
              <!-- plugins:css -->
        <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../../css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="../../images/favicon.png" />
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
          <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Please enter order detail</h4>

                                        <form class="forms-sample">
                                         
                                            <div class="form-group">
                                                <label for="requiredate">Require date: </label>
                                                <?php
                                                        echo '<input type="date" class="form-control" name="requiredate" min= "'. date("Y-m-d").'">';
                                                        ?>
                                            </div>
                                            <div class="form-group">
                                                
                                            Pick up at store <input type="checkbox" value="Pickup" checked></br>
                                            </div>

                                            <div class="form-group">
                                                <label for="deliveryAddress">Delivery address</label>
                                                <input type="email" class="form-control" name="deliveryAddress" placeholder="Delivery Address">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">Confirm Password</label>
                                                <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                                            </div>
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input">
                                                    Remember me
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                                            <button class="btn btn-light">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
    </body>
</html>
