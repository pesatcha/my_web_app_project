// เปิด modal และเติมข้อมูลสำหรับการแก้ไข
$(document).on('click', '.edit-btn', function() {
    var row = $(this).closest('tr'); 
    var id = row.find('td:eq(0)').text(); 
    var nameType = row.find('td:eq(2)').text(); 
    var max_score = row.find('td:eq(3)').text(); 
    var min_score = row.find('td:eq(4)').text(); 
    var nameTypeEng = row.find('td:eq(5)').text(); 
    var type = row.find('td:eq(6)').text(); 


    // เติมข้อมูลในฟอร์ม
    $('#id').val(id); // กำหนดค่าของ id ใน input hidden
    $('#editNameType').val(nameType);
    $('#editMax_score').val(max_score);
    $('#editMin_score').val(min_score);
    $('#editNameTypeEng').val(nameTypeEng);
    $('#editType').val(type);

    // เปิด modal
    $('#editTypeModal').modal('show');
});

// เมื่อส่งฟอร์มการแก้ไข
$('#editTypeForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // ข้อมูลฟอร์มที่ต้องการส่ง

    $.ajax({
        type: 'POST',
        url: 'update/update_manege_type.php', // สคริปต์ที่ใช้สำหรับอัพเดทข้อมูล
        data: formData,
        success: function(response) {
            if (response.trim() === "success") { // ตรวจสอบข้อความที่ได้จาก PHP
                alert('ข้อมูลถูกอัปเดตแล้ว!');
                location.reload(); // โหลดหน้าใหม่
            } else {
                alert('เกิดข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้');
            }
        },
        error: function() {
            alert('เกิดข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้');
        }
    });
});
