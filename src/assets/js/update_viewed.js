document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".view-data").forEach(function (element) {
        element.addEventListener("click", function (event) {
            let saveDataId = this.getAttribute("data-id");
            let row = this.closest("tr");

            // ส่ง AJAX request ไปยังไฟล์ PHP เพื่ออัปเดตสถานะ
            fetch("update/update_viewed.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + saveDataId
            })
            .then(response => response.text())
            .then(data => {
                if (data === "success") {
                    row.classList.remove("not-viewed"); // ลบสีเข้มออก
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});
