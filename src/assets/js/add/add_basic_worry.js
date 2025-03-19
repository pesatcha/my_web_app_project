document.addEventListener("DOMContentLoaded", function () {
    // ตรวจสอบฟอร์มก่อนส่งข้อมูล
    const form = document.getElementById("addBasicWorryForm");
    form.addEventListener("submit", function (event) {
        const nameWorry = document.getElementById("nameWorry").value.trim();
        const nameWorryEng = document.getElementById("nameWorryEng").value.trim();


        if (!nameWorry || !nameWorryEng) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            event.preventDefault(); // ป้องกันการส่งฟอร์มหากข้อมูลไม่ครบ
        }
    });

    // ล้างค่าฟอร์มเมื่อปิดโมดอล
    const modal = document.getElementById("addBasicWorryModal");
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset();
    });

    // ตรวจสอบ ข้อมูล ซ้ำ
    document.getElementById("nameWorry").addEventListener("blur", function () {
        let nameWorry = this.value.trim();
        if (nameWorry !== "") {
            fetch("check/check_basic_worry.php?nameWorry=" + nameWorry)
                .then(response => response.text())
                .then(data => {
                    if (data === "exists") {
                        alert("nameWorry นี้ถูกใช้แล้ว กรุณาเลือกชื่อใหม่");
                        this.value = "";
                    }
                });
        }
    });
});
