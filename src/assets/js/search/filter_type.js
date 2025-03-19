document.addEventListener('DOMContentLoaded', function() {
    const filterType = document.getElementById('filterType'); // ดึง dropdown
    const tableRows = document.querySelectorAll('tbody tr'); // ดึงทุกแถวของตาราง

    filterType.addEventListener('change', function() {
        const selectedType = this.value.trim(); // ค่าที่เลือกจาก dropdown
        tableRows.forEach(row => {
            const typeCell = row.querySelector('td:nth-child(7)'); // คอลัมน์ที่ 6 (Form Type)

            if (typeCell) {
                const typeText = typeCell.textContent.trim(); // อ่านค่าจากตาราง
                if (selectedType === '' || typeText === selectedType) {
                    row.style.display = ''; // แสดงแถวที่ตรงกับค่าที่เลือก
                } else {
                    row.style.display = 'none'; // ซ่อนแถวที่ไม่ตรงกับค่าที่เลือก
                }
            }
        });
    });
});
