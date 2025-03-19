// เปิด modal และเติมข้อมูลสำหรับการแก้ไข
$(document).on('click', '.edit-btn', function() {
    var row = $(this).closest('tr'); // หาแถว
    var id = row.find('td:eq(0)').text(); // ดึง ID
    var option_name = row.find('td:eq(2)').text(); 
    var formtype_id = row.find('td:eq(3)').text(); 
    var score = row.find('td:eq(4)').text(); 


    // เติมข้อมูลในฟอร์ม
    $('#optionId').val(id); // กำหนดค่าของ id ใน input hidden
    $('#editOption_name').val(option_name);
    $('#editFormtype_id').val(formtype_id);
    $('#editScore').val(score);

    // เปิด modal
    $('#editOptionModal').modal('show');
});

// เมื่อส่งฟอร์มการแก้ไข
$('#editOptionForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // ข้อมูลฟอร์มที่ต้องการส่ง

    $.ajax({
        type: 'POST',
        url: 'update/update_manage_option.php', // สคริปต์ที่ใช้สำหรับอัพเดทข้อมูล
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
