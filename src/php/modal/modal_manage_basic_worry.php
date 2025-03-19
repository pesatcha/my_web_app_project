<!-- Modal add -->
<div class="modal fade" id="addBasicWorryModal" tabindex="-1" aria-labelledby="addBasicWorryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBasicWorryModalLabel">Add Basic Worry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBasicWorryForm" method="POST" action="add_basic_worry.php">
                    <div class="mb-3">
                        <label for="nameWorry" class="form-label">Name Worry</label>
                        <input type="text" class="form-control" id="nameWorry" name="nameWorry" required>
                    </div>
                    <div class="mb-3">
                        <label for="nameWorryEng" class="form-label">Name Worry Eng</label>
                        <input type="text" class="form-control" id="nameWorryEng" name="nameWorryEng" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Basic Worry -->
<div class="modal fade" id="editBasicWorryModal" tabindex="-1" aria-labelledby="editBasicWorryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBasicWorryModalLabel">Edit Basic Worry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBasicWorryForm">
                    <input type="hidden" id="basicWorryId" name="basicWorryId"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="editNameWorry" class="form-label">Name Worry</label>
                        <input type="text" class="form-control" id="editNameWorry" name="nameWorry" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNameWorryEng" class="form-label">Name Worry Eng</label>
                        <input type="text" class="form-control" id="editNameWorryEng" name="nameWorryEng" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
