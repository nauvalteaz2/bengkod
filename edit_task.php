<?php
include('db_connect.php');

$id = '';
$task_name = '';
$tanggal_awal = '';
$tanggal_akhir = '';
$status = '';

// Mengambil data tugas berdasarkan ID
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM tasks WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $task_name = $row['task_name'];
        $tanggal_awal = $row['tanggal_awal'];
        $tanggal_akhir = $row['tanggal_akhir'];
        $status = $row['status'];
    }
}

// Menangani pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['id']);
    $task_name = $conn->real_escape_string($_POST['task_name']);
    $tanggal_awal = $conn->real_escape_string($_POST['tanggal_awal']);
    $tanggal_akhir = $conn->real_escape_string($_POST['tanggal_akhir']);

    // Set status menjadi "Selesai" secara otomatis
    $status = "Selesai";

    // Melakukan update data tugas
    $sql = "UPDATE tasks SET 
            task_name='$task_name', 
            tanggal_awal='$tanggal_awal', 
            tanggal_akhir='$tanggal_akhir', 
            status='$status' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Task - To-Do List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }

        .form-container {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
            margin: 20px auto;
            max-width: 600px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Edit Tugas</h2>
            <form action="edit_task.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="form-group">
                    <label for="task_name">Nama Tugas</label>
                    <input type="text" name="task_name" id="task_name" class="form-control"
                        value="<?php echo $task_name; ?>" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_awal">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                        value="<?php echo $tanggal_awal; ?>" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                        value="<?php echo $tanggal_akhir; ?>" required>
                </div>

                <!-- Hapus dropdown untuk status -->
                <input type="hidden" name="status" value="Selesai">

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-secondary btn-block">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>