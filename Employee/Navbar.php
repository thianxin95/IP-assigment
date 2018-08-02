<ul class="navbar-nav navbar-nav-right">
    <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <div class="nav-profile-text">
                <p class="mb-1 text-black"><?php echo($Username) ?></p>
            </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="employeeProfile.php">
                <i class="mdi mdi-cached mr-2 text-success"></i>
                Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../logout.php">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Log Out
            </a>
        </div>
    </li>
</ul>