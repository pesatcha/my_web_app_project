<?php
require 'connect.php'; // เชื่อมต่อฐานข้อมูล

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT 
            s.id AS id,
            DATE(s.createdAt) AS date,
            s.score AS score,
            s.interpre_level,
            q.question,
            o.option_name,
            f.nameType AS assessment_name
        FROM save_data s
        JOIN question_select qs ON s.id = qs.save_data_id
        JOIN question q ON qs.queston_id = q.id
        JOIN option o ON qs.option_id = o.id
        JOIN form_type f ON s.formtype_id = f.id
        WHERE s.acc_id = :user_id
        ORDER BY s.createdAt DESC";

$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// จัดกลุ่มข้อมูลใหม่ให้แต่ละ assessment มี questions ของตัวเอง
$assessments = [];
foreach ($rows as $row) {
    $id = $row['id'];
    
    if (!isset($assessments[$id])) {
        $assessments[$id] = [
            'assessment_name' => $row['assessment_name'],
            'date' => $row['date'],
            'score' => $row['score'],
            'interpre_level' => $row['interpre_level'],
            'questions' => []
        ];
    }
    
    $assessments[$id]['questions'][] = [
        'question' => $row['question'],
        'option_name' => $row['option_name']
    ];
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/logos/idea.png" type="image/x-icon">
    <title>WELLBEINGAPP</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/addQ.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <?php include 'sidebar.php'; ?>
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35"
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="login.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <h2 class="head-topic text-primary pb-3">Data Assessment/ข้อมูลการประเมิน</h2>
                    <hr class="p-md-2">

                    <?php foreach ($assessments as $data): ?>
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h3 class="text-center text-secondary"><?= htmlspecialchars($data['assessment_name']); ?></h3>
                                
                                <div class="d-flex justify-content-between flex-wrap">
                                    <p><strong>📅 วันที่ทำแบบประเมิน:</strong> <?= htmlspecialchars($data['date']); ?></p>
                                    <p><strong>📌 ผลการประเมิน:</strong> 
                                        <span class="badge bg-danger"><?= htmlspecialchars($data['interpre_level']); ?></span>
                                    </p>
                                    <p><strong>⭐ คะแนนรวม:</strong> 
                                        <span class="badge bg-primary"><?= htmlspecialchars($data['score']); ?></span>
                                    </p>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="text-center">คำถาม</th>
                                                <th class="text-center">การตอบคำถาม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['questions'] as $question): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($question['question']); ?></td>
                                                    <td><?= htmlspecialchars($question['option_name']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
