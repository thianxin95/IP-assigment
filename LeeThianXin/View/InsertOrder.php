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
                                        <h4 class="card-title">Enter basic order detail</h4>
                                        <p class="card-description">
                                            Basic form layout
                                        </p>
                                        <form class="forms-sample">
                                         
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Date: </label>
                                                <?php
                                                        echo '<input type="date" class="form-control" name="date" min= "'. date("Y-m-").'">';
                                                        ?>
                                            </div>
                                            
                                            <input type="checkbox" name="vehicle" value="Bike"> I have a bike<br>
  <input type="checkbox" name="vehicle" value="Car" checked> I have a car<br>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
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
