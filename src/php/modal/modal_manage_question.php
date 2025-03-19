<!-- Modal add -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestionModalLabel">Add Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addQuestionForm" method="POST" action="add_question.php">
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question" required>
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
                        <label for="question_type" class="form-label">Question Type</label>
                        <input type="text" class="form-control" id="question_type" name="question_type" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Question -->
<div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editQuestionForm">
                    <input type="hidden" id="questionId" name="questionId"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="editQuestion" class="form-label">Question</label>
                        <input type="text" class="form-control" id="editQuestion" name="question" required>
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
                        <label for="editQuestion_type" class="form-label">Question Type</label>
                        <input type="text" class="form-control" id="editQuestion_type" name="question_type" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
