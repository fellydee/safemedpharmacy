<?php include('sidebar-logic.php'); ?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-text mx-3"><img src="logo_transparent.png" width='260' /></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php echo !strcmp($_SERVER['REQUEST_URI'], '/safemedpharmacy/index.php') ? 'active' : '' ?>">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Items Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link <?php echo is_nav_active($items) ? 'active' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-list"></i>
        <span>Items</span>
      </a>
      <div id="collapseTwo" class="collapse <?php echo is_nav_active($items) ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?php echo is_nav_item_active('inventory')?>" href="inventory.php">Inventory</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Stock Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link <?php echo is_nav_active($stock) ? 'active' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-cube"></i>
        <span>Stock</span>
      </a>
      <div id="collapseUtilities" class="collapse <?php echo is_nav_active($stock) ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?php echo is_nav_item_active('near-expiry')?>" href="near-expiry.php">Near Expiry</a>
          <a class="collapse-item <?php echo is_nav_item_active('expired')?>" href="expired.php">Expired</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Purchases Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link <?php echo is_nav_active($purchases) ? 'active' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapsePagesPurchases" aria-expanded="true" aria-controls="collapsePagesPurchases">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Purchases</span>
      </a>
      <div id="collapsePagesPurchases" class="collapse <?php echo is_nav_active($purchases) ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?php echo is_nav_item_active('purchase-order')?>" href="purchase-order.php">Purchase Order</a>
          <a class="collapse-item <?php echo is_nav_item_active('purchase-invoice')?>" href="purchase-invoice.php">Purchase Invoice</a>
          <a class="collapse-item <?php echo is_nav_item_active('stock-card')?>" href="stock-card.php">Stock Card</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Sales Invoice Collapse Menu -->
    <li class="nav-item <?php echo !strcmp($_SERVER['REQUEST_URI'], '/safemedpharmacy/pos.php') ? 'active' : '' ?>">
      <a class="nav-link" href="pos.php">
        <i class="far fa-money-bill-alt"></i>
        <span>Point of Sales</span></a>
      </li>


      <?php 
      if($login_type != "Super Admin" and $login_type != "Admin") {
        echo "<style>#cpanel { display: none; }</style>";
      }
      ?>

      <!-- Nav Item - Control Panel Collapse Menu -->
      <li class="nav-item" id="cpanel">
        <a class="nav-link <?php echo is_nav_active($controlPanel) ? 'active' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapsePagesControlPanel" aria-expanded="true" aria-controls="collapsePagesControlPanel">
          <i class="fas fa-fw fa fa-cog"></i>
          <span>Control Panel</span>
        </a>
        <div id="collapsePagesControlPanel" class="collapse <?php echo is_nav_active($controlPanel) ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo is_nav_item_active('user-account')?>" href="user-account.php">Users</a>
            <?php 
            if($login_type == "Super Admin") {
              echo '<a class="collapse-item ' . is_nav_item_active('log-management') . '" href="log-management.php">Log Management</a>
              <a class="collapse-item ' . is_nav_item_active('backup') . '" href="backup.php">Backup Database</a>';
            }
            ?>
          </div>
        </div>
      </li>

    </ul>