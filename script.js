$(document).ready(function () {
  const editModal = new bootstrap.Modal(document.getElementById('editModal'));
  const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

  function loadUsers() {
    $.post('backend.php', { action: 'fetch' }, function (data) {
      $('#userList').html(data);
    });
  }

  loadUsers();

  $('#userForm').submit(function (e) {
    e.preventDefault();
    $.post('backend.php', $(this).serialize() + '&action=insert', function () {
      $('#userForm')[0].reset();
      loadUsers();
    });
  });

  $(document).on('click', '.editBtn', function () {
    $('#edit-id').val($(this).data('id'));
    $('#edit-name').val($(this).data('name'));
    $('#edit-email').val($(this).data('email'));
    editModal.show();
  });

  $('#editForm').submit(function (e) {
    e.preventDefault();
    $.post('backend.php', $(this).serialize() + '&action=update', function () {
      editModal.hide();
      loadUsers();
    });
  });

  $(document).on('click', '.deleteBtn', function () {
    $('#delete-id').val($(this).data('id'));
    deleteModal.show();
  });

  $('#deleteForm').submit(function (e) {
    e.preventDefault();
    $.post('backend.php', $(this).serialize() + '&action=delete', function () {
      deleteModal.hide();
      loadUsers();
    });
  });
});
