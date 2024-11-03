<?php
include('db_connect.php');

$id = $_GET['id'];
$task = $conn->query("SELECT status FROM tasks WHERE id = $id")->fetch_assoc();
$new_status = $task['status'] === 'Belum' ? 'Sudah' : 'Belum';

$conn->query("UPDATE tasks SET status = '$new_status' WHERE id = $id");

header("Location: index.php");
