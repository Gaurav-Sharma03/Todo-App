<?php
require_once "../config/database.php";
require_once "../models/Task.php";
require_once "../models/Category.php";

$db = (new Database())->connect();
$task = new Task($db);
$cat = new Category($db);

$data = $task->find($_GET['id']);

if ($_POST) {
    $task->update($_GET['id'], $_POST['title'], $_POST['description'], $_POST['category'], $_POST['deadline']);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<h2>Edit Task</h2>

<form method="post">
<input type="text" name="title" value="<?= $data['title'] ?>" required>
<textarea name="description"><?= $data['description'] ?></textarea>

<select name="category">
<?php foreach ($cat->all() as $c): ?>
<option value="<?= $c['id'] ?>" <?= $c['id']==$data['category_id']?'selected':'' ?>>
<?= $c['name'] ?>
</option>
<?php endforeach; ?>
</select>

<input type="date" name="deadline" value="<?= $data['deadline'] ?>">
<button class="btn edit">Update</button>
</form>
</div>
</body>
</html>
