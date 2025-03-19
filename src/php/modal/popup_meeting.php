<div id="popupMeeting" class="modal fade" tabindex="-1" aria-labelledby="popupMeetingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">นัดพบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="meetingForm">
                    <div class="mb-3">
                        <input type="date" class="form-control" id="meetingDate" name="meetingDate" required>
                    </div>
                    <div class="mb-3">
                        <input type="time" class="form-control" id="startTime" name="startTime" required>
                    </div>
                    <div class="mb-3">
                        <input type="time" class="form-control" id="endTime" name="endTime" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="meetingDescription" name="meetingDescription" rows="3"
                            placeholder="นักจิตวิทยาต้องการพบคุณ"></textarea>
                    </div>
                    <input type="hidden" id="meetingUserId" name="userId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="confirmMeeting">บันทึก</button>
            </div>
        </div>
    </div>
</div>