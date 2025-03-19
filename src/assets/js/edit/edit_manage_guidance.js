// เปิด modal และเติมข้อมูลสำหรับการแก้ไข
$(document).on('click', '.edit-btn', function() {
    var row = $(this).closest('tr');
    var id = row.find('td:eq(0)').text().trim();
    var guidance = row.find('td:eq(2)').text().trim();
    var formtype_id = row.find('td:eq(3)').text().trim();

    console.log("เปิด Modal ID: " + id); // เช็คว่า ID ถูกต้องไหม
    console.log("Guidance: " + guidance);
    console.log("FormType: " + formtype_id);
    

    // เติมข้อมูล
    $('#guidanceId').val(id);
    $('#editGuidance').val(guidance);

    // ตรวจสอบค่าของ Form Type และเลือกให้ตรง
    $('#editFormtype_id').val(formtype_id).change();

    // เปิด modal
    $('#editGuidanceModal').modal('show');
});


// เมื่อส่งฟอร์มการแก้ไข
$('#editGuidanceForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // ข้อมูลฟอร์มที่ต้องการส่ง

    $.ajax({
        type: 'POST',
        url: 'update/update_manage_guidance.php', // สคริปต์ที่ใช้สำหรับอัพเดทข้อมูล
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
