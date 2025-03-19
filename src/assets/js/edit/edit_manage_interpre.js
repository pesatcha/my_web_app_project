// เปิด modal และเติมข้อมูลสำหรับการแก้ไข
$(document).on('click', '.edit-btn', function() {
    var row = $(this).closest('tr'); 
    var id = row.find('td:eq(0)').text(); 
    var nameInterpre = row.find('td:eq(2)').text(); 
    var formtype_id = row.find('td:eq(3)').text(); 
    var min_Interpre = row.find('td:eq(4)').text(); 
    var max_Interpre = row.find('td:eq(5)').text(); 
    var color_Progress = row.find('td:eq(6)').text(); 


    // เติมข้อมูลในฟอร์ม
    $('#interpreId').val(id); // กำหนดค่าของ id ใน input hidden
    $('#editNameInterpre').val(nameInterpre);
    $('#editFormtype_id').val(formtype_id);
    $('#editMin_Interpre').val(min_Interpre);
    $('#editMax_Interpre').val(max_Interpre);
    $('#editColor_Progress').val(color_Progress);

    // เปิด modal
    $('#editInterpreModal').modal('show');
});

// เมื่อส่งฟอร์มการแก้ไข
$('#editInterpreForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // ข้อมูลฟอร์มที่ต้องการส่ง

    $.ajax({
        type: 'POST',
        url: 'update/update_manage_interpre.php', // สคริปต์ที่ใช้สำหรับอัพเดทข้อมูล
        data: formData,
        success: function(response) {
            if (response.trim() === "success") {
                alert('ข้อมูลถูกอัปเดตแล้ว!');
                location.reload(); // โหลดหน้าใหม่เพื่อแสดงข้อมูลที่อัปเดต
            } else {
                alert('เกิดข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้');
            }
        },
        error: function() {
            alert('เกิดข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้');
        }
    });
});
