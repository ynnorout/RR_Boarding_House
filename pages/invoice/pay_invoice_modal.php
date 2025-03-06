<!-- Pay invoice modal -->
<div class="modal fade" id="pay_<?php echo $row['invoice_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="payInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form method="post" action="function/payInvoice.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pay Invoice</h4>
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
                        <label for="complete_name">Tenant Name</label>
                        <input class="form-control" type="text" id="complete_name" name="complete_name" value="<?php echo $row['complete_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input class="form-control" type="text" id="due_date" name="due_date" value="<?php echo $row['due_date_iterate']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_due">Total Due</label>
                        <input class="form-control" type="number" id="total_due" name="total_due" value="<?php echo $row['total_due']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="payment">Payment Amount</label>
                        <input class="form-control" type="number" id="payment" name="payment" value="<?php echo $row['total_due']; ?>" min="<?php echo $row['total_due']; ?>" max="<?php echo $row['total_due']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" id="pay_button" name="pay" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Pay</button>
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
    $("#payment").on("keyup", function () {
        // Replace any non-numeric characters with empty string
        this.value = this.value.replace(/[^0-9]/g, '');

    });
});
</script>