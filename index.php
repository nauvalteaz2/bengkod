<?php include('db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px 0;
            background-color: #f8f9fa;
        }

        .form-container {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
            margin-bottom: 20px;
        }

        .table-container {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="my-4">To-Do List</h2>

        <!-- Form Tambah Tugas -->
        <div class="form-container">
            <form action="add_task.php" method="POST">
                <div class="form-group">
                    <label for="task_name">Nama Tugas</label>
                    <input type="text" name="task_name" id="task_name" class="form-control" placeholder="Nama Tugas" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Tugas</button>
            </form>
        </div>

        <!-- Tabel Tugas -->
        <div class="table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Tugas</th>
                        <th>Tanggal Awal</th>
                        <th>Tanggal Akhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tasks ORDER BY id DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Format the dates
                            $tanggal_awal = date('d-m-Y', strtotime($row['tanggal_awal']));
                            $tanggal_akhir = date('d-m-Y', strtotime($row['tanggal_akhir']));

                            // Set status class
                            $statusClass = $row['status'] === 'Belum' ? 'badge badge-warning' : 'badge badge-success';

                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['task_name']}</td>
                                <td>{$tanggal_awal}</td>
                                <td>{$tanggal_akhir}</td>
                                <td><span class='{$statusClass}'>{$row['status']}</span></td>
                                <td>
                                    <a href='edit_task.php?id={$row['id']}' class='btn btn-sm btn-info'>Ubah</a>
                                    <a href='delete_task.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus tugas ini?\")'>Hapus</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Tidak ada tugas</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript untuk Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>