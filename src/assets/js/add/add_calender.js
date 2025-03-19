$(document).ready(function () {
    if (typeof window.Swal === "undefined") {
        console.error("SweetAlert2 is not loaded. Make sure to include the script.");
        return;
    }

    console.log("SweetAlert2 is loaded successfully.");

    $(".schedule-meeting").click(function () {
        let saveDataId = $(this).data("id"); // ดึง save_data_id จากปุ่ม "นัดพบ"
        let accId = $(this).data("acc-id"); // ดึง acc_id จากปุ่ม "นัดพบ"
        Swal.fire({
            title: "เลือกวันที่และเวลานัดพบ",
            html: `
                <input type="date" id="meeting_date" class="swal2-input" required>
                <input type="time" id="start_time" class="swal2-input" required>
                <input type="time" id="end_time" class="swal2-input" required>
                <textarea id="description" class="swal2-textarea" placeholder="กรุณากรอกรายละเอียดการนัดพบ เช่น สถานที่ หรือ ข้อมูลในการติดต่อกลับ"></textarea></div>
            `,
            showCancelButton: true,
            confirmButtonText: "บันทึก",
            cancelButtonText: "ยกเลิก",
            preConfirm: () => {
                let selectedDate = $("#meeting_date").val();
                let startTime = $("#start_time").val();
                let endTime = $("#end_time").val();
                let meetingDescription = $("#description").val();

                if (!selectedDate || !startTime || !endTime || !meetingDescription) {
                    Swal.showValidationMessage("กรุณากรอกข้อมูลให้ครบถ้วน!");
                    return false;
                }

                // แปลงรูปแบบวันที่จาก YYYY-MM-DD เป็น DD/MM/YYYY
                let dateParts = selectedDate.split('-');
                let formattedDate = `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;

                // ตรวจสอบว่าวันที่เลือกเป็นวันที่ในอดีตหรือไม่
                let today = new Date().toISOString().split('T')[0]; // ได้รูปแบบ YYYY-MM-DD
                if (selectedDate < today) {
                    Swal.showValidationMessage("ไม่สามารถนัดพบวันที่ผ่านมาแล้ว!");
                    return false;
                }

                // ตรวจสอบว่าเวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด
                if (startTime >= endTime) {
                    Swal.showValidationMessage("เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด!");
                    return false;
                }

                return { selectedDate: formattedDate, startTime, endTime, meetingDescription };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let { selectedDate, startTime, endTime, meetingDescription } = result.value;

                console.log("Sending Data:", {
                    saveDataId: saveDataId,
                    accId: accId,
                    meetingDate: selectedDate,
                    startTime: startTime,
                    endTime: endTime,
                    meetingDescription: meetingDescription
                });

                $.ajax({
                    url: "update/force_save_meeting.php",
                    type: "POST",
                    data: {
                        saveDataId: saveDataId,
                        accId: accId,
                        meetingDate: selectedDate,
                        startTime: startTime,
                        endTime: endTime,
                        meetingDescription: meetingDescription
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log("Response:", response); // ตรวจสอบค่าที่ได้รับ
                        if (response.status === "conflict") {
                            // แสดงข้อมูลนัดหมายที่ซ้อนทับกัน
                            let conflictMessage = "มีการนัดหมายที่ซ้อนทับกัน:\n";
                            response.conflicts.forEach(meeting => {
                                conflictMessage += `วันที่: ${meeting.meeting_date}, เวลา: ${meeting.start_time} - ${meeting.end_time}\n`;
                            });

                            // ถามผู้ใช้ว่าต้องการบันทึกการนัดหมายหรือไม่
                            Swal.fire({
                                title: "มีการนัดหมายที่ซ้อนทับกัน",
                                text: conflictMessage,
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonText: "บันทึกการนัดหมาย",
                                cancelButtonText: "ยกเลิก"
                            }).then((confirmResult) => {
                                if (confirmResult.isConfirmed) {
                                    // ส่งคำขอเพื่อบันทึกการนัดหมาย
                                    $.ajax({
                                        url: "../force_save_meeting.php", // ไฟล์สำหรับบันทึกการนัดหมายโดยไม่ตรวจสอบการซ้อนทับ
                                        type: "POST",
                                        data: {
                                            saveDataId: saveDataId,
                                            accId: accId,
                                            meetingDate: selectedDate,
                                            startTime: startTime,
                                            endTime: endTime,
                                            meetingDescription: meetingDescription
                                        },
                                        dataType: "json",
                                        success: function (response) {
                                            if (response.status === "success") {
                                                Swal.fire("สำเร็จ!", response.message, "success").then(() => {
                                                    location.reload(); // รีเฟรชหน้าเว็บ
                                                });
                                            } else {
                                                Swal.fire("เกิดข้อผิดพลาด!", response.message, "error");
                                            }
                                        },
                                        error: function () {
                                            Swal.fire("เกิดข้อผิดพลาด!", "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้", "error");
                                        },
                                    });
                                }
                            });
                        } else if (response.status === "success") {
                            Swal.fire("สำเร็จ!", response.message, "success").then(() => {
                                location.reload(); // รีเฟรชหน้าเว็บ
                            });
                        } else {
                            Swal.fire("เกิดข้อผิดพลาด!", response.message, "error");
                        }
                    },
                    error: function () {
                        Swal.fire("เกิดข้อผิดพลาด!", "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้", "error");
                    },
                });
            }
        });
    });
});