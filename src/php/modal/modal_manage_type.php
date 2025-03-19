<!-- Modal add -->
<div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTypeModalLabel">Add Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTypeForm" method="POST" action="add_type.php"onsubmit="return validateScores('addTypeForm')">
                    <div class="mb-3">
                        <label for="nameType" class="form-label">Name Type</label>
                        <input type="text" class="form-control" id="nameType" name="nameType" required>
                    </div>
                    <div class="mb-3">
                        <label for="nameTypeEng" class="form-label">Name Type Eng</label>
                        <input type="text" class="form-control" id="nameTypeEng" name="nameTypeEng" required>
                    </div>
                    <div class="mb-3">
                        <label for="max_score" class="form-label">Max Score</label>
                        <input type="number" class="form-control" id="max_score" name="max_score" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="min_score" class="form-label">Min Score</label>
                        <input type="number" class="form-control" id="min_score" name="min_score" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Type -->
<div class="modal fade" id="editTypeModal" tabindex="-1" aria-labelledby="editTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTypeModalLabel">Edit Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTypeForm" onsubmit="return validateScores('editTypeForm')">
                    <input type="hidden" id="id" name="id"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="editNameType" class="form-label">Name Type</label>
                        <input type="text" class="form-control" id="editNameType" name="nameType" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMax_score" class="form-label">Max Score</label>
                        <input type="number" class="form-control" id="editMax_score" name="max_score" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="editMin_score" class="form-label">Min Score</label>
                        <input type="number" class="form-control" id="editMin_score" name="min_score" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="editNameTypeEng" class="form-label">Name Type Eng</label>
                        <input type="text" class="form-control" id="editNameTypeEng" name="nameTypeEng" required>
                    </div>
                    <div class="mb-3">
                        <label for="editType" class="form-label">Type</label>
                        <input type="text" class="form-control" id="editType" name="type" required>
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
        const maxScore = parseFloat(form.querySelector('[name="max_score"]').value);
        const minScore = parseFloat(form.querySelector('[name="min_score"]').value);

        if (maxScore < minScore) {
            alert("ค่า Max ต้องมีค่ามากกว่าค่า Min");
            return false; // ป้องกันการบันทึก
        }
        return true; // อนุญาตให้บันทึก
    }

</script>