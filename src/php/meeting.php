<?php
require 'connect.php';

// ดึงข้อมูลการนัดพบ
$meetingSql = "SELECT m.id, m.meeting_date, m.start_time, m.end_time, m.description, u.name
                FROM meetings m 
                JOIN acc_user u ON m.acc_id = u.id";
$meetingStmt = $conn->query($meetingSql);
$meetings = $meetingStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/logos/idea.png" type="image/x-icon">
    <title>WELLBEINGAPP</title>
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
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
                    <h2 class="head-topic text-primary pb-3">Manage Meeting/จัดการการนัดพบ</h2>
                    <hr class="p-md-2">
                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 overflow-hidden">
                                <div class="card-body py-1 d-flex align-items-center justify-content-end mb-1">
                                    <h4 class="fs- mb-1 card-title text-primary me-2">ค้นหาชื่อ</h4>
                                </div>
                                <div class="card-body py-1 d-flex align-items-center justify-content-end mb-1">
                                    <input type="text" id="searchInput" class="form-control w-20 me-2"
                                        placeholder="ชื่อ">
                                </div>
                                <hr>
                                <div data-simplebar class="position-relative">
                                    <div id="searchResult" class="table-responsive products-tabel" data-simplebar>
                                        <table class="table text-nowrap mb-0 align-middle table-hover">
                                            <thead class="fs-4">
                                                <tr>
                                                    <th class="fs-3">No</th>
                                                    <th class="fs-3">Date</th>
                                                    <th class="fs-3">Start Time</th>
                                                    <th class="fs-3">End Time</th>
                                                    <th class="fs-3">Description</th>
                                                    <th class="fs-3">name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1;
                                                if ($meetings): ?>
                                                    <?php foreach ($meetings as $meeting): ?>
                                                        <tr>
                                                        <td hidden><?= htmlspecialchars($meeting['id']); ?></td>
                                                        <td><?= htmlspecialchars($count++); ?></td>
                                                            <td><?= htmlspecialchars(date('Y-m-d', strtotime($meeting['meeting_date']))); ?></td>
                                                            <td><?= htmlspecialchars($meeting['start_time']); ?></td>
                                                            <td><?= htmlspecialchars($meeting['end_time']); ?></td>
                                                            <td><?= htmlspecialchars($meeting['description']); ?></td>
                                                            <td><?= htmlspecialchars($meeting['name']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">ไม่มีข้อมูลการนัดหมาย</td>
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
    <script src="../assets/js/search/search.js"></script>
</body>

</html>