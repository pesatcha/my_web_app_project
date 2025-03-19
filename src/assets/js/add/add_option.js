document.addEventListener("DOMContentLoaded", function () {
    // ตรวจสอบฟอร์มก่อนส่งข้อมูล
    const form = document.getElementById("addOptionForm");
    form.addEventListener("submit", function (event) {
        const option_name = document.getElementById("option_name").value.trim();
        const formtype_id = document.getElementById("formtype_id").value.trim();
        const score = document.getElementById("score").value.trim();

        if (!option_name || !formtype_id || !score) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            event.preventDefault(); // ป้องกันการส่งฟอร์มหากข้อมูลไม่ครบ
        }
    });

    // ล้างค่าฟอร์มเมื่อปิดโมดอล
    const modal = document.getElementById("addOptionModal");
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset();
    });

    // ตรวจสอบ username ซ้ำ
    document.getElementById("option_name").addEventListener("blur", function () {
        let option_name = this.value.trim();
        if (option_name !== "") {
            fetch("check/check_option.php?option_name=" + option_name)
                .then(response => response.text())
                .then(data => {
                    if (data === "exists") {
                        alert("Option นี้ถูกใช้แล้ว กรุณาเลือกชื่อใหม่");
                        this.value = "";
                    }
                });
        }
    });
});
