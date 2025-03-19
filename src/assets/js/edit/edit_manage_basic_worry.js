// เปิด modal และเติมข้อมูลสำหรับการแก้ไข
$(document).on('click', '.edit-btn', function() {
    var row = $(this).closest('tr'); 
    var id = row.find('td:eq(0)').text(); 
    var nameWorry = row.find('td:eq(2)').text(); 
    var nameWorryEng = row.find('td:eq(3)').text(); 

    // เติมข้อมูลในฟอร์ม
    $('#basicWorryId').val(id); // กำหนดค่าของ id ใน input hidden
    $('#editNameWorry').val(nameWorry);
    $('#editNameWorryEng').val(nameWorryEng);

    // เปิด modal
    $('#editBasicWorryModal').modal('show');
});

// เมื่อส่งฟอร์มการแก้ไข
$('#editBasicWorryForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // ข้อมูลฟอร์มที่ต้องการส่ง

    $.ajax({
        type: 'POST',
        url: 'update/update_manage_basic_worry.php', // สคริปต์ที่ใช้สำหรับอัพเดทข้อมูล
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
