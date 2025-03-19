<!-- Modal add -->
<div class="modal fade" id="addMatchModal" tabindex="-1" aria-labelledby="addMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMatchModalLabel">Add Match</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMatchForm" method="POST" action="add_match.php">
                    <div class="mb-3">
                        <label for="basic_worry_id" class="form-label">Basic Worry ID</label>
                        <select class="form-control" id="basic_worry_id" name="basic_worry_id" required>
                            <option value="">-- Select Basic Worry --</option>
                            <?php
                            require 'connect.php'; // เชื่อมต่อฐานข้อมูล
                            $stmt = $conn->query("SELECT id, nameWorry FROM basic_worry"); // ดึงข้อมูล
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id']}'>{$row['nameWorry']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="faculties_id" class="form-label">Faculties ID</label>
                        <select class="form-control" id="faculties_id" name="faculties_id" required>
                            <option value="">-- Select Faculties --</option>
                            <?php
                            require 'connect.php'; // เชื่อมต่อฐานข้อมูล
                            $stmt = $conn->query("SELECT id, faculties FROM faculties"); // ดึงข้อมูล
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id']}'>{$row['faculties']}</option>";
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

<!-- Modal for Edit Match -->
<div class="modal fade" id="editMatchModal" tabindex="-1" aria-labelledby="editMatchModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMatchModalLabel">Edit Match</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMatchForm">
                    <input type="hidden" id="matchId" name="matchId"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="basic_worry_id" class="form-label">Basic Worry ID</label>
                        <select class="form-control" id="basic_worry_id" name="basic_worry_id" required>
                            <option value="">-- Select Basic Worry --</option>
                            <?php
                            require 'connect.php'; // เชื่อมต่อฐานข้อมูล
                            $stmt = $conn->query("SELECT id, nameWorry FROM basic_worry"); // ดึงข้อมูล
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id']}'>{$row['nameWorry']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="faculties_id" class="form-label">Faculties ID</label>
                        <select class="form-control" id="faculties_id" name="faculties_id" required>
                            <option value="">-- Select Faculties --</option>
                            <?php
                            require 'connect.php'; // เชื่อมต่อฐานข้อมูล
                            $stmt = $conn->query("SELECT id, faculties FROM faculties"); // ดึงข้อมูล
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id']}'>{$row['faculties']}</option>";
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
