<?php
require_once "../config/database.php";
require_once "../models/Task.php";
require_once "../models/Category.php";

$db = (new Database())->connect();
$task = new Task($db);
$cat = new Category($db);

if ($_POST) {
    $task->create($_POST['title'], $_POST['description'], $_POST['category'], $_POST['deadline']);
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
<h2>Add Task</h2>

<form method="post">
<input type="text" name="title" placeholder="Task title" required>
<textarea name="description" placeholder="Description"></textarea>

<select name="category">
<?php foreach ($cat->all() as $c): ?>
<option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
<?php endforeach; ?>
</select>

<input type="date" name="deadline" required>
<button class="btn add">Save Task</button>
</form>
</div>
</body>
</html>
