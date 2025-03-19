// เลือก canvas ที่จะใช้แสดงกราฟ
const ctx = document.getElementById('myDonutChart').getContext('2d');

    // สร้าง Donut Chart ด้วย Chart.js
    const myDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Remaining', 'Completed'],
            datasets: [{
                data: [53, 47], // เปอร์เซ็นต์ของข้อมูลที่ต้องการแสดง (53% คือที่เหลือ, 47% คือที่ทำแล้ว)
                backgroundColor: ['#e0e0e0', '#e91e63'], // สีของแต่ละส่วน
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            cutout: '70%', // ขนาดช่องว่างตรงกลาง
            plugins: {
                legend: {
                    display: false // ซ่อน legend
                }
            },
            // ปิด tooltips และ animations บางส่วนเพื่อง่ายต่อการอัปเดตแบบเรียลไทม์
            animation: {
                animateRotate: false,
                animateScale: false
            }
        }
    });

    // ฟังก์ชันสำหรับอัปเดตเปอร์เซ็นต์ใน Donut Chart
    function updateDonutChart(percentage) {
        myDonutChart.data.datasets[0].data = [100 - percentage, percentage];
        myDonutChart.update();

        // อัปเดตข้อความแสดงเปอร์เซ็นต์ด้านล่าง
        document.getElementById('chartPercentage').textContent = percentage + '%';
    }

    // ตัวอย่างการอัปเดตค่าเปอร์เซ็นต์เป็น 47%
    updateDonutChart(47);
