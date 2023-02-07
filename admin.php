<?php
session_start();

if ($_SESSION['status'] != "login") {
    header("location:index.php?pesan=belum_login");
} else {
    $_SESSION['status'] == "login";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swalayan.</title>

    <link rel="stylesheet" href="assets/css/main/app.css" />
    <link rel="stylesheet" href="assets/css/main/app-dark.css" />
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png" />
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css" />
    <link rel="stylesheet" href="assets/css/pages/simple-datatables.css" />
    <link rel="stylesheet" href="assets/extensions/choices.js/public/assets/styles/choices.css" />

</head>

<body>
    <script src="assets/js/initTheme.js"></script>
    <div id="main" class="layout-horizontal">
        <header class="mb-5">
            <div class="header-top shadow-sm mt-3">
                <div class="container">
                    <div class="logo">
                    </div>
                    <div class="header-top-right">
                        <div class="dropdown">
                            <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar avatar-md2">
                                    <img src="assets/images/faces/1.jpg" alt="Avatar" />
                                </div>
                                <div class="text">
                                    <h6 class="user-dropdown-name"><?php echo $_SESSION['username']; ?> </h6>
                                    <p class="user-dropdown-status text-sm text-muted">
                                        <?php echo $_SESSION['id_user']; ?>
                                    </p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                <li><a class="dropdown-item" href="#">My Account</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>

                                    <div class="theme-toggle d-flex gap-2  align-items-center ms-4 me-5">
                                        Theme
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                            <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                                <g transform="translate(-210 -1)">
                                                    <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                                    <circle cx="220.5" cy="11.5" r="4"></circle>
                                                    <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <div class="form-check form-switch fs-6">
                                            <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                            <label class="form-check-label"></label>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                                        </svg>

                                    </div>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item" onclick="Logout('db_conn/logout.php')">Logout</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Burger button responsive -->
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div id="sidebar" class="active">
                <div class="sidebar-wrapper active shadow">
                    <div class="sidebar-header position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="logo fs-2">
                                <a href="index.html"><i class="bi bi-shop"></i> Swalayan</a>
                            </div>
                            <hr class="dropdown-divider" />
                            <div class="sidebar-toggler  x">
                                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-title">Menu</li>

                            <li <?php
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    switch ($page) {
                                        case 'dashboard';
                                            echo 'class="sidebar-item active"';
                                    }
                                }
                                ?> class="sidebar-item">
                                <a href="admin.php?page=dashboard" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li <?php
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    switch ($page) {
                                        case 'transaksi';
                                            echo 'class="sidebar-item active"';
                                    }
                                }
                                ?> class="sidebar-item">
                                <a href="admin.php?page=transaksi" class='sidebar-link'>
                                    <i class="bi bi-cart4"></i>
                                    <span>Transaksi</span>
                                </a>
                            </li>

                            <li <?php
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    switch ($page) {
                                        case 'user';
                                            echo 'class="sidebar-item active"';
                                    }
                                }
                                ?> class="sidebar-item ">
                                <a href="admin.php?page=user" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>User</span>
                                </a>
                            </li>

                            <li <?php
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    switch ($page) {
                                        case 'pelanggan';
                                            echo 'class="sidebar-item active"';
                                    }
                                }
                                ?> class="sidebar-item ">
                                <a href="admin.php?page=pelanggan" class='sidebar-link'>
                                    <i class="bi bi-person-bounding-box"></i>
                                    <span>Pelanggan</span>
                                </a>
                            </li>

                            <li <?php
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    switch ($page) {
                                        case 'barang';
                                            echo 'class="sidebar-item active"';
                                    }
                                }
                                ?> class="sidebar-item">
                                <a href="admin.php?page=barang" class='sidebar-link'>
                                    <i class="bi bi-box-seam-fill"></i>
                                    <span>Barang</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="admin.php?page=transaksi_barang" class='sidebar-link' disable>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div id="main">
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    switch ($page) {
                        case 'dashboard':
                            include "page/dashboard.php";
                            break;
                        case 'user':
                            include "page/user.php";
                            break;
                        case 'edit_user':
                            include "page/edit_user.php";
                            break;
                        case 'pelanggan':
                            include "page/pelanggan.php";
                            break;
                        case 'barang':
                            include "page/barang.php";
                            break;
                        case 'transaksi_barang':
                            include "page/transaksi_barang.php";
                            break;
                        case 'transaksi':
                            include "page/transaksi.php";
                            break;
                        case 'laporan':
                            include "page/laporan.php";
                            break;
                            // case 'cetak':
                            //     include "page/cetak.php";
                            //     break;
                    }
                }
                ?>
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>

            </div>
    </div>

    <script>
        function Logout(url) {
            Swal.fire({
                title: 'Log Out?',
                text: 'Anda yakin ingin Log Out?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                    Swal.fire(
                        'Berhasil!',
                        'Log Out telah berhasil.',
                        'success',
                    )
                }

            })
        }
    </script>

    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="assets/js/pages/form-element-select.js"></script>
</body>

</html>