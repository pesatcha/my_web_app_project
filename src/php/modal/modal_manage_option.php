<!-- Modal add -->
<div class="modal fade" id="addOptionModal" tabindex="-1" aria-labelledby="addOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOptionModalLabel">Add Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addOptionForm" method="POST" action="add_option.php">
                    <div class="mb-3">
                        <label for="option_name" class="form-label">Option Name</label>
                        <input type="text" class="form-control" id="option_name" name="option_name" required>
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
                    <div class="mb-3">
                        <label for="score" class="form-label">Score</label>
                        <input type="number" class="form-control" id="score" name="score" required min="0">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Option -->
<div class="modal fade" id="editOptionModal" tabindex="-1" aria-labelledby="editOptionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOptionModalLabel">Edit Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editOptionForm">
                    <input type="hidden" id="optionId" name="optionId"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="editOption_name" class="form-label">Option Name</label>
                        <input type="text" class="form-control" id="editOption_name" name="option_name" required>
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
                    <div class="mb-3">
                        <label for="editScore" class="form-label">Score</label>
                        <input type="number" class="form-control" id="editScore" name="score" required min="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
