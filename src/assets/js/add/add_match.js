document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("addMatchForm");

    if (!form) {
        console.error("❌ Form not found! ตรวจสอบ ID addMatchForm");
        return;
    }

    console.log("✅ Form Loaded:", form);

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        console.log("🚀 Form Submitted!");

        const formData = new FormData(this);
        console.log("📦 FormData:", [...formData.entries()]); // Debug Data

        fetch("/src/php/add_match.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text()) // อ่านเป็น Text ก่อน
        .then(data => {
            console.log("📜 Raw Response:", data);
            try {
                const jsonData = JSON.parse(data);
                alert(jsonData.message);
                if (jsonData.status === "success") {
                    location.reload(); // รีโหลดหน้าเมื่อสำเร็จ
                }
            } catch (error) {
                console.error("❌ JSON Parse Error:", error, "Response:", data);
            }
        })
        .catch(error => console.error("❌ Fetch Error:", error));
    });
});
