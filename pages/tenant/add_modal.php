<!-- Your modal HTML code -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <form method="post" action="function/addTenant.php" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Tenant</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="complete_name">Complete Name</label>
                                <input class="form-control" type="text" id="complete_name" name="complete_name" required>
                                <div id="response"></div> <!-- Response container -->
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <input class="form-control" type="email" id="email_address" name="email_address" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input class="form-control" type="text" id="contact" name="contact" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profile_picture">Profile Picture</label>
                                <input class="form-control" type="file" id="profile_picture" name="profile_picture" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="proof_of_identity">Proof of Identity</label>
                                <input class="form-control" type="file" id="proof_of_identity" name="proof_of_identity" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" type="text" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" id="add_button" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Save</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Integrate the provided JavaScript code -->
<script>
    // Define a function to check for duplicate tenant
function checkDuplicate() {
    var complete_name = $('#complete_name').val().trim();
    if (complete_name != '') {
        $.ajax({
            url: 'function/checkDuplicate.php', // PHP script to check for duplicate
            type: 'post',
            data: { complete_name: complete_name },
            success: function (response) {
                console.log('Success:', response); // Log success message
                if (response.trim() === 'exists') { // Trim response to remove any extra whitespace
                    $('#response').html('<span style="color: red;">Complete name already exists</span>');
                    $('#add_button').prop('disabled', true); // Disable add button
                } else {
                    $('#response').html(''); // Clear error message
                    $('#add_button').prop('disabled', false); // Enable add button
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error); // Log error message
            }
        });
    } else {
        $('#response').html(""); // Clear response container
        $('#add_button').prop('disabled', false); // Enable add button
    }
}

$(document).ready(function () {
    // Call the checkDuplicate function each time a key is pressed in the complete_name input field
    $("#complete_name").keyup(checkDuplicate);
});

</script>
