<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin dashboard - InterWorks</title>
  <link rel="stylesheet" href="../../src-modernize/assets/css/styles.min.css" />
  <link rel="shortcut icon" type="image/png" href="../../src-modernize/assets/images/interworks/logo-removebg-preview.png" />
  <?php require '../../util/acess_control.php'; ?>
  <?php require '../../util/db_connection.php'; ?>
  <?php require '../../util/product.php'; ?>
</head>

<body>
  <?php acces_control_admin(); ?>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <img src="../../src-modernize/assets/images/interworks/logo-removebg-preview.png" width="180" alt="" class="img-fluid mx-auto d-block" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./admin.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Main page</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../../views/index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-shopping-cart"></i>
                </span>
                <span class="hide-menu">Web</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Products</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./new_product.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">New Product</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./inventory.php" aria-expanded="false">
                <span>
                  <i class="ti ti-basket"></i>
                </span>
                <span class="hide-menu">Inventory</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Users</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./user_list.php" aria-expanded="false">
                <span>
                  <i class="ti ti-user-circle"></i>
                </span>
                <span class="hide-menu">Users list</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <div class="container-fluid">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4 border border-warning">
          <div class="card-body px-4 py-3">
            <div class="row align-items-center">
              <div class="col-9">
                <h4 class="fw-semibold mb-8">Insert product</h4>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a class="text-muted text-decoration-none" href="../../views/index.php">Main page</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                      <a class="text-muted text-decoration-none" href="../../views/index.php">Shop</a>
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="col-3">
                <div class="mb-3">
                  <img src="../../views/img/logo-removebg-preview.png" alt="" class="img-fluid mb-n4" width="110">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body border border-warning">
              <?php require '../insert_product.php'; ?>
          </div>
        </div>
      </div>
    </div>
    <script src="../../src-modernize/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../src-modernize/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../src-modernize/assets/js/sidebarmenu.js"></script>
    <script src="../../src-modernize/assets/js/app.min.js"></script>
    <script src="../../src-modernize/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../src-modernize/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../src-modernize/assets/js/dashboard.js"></script>
</body>

</html>