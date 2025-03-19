<?php
session_start();
$role_id = $_SESSION['role_id'] ?? null;
?>

<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-center mt-3">
            <a href="./index.php" class="text-nowrap logo-img">
                <h3 class="logohead text-primary fs-6">WELLBEING</h3>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                
                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index.php">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- เฉพาะ Admin -->
                <?php if ($role_id == 1): ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link" id="accountManagementToggle">
                            <iconify-icon icon="solar:card-2-outline"></iconify-icon>
                            <span class="hide-menu">จัดการบัญชี</span>
                        </a>
                        <ul class="submenu" style="display: none; padding-left: 20px;">
                            <li><a class="sidebar-link" href="manage_admin.php"><iconify-icon icon="solar:user-hand-up-bold-duotone"></iconify-icon>ผู้ดูแลระบบ</a></li>
                            <li><a class="sidebar-link" href="manage_user.php"><iconify-icon icon="solar:user-hand-up-bold"></iconify-icon>บัญชีผู้ใช้งาน</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"><a class="sidebar-link" href="manage_question.php"><iconify-icon icon="solar:question-circle-bold"></iconify-icon>จัดการคำถาม</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="manage_option.php"><iconify-icon icon="solar:map-point-favourite-bold-duotone"></iconify-icon>จัดการคะแนน</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="manage_interpre.php"><iconify-icon icon="solar:checklist-bold-duotone"></iconify-icon>จัดการการแปลผล</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="manage_type.php"><iconify-icon icon="ant-design:database-outlined"></iconify-icon>จัดการประเภท</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="manage_basic_worry.php"><iconify-icon icon="typcn:input-checked"></iconify-icon>จัดการตัวเลือกเบื้องต้น</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="manage_faculties.php"><iconify-icon icon="typcn:mortar-board"></iconify-icon>จัดการตัวเลือกหน่วยงาน</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="manage_match.php"><iconify-icon icon="carbon:ibm-match-360"></iconify-icon>จัดการการจับคู่</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="manage_guidance.php"><iconify-icon icon="typcn:heart-half-outline"></iconify-icon>คำแนะนำ</a></li>
                <?php endif; ?>

                <!-- เมนูที่แสดงให้ทั้ง Admin และ นักจิตวิทยา -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="recordmain.php">
                        <iconify-icon icon="solar:vinyl-record-broken"></iconify-icon>
                        <span class="hide-menu">ประวัติการประเมิน</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="individual.php">
                        <iconify-icon icon="lucide:book-user"></iconify-icon>
                        <span class="hide-menu">รายบุคคล</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="meeting.php">
                        <iconify-icon icon="lucide:alarm-clock-check"></iconify-icon>
                        <span class="hide-menu">การนัดพบ</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="login.php">
                        <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- Sidebar End -->
