<?php
require 'connect.php';

// ดึงข้อมูลจากตาราง manageadmin และ role
$sql = "SELECT manageadmin.*, role.role FROM manageadmin 
        LEFT JOIN role ON manageadmin.role_id = role.id";
$stmt = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/logos/idea.png" type="image/x-icon">
    <title>WELLBEINGAPP</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/addQ.css" />
    <link rel="stylesheet" href="../assets/css/notification.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <?php include 'sidebar.php'; ?>
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php include 'header.php'; ?>
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <h2 class="head-topic text-primary pb-3">ManageUser/จัดการผู้ดูแลระบบ</h2>
                    <hr class="p-md-2">
                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 overflow-hidden">
                                <div class="card-body pb-0 d-flex align-items-center justify-content-between mb-2">
                                    <h4 class="fs- mb-1 card-title text-primary me-2">Role/สิทธิ์การใช้งาน</h4>
                                    <h4 class="fs- mb-1 card-title text-primary me-2">ค้นหารายชื่อ</h4>
                                </div>
                                <div class="card-body pb-0 d-flex align-items-center justify-content-between mb-2">
                                    <select id="roleFilter" class="form-control option w-40">
                                        <option value="all">ทั้งหมด</option>
                                        <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                                        <option value="นักจิตวิทยา">นักจิตวิทยา</option>
                                    </select>
                                    <input type="text" id="searchInput" class="form-control w-20 me-2"
                                        placeholder="email ชื่อ ">
                                </div>
                                <div class="card-body py-1 d-flex align-items-center justify-content-end mb-1">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addAdminModal">
                                        Add Admin +
                                    </button>
                                </div>
                                <hr>
                                <div data-simplebar class="position-relative">
                                    <div id="searchResult" class="table-responsive products-tabel" data-simplebar>
                                        <table class="table text-nowrap mb-0 align-middle table-hover">
                                            <thead class="fs-4">
                                                <tr></tr>
                                                <th>No</th>
                                                <th>ชื่อ</th>
                                                <th>นามสกุล</th>
                                                <th>บัญชีผู้ใช้</th>
                                                <th>โทรศัพท์</th>
                                                <th>สิทธิ์</th>
                                                <th>จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1;
                                                if ($users): ?>
                                                    <?php foreach ($users as $user): ?>
                                                        <tr>
                                                            <td hidden><?= htmlspecialchars($user['id']); ?></td>
                                                            <td><?= htmlspecialchars($count++); ?></td>
                                                            <td><?= htmlspecialchars($user['firstname']); ?></td>
                                                            <td><?= htmlspecialchars($user['lastname']); ?></td>
                                                            <td><?= htmlspecialchars($user['username']); ?></td>
                                                            <td><?= htmlspecialchars($user['phone']); ?></td>
                                                            <td><?= htmlspecialchars($user['role']); ?></td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm edit-btn">Edit</button>
                                                                <button class="btn btn-danger btn-sm delete-btn"
                                                                    data-id="<?= $user['id']; ?>">Delete</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">ไม่มีข้อมูลผู้ใช้งาน</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'modal/modal_manage_admin.php'; ?>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/notification_bell.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="../assets/js/edit/edit_manage_admin.js"></script>
    <script src="../assets/js/delete/delete_manage_admin.js"></script>
    <script src="../assets/js/search/search.js"></script>
    <script src="../assets/js/search/filter.js"></script>
    <script src="../assets/js/add/add_manage_admin.js"></script>
</body>

</html>