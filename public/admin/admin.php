<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin dashboard - InterWorks</title>
  <link rel="stylesheet" href="../../src-modernize/assets/css/styles.min.css" />
  <link rel="shortcut icon" type="image/png" href="../../src-modernize/assets/images/interworks/logo-removebg-preview.png" />
  <?php require '../../util/acess_control.php'; ?>
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
              <a class="sidebar-link"  href="./inventory.php" aria-expanded="false">
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
              <a class="sidebar-link" aria-expanded="false">
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
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded sidebar-ad mt-3">
                <div class="hstack gap-4">
                  <div class="admin-img">
                    <img src="../../src-modernize/assets/images/interworks/foto.jpeg" class="rounded-circle" width="40" height="40" alt="">
                  </div>
                  <div class="admin-title">
                    <h6 class="mb-0 fs-6 fw-semibold">Victor</h6>
                    <span class="fs-4">Admin</span>
                  </div>
                  <a href="../log_off.php"> <i class="ti ti-power fs-8"></i></a>
                </div>
              </div>
          </div>
          </li>
          </ul>
    </div>
    </nav>
    </header>
    <!--  Header End -->
    <div class="body-wrapper">
      <div class="container-fluid">
      </div>
    </div>
    <!-- <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>  -->
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