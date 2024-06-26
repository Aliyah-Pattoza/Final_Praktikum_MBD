<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Pasien</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Klinik</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="pegawai.php">Data Pegawai</a></li>
                <li class="nav-item"><a class="nav-link" href="pasien.php">Data Pasien</a></li>
                <li class="nav-item"><a class="nav-link" href="spesialis.php">Data Spesialis</a></li>
                <li class="nav-item"><a class="nav-link" href="dokter.php">Data Dokter</a></li>
                <li class="nav-item"><a class="nav-link" href="obat.php">Data Obat</a></li>
                <li class="nav-item"><a class="nav-link" href="rekam_medis.php">Data Rekam Medis</a></li>
                <li class="nav-item"><a class="nav-link" href="resep.php">Data Resep</a></li>
                <li class="nav-item"><a class="nav-link" href="resep_detail.php">Data Resep Detail</a></li>
                <li class="nav-item"><a class="nav-link" href="transaksi.php">Data Transaksi</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Update Data Pasien</h1>

        <?php
        include 'db_connect.php';

        // Ambil data pasien berdasarkan ID
        if (isset($_GET['id'])) {
            $pasien_id = $_GET['id'];

            // Ambil data pasien dari database
            $sql_select = "SELECT * FROM pasien WHERE pasien_ID = $pasien_id";
            $result = $conn->query($sql_select);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nama = $row['nama'];
                $tgl_lahir = $row['tgl_lahir'];
                $wali = $row['wali'];
                $alamat = $row['alamat'];
                $telepon = $row['telepon'];
            } else {
                echo "<div class='alert alert-danger'>Data pasien tidak ditemukan.</div>";
                exit();
            }
        } else {
            echo "<div class='alert alert-danger'>ID pasien tidak diberikan.</div>";
            exit();
        }

        // Proses update data pasien
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $tgl_lahir = $_POST['tgl_lahir'];
            $wali = $_POST['wali'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];

            // Panggil stored procedure untuk mengupdate pasien
            $sql_update = "CALL update_pasien($pasien_id, '$nama', '$tgl_lahir', '$wali', '$alamat', '$telepon')";

            if ($conn->query($sql_update) === TRUE) {
                echo "<div class='alert alert-success'>Data pasien berhasil diupdate</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql_update . "<br>" . $conn->error . "</div>";
            }
        }
        ?>

        <form action="pasien_edit.php?id=<?php echo $pasien_id; ?>" method="post" class="mb-4">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $tgl_lahir; ?>" required>
            </div>
            <div class="form-group">
                <label for="wali">Wali:</label>
                <input type="text" class="form-control" id="wali" name="wali" value="<?php echo $wali; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $telepon; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
            <a href="pasien.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
