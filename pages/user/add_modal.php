<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="function/addUser.php">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select class="form-control" id="user_type" name="user_type" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="complete_name">Complete Name</label>
                            <input class="form-control" type="text" id="complete_name" name="complete_name" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="add" class="btn btn-primary">Submit</button>
            </div>
            </form>
            <!-- form end -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
