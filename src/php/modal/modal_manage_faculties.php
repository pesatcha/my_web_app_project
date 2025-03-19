<!-- Modal add -->
<div class="modal fade" id="addFacultiesModal" tabindex="-1" aria-labelledby="addFacultiesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFacultiesModalLabel">Add Faculties</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addFacultiesForm" method="POST" action="add_faculties.php">
                    <div class="mb-3">
                        <label for="faculties" class="form-label">Faculties</label>
                        <input type="text" class="form-control" id="faculties" name="faculties" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Faculties -->
<div class="modal fade" id="editFacultiesModal" tabindex="-1" aria-labelledby="editFacultiesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFacultiesModalLabel">Edit Faculties</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFacultiesForm">
                    <input type="hidden" id="facultiesId" name="facultiesId"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="editFaculties" class="form-label">Faculties</label>
                        <input type="text" class="form-control" id="editFaculties" name="faculties" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
