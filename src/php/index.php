<?php
require 'connect.php';

try {
    // ดึงข้อมูลปีที่ไม่ซ้ำกันจากฐานข้อมูล
    $sql_years = "SELECT DISTINCT YEAR(createdAt) as year FROM save_data ORDER BY year DESC";
    $stmt_years = $conn->prepare($sql_years);
    $stmt_years->execute();
    $years = $stmt_years->fetchAll(PDO::FETCH_ASSOC);

    // ดึงข้อมูลเดือนที่ไม่ซ้ำกันจากฐานข้อมูล
    $sql_months = "SELECT DISTINCT MONTH(createdAt) as month FROM save_data ORDER BY month ASC";
    $stmt_months = $conn->prepare($sql_months);
    $stmt_months->execute();
    $months = $stmt_months->fetchAll(PDO::FETCH_ASSOC);

    // ข้อมูลอื่นๆ ที่ใช้ในหน้าเว็บ
    $selected_year = isset($_GET['year']) ? $_GET['year'] : 0;
    $selected_month = isset($_GET['month']) ? $_GET['month'] : 0;

    // ตรวจสอบว่ามีการเลือกปีหรือไม่
    if ($selected_year == 0) {
        $selected_month = 0; // รีเซ็ตเดือนเป็น "ทั้งหมด" หากปีเป็น "ทั้งหมด"
    }

    // นับจำนวนผู้ประเมินที่ไม่ซ้ำกันตามประเภทการประเมิน
    $sql_counts = "SELECT f.nameType, COUNT(*) as assessment_count
                   FROM save_data s
                   JOIN form_type f ON s.formtype_id = f.id
                   WHERE (:year = 0 OR YEAR(s.createdAt) = :year)
                   AND (:month = 0 OR MONTH(s.createdAt) = :month)
                   GROUP BY f.nameType";
    $stmt_counts = $conn->prepare($sql_counts);
    $stmt_counts->execute(['year' => $selected_year, 'month' => $selected_month]);
    $counts = $stmt_counts->fetchAll(PDO::FETCH_ASSOC);

    $assessment_counts = [];
    foreach ($counts as $row) {
        $nameType = $row['nameType'] ?? 'ไม่ระบุ';
        $assessment_counts[$nameType] = $row['assessment_count'];
    }

    // นับจำนวนผลการประเมินตาม interpre_level โดยนับเฉพาะผู้ใช้ที่ไม่ซ้ำกัน
    $sql_interpre_level_counts = "SELECT interpre_level, COUNT(*) as count
                                  FROM save_data
                                  WHERE (:year = 0 OR YEAR(createdAt) = :year)
                                  AND (:month = 0 OR MONTH(createdAt) = :month)
                                  GROUP BY interpre_level";
    $stmt_interpre_level_counts = $conn->prepare($sql_interpre_level_counts);
    $stmt_interpre_level_counts->execute(['year' => $selected_year, 'month' => $selected_month]);
    $interpre_level_counts = $stmt_interpre_level_counts->fetchAll(PDO::FETCH_ASSOC);

    $interpre_level_data = [];
    foreach ($interpre_level_counts as $row) {
        $interpre_level = $row['interpre_level'] ?? 'ไม่ระบุ';
        $interpre_level_data[$interpre_level] = $row['count'];
    }

    // นับจำนวนเพศจาก acc_user
    $sql_gender_counts = "SELECT gender, COUNT(*) as count
                          FROM acc_user
                          WHERE (:year = 0 OR YEAR(createdAt) = :year)
                          AND (:month = 0 OR MONTH(createdAt) = :month)
                          GROUP BY gender";
    $stmt_gender_counts = $conn->prepare($sql_gender_counts);
    $stmt_gender_counts->execute(['year' => $selected_year, 'month' => $selected_month]);
    $gender_counts = $stmt_gender_counts->fetchAll(PDO::FETCH_ASSOC);

    $gender_data = [];
    foreach ($gender_counts as $row) {
        $gender = $row['gender'] ?? 'ไม่ระบุ';
        $gender_data[$gender] = $row['count'];
    }

    // นับจำนวนคณะจาก acc_user
    $sql_faculty_counts = "SELECT faculty, COUNT(*) as count
                           FROM acc_user
                           WHERE (:year = 0 OR YEAR(createdAt) = :year)
                           AND (:month = 0 OR MONTH(createdAt) = :month)
                           GROUP BY faculty";
    $stmt_faculty_counts = $conn->prepare($sql_faculty_counts);
    $stmt_faculty_counts->execute(['year' => $selected_year, 'month' => $selected_month]);
    $faculty_counts = $stmt_faculty_counts->fetchAll(PDO::FETCH_ASSOC);

    $faculty_data = [];
    foreach ($faculty_counts as $row) {
        $faculty = $row['faculty'] ?? 'ไม่ระบุ';
        $faculty_data[$faculty] = $row['count'];
    }

    // นับจำนวนผู้ประเมินที่ไม่ซ้ำกัน
    $sql_total_users = "SELECT COUNT(DISTINCT acc_id) as total_users 
                        FROM save_data
                        WHERE (:year = 0 OR YEAR(createdAt) = :year)
                        AND (:month = 0 OR MONTH(createdAt) = :month)";
    $stmt_total_users = $conn->prepare($sql_total_users);
    $stmt_total_users->execute(['year' => $selected_year, 'month' => $selected_month]);
    $total_users = $stmt_total_users->fetch(PDO::FETCH_ASSOC)['total_users'] ?? 0;

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/logos/idea.png" type="image/x-icon">
    <title>WELLBEINGAPP</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/notification.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <!-- <link rel="stylesheet" href="../assets/css/addQ.css"> -->
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <?php include 'sidebar.php'; ?>
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php include 'header.php'; ?> <!-- เพิ่มส่วนหัวที่มีระบบแจ้งเตือน -->
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <h2 class="head-topic text-primary pb-3">Dashboard/กราฟสถิติ</h2>
                    <hr class="p-md-2">
                    <div class="card-body pb-0 d-flex align-items-center justify-content-between mb-2">
                        <h4 class="fs- mb-1 card-title text-primary me-2">เลือกปี</h4>
                        <h4 class="fs- mb-1 card-title text-primary me-2">เลือกเดือน</h4>
                    </div>

                    <div class="card-body pb-0 d-flex align-items-center justify-content-between mb-2">
                        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <select id="year-select" name="year" class="form-control" onchange="this.form.submit()">
                                <option value="0" <?php echo ($selected_year == 0) ? 'selected' : ''; ?>>ทั้งหมด</option>
                                <?php foreach ($years as $year): ?>
                                    <option value="<?php echo $year['year']; ?>" <?php echo ($year['year'] == $selected_year) ? 'selected' : ''; ?>>
                                        <?php echo $year['year']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <select id="month-select" name="month" class="form-control" onchange="this.form.submit()"
                                <?php echo ($selected_year == 0) ? 'disabled' : ''; ?>>
                                <option value="0" <?php echo ($selected_month == 0) ? 'selected' : ''; ?>>ทั้งหมด</option>
                                <?php if ($selected_year != 0): // ตรวจสอบว่ามีการเลือกปี ?>
                                    <?php foreach ($months as $month): ?>
                                        <option value="<?php echo $month['month']; ?>" <?php echo ($month['month'] == $selected_month) ? 'selected' : ''; ?>>
                                            <?php echo date('F', mktime(0, 0, 0, $month['month'], 10)); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <input type="hidden" name="year" value="<?php echo $selected_year; ?>">
                        </form>
                    </div>
                </div>
                <hr class="p-md-2">
                <!--  Row 1 -->
                <div class="row">

                    <!-- Pie Chart สำหรับประเภทการประเมิน -->
                    <div class="col-lg-6 col-md-12">
                        <div class="chart-container">
                            <h3>ประเภทการประเมิน</h3>
                            <p>จำนวนคนที่ประเมิน : <?php echo $total_users; ?> คน</p>
                            <div id="pie-chart-assessment"></div>
                        </div>
                    </div>

                    <!-- Pie Chart สำหรับผลการประเมิน (interpre_level) -->
                    <div class="col-lg-6 col-md-12">
                        <div class="chart-container">
                            <h3>ผลการประเมิน</h3>
                            <p>จำนวนครั้งที่ประเมิน : <?php echo $total_users; ?> คน</p>
                            <div id="pie-chart-interpre-level"></div>
                        </div>
                    </div>

                    <!-- Pie Chart สำหรับเพศ -->
                    <div class="col-lg-6 col-md-12">
                        <div class="chart-container">
                            <h3>เพศ</h3>
                            <div id="pie-chart-gender"></div>
                        </div>
                    </div>

                    <!-- Pie Chart สำหรับคณะ -->
                    <div class="col-lg-6 col-md-12">
                        <div class="chart-container">
                            <h3>คณะ</h3>
                            <div id="pie-chart-faculty"></div>
                        </div>
                    </div>

                    <!-- Bar Chart สำหรับผลการประเมิน -->
                    <div class="col-lg-12">
                        <div class="chart-container">
                            <h3>ผลการประเมินตามระดับ</h3>
                            <div id="bar-chart-interpre-level"></div>
                        </div>
                    </div>
                </div>

                <!-- ตารางแสดงผลการประเมิน -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart-container">
                            <h3>ตารางผลการประเมิน</h3>
                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>ผลการประเมิน</th>
                                        <th>จำนวน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($interpre_level_data as $level => $count): ?>
                                        <tr>
                                            <td><?php echo $level === "" ? "ไม่ระบุ" : $level; ?></td>
                                            <td><?php echo $count; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </>

        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="../assets/js/notification_bell.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
        <script>
            document.getElementById('year-select').addEventListener('change', function () {
                var monthSelect = document.getElementById('month-select');
                if (this.value != 0) {
                    monthSelect.disabled = false; // เปิดใช้งานการเลือกเดือน
                } else {
                    monthSelect.disabled = true; // ปิดการเลือกเดือน
                    monthSelect.value = 0; // รีเซ็ตค่าเดือนเป็น "ทั้งหมด" เมื่อปีเป็น "ทั้งหมด"
                }
                fetchDataAndUpdateCharts();
            });

            document.getElementById('month-select').addEventListener('change', function () {
                fetchDataAndUpdateCharts();
            });

            function updateCharts(data) {
                // อัปเดต Pie Chart สำหรับประเภทการประเมิน
                chartPieAssessment.updateSeries(data.assessment_counts);
                chartPieAssessment.updateOptions({ labels: Object.keys(data.assessment_counts) });

                // อัปเดต Pie Chart สำหรับผลการประเมิน
                chartPieInterpreLevel.updateSeries(data.interpre_level_counts);
                chartPieInterpreLevel.updateOptions({ labels: Object.keys(data.interpre_level_counts) });

                // อัปเดต Pie Chart สำหรับเพศ
                chartPieGender.updateSeries(data.gender_counts);
                chartPieGender.updateOptions({ labels: Object.keys(data.gender_counts) });

                // อัปเดต Pie Chart สำหรับคณะ
                chartPieFaculty.updateSeries(data.faculty_counts);
                chartPieFaculty.updateOptions({ labels: Object.keys(data.faculty_counts) });

                // อัปเดต Bar Chart สำหรับผลการประเมิน
                chartBar.updateSeries([{ data: Object.values(data.interpre_level_counts) }]);
                chartBar.updateOptions({ xaxis: { categories: Object.keys(data.interpre_level_counts) } });
            }

            // ข้อมูลสำหรับ Pie Chart ประเภทการประเมิน
            var assessmentData = <?php echo json_encode($assessment_counts); ?>;
            var pieChartDataAssessment = [];
            var labelsAssessment = [];
            for (var nameType in assessmentData) {
                labelsAssessment.push(nameType === "" ? "ไม่ระบุ" : nameType);
                pieChartDataAssessment.push(assessmentData[nameType]);
            }
            var pastelColors = ["#FFB6C1", "#FFDDC1", "#C1E1FF", "#D7BDE2", "#A2D5AB", "#F7C8E0", "#FFD1DC"];
            // ข้อมูลสำหรับ Pie Chart ประเภทการประเมิน
            var optionsPieAssessment = {
                chart: { type: 'donut' },
                labels: labelsAssessment,
                series: pieChartDataAssessment,
                colors: pastelColors,
                legend: {
                    show: true, // แสดง legend
                    position: 'bottom', // ตำแหน่งของ legend
                    formatter: function (seriesName, opts) {
                        return seriesName + ": " + opts.w.globals.series[opts.seriesIndex] + " ครั้ง"; // แสดงข้อมูลใน legend
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '60%', // กำหนดขนาดวงกลม
                            labels: {
                                show: true, // แสดง labels
                                name: { fontSize: '16px' }, // ปรับแต่งชื่อ
                                value: { fontSize: '18px' }, // ปรับแต่งค่าข้อมูล
                                total: {
                                    show: true, // แสดงผลรวม
                                    label: 'Total', // ชื่อผลรวม
                                    fontSize: '22px', // ขนาดฟอนต์
                                    formatter: function (w) {
                                        // คำนวณผลรวม
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + ' ครั้ง';
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value, { seriesIndex, w }) {
                            return value + ' ครั้ง';
                        }
                    }
                }
            };

            var chartPieAssessment = new ApexCharts(document.querySelector("#pie-chart-assessment"), optionsPieAssessment);
            chartPieAssessment.render();

            // ข้อมูลสำหรับ Pie Chart ผลการประเมิน
            var interpreLevelData = <?php echo json_encode($interpre_level_data); ?>;
            var pieChartDataInterpreLevel = [];
            var labelsInterpreLevel = [];
            for (var level in interpreLevelData) {
                labelsInterpreLevel.push(level === "" ? "ไม่ระบุ" : level);
                pieChartDataInterpreLevel.push(interpreLevelData[level]);
            }
            var pastelColors = ["#FFB6C1", "#FFDDC1", "#C1E1FF", "#D7BDE2", "#A2D5AB", "#F7C8E0", "#FFD1DC"];
            // ข้อมูลสำหรับ Pie Chart ผลการประเมิน
            var optionsPieInterpreLevel = {
                chart: { type: 'donut' },
                labels: labelsInterpreLevel,
                series: pieChartDataInterpreLevel,
                colors: pastelColors,
                legend: {
                    show: true, // แสดง legend
                    position: 'bottom', // ตำแหน่งของ legend
                    formatter: function (seriesName, opts) {
                        return seriesName + ": " + opts.w.globals.series[opts.seriesIndex] + " ครั้ง"; // แสดงข้อมูลใน legend
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '60%', // กำหนดขนาดวงกลม
                            labels: {
                                show: true, // แสดง labels
                                name: { fontSize: '16px' }, // ปรับแต่งชื่อ
                                value: { fontSize: '18px' }, // ปรับแต่งค่าข้อมูล
                                total: {
                                    show: true, // แสดงผลรวม
                                    label: 'Total', // ชื่อผลรวม
                                    fontSize: '22px', // ขนาดฟอนต์
                                    formatter: function (w) {
                                        // คำนวณผลรวม
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + ' ครั้ง';
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value, { seriesIndex, w }) {
                            return value + ' คน';
                        }
                    }
                }
            };
            var chartPieInterpreLevel = new ApexCharts(document.querySelector("#pie-chart-interpre-level"), optionsPieInterpreLevel);
            chartPieInterpreLevel.render();

            // ข้อมูลสำหรับ Pie Chart เพศ
            var genderData = <?php echo json_encode($gender_data); ?>;
            var pieChartDataGender = [];
            var labelsGender = [];
            for (var gender in genderData) {
                labelsGender.push(gender === "" ? "ไม่ระบุ" : gender); // แปลงค่าว่างเป็น "ไม่ระบุ"
                pieChartDataGender.push(genderData[gender]);
            }

            var pastelColors = ["#FFB6C1", "#FFDDC1", "#C1E1FF", "#D7BDE2", "#A2D5AB", "#F7C8E0", "#FFD1DC"];
            // ข้อมูลสำหรับ Pie Chart เพศ
            var optionsPieGender = {
                chart: { type: 'donut' },
                labels: labelsGender,
                series: pieChartDataGender,
                colors: pastelColors,
                legend: {
                    show: true, // แสดง legend
                    position: 'bottom', // ตำแหน่งของ legend
                    formatter: function (seriesName, opts) {
                        return seriesName + ": " + opts.w.globals.series[opts.seriesIndex]; // แสดงข้อมูลใน legend
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '60%', // กำหนดขนาดวงกลม
                            labels: {
                                show: true, // แสดง labels
                                name: { fontSize: '16px' }, // ปรับแต่งชื่อ
                                value: { fontSize: '18px' }, // ปรับแต่งค่าข้อมูล
                                total: {
                                    show: true, // แสดงผลรวม
                                    label: 'Total', // ชื่อผลรวม
                                    fontSize: '22px', // ขนาดฟอนต์
                                    formatter: function (w) {
                                        // คำนวณผลรวม
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + ' คน';
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value, { seriesIndex, w }) {
                            return value + ' คน';
                        }
                    }
                }
            };
            var chartPieGender = new ApexCharts(document.querySelector("#pie-chart-gender"), optionsPieGender);
            chartPieGender.render();

            // ข้อมูลสำหรับ Pie Chart คณะ
            var facultyData = <?php echo json_encode($faculty_data); ?>;
            var pieChartDataFaculty = [];
            var labelsFaculty = [];
            for (var faculty in facultyData) {
                labelsFaculty.push(faculty === "" ? "ไม่ระบุ" : faculty); // แปลงค่าว่างเป็น "ไม่ระบุ"
                pieChartDataFaculty.push(facultyData[faculty]);
            }

            var pastelColors = ["#FFB6C1", "#FFDDC1", "#C1E1FF", "#D7BDE2", "#A2D5AB", "#F7C8E0", "#FFD1DC"];
            var optionsPieFaculty = {
                chart: { type: 'donut' },
                labels: labelsFaculty,
                series: pieChartDataFaculty,
                colors: pastelColors,
                legend: {
                    show: true, // แสดง legend
                    position: 'bottom', // ตำแหน่งของ legend
                    formatter: function (seriesName, opts) {
                        return seriesName + ": " + opts.w.globals.series[opts.seriesIndex]; // แสดงข้อมูลใน legend
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '60%', // กำหนดขนาดวงกลม
                            labels: {
                                show: true, // แสดง labels
                                name: { fontSize: '16px' }, // ปรับแต่งชื่อ
                                value: { fontSize: '18px' }, // ปรับแต่งค่าข้อมูล
                                total: {
                                    show: true, // แสดงผลรวม
                                    label: 'Total', // ชื่อผลรวม
                                    fontSize: '22px', // ขนาดฟอนต์
                                    formatter: function (w) {
                                        // คำนวณผลรวม
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + ' คน';
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value, { seriesIndex, w }) {
                            return value + ' คน';
                        }
                    }
                }
            };

            var chartPieFaculty = new ApexCharts(document.querySelector("#pie-chart-faculty"), optionsPieFaculty);
            chartPieFaculty.render();

            // ข้อมูลสำหรับ Bar Chart ระดับการประเมิน
            var barChartData = [];
            var categories = [];
            for (var level in interpreLevelData) {
                categories.push(level === "" ? "ไม่ระบุ" : level); // แปลงค่าว่างเป็น "ไม่ระบุ"
                barChartData.push(interpreLevelData[level]);
            }

            var pastelColors = ["#FFB6C1", "#FFDDC1", "#C1E1FF", "#D7BDE2", "#A2D5AB", "#F7C8E0", "#FFD1DC"];
            var optionsBar = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'จำนวน',
                    data: barChartData
                }],
                colors: pastelColors, // กำหนดสีพาสเทลให้กับ Bar Chart
                xaxis: {
                    categories: categories
                },
                title: {
                    text: 'จำนวนผลการประเมินตามระดับ',
                    align: 'center',
                    margin: 20,
                    style: {
                        fontSize: '20px',
                        fontWeight: 'bold'
                    }
                }
            };

            // Render Bar Chart
            var chartBar = new ApexCharts(document.querySelector("#bar-chart-interpre-level"), optionsBar);
            chartBar.render();
        </script>

</body>

</html>