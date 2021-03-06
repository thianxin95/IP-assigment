<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="Catalog/xsl/flowercatalog.xml">
                <span class="menu-title">Flower Catalog</span>
                <i class="mdi mdi-file-check menu-icon"></i>
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
                    <li class="nav-item"> <a class="nav-link" href="CustomOrdersList.php"> Custom Order List </a></li>
                </ul>
            </div>
        </li> 
         <?php if ($user->getUserType() == "Customer"){ ?>
        <li class="nav-item">
              <a class="nav-link" href="selectFlower.php">
                  <span class="menu-title">Customize Order</span>
                  <i class="mdi mdi-flower menu-icon"></i>
              </a>
        </li>
        <?php } ?>
        <?php if ($user->getUserType() == "Corporate" && $user->getUserType()!= ""){ ?>
        
        <li class="nav-item">
              <a class="nav-link" href="ManageInvoice.php">
                  <span class="menu-title">Invoices</span>
                  <i class="mdi mdi-mdi mdi-file-document menu-icon"></i>
              </a>
        </li>
        
        <?php } ?>
    </ul>
    
</nav>
