<!-- Modal add -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addAdminForm" method="POST" action="add_admin.php">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                                    <option value="นักจิตวิทยา">นักจิตวิทยา</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<!-- Modal for Edit Admin -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editAdminForm">
          <input type="hidden" id="adminId" name="adminId"> <!-- Hidden field for ID -->
          <div class="mb-3">
            <label for="editFirstname" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="editFirstname" name="firstname" required>
          </div>
          <div class="mb-3">
            <label for="editLastname" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="editLastname" name="lastname" required>
          </div>
          <div class="mb-3">
            <label for="editUsername" class="form-label">บัญชีผู้ใช้</label>
            <input type="text" class="form-control" id="editUsername" name="username" required>
          </div>
          <div class="mb-3">
            <label for="editPhone" class="form-label">โทรศัพท์</label>
            <input type="text" class="form-control" id="editPhone" name="phone" required>
          </div>
          <div class="mb-3">
            <label for="editRole" class="form-label">สิทธิ์</label>
            <select class="form-control" id="editRole" name="role" required>
              <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
              <option value="นักจิตวิทยา">นักจิตวิทยา</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>


