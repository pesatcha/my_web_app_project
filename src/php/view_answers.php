<?php
require 'connect.php';

if (!isset($_GET['save_data_id'])) {
    die("ไม่พบข้อมูลที่ต้องการ");
}

$save_data_id = $_GET['save_data_id'];

// ดึงข้อมูลผู้ใช้และรายละเอียดแบบสอบถาม
$sql_user = "SELECT 
                a.name, a.phone, a.faculty, 
                f.nameType, s.createdAt, s.score
            FROM save_data s
            JOIN acc_user a ON s.acc_id = a.id
            JOIN form_type f ON s.formtype_id = f.id
            WHERE s.id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->execute([$save_data_id]);
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);

// ดึงข้อมูลคำตอบของผู้ใช้
$sql_answers = "SELECT 
                    q.question, 
                    o.option_name, 
                    o.score
                FROM question_select qs
                JOIN question q ON qs.queston_id = q.id
                JOIN option o ON qs.option_id = o.id
                WHERE qs.save_data_id = ?";
$stmt_answers = $conn->prepare($sql_answers);
$stmt_answers->execute([$save_data_id]);
$answers = $stmt_answers->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/logos/idea.png" type="image/x-icon">
    <title>รายละเอียดการประเมิน - WELLBEINGAPP</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/record.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../assets/css/notification.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <div class="brand-logo d-flex align-items-center justify-content-center mt-3">
                <a href="./index.html" class="text-nowrap logo-img">
                    <h3 class="logohead text-primary fs-6">WELLBEING</h3>
                </a>
            </div>
        </aside>
        <!-- Sidebar End -->
        <?php include 'sidebar.php'; ?>
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
            <?php include 'header.php'; ?>
            <!-- Header End -->

            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <h2 class="head-topic text-primary pb-3">รายละเอียดการประเมิน</h2>
                    <hr class="p-md-2">

                    <!-- Card แสดงรายละเอียดผู้ใช้ -->
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card w-100 shadow-sm border-0 rounded-3">
                                <div class="card-body">
                                    <h4 class="card-title text-primary mb-3 text-start">
                                        <i class="ti ti-user-check me-2"></i> ข้อมูลผู้ทำแบบประเมิน
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><i class="ti ti-user text-primary me-2"></i><strong>ชื่อ:</strong>
                                                <?= htmlspecialchars($user['name']) ?></p>
                                            <p><i class="ti ti-phone text-success me-2"></i><strong>เบอร์โทร:</strong>
                                                <?= htmlspecialchars($user['phone']) ?></p>
                                            <p><i class="ti ti-building text-warning me-2"></i><strong>คณะ:</strong>
                                                <?= htmlspecialchars($user['faculty']) ?></p>
                                        </div>
                                        <div class="col-md-6 text-">
                                            <p><i
                                                    class="ti ti-clipboard-text text-danger me-2"></i><strong>ประเภทแบบสอบถาม:</strong>
                                                <?= htmlspecialchars($user['nameType']) ?></p>
                                            <?php
                                            date_default_timezone_set('Asia/Bangkok'); 
                                            $createdAtFormatted = date("d/m/Y H:i", strtotime($user['createdAt'])); // แปลงรูปแบบวันที่
                                            ?>
                                                <p><i
                                                        class="ti ti-calendar text-info me-2"></i><strong>วันที่ทำแบบสอบถาม:</strong>
                                                    <?= htmlspecialchars($createdAtFormatted) ?>
                                                </p>
                                                <p><i
                                                        class="ti ti-star text-primary me-2"></i><strong>คะแนนรวม:</strong>
                                                    <span
                                                        class="badge bg-primary fs-6"><?= htmlspecialchars($user['score']) ?></span>
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table แสดงคำตอบ -->
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-light ">
                                <tr>
                                    <th class="text-center text-primary">คำถาม</th>
                                    <th class="text-center text-primary">ตัวเลือกที่เลือก</th>
                                    <th class="text-center text-primary">คะแนน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($answers as $answer): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($answer['question']) ?></td>
                                        <td><?= htmlspecialchars($answer['option_name']) ?></td>
                                        <td><?= htmlspecialchars($answer['score']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="recordmain.php" class="btn btn-primary mt-3">กลับไปหน้าประวัติ</a>
                </div>
            </div>
        </div>
    </div>

    </div> <!-- container-fluid -->
    </div> <!-- body-wrapper-inner -->
    </div> <!-- body-wrapper -->
    </div> <!-- page-wrapper -->

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- นำเข้า JavaScript ที่สร้างไว้ -->
    <script src="../assets/js/notification.js"></script>
    <script src="../assets/js/notification_bell.js"></script>


</body>

</html>