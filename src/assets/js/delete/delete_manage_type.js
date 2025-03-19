$(document).ready(function () {
    $(".delete-btn").click(function () {
        let typeId = $(this).data("id");

        if (!typeId) {
            alert("ไม่พบข้อมูลที่ต้องการลบ");
            return;
        }

        if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?")) {
            $.ajax({
                url: "delete/delete_manage_type.php",
                type: "POST",
                data: { id: typeId },
                dataType: "json",
                success: function (response) {
                    alert(response.message);
                    if (response.status === "success") {
                        location.reload(); // รีโหลดหน้าใหม่เมื่อสำเร็จ
                    }
                },
                error: function () {
                    alert("เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง");
                }
            });
        }
    });
});
