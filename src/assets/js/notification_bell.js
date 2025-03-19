document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');
    const notificationBell = document.getElementById('notificationBell');
    const notificationCount = document.querySelector('.notification-count');

    function fetchNotifications() {
        fetch('get_notification_bell.php')
            .then(response => response.json())
            .then(data => {
                console.log('Notifications data:', data); // ตรวจสอบข้อมูลที่ดึงมา
                if (data.length > 0) {
                    console.log('Showing notification count'); // ตรวจสอบการแสดงตัวเลขแจ้งเตือน
                    if (notificationCount) {
                        notificationCount.textContent = data.length; // แสดงจำนวนแจ้งเตือน
                        notificationCount.style.display = 'block';
                    }

                    notificationBell.addEventListener('click', function () {
                        Swal.fire({
                            title: 'การแจ้งเตือน',
                            html: data.map(item => `<p>${item.name} - ${item.createdAt}</p>`).join(''),
                            icon: 'info',
                            confirmButtonText: 'ปิด'
                        }).then(() => {
                            // อัปเดตสถานะ viewed เป็น 1 เมื่อปิด Popup
                            updateViewedStatus(data);
                        });
                    });
                } else {
                    console.log('Hiding notification count'); // ตรวจสอบการซ่อนตัวเลขแจ้งเตือน
                    if (notificationCount) {
                        notificationCount.style.display = 'none';
                    }
                }
            })
            .catch(error => console.error('Error fetching notifications:', error)); // ตรวจสอบข้อผิดพลาด
    }

    // อัปเดตสถานะ viewed เป็น 1
    function updateViewedStatus(notifications) {
        const ids = notifications.map(item => item.id); // เก็บ ID ของแจ้งเตือนทั้งหมด
        fetch('update_viewed.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ ids: ids }) // ส่ง ID ไปยังเซิร์ฟเวอร์
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Viewed status updated');
                // ซ่อนตัวเลขแจ้งเตือน
                if (notificationCount) {
                    notificationCount.style.display = 'none';
                }
                // รีเฟรชข้อมูลแจ้งเตือน
                fetchNotifications();
            }
        })
        .catch(error => console.error('Error updating viewed status:', error));
    }

    // เรียกฟังก์ชันดึงข้อมูลแจ้งเตือน
    fetchNotifications();
    setInterval(fetchNotifications, 100000);
});