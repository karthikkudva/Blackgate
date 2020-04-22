<?php session_start(); ?>
<!-- <div class="container-fluid text-center top-container">
    <img src="images/prison_icon.png">
</div> -->
<header>
    <nav>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="index.php" class="nav-link <?php if ($page=="index") echo "active"; ?>">Home</a></li>
            <li class="nav-item"><a href="prisoners.php" class="nav-link <?php if ($page=="prisoners") echo "active"; ?>">Prisoners</a></li>
            <li class="nav-item"><a href="employees.php" class="nav-link <?php if ($page=="employees") echo "active"; ?>">Employees</a></li>
            <li class="nav-item"><a href="dependants.php" class="nav-link <?php if ($page=="dependants") echo "active"; ?>">Dependants</a></li>
            <li class="nav-item"><a href="visitors.php" class="nav-link <?php if ($page=="visitors") echo "active"; ?>">Visitors</a></li>
        </ul>
    </nav>
    <hr style="clear:both">
</header>