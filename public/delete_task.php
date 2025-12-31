<?php
require_once "../config/database.php";
require_once "../models/Task.php";

$db = (new Database())->connect();
$task = new Task($db);
$task->delete($_GET['id']);
header("Location: index.php");
