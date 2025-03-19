document.addEventListener("DOMContentLoaded", function () {
    // ตรวจสอบฟอร์มก่อนส่งข้อมูล
    const form = document.getElementById("addGuidanceForm");
    form.addEventListener("submit", function (event) {
        const guidance = document.getElementById("guidance").value.trim();
        const formtype_id = document.getElementById("formtype_id").value.trim();

        if (!guidance || !formtype_id) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            event.preventDefault(); // ป้องกันการส่งฟอร์มหากข้อมูลไม่ครบ
        }
    });

    // ล้างค่าฟอร์มเมื่อปิดโมดอล
    const modal = document.getElementById("addGuidanceModal");
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset();
    });

    // ตรวจสอบซ้ำ
    document.getElementById("guidance").addEventListener("blur", function () {
        let guidance = this.value.trim();
        if (guidance !== "") {
            fetch("check/check_guidance.php?guidance=" + guidance)
                .then(response => response.text())
                .then(data => {
                    if (data === "exists") {
                        alert("คำแนะนำนี้ถูกใช้แล้ว กรุณาเลือกคำแนะนำใหม่");
                        this.value = "";
                    }
                });
        }
    });
});
