document.addEventListener("DOMContentLoaded", function () {
    // ตรวจสอบฟอร์มก่อนส่งข้อมูล
    const form = document.getElementById("addTypeForm");
    form.addEventListener("submit", function (event) {
        const nameType_th = document.getElementById("namaTtpe").value.trim();
        const nameType_en = document.getElementById("nameTypeEng").value.trim();
        const max_score = document.getElementById("max_score").value.trim();
        const min_score = document.getElementById("min_score").value.trim();
        const type = document.getElementById("type").value.trim();

        if (!nameType_th || !nameType_en || !max_score || !min_score || !type) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            event.preventDefault(); // ป้องกันการส่งฟอร์มหากข้อมูลไม่ครบ
        }
    });

    // ล้างค่าฟอร์มเมื่อปิดโมดอล
    const modal = document.getElementById("addTypeModal");
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset();
    });

    // ตรวจสอบ username ซ้ำ
    document.getElementById("nameType").addEventListener("blur", function () {
        let nameType = this.value.trim();
        if (nameType !== "") {
            fetch("check/check_type.php?nameType=" + nameType)
                .then(response => response.text())
                .then(data => {
                    if (data === "exists") {
                        alert("nameType นี้ถูกใช้แล้ว กรุณาเลือกชื่อใหม่");
                        this.value = "";
                    }
                });
        }
    });
});
