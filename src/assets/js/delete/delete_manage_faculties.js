$(document).ready(function() {
    // ฟังก์ชันลบ
    $('.delete-btn').click(function() {
        var facultiesId = $(this).data('id'); // ดึง id ของผู้ใช้ที่ต้องการลบ
        
        // ใช้ confirm() ถามผู้ใช้ก่อนลบ
        var confirmDelete = confirm("คุณต้องการลบแปลผลนี้หรือไม่?");
        
        if (confirmDelete) {
            // ถ้ายืนยันลบ ส่งข้อมูลไปยังไฟล์ PHP สำหรับลบ
            $.ajax({
                url: 'delete/delete_manage_faculties.php',
                type: 'POST',
                data: { facultiesId: facultiesId },
                success: function(response) {
                    alert(response); // แสดงผลการลบ
                    location.reload(); // โหลดหน้าใหม่เพื่อแสดงผลการลบ
                },
                error: function() {
                    alert("เกิดข้อผิดพลาดในการลบข้อมูล");
                }
            });
        } else {
            // ถ้าไม่ยืนยันการลบ
            alert("ยกเลิกการลบ");
        }
    });
});
