<!-- Comment List -->
<div id="comment-list" class="card my-3 p-3">
  <h4 class="card-title"><?= "Comments (" . count($comments) . ")" ?></h4>
</div>

<!-- Script to load comments -->
<script type="text/javascript">
$( document ).ready(function () {
  fetch("http://localhost/codeigniter/comment/get_comments")
  .then(
    (response) => { return response.text() }
  ).then(
    (text) => { loadComments(JSON.parse(text)) }
  )
})

/**
 * Load the given data into the designated DOM
 */
function loadComments(data) {
  // iterate each comment
  data.comments.forEach(comment => {
    let dateCreated = new Date(comment.date_created)
    let dateModified = new Date(comment.date_modified)

    // string for displaying creation date
    let option = { year: "numeric", month: "short", day: "2-digit" }
    let createdTxt = `${dateCreated.toLocaleDateString("id", option)}`
    
    // string for displaying modification date
    let editedTxt = "";
    if (dateCreated.getTime() < dateModified.getTime()) {
      // compare modification date to today's and yesterday's date
      let today = new Date()
      today.setHours(0, 0, 0, 0)

      let yesterday = new Date()
      yesterday.setDate(yesterday.getDate() - 1)
      yesterday.setHours(0, 0, 0, 0)
      
      let editDay = dateModified.setHours(0, 0, 0, 0)

      switch (editDay.valueOf()) {
        case (today.valueOf()):
          editedTxt = " (edited today)"
          break;
        case (yesterday.valueOf()):
          editedTxt = " (edited yesterday)"
          break;
        default:
          editedTxt = ` (edited ${dateModified.toLocaleDateString("id", option)})`
      }
    }
    
    // Display edit and delete button if curently logged in as admin
    <?php if ($this->session->has_userdata("logged_in")) : ?>
    let buttonsTxt = `<?=require_once("application/views/templates/admin_buttons.php");?>`
    buttonsTxt = buttonsTxt.substring(0, buttonsTxt.length-1)
    <?php else : ?>
    let buttonsTxt = ""
    <?php endif; ?>


    htmlFormat = `
    <div class="card my-1 px-3 py-1">
      <div class="row">
        <div class="card-body">
          <h5 class="card-title">${comment.name}</h5>
          <h6 class="card-subtitle mb-2 text-muted">${createdTxt}${editedTxt}</h6>
          <p class="card-text">${comment.text}</p>
          ${buttonsTxt}
        </div>
      </div>
    </div>
  `
    $("#comment-list").append(htmlFormat)
  });
}
</script>

<?php if ($this->session->has_userdata("logged_in")) : ?>
<!-- Scripts to load comment info into modal -->
<script type="text/javascript">
  /**
   * Load comment id and info into edit modal
   */
  const editModal = document.getElementById('editModal')
  editModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    
    // Extract commentId from data-bs-* attributes
    const commentId = button.getAttribute('data-bs-id')
    const modalCommentId = editModal.querySelector('.modal-body #edit-comment-id')
    modalCommentId.value = commentId
    
    fetch(`http://localhost/codeigniter/comment/get_comment?id=${commentId}`)
    .then(
      (response) => { return response.text() }
    ).then(
      (text) => { loadComment(JSON.parse(text)) }
    )
  })
      
  /**
   * Load comment info into edit modal
   */
  function loadComment(data) {
    const editModal = document.getElementById('editModal')
    const modalName = editModal.querySelector('.modal-body #new-name')
    const modalText = editModal.querySelector('.modal-body #new-text')
    modalName.value = data.comment.name
    modalText.textContent = data.comment.text
  }

  /**
   * Load comment id into delete modal
   */
  const deleteModal = document.getElementById('deleteModal')
  deleteModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    const id = button.getAttribute('data-bs-id')
    const commentId = button.getAttribute('data-bs-id')
    const modalCommentId = deleteModal.querySelector('.modal-body #delete-comment-id')
    modalCommentId.value = commentId
  })
</script>
<?php endif; ?>