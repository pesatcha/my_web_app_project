// เปิด modal และเติมข้อมูลสำหรับการแก้ไข
$(document).on('click', '.edit-btn', function() {
    var row = $(this).closest('tr'); // หาแถว
    var id = row.find('td:eq(0)').text(); // ดึง ID
    var basic_worry_id = row.find('td:eq(2)').text(); 
    var faculties_id = row.find('td:eq(3)').text(); 

    console.log('Edit ID:', id);
    // เติมข้อมูลในฟอร์ม
    $('#matchId').val(id); // กำหนดค่าของ id ใน input hidden
    $('#editBasic_worry_id').val(basic_worry_id);
    $('#editFaculties_id').val(faculties_id);

    // เปิด modal
    $('#editMatchModal').modal('show');
});

// เมื่อส่งฟอร์มการแก้ไข
$('#editMatchForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // ข้อมูลฟอร์มที่ต้องการส่ง
    console.log('Form Data:', formData);
    $.ajax({
        type: 'POST',
        url: 'update/update_manage_match.php', // สคริปต์ที่ใช้สำหรับอัพเดทข้อมูล
        data: formData,
        success: function(response) {
            alert('ข้อมูลถูกอัปเดตแล้ว!');
            location.reload(); // โหลดหน้าใหม่เพื่อแสดงข้อมูลที่อัปเดต
        },
        error: function() {
            alert('เกิดข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้');
        }
    });
});
