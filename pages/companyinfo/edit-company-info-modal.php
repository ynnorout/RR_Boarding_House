<!-- edit-company-info-modal.php -->

<div class="modal fade" id="edit-company_info" tabindex="-1" role="dialog" aria-labelledby="edit-company_info-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-company_info-label">Edit Company Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="update-company-info.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="company_id" id="company_id">
          <!-- Display company logo and allow the user to upload a new logo -->
          <div class="form-group">
            <label for="company_logo">Company Logo:</label>
            <input type="file" class="form-control-file" id="company_logo" name="company_logo">
          </div>
          <div class="form-group">
            <label for="company_name">Company Name:</label>
            <input type="text" class="form-control" id="company_name" name="company_name">
          </div>
          <div class="form-group">
            <label for="company_address">Address:</label>
            <input type="text" class="form-control" id="company_address" name="company_address">
          </div>
          <div class="form-group">
            <label for="company_contact">Contact:</label>
            <input type="text" class="form-control" id="company_contact" name="company_contact">
          </div>
          <div class="form-group">
            <label for="company_website">Website:</label>
            <input type="text" class="form-control" id="company_website" name="company_website">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Function to populate the edit modal fields with current company information
  function populateEditModal(company_id, company_name, company_address, company_contact, company_website) {
    document.getElementById('company_id').value = company_id;
    document.getElementById('company_name').value = company_name;
    document.getElementById('company_address').value = company_address;
    document.getElementById('company_contact').value = company_contact;
    document.getElementById('company_website').value = company_website;
  }
</script>
