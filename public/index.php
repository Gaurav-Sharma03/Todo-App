<?php
require_once "../config/database.php";
require_once "../models/Task.php";

$db = (new Database())->connect();
$task = new Task($db);
$tasks = $task->all();
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do App</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container">
    <h1><i class="fa-solid fa-list-check"></i> To-Do List</h1>

    <a href="add_task.php" class="btn add">
        <i class="fa fa-plus"></i> Add Task
    </a>

    <table>
        <tr>
            <th>Task</th>
            <th>Category</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $tasks->fetch(PDO::FETCH_ASSOC)): ?>
        <tr class="<?= $row['status'] ?>">
            <td data-label="Task"><?= htmlspecialchars($row['title']) ?></td>
<td data-label="Category"><?= $row['category'] ?></td>
<td data-label="Deadline"><?= $row['deadline'] ?></td>
<td data-label="Status">
    <span class="badge <?= $row['status'] ?>">
        <?= ucfirst($row['status']) ?>
    </span>
</td>
<td data-label="Actions">

                <a href="toggle_status.php?id=<?= $row['id'] ?>" class="icon done">
                    <i class="fa fa-check"></i>
                </a>
                <a href="edit_task.php?id=<?= $row['id'] ?>" class="icon edit">
                    <i class="fa fa-pen"></i>
                </a>
                <a href="delete_task.php?id=<?= $row['id'] ?>" class="icon delete"
                   onclick="return confirm('Delete task?')">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
