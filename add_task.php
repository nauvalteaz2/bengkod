<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = $conn->real_escape_string($_POST['task_name']);
    $tanggal_awal = $conn->real_escape_string($_POST['tanggal_awal']);
    $tanggal_akhir = $conn->real_escape_string($_POST['tanggal_akhir']);

    // Set default status as 'Belum'
    $status = "Belum";

    $sql = "INSERT INTO tasks (task_name, tanggal_awal, tanggal_akhir, status) 
            VALUES ('$task_name', '$tanggal_awal', '$tanggal_akhir', '$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
