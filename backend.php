<?php
$db = new SQLite3('data.db');

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL
)");

$action = $_POST['action'] ?? '';

if ($action === 'insert') {
    $stmt = $db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->bindValue(':name', $_POST['name']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->execute();
}

if ($action === 'fetch') {
    $res = $db->query("SELECT * FROM users ORDER BY id DESC");
    echo '<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Aktion</th></tr></thead><tbody>';
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
              <button class='btn btn-sm btn-warning editBtn' data-id='{$row['id']}' data-name='{$row['name']}' data-email='{$row['email']}'>Bearbeiten</button>
              <button class='btn btn-sm btn-danger deleteBtn' data-id='{$row['id']}'>Löschen</button>
            </td>
          </tr>";
    }
    echo '</tbody></table>';
}

if ($action === 'update') {
    $stmt = $db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->bindValue(':name', $_POST['name']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
}

if ($action === 'delete') {
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
}
?>
