document.addEventListener("DOMContentLoaded", function () {
    // ตรวจสอบฟอร์มก่อนส่งข้อมูล
    const form = document.getElementById("addFacultiesForm");
    form.addEventListener("submit", function (event) {
        const faculties = document.getElementById("faculties").value.trim();
        const phone = document.getElementById("phone").value.trim();


        if (!faculties || !phone) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            event.preventDefault(); // ป้องกันการส่งฟอร์มหากข้อมูลไม่ครบ
        }
    });

    // ล้างค่าฟอร์มเมื่อปิดโมดอล
    const modal = document.getElementById("addFacultiesModal");
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset();
    });

    // ตรวจสอบ username ซ้ำ
    document.getElementById("faculties").addEventListener("blur", function () {
        let faculties = this.value.trim();
        if (faculties !== "") {
            fetch("check/check_faculties.php?faculties=" + faculties)
                .then(response => response.text())
                .then(data => {
                    if (data === "exists") {
                        alert("faculties นี้ถูกใช้แล้ว กรุณาเลือกชื่อใหม่");
                        this.value = "";
                    }
                });
        }
    });
});
