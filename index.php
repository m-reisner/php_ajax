<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>CRUD mit PHP, SQLite, jQuery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="container mt-4">
  <h2>Benutzerverwaltung</h2>

  <!-- Formular zum Hinzufügen -->
  <form id="userForm" class="row g-3">
    <div class="col-md-4">
      <input type="text" name="name" class="form-control" placeholder="Name" required>
    </div>
    <div class="col-md-4">
      <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
    </div>
    <div class="col-md-4">
      <button type="submit" class="btn btn-primary">Hinzufügen</button>
    </div>
  </form>

  <hr>
  <h4>Benutzerliste</h4>
  <div id="userList"></div>

  <!-- Modal zum Bearbeiten -->
  <div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
      <form id="editForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Benutzer bearbeiten</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">
          <input type="text" name="name" id="edit-name" class="form-control mb-2" required>
          <input type="email" name="email" id="edit-email" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Speichern</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal zum Löschen -->
  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
      <form id="deleteForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Benutzer löschen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Möchtest du diesen Benutzer wirklich löschen?</p>
          <input type="hidden" name="id" id="delete-id">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Löschen</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
  
<?php if (!extension_loaded('sqlite3')) { ?>
<div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Schwerer Fehler</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="errorModalBody">
        <p>PHP Module 'sqlite3' is not loaded.<br />Please check your php.ini(<?php echo php_ini_loaded_file(); ?>).</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>
<script>
  const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
  errorModal.show();
</script>
<?php } ?>
</body>
</html>
