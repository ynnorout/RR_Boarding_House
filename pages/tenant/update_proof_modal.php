<!-- Upload and Update Proof of Identity Modal -->
<div class="modal fade" id="edit_proof_<?php echo $row['tenant_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload and Update Proof of Identity for <?php echo $row['complete_name']; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="function/uploadProofPicture.php" enctype="multipart/form-data">
                    <input type="hidden" name="tenant_id" value="<?php echo $row['tenant_id']; ?>">
                    <div class="form-group">
                        <label for="proof_picture_<?php echo $row['tenant_id']; ?>">Select Proof of Identity</label>
                        <input type="file" class="form-control-file" id="proof_picture_<?php echo $row['tenant_id']; ?>" name="proof_picture" accept="image/*" required>
                        <img id="preview_proof_<?php echo $row['tenant_id']; ?>" src="" alt="Preview" style="max-width: 100%; margin-top: 10px; display: none;">
                    </div>
                    <button type="submit" name="upload_proof_picture" class="btn btn-primary">Upload Proof of Identity</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input[type="file"]').change(function(e) {
            var id = $(this).attr('id');
            var previewId = id.replace('proof_picture_', 'preview_proof_');
            previewImage(e.target, previewId);
        });

        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + previewId).attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
