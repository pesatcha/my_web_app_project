<?php
require 'connect.php';

// จำนวนข้อมูลต่อหน้า
$itemsPerPage = 20;
// คำนวณหน้า
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

$sql = "SELECT s.id, s.acc_id, a.name, a.phone, a.faculty, s.createdAt, f.nameType, s.score, s.viewed
FROM save_data s 
JOIN acc_user a ON s.acc_id = a.id 
JOIN form_type f ON s.formtype_id = f.id
ORDER BY s.createdAt DESC
LIMIT :limit OFFSET :offset";


$stmt = $conn->prepare($sql);
$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

// ตรวจสอบว่ามีข้อมูลหรือไม่
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// คำนวณจำนวนหน้าทั้งหมด
$totalSql = "SELECT COUNT(*) FROM save_data";
$totalStmt = $conn->query($totalSql);
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $itemsPerPage);

// ฟังก์ชันแปลงเวลาเป็นเวลาของไทย
function convertToThaiTime($datetime)
{
    $time = strtotime($datetime);
    $time = $time + (7 * 60 * 60); // เพิ่มเวลา 7 ชั่วโมง
    return date('d/m/Y H:i:s', $time); // รูปแบบวันที่และเวลาที่ต้องการ
}

// ตรวจสอบข้อมูลในฐานข้อมูล
$duplicateSql = "SELECT acc_id, createdAt, COUNT(*) AS count 
                 FROM save_data 
                 GROUP BY acc_id, createdAt"; 

$duplicateStmt = $conn->query($duplicateSql);
$duplicates = $duplicateStmt->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../assets/css/notification.css" />
    <style>
        .not-viewed {
            color: rgba(186, 40, 235, 0.5) !important; /* อาจทำให้ไอคอนดูจาง */
            /* เปลี่ยนสีตัวอักษร */
            font-weight: bold;
            /* ทำให้ตัวหนา */
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <?php include 'sidebar.php'; ?>
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
            <?php include 'header.php'; ?>
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <h2 class="head-topic text-primary pb-3">Record/ประวัติ</h2>
                    <hr class="p-md-2">
                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 overflow-hidden">
                                <div class="card-body pb-0 d-flex align-items-center justify-content-between mb-2">
                                    <h4 class="fs- mb-1 card-title text-primary me-2">ประเภทคำถามที่ต้องการค้นหา
                                    </h4>
                                    <h4 class="fs- mb-1 card-title text-primary me-2">ค้นหารายชื่อ</h4>
                                </div>
                                <div class="card-body pb-0 d-flex align-items-center justify-content-between mb-2">
                                    <select id="filterType" class="form-control option w-40">
                                        <option value="">เลือกประเภทคำถาม</option>
                                        <option value="แบบประเมินความเครียด (ST-5)">แบบประเมินความเครียด (ST-5)</option>
                                        <option value="แบบประเมินซึมเศร้า (9Q)">แบบประเมินซึมเศร้า (9Q)</option>
                                        <option value="แบบประเมินพลังสุขภาพจิต (RQ)">แบบประเมินพลังสุขภาพจิต (RQ)
                                        </option>
                                    </select>
                                    <input type="date" id="filterDate" class="form-control w-20">
                                    <input type="text" id="searchInput" class="form-control w-20"
                                        placeholder="ค้นหารายชื่อ">
                                </div>
                                <hr>
                                <div data-simplebar class="position-relative">
                                    <div id="searchResult" class="table-responsive products-tabel" data-simplebar>
                                        <table class="table text-nowrap mb-0 align-middle table-hover">
                                            <thead class="fs-4">
                                                <tr>
                                                    <th class="fs-3">No</th>
                                                    <th class="fs-3">Name</th>
                                                    <th class="fs-3">Phone</th>
                                                    <th class="fs-3">Faculty</th>
                                                    <th class="fs-3">Date</th>
                                                    <th class="fs-3">Form Type</th>
                                                    <th class="fs-3">Score</th>
                                                    <th class="fs-3">status</th>
                                                    <th class="fs-3">manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = $offset + 1;
                                                if (!empty($result)): ?>
                                                    <?php foreach ($result as $row): ?>
                                                        <tr class="<?= $row['viewed'] == 0 ? 'not-viewed' : '' ?>">
                                                            <td hidden><?= htmlspecialchars($row['id']); ?></td>
                                                            <td><?= htmlspecialchars($count++); ?></td>
                                                            <td><?= htmlspecialchars($row['name']); ?></td>
                                                            <td><?= htmlspecialchars($row['phone']); ?></td>
                                                            <td><?= htmlspecialchars($row['faculty']); ?></td>
                                                            <td><?= date('Y-m-d', strtotime($row['createdAt'])); ?></td>
                                                            <td><?= htmlspecialchars($row['nameType']); ?></td>
                                                            <td><?= htmlspecialchars($row['score']); ?></td>
                                                            <td>
                                                                <?php
                                                                $score = $row['score'];
                                                                $form_type = $row['nameType'];
                                                                $icon = "";

                                                                if ($form_type == "แบบประเมินความเครียด (ST-5)") {
                                                                    if ($score >= 0 && $score <= 4) {
                                                                        $icon = "fluent-emoji:beaming-face-with-smiling-eyes";
                                                                    } elseif ($score >= 5 && $score <= 7) {
                                                                        $icon = "fluent-emoji:flushed-face";
                                                                    } elseif ($score >= 8 && $score <= 9) {
                                                                        $icon = "fluent-emoji:face-holding-back-tears";
                                                                    } else {
                                                                        $icon = "fluent-emoji:cold-face";
                                                                    }
                                                                } elseif ($form_type == "แบบประเมินซึมเศร้า (9Q)") {
                                                                    if ($score < 7) {
                                                                        $icon = "fluent-emoji:beaming-face-with-smiling-eyes";
                                                                    } elseif ($score >= 7 && $score <= 12) {
                                                                        $icon = "fluent-emoji:flushed-face";
                                                                    } elseif ($score >= 13 && $score <= 18) {
                                                                        $icon = "fluent-emoji:face-holding-back-tears";
                                                                    } else {
                                                                        $icon = "fluent-emoji:cold-face";
                                                                    }
                                                                } elseif ($form_type == "แบบประเมินพลังสุขภาพจิต (RQ)") {
                                                                    if ($score < 55) {
                                                                        $icon = "fluent-emoji:cold-face";
                                                                    } elseif ($score >= 55 && $score <= 69) {
                                                                        $icon = "fluent-emoji:flushed-face";
                                                                    } else {
                                                                        $icon = "fluent-emoji:beaming-face-with-smiling-eyes";
                                                                    }
                                                                }

                                                                echo "<iconify-icon icon='$icon' width='30' height='30'></iconify-icon>";
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge rounded-pill fs-2 fw-medium bg-info-subtle text-bg-info">
                                                                    <a href="view_answers.php?save_data_id=<?= $row['id'] ?>"
                                                                        class="view-data" data-id="<?= $row['id'] ?>">
                                                                        ดูข้อมูล
                                                                    </a>
                                                                </span>

                                                                <button
                                                                    class="badge rounded-pill btn btn-pink-pastel fs-2 fw-medium schedule-meeting"
                                                                    data-id="<?= $row['id'] ?>"
                                                                    data-acc-id="<?= $row['acc_id'] ?>">
                                                                    นัดพบ
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">ไม่มีข้อมูล</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="pagination text-center mt-3">
                                            <?php if ($page > 1): ?>
                                                <a href="?page=<?= $page - 1 ?>" class="btn btn-danger btn-sm">ก่อนหน้า</a>
                                            <?php endif; ?>

                                            <span class="mx-3">หน้า <?= $page ?> จาก <?= $totalPages ?></span>

                                            <?php if ($page < $totalPages): ?>
                                                <a href="?page=<?= $page + 1 ?>" class="btn btn-danger btn-sm">ถัดไป</a>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                                <?php include 'modal/popup_meeting.php'; ?>
                            </div>
                        </div>
                        <div class="discription">
                            <iconify-icon icon="fluent-emoji:beaming-face-with-smiling-eyes" width="30"
                                height="30"></iconify-icon>
                            <span> = แฮปปี้</span>

                            <iconify-icon icon="fluent-emoji:flushed-face" width="30" height="30"></iconify-icon>
                            <span> = ปกติ</span>

                            <iconify-icon icon="fluent-emoji:face-holding-back-tears" width="30"
                                height="30"></iconify-icon>
                            <span> = มีแนวโน้มต้องได้รับคำปรึกษา</span>

                            <iconify-icon icon="fluent-emoji:cold-face" width="30" height="30"></iconify-icon>
                            <span> = ต้องได้รับคำแนะนำจากผู้เชี่ยวชาญ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <script src="../assets/js/search/filter_type.js"></script>
    <script src="../assets/js/search/filter_date.js"></script>
    <script src="../assets/js/update_viewed.js"></script>
    <script src="../assets/js/add/add_calender.js"></script>
</body>

</html>