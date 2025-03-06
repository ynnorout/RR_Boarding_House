<!-- Your modal HTML code -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-md">
        <form method="post" action="function/addBedAssignment.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Bed Assignment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tenant_id">Tenant Name</label>
                        <select class="form-control" id="tenant_id" name="tenant_id" required>
                            <!-- Populate the select options with tenant data -->
                            <?php
                                require_once('../includes/dbcon.php');
                                $sql = "SELECT * FROM tbltenant";
                                $result = $conn->query($sql);
                                echo "<option value=''>Select Tenant</option>"; // Add default option
                                while ($tenant = $result->fetch_assoc()) {
                                    echo "<option value='" . $tenant['tenant_id'] . "'>" . $tenant['complete_name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room_id">Room Name</label>
                        <select class="form-control" id="room_id" name="room_id" required>
                            <!-- Populate the select options with room data -->
                            <?php
                                $sql = "SELECT * FROM tblroom";
                                $result = $conn->query($sql);
                                echo "<option value=''>Select Room</option>"; // Add default option
                                while ($room = $result->fetch_assoc()) {
                                    echo "<option value='" . $room['room_id'] . "'>" . $room['room_name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bed_id">Bed Number</label>
                        <select class="form-control" id="bed_id" name="bed_id" required>
                            <!-- Populate the select options with bed data where status is available -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date (enter 1-28)</label>
                        <input class="form-control" type="number" id="due_date" name="due_date" min="1" max="28" required>
                    </div>
                    <div class="form-group">
                        <label for="months_to_stay">Months to Stay</label>
                        <input class="form-control" type="number" id="months_to_stay" name="months_to_stay" min="0" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tenant_agreement" required>
                        <label class="form-check-label" for="tenant_agreement">
                            I acknowledge that I have read and agree to the Terms and Conditions.
                        </label>
                    </div>
                    <div id="response"></div> <!-- Response container -->
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

<script>
$(document).ready(function() {
    // Validate due date input
    $('#due_date').on('input', function() {
        var value = $(this).val();
        if (value < 1 || value > 28) {
            $(this).val(''); // Clear input if not within 1-28 range
        }
    });

    // Prevent input of negative numbers for months to stay
    $('#months_to_stay').on('input', function() {
        var value = $(this).val();
        if (value < 0) {
            $(this).val(''); // Clear input if negative
        }
    });

    // Fetch available beds based on selected room
    $('#room_id').change(function() {
        var room_id = $(this).val();
        if (room_id != '') {
            $.ajax({
                url: 'function/getAvailableBeds.php', // PHP script to fetch available beds based on room
                type: 'post',
                data: { room_id: room_id },
                success: function(response) {
                    $('#bed_id').html(response); // Update the bed options in the select dropdown
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error); // Log error message
                }
            });
        } else {
            $('#bed_id').html('<option value="">Select Room First</option>'); // Display default option
        }
    });
});
</script>
<!-- Your modal HTML code -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-md">
        <form method="post" action="function/addBedAssignment.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Bed Assignment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tenant_id">Tenant Name</label>
                        <select class="form-control" id="tenant_id" name="tenant_id" required>
                            <!-- Populate the select options with tenant data -->
                            <?php
                                require_once('../includes/dbcon.php');
                                $sql = "SELECT * FROM tbltenant";
                                $result = $conn->query($sql);
                                echo "<option value=''>Select Tenant</option>"; // Add default option
                                while ($tenant = $result->fetch_assoc()) {
                                    echo "<option value='" . $tenant['tenant_id'] . "'>" . $tenant['complete_name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room_id">Room Name</label>
                        <select class="form-control" id="room_id" name="room_id" required>
                            <!-- Populate the select options with room data -->
                            <?php
                                $sql = "SELECT * FROM tblroom";
                                $result = $conn->query($sql);
                                echo "<option value=''>Select Room</option>"; // Add default option
                                while ($room = $result->fetch_assoc()) {
                                    echo "<option value='" . $room['room_id'] . "'>" . $room['room_name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bed_id">Bed Number</label>
                        <select class="form-control" id="bed_id" name="bed_id" required>
                            <!-- Populate the select options with bed data where status is available -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date (enter 1-28)</label>
                        <input class="form-control" type="number" id="due_date" name="due_date" min="1" max="28" required>
                    </div>
                    <div class="form-group">
                        <label for="months_to_stay">Months to Stay</label>
                        <input class="form-control" type="number" id="months_to_stay" name="months_to_stay" min="0" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tenant_agreement" required>
                        <label class="form-check-label" for="tenant_agreement">
                            I acknowledge that I have read and agree to the Terms and Conditions.
                        </label>
                    </div>
                    <div id="response"></div> <!-- Response container -->
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

<script>
$(document).ready(function() {
    // Validate due date input
    $('#due_date').on('input', function() {
        var value = $(this).val();
        if (value < 1 || value > 28) {
            $(this).val(''); // Clear input if not within 1-28 range
        }
    });

    // Prevent input of negative numbers for months to stay
    $('#months_to_stay').on('input', function() {
        var value = $(this).val();
        if (value < 0) {
            $(this).val(''); // Clear input if negative
        }
    });

    // Fetch available beds based on selected room
    $('#room_id').change(function() {
        var room_id = $(this).val();
        if (room_id != '') {
            $.ajax({
                url: 'function/getAvailableBeds.php', // PHP script to fetch available beds based on room
                type: 'post',
                data: { room_id: room_id },
                success: function(response) {
                    $('#bed_id').html(response); // Update the bed options in the select dropdown
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error); // Log error message
                }
            });
        } else {
            $('#bed_id').html('<option value="">Select Room First</option>'); // Display default option
        }
    });
});
</script>
