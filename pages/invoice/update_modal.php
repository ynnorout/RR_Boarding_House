<!-- Update modal -->
<div class="modal fade" id="update_<?php echo $row['invoice_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form method="post" action="function/updateInvoice.php" onsubmit="return validateForm()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Invoice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id']; ?>"> <!-- Include invoice_id -->
                    <div class="form-group">
                        <label for="invoice_number">Invoice Number</label>
                        <input class="form-control" type="text" id="invoice_number" name="invoice_number" value="<?php echo $row['invoice_number']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bed_rate">Bed Rate</label>
                        <input class="form-control" type="number" id="bed_rate" name="bed_rate" min="0" value="<?php echo $row['bed_rate']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="penalty">Penalty</label>
                        <input class="form-control" type="number" id="penalty" name="penalty" min="0" value="<?php echo $row['penalty_amount']; ?>" onkeyup="updateTotalDue()">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input class="form-control" type="number" id="discount" name="discount" min="0" value="<?php echo $row['discount_amount']; ?>" onkeyup="updateTotalDue()">
                    </div>
                    <div class="form-group">
                        <label for="total_due">Total Due</label>
                        <input class="form-control" type="number" id="total_due" name="total_due" min="0" value="<?php echo $row['total_due']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks"><?php echo $row['remarks']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" id="update_button" name="update" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Update</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="../../plugins/jquery/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // Allow only numeric input for penalty and discount
    $("#penalty, #discount").on("keyup", function () {
        // Replace any non-numeric characters with empty string
        this.value = this.value.replace(/[^0-9]/g, '');
        
    });


});
</script>
