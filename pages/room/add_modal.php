<!-- Your modal HTML code -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-md">
        <form method="post" action="function/addRoom.php" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Room</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="room_name">Room Name</label>
                        <input class="form-control" type="text" id="room_name" name="room_name" required>
                        <div id="response"></div> <!-- Response container -->
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input class="form-control-file" type="file" id="image" name="image" required accept="image/*">
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
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Integrate the provided JavaScript code -->
<script>
    // Define a function to check for duplicate room names
    function checkDuplicate() {
        var roomName = $('#room_name').val().trim();
        if (roomName != '') {
            $.ajax({
                url: 'function/checkDuplicate.php', // PHP script to check for duplicate room names
                type: 'post',
                data: { roomName: roomName },
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
        // Call the checkDuplicate function each time a key is pressed in the #room_name input field
        $("#room_name").keyup(checkDuplicate);
    });
</script>
