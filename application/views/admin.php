<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <?php require_once("application/views/templates/scripts.php"); ?>
</head>
<body>
  <?php require_once("application/views/templates/header.php"); ?>

  <!-- Edit Modal -->
  <form action="<?= base_url('admin/edit_comment') ?>" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="edit-comment-id" name="comment-id">
            <div class="mb-3">
              <label for="new-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" id="new-name" name="new-name">
            </div>
            <div class="mb-3">
              <label for="new-text" class="col-form-label">Comment:</label>
              <textarea class="form-control" id="new-text" name="new-text"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Delete Modal -->
  <form action="<?= base_url('admin/delete_comment') ?>" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="delete-comment-id" name="comment-id">
            Are you sure want to delete this comment?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  
  <div class="container" style="width: 60%;">
    <?php require_once("application/views/templates/comments.php"); ?>
  </div>

</body>
</html>