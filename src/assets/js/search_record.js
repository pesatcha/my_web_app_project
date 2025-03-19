$(document).ready(function () {
    $("#searchDate").on("change", function () {
        let selectedDate = $(this).val();
        if (selectedDate) {
            $.ajax({
                url: "search_record.php",
                type: "GET",
                data: { date: selectedDate },
                dataType: "json",
                success: function (data) {
                    let tableBody = $("tbody");
                    tableBody.empty(); // ล้างข้อมูลเก่าออกก่อน
                    if (data.length > 0) {
                        let newId = 1;
                        data.forEach(function (row) {
                            let scoreIcon = "";
                            if (row.score < 5) {
                                scoreIcon = "<iconify-icon icon='emojione:hugging-face' width='30' height='30'></iconify-icon>";
                            } else if (row.score >= 5 && row.score < 10) {
                                scoreIcon = "<iconify-icon icon='twemoji:nauseated-face' width='30' height='30'></iconify-icon>";
                            } else {
                                scoreIcon = "<iconify-icon icon='twemoji:hot-face' width='30' height='30'></iconify-icon>";
                            }
                            tableBody.append(`
                                <tr>
                                    <td>${newId++}</td>
                                    <td>${row.name}</td>
                                    <td>${row.phone}</td>
                                    <td>${row.faculty}</td>
                                    <td>${row.createdAt}</td>
                                    <td>${row.nameType}</td>
                                    <td>${scoreIcon}</td>
                                    <td><span class='badge rounded-pill fs-2 fw-medium bg-info-subtle text-bg-info'><a href='#'>ดูข้อมูล</a></span></td>
                                </tr>
                            `);
                        });
                    } else {
                        tableBody.append("<tr><td colspan='8' class='text-center'>ไม่พบข้อมูล</td></tr>");
                    }
                },
                error: function () {
                    alert("เกิดข้อผิดพลาดในการค้นหาข้อมูล");
                }
            });
        }
    });
});
