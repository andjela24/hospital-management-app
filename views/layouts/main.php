<?php

use app\core\Application;
use app\core\Constant;

$loggedInUser = isset(Application::$app->session) ? Application::$app->session->get(Constant::$auth_session) : null;
$role = ($loggedInUser !== null) ? $loggedInUser->roles : null;

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eKarton</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/patient.png"/>
    <link rel="stylesheet" href="../assets/css/styles.min.css"/>
    <link rel="stylesheet" href="../assets/js/plugins/toastr/toastr.min.css">
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/js/plugins/toastr/toastr.min.js"></script>
    <script src="../assets/js/plugins/toastr/toastr-options.js"></script>
</head>

<body>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="/home" class="text-nowrap logo-img">
                    <img src="../assets/images/logos/ekarton.png" alt=""/>
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
                        <span class="hide-menu">Početna strana</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/home" aria-expanded="false">
                            <span>
                            <i class="ti ti-home"></i>
                            </span>
                            <span class="hide-menu">Početna strana</span>
                        </a>
                    </li>
                    <?php if (in_array('Administrator', $role)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/report" aria-expanded="false">
                            <span>
                            <i class="ti ti-chart-area-line"></i>
                            </span>
                                <span class="hide-menu">Izveštaji</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Pacijenti</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/patientCreate" aria-expanded="false">
                            <span>
                            <i class="ti ti-circle-plus"></i>
                            </span>
                            <span class="hide-menu">Kreiranje pacijenta</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/patientList" aria-expanded="false">
                            <span>
                              <i class="ti ti-list"></i>
                            </span>
                            <span class="hide-menu">Pregled pacijenata</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/patientDownload" aria-expanded="false">
                            <span>
                             <i class="ti ti-download"></i>
                            </span>
                            <span class="hide-menu">Preuzmi pacijente</span>
                        </a>
                    </li>

                    <?php if (in_array('Administrator', $role)): ?>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Zaposleni</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/employeeCreate" aria-expanded="false">
                            <span>
                            <i class="ti ti-circle-plus"></i>
                            </span>
                                <span class="hide-menu">Kreiranje zaposlenog</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/employeeList" aria-expanded="false">
                            <span>
                              <i class="ti ti-list"></i>
                            </span>
                                <span class="hide-menu">Pregled zaposlenih</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (in_array('Administrator', $role)): ?>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Lekovi</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/medicineCreate" aria-expanded="false">
                            <span>
                            <i class="ti ti-circle-plus"></i>
                            </span>
                                <span class="hide-menu">Kreiranje leka</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/medicineList" aria-expanded="false">
                            <span>
                              <i class="ti ti-list"></i>
                            </span>
                                <span class="hide-menu">Pregled lekova</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Recepti</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/prescriptionList" aria-expanded="false">
                            <span>
                              <i class="ti ti-list"></i>
                            </span>
                            <span class="hide-menu">Pregled recepata</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <div class="body-wrapper">
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <img src="../assets/images/profile/user1.webp" alt="" width="35" height="35"
                                     class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                 aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="/logout"
                                       class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="container-fluid">
            {{ renderSection }}
        </div>
    </div>
</div>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/js/constants/localStorageConstants.js"></script>
<script src="../assets/js/index.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php
$success = Application::$app->session->getFlash(Constant::$flash_session_success);
if ($success !== false) {
    echo "
        <script>
            $(document).ready(function (){
                toastr.success('$success');
            });
        </script>
    ";
}

$error = Application::$app->session->getFlash(Constant::$flash_session_error);
if ($error !== false) {
    echo "
        <script>
            $(document).ready(function (){
                toastr.error('$error');
            });
        </script>
    ";
}

?>

<!--<script>-->
<!--    $(document).ready(function (){-->
<!--        showCartNotification();-->
<!--    });-->
<!---->
<!--    $(document).on('click', '.add-car', function (){-->
<!--        let id = $(this).data("id");-->
<!--        let brand = $(this).data("brand");-->
<!--        let model = $(this).data("model");-->
<!--        let price = $(this).data("price");-->
<!--        let image_path = $(this).data("image-path");-->
<!--        let description = $(this).data("description");-->
<!---->
<!--        addToCart(id, brand, model, price, image_path, description);-->
<!--        $("#quantity-button-" + id).html(checkQuantity(id));-->
<!--    });-->
<!---->
<!--    $(document).on('click', '.remove-car', function (){-->
<!--        let id = $(this).data("id");-->
<!---->
<!--        removeFromCart(id);-->
<!--        $("#quantity-button-" + id).html(checkQuantity(id));-->
<!--    });-->
<!--</script>-->
<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $('.download-json').click(function (e) {-->
<!--            e.preventDefault(); // Zaustavljanje podrazumevanog ponašanja klika na link-->
<!--            $.get("/patientDownload", function () {-->
<!--                // Flash poruka-->
<!--                alert("JSON file successfully downloaded.");-->
<!--            });-->
<!--        });-->
<!--    });-->
<!--</script>-->


</body>

</html>