document.addEventListener("DOMContentLoaded", function () {
    // ตรวจสอบฟอร์มก่อนส่งข้อมูล
    const form = document.getElementById("addInterpreForm");
    form.addEventListener("submit", function (event) {
        const nameInterpre = document.getElementById("nameInterpre").value.trim();
        const formtype_id = document.getElementById("formtype_id").value.trim();
        const min_Interpre = document.getElementById("min_Interpre").value.trim();
        const max_Interpre = document.getElementById("max_Interpre").value.trim();
        const color_Progress = document.getElementById("color_Progress").value.trim();

        if (!nameInterpre || !formtype_id || !min_Interpre || !max_Interpre || !color_Progress) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            event.preventDefault(); // ป้องกันการส่งฟอร์มหากข้อมูลไม่ครบ
        }
    });

    // ล้างค่าฟอร์มเมื่อปิดโมดอล
    const modal = document.getElementById("addInterpreModal");
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset();
    });

    // ตรวจสอบ username ซ้ำ
    document.getElementById("nameInterpre").addEventListener("blur", function () {
        let nameInterpre = this.value.trim();
        if (nameInterpre !== "") {
            fetch("check/check_interpre.php?nameInterpre=" + nameInterpre)
                .then(response => response.text())
                .then(data => {
                    if (data === "exists") {
                        alert("แปลผลนี้ถูกใช้แล้ว กรุณาเลือกชื่อใหม่");
                        this.value = "";
                    }
                });
        }
    });
});
