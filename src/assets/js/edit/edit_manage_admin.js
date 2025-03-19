// เปิด modal และเติมข้อมูลสำหรับการแก้ไข
$(document).on('click', '.edit-btn', function() {
    var row = $(this).closest('tr'); // หาแถวที่ผู้ใช้เลือก
    var id = row.find('td:eq(0)').text(); // ดึง ID
    var firstname = row.find('td:eq(2)').text(); // ดึง ชื่อ
    var lastname = row.find('td:eq(3)').text(); // ดึง นามสกุล
    var username = row.find('td:eq(4)').text(); // ดึง บัญชีผู้ใช้
    var phone = row.find('td:eq(5)').text(); // ดึง โทรศัพท์
    var role = row.find('td:eq(6)').text(); // ดึง สิทธิ์

    // เติมข้อมูลในฟอร์ม
    $('#adminId').val(id); // กำหนดค่าของ id ใน input hidden
    $('#editFirstname').val(firstname);
    $('#editLastname').val(lastname);
    $('#editUsername').val(username);
    $('#editPhone').val(phone);
    $('#editRole').val(role);

    // เปิด modal
    $('#editAdminModal').modal('show');
});

// เมื่อส่งฟอร์มการแก้ไข
$('#editAdminForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // ข้อมูลฟอร์มที่ต้องการส่ง

    $.ajax({
        type: 'POST',
        url: 'update/update_manage_admin.php', // สคริปต์ที่ใช้สำหรับอัพเดทข้อมูล
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
