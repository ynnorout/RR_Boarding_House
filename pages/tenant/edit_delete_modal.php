<!-- Edit Modal -->
<div class="modal fade" id="edit_<?php echo $row['tenant_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="function/editTenant.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Tenant</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $row['tenant_id']; ?>">
                        <label for="complete_name">Complete Name</label>
                        <input class="form-control complete_name_input" type="text" name="complete_name" value="<?php echo $row['complete_name']; ?>" required>
                        <div class="response"></div> <!-- Response container -->
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control address_input" type="text" name="address" value="<?php echo $row['address']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email_address">Email Address</label>
                        <input class="form-control email_address_input" type="email" name="email_address" value="<?php echo $row['email_address']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input class="form-control contact_input" type="text" name="contact" value="<?php echo $row['contact']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control gender_input" name="gender" required>
                            <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                            <option value="Other" <?php echo ($row['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Active" <?php echo ($row['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                            <option value="Inactive" <?php echo ($row['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['tenant_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
              <h4 class="modal-title">Delete Record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<h2 class="text-center"><?php echo $row['complete_name']; ?></h2>
			</div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="function/deleteTenant.php?id=<?php echo $row['tenant_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>

<!-- Include jQuery library -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<script src="../../plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        // Define a function to check for duplicate tenant
        function checkDuplicate() {
            var complete_name = $('.complete_name_input').val().trim();
            var responseContainer = $('.response'); // Select the response container by its class

            if (complete_name != '') {
                $.ajax({
                    url: 'function/checkDuplicate.php', // PHP script to check for duplicate
                    type: 'post',
                    data: { complete_name: complete_name },
                    success: function (response) {
                        console.log('Success:', response); // Log success message
                        if (response.trim() === 'exists') { // Trim response to remove any extra whitespace
                            responseContainer.html('<span style="color: red;">Complete name already exists</span>');
                            $('button[name="edit"]').prop('disabled', true); // Disable edit button
                        } else {
                            responseContainer.html(''); // Clear error message
                            $('button[name="edit"]').prop('disabled', false); // Enable edit button
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error); // Log error message
                    }
                });
            } else {
                responseContainer.html(""); // Clear response container
                $('button[name="edit"]').prop('disabled', false); // Enable edit button
            }
        }

        // Call the checkDuplicate function each time a key is pressed in the complete_name input field
        $(".complete_name_input").keyup(checkDuplicate);
    });
</script>
