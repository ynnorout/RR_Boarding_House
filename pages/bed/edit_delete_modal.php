<!-- Edit Modal -->
<div class="modal fade" id="edit_<?php echo $row['bed_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Bed</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="function/editBed.php">
                        <input type="hidden" name="bed_id" value="<?php echo $row['bed_id']; ?>">
                        <div class="form-group">
                            <label for="room_id">Room</label>
                            <select class="form-control room_input" name="room_id" required>
                                <!-- Populate the select options with room data -->
                                <?php
                                $sql = "SELECT * FROM tblroom";
                                $result = $conn->query($sql);
                                while ($room = $result->fetch_assoc()) {
                                    echo "<option value='" . $room['room_id'] . "' " . (($room['room_name'] == $row['room_name']) ? 'selected' : '') . ">" . $room['room_name'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="bed_number">Bed Number</label>
                            <input class="form-control bed_number_input" type="text" name="bed_number" value="<?php echo $row['bed_number']; ?>" required>
                            <div class="response"></div> <!-- Response container -->
                        </div>
                        <div class="form-group">
                            <label for="monthly_rent">Monthly Rent</label>
                            <input class="form-control monthly_rent_input" type="number" name="monthly_rent" value="<?php echo $row['monthly_rent']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control status_input" name="status" required>
                                <option value="available" <?php echo ($row['status'] == 'available') ? 'selected' : ''; ?>>Available</option>
                                <option value="occupied" <?php echo ($row['status'] == 'occupied') ? 'selected' : ''; ?>>Occupied</option>
                            </select>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $row['bed_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Bed</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">  
                <p class="text-center">Are you sure you want to delete this bed?</p>
                <h2 class="text-center"><?php echo $row['bed_number']; ?></h2>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="function/deleteBed.php?bed_id=<?php echo $row['bed_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery library -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $(".bed_number_input").keyup(function () {
            var bed_number = $(this).val().trim();
            var responseContainer = $(this).closest('.modal-content').find('.response');
            var submitButton = $(this).closest('.modal-content').find('button[type="submit"]');
            
            if (bed_number != '') {
                $.ajax({
                    url: 'function/checkDuplicate.php', // PHP script to check for duplicate bed number
                    type: 'post',
                    data: { bed_number: bed_number },
                    success: function (response) {
                        responseContainer.html(response); // Display response message
                        if (!response.includes('Bed number already exists. Please enter a different bed number.')) {
                            submitButton.prop('disabled', false); // Enable submit button
                        } else {
                            submitButton.prop('disabled', true); // Disable submit button
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('Error:', error); // Log error message
                    }
                });
            } else {
                responseContainer.html(""); // Clear response container
                submitButton.prop('disabled', true); // Disable submit button
            }
        });
    });
</script>
