<!-- Your modal HTML code -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-md">
        <form method="post" action="function/addBed.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Bed</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="room_id">Room</label>
                        <select class="form-control" id="room_id" name="room_id" required>
                            <!-- Populate the select options with room data -->
                            <?php
                            require_once('../includes/dbcon.php');
                            $sql = "SELECT * FROM tblroom";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['room_id'] . "'>" . $row['room_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bed_number">Bed Number</label>
                        <input class="form-control" type="text" id="bed_number" name="bed_number" required>
                        <div id="response"></div> <!-- Response container for duplicate check -->
                    </div>
                    <div class="form-group">
                        <label for="monthly_rent">Monthly Rent</label>
                        <input class="form-control" type="number" id="monthly_rent" name="monthly_rent" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                        </select>
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

<!-- Include jQuery library -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- Integrate the provided JavaScript code -->
<script>
    // Define a function to check for duplicate bed number
    function checkDuplicate() {
        var bed_number = $('#bed_number').val().trim();
        if (bed_number != '') {
            $.ajax({
                url: 'function/checkDuplicate.php', // PHP script to check for duplicate bed number
                type: 'post',
                data: { bed_number: bed_number },
                success: function (response) {
                    console.log('Success:', response); // Log success message
                    $('#response').html(response); // Display response message
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error); // Log error message
                }
            });
        } else {
            $("#response").html(""); // Clear response container
        }
    }

    $(document).ready(function () {
        // Call the checkDuplicate function each time a key is pressed in the #bed_number input field
        $("#bed_number").keyup(checkDuplicate);

        // Allow only numeric input for monthly rent
        $("#monthly_rent").on("input", function () {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });
</script>

