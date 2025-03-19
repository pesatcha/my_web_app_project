document.addEventListener("DOMContentLoaded", function () {
    // ตรวจสอบฟอร์มก่อนส่งข้อมูล
    const form = document.getElementById("addQuestionForm");
    form.addEventListener("submit", function (event) {
        const question = document.getElementById("question").value.trim();
        const formtype_id = document.getElementById("formtype_id").value.trim();
        const question_type = document.getElementById("question_type").value.trim();

        if (!question || !formtype_id || !question_type) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            event.preventDefault(); // ป้องกันการส่งฟอร์มหากข้อมูลไม่ครบ
        }
    });

    // ล้างค่าฟอร์มเมื่อปิดโมดอล
    const modal = document.getElementById("addQuestionModal");
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset();
    });

    // ตรวจสอบ username ซ้ำ
    document.getElementById("question").addEventListener("blur", function () {
        let question = this.value.trim();
        if (question !== "") {
            fetch("check/check_question.php?question=" + question)
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
