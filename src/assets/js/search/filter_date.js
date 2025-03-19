document.addEventListener('DOMContentLoaded', function () {
    const filterDate = document.getElementById('filterDate'); // ดึง input date
    const filterType = document.getElementById('filterType'); // ดึง select ประเภทคำถาม
    const searchInput = document.getElementById('searchInput'); // ดึง input ค้นหารายชื่อ
    const tableRows = document.querySelectorAll('tbody tr'); // ดึงทุกแถวของตาราง

    function filterRows() {
        const selectedDate = filterDate.value.trim(); // ค่าที่เลือกใน input date (YYYY-MM-DD)
        const selectedType = filterType.value.trim(); // ค่าที่เลือกใน select ประเภทคำถาม
        const searchTerm = searchInput.value.trim().toLowerCase(); // ค่าที่ค้นหาใน input ค้นหารายชื่อ

        tableRows.forEach(row => {
            const dateCell = row.querySelector('td:nth-child(6)'); 
            const typeCell = row.querySelector('td:nth-child(7)'); // สมมติว่า ประเภทคำถามอยู่ในคอลัมน์ที่ 7
            const nameCell = row.querySelector('td:nth-child(3)'); // สมมติว่า ชื่ออยู่ในคอลัมน์ที่ 3

            const rowDate = dateCell ? dateCell.textContent.trim() : '';
            const rowType = typeCell ? typeCell.textContent.trim() : '';
            const rowName = nameCell ? nameCell.textContent.trim().toLowerCase() : '';

            // ตรวจสอบเงื่อนไขการแสดงแถว
            const dateMatch = !selectedDate || rowDate === selectedDate;
            const typeMatch = !selectedType || rowType === selectedType;
            const nameMatch = !searchTerm || rowName.includes(searchTerm);

            if (dateMatch && typeMatch && nameMatch) {
                row.style.display = ''; // แสดงแถวที่ตรงกับเงื่อนไข
            } else {
                row.style.display = 'none'; // ซ่อนแถวที่ไม่ตรงกับเงื่อนไข
            }
        });
    }

    filterDate.addEventListener('input', filterRows);
    filterType.addEventListener('change', filterRows); // เพิ่มการฟังเหตุการณ์สำหรับประเภทคำถาม
    searchInput.addEventListener('input', filterRows); // เพิ่มการฟังเหตุการณ์สำหรับการค้นหารายชื่อ
});