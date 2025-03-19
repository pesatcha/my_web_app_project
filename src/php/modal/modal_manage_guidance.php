<!-- Modal add -->
<div class="modal fade" id="addGuidanceModal" tabindex="-1" aria-labelledby="addGuidanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGuidanceModalLabel">Add Guidance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addGuidanceForm" method="POST" action="add_guidance.php">
                    <div class="mb-3">
                        <label for="guidance" class="form-label">Guidance</label>
                        <input type="text" class="form-control" id="guidance" name="guidance" required>
                    </div>
                    <div class="mb-3">
                        <label for="formtype_id" class="form-label">Form Type</label>
                        <select class="form-control" id="formtype_id" name="formtype_id" required>
                            <option value="">-- Select Form Type --</option>
                            <?php
                            require 'connect.php'; // เชื่อมต่อฐานข้อมูล
                            $stmt = $conn->query("SELECT id, nameType FROM form_type WHERE id IN (1, 2, 3)"); // ดึงข้อมูลเฉพาะที่ต้องการ
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id']}'>{$row['nameType']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Edit Guidance -->
<div class="modal fade" id="editGuidanceModal" tabindex="-1" aria-labelledby="editGuidanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGuidanceModalLabel">Edit Guidance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editGuidanceForm">
                    <input type="hidden" id="guidanceId" name="guidanceId"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="editGuidance" class="form-label">Guidance</label>
                        <input type="text" class="form-control" id="editGuidance" name="guidance" required>
                    </div>
                    <div class="mb-3">
                        <label for="formtype_id" class="form-label">Form Type</label>
                        <select class="form-control" id="editFormtype_id" name="formtype_id" required>
                            <option value="">-- Select Form Type --</option>
                            <?php
                            require 'connect.php'; // เชื่อมต่อฐานข้อมูล
                            $stmt = $conn->query("SELECT id, nameType FROM form_type WHERE id IN (1, 2, 3)"); // ดึงข้อมูลเฉพาะที่ต้องการ
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id']}'>{$row['nameType']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
