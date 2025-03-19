<?php
require 'connect.php'; // เชื่อมต่อฐานข้อมูล

$search = isset($_GET['query']) ? trim($_GET['query']) : '';

$sql = "SELECT * FROM acc_user WHERE 
        email LIKE :search OR 
        name LIKE :search OR 
        id_student LIKE :search
         ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute(['search' => "%$search%"]);

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
                    <h2 class="head-topic text-primary pb-3">ManageUser/จัดการผู้ใช้งาน</h2>
                    <hr class="p-md-2">
                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 overflow-hidden">
                                <div class="card-body py-1 d-flex align-items-center justify-content-end mb-1">
                                    <h4 class="fs- mb-1 card-title text-primary me-2">ค้นหาผู้ใช้</h4>
                                </div>
                                <div class="card-body py-1 d-flex align-items-center justify-content-end mb-1">
                                    <input type="text" id="searchInput" class="form-control w-20 me-2"
                                        placeholder="email ชื่อ รหัสนักศึกษา">
                                </div>

                                <!-- ดึง Modal -->
                                <?php
                                // include 'modal_edituser.php';
                                ?>
                                <hr>
                                <div data-simplebar class="position-relative">
                                    <div id="searchResult" class="table-responsive products-tabel" data-simplebar>
                                        <table class="table text-nowrap mb-0 align-middle table-hover">
                                            <thead class="fs-4">
                                                <tr>
                                                    <th class="fs-3 px-4">No</th>
                                                    <th class="fs-3 px-4">email</th>
                                                    <th class="fs-3">ชื่อ</th>
                                                    <th class="fs-3">รหัสนักศึกษา</th>
                                                    <th class="fs-3">อายุ</th>
                                                    <th class="fs-3">เพศ</th>
                                                    <th class="fs-3">คณะที่สังกัด</th>
                                                    <th class="fs-3">โทรศัพท์</th>
                                                    <th class="fs-3">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                if ($users):
                                                    foreach ($users as $user):
                                                        // คำนวณอายุจากวันเกิด
                                                        $birthdate = new DateTime($user['birthday']);
                                                        $today = new DateTime();
                                                        $age = $today->diff($birthdate)->y;
                                                        ?>
                                                        <tr>
                                                            <td hidden><?= htmlspecialchars($user['id']); ?></td>
                                                            <td><?= htmlspecialchars($count++); ?></td>
                                                            <td><?= htmlspecialchars($user['email']); ?></td>
                                                            <td><?= htmlspecialchars($user['name']); ?></td>
                                                            <td><?= htmlspecialchars($user['id_student']); ?></td>
                                                            <td><?= htmlspecialchars($age); ?></td> <!-- แสดงอายุแทนวันเกิด -->
                                                            <td><?= htmlspecialchars($user['gender']); ?></td>
                                                            <td><?= htmlspecialchars($user['faculty']); ?></td>
                                                            <td><?= htmlspecialchars($user['phone']); ?></td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm delete-btn"
                                                                    data-id="<?= $user['id']; ?>">Delete</button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                else:
                                                    ?>
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
    <script src="../assets/js/delete/delete_manage_user.js"></script>
</body>

</html>