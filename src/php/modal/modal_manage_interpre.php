<!-- Modal add -->
<div class="modal fade" id="addInterpreModal" tabindex="-1" aria-labelledby="addInterpreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInterpreModalLabel">Add Interpre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addInterpreForm" method="POST" action="add_interpre.php" onsubmit="return validateScores('addInterpreForm')">
                    <div class="mb-3">
                        <label for="nameInterpre" class="form-label">Name Interpre</label>
                        <input type="text" class="form-control" id="nameInterpre" name="nameInterpre" required>
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
                        <label for="min_Interpre" class="form-label">Min Interpre</label>
                        <input type="number" class="form-control" id="min_Interpre" name="min_Interpre" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="max_Interpre" class="form-label">Max Interpre</label>
                        <input type="number" class="form-control" id="max_Interpre" name="max_Interpre" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="color_Progress" class="form-label">Color Progress</label>
                        <input type="text" class="form-control" id="color_Progress" name="color_Progress" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Interpre -->
<div class="modal fade" id="editInterpreModal" tabindex="-1" aria-labelledby="editInterpreModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInterpreModalLabel">Edit Interpre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editInterpreForm" onsubmit="return validateScores('editInterpreForm')">
                    <input type="hidden" id="interpreId" name="interpreId"> 
                    <div class="mb-3">
                        <label for="editNameInterpre" class="form-label">Name Interpre</label>
                        <input type="text" class="form-control" id="editNameInterpre" name="nameInterpre" required>
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
                        <label for="editMin_Interpre" class="form-label">Min Interpre</label>
                        <input type="number" class="form-control" id="editMin_Interpre" name="min_Interpre" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="editMax_Interpre" class="form-label">Max Interpre</label>
                        <input type="number" class="form-control" id="editMax_Interpre" name="max_Interpre" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="editColor_Progress" class="form-label">Color Progress</label>
                        <input type="text" class="form-control" id="editColor_Progress" name="color_Progress" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    
    function validateScores(formId) {
        const form = document.getElementById(formId);
        const maxScore = parseFloat(form.querySelector('[name="max_Interpre"]').value);
        const minScore = parseFloat(form.querySelector('[name="min_Interpre"]').value);

        if (maxScore < minScore) {
            alert("ค่า Max ต้องมีค่ามากกว่าค่า Min");
            return false; // ป้องกันการบันทึก
        }
        return true; // อนุญาตให้บันทึก
    }
    
</script>
