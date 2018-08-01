<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                    <span class="menu-title">Catalog Maintenance</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="general-pages">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="AddNewItem.php"> Add New Item </a></li>
                        <li class="nav-item"> <a class="nav-link" href="CatalogView.php"> Full Product List </a></li>
                        <li class="nav-item"> <a class="nav-link" href="CreateMonthlyCatalog.php"> Generate Monthly Catalog </a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#Manage-Orders" aria-expanded="false" aria-controls="Manage-Orders">
                    <span class="menu-title">Manage Orders</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="Manage-Orders">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="ManageOrder.php">Normal Orders</a></li>
                        <li class="nav-item"> <a class="nav-link" href="ManageCustomOrder.php"> Custom Orders </a></li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="ReportXML/Daily_OrderProcessed.xml">
                    <span class="menu-title">Daily Order Report</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- partial -->