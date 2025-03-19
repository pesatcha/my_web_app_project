<?php
require 'connect.php';

$sql = "SELECT id, faculties, phone FROM faculties ";
$stmt = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

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
                    <h2 class="head-topic text-primary pb-3">Manage Faculties/จัดการตัวเลือกหน่วยงาน</h2>
                    <hr class="p-md-2">
                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 overflow-hidden">
                                <div class="card-body py-1 d-flex align-items-center justify-content-end mb-1">
                                    <h4 class="fs- mb-1 card-title text-primary me-2">ค้นหาจากหน่วยงาน</h4>
                                </div>
                                <div class="card-body py-1 d-flex align-items-center justify-content-end mb-1">
                                    <input type="text" id="searchInput" class="form-control w-20 me-2"
                                        placeholder="ชื่อหน่วยงาน">
                                </div>
                                <div class="card-body py-1 d-flex align-items-center justify-content-end mb-1">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addFacultiesModal">
                                        Add Faculties +
                                    </button>
                                </div>
                                <hr>
                                <div data-simplebar class="position-relative">
                                    <div id="searchResult" class="table-responsive products-tabel" data-simplebar>
                                        <table class="table text-nowrap mb-0 align-middle table-hover">
                                            <thead class="fs-4">
                                                <tr>
                                                    <th class="fs-3">No</th>
                                                    <th class="fs-3">Faculties</th>
                                                    <th class="fs-3">Phone</th>
                                                    <th class="fs-3">manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1;
                                                if ($result): ?>
                                                    <?php foreach ($result as $row): ?>
                                                        <tr>
                                                            <td hidden><?= htmlspecialchars($row['id']); ?></td>
                                                            <td><?= htmlspecialchars($count++); ?></td>
                                                            <td><?= htmlspecialchars($row['faculties']); ?></td>
                                                            <td><?= htmlspecialchars($row['phone']); ?></td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm edit-btn">Edit</button>
                                                                <button class="btn btn-danger btn-sm delete-btn"
                                                                    data-id="<?= $row['id']; ?>">Delete</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">ไม่มีข้อมูล</td>
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
        <?php include 'modal/modal_manage_faculties.php'; ?>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/notification_bell.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="../assets/js/search/search.js"></script>
    <script src="../assets/js/add/add_faculties.js"></script>
    <script src="../assets/js/edit/edit_manage_faculties.js"></script>
    <script src="../assets/js/delete/delete_manage_faculties.js"></script>
</body>
</html>