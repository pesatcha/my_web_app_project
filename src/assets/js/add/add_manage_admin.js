document.addEventListener("DOMContentLoaded", function () {
    // ตรวจสอบฟอร์มก่อนส่งข้อมูล
    const form = document.getElementById("addAdminForm");
    form.addEventListener("submit", function (event) {
        const firstname = document.getElementById("firstname").value.trim();
        const lastname = document.getElementById("lastname").value.trim();
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        const phone = document.getElementById("phone").value.trim();

        if (!firstname || !lastname || !username || !password || !phone) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            event.preventDefault(); // ป้องกันการส่งฟอร์มหากข้อมูลไม่ครบ
        }
    });

    // ล้างค่าฟอร์มเมื่อปิดโมดอล
    const modal = document.getElementById("addAdminModal");
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset();
    });

    // ตรวจสอบ username ซ้ำ
    document.getElementById("username").addEventListener("blur", function () {
        let username = this.value.trim();
        if (username !== "") {
            fetch("check/check_username.php?username=" + username)
                .then(response => response.text())
                .then(data => {
                    if (data === "exists") {
                        alert("Username นี้ถูกใช้แล้ว กรุณาเลือกชื่อใหม่");
                        this.value = "";
                    }
                });
        }
    });
});
