<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
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
        <h1>Data Pasien</h1>
        <form action="pasien.php" method="post" class="mb-4">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
            </div>
            <div class="form-group">
                <label for="wali">Wali:</label>
                <input type="text" class="form-control" id="wali" name="wali" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </form>

        <?php
        include 'db_connect.php';

        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $tgl_lahir = $_POST['tgl_lahir'];
            $wali = $_POST['wali'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];

            $sql = "CALL tambah_pasien('$nama', '$tgl_lahir', '$wali', '$alamat', '$telepon')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Data pasien berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        // Menampilkan data pasien
        $sql = "SELECT * FROM pasien";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'><thead><tr><th>ID</th><th>Nama</th><th>Tanggal Lahir</th><th>Wali</th><th>Alamat</th><th>Telepon</th><th>Status</th><th>Action</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) {
                $status_sql = "SELECT CekStatusPasien(" . $row["pasien_ID"] . ") as status";
                $status_result = $conn->query($status_sql);
                $status = $status_result->fetch_assoc()['status'];

                echo "<tr><td>" . $row["pasien_ID"]. "</td><td>" . $row["nama"]. "</td><td>" . $row["tgl_lahir"]. "</td><td>" . $row["wali"]. "</td><td>" . $row["alamat"]. "</td><td>" . $row["telepon"]. "</td><td>" . $status. "</td>
                <td><a href='pasien_edit.php?id=" . $row["pasien_ID"]. "' class='btn btn-warning btn-sm'>Edit</a> <a href='pasien_delete.php?id=" . $row["pasien_ID"]. "' class='btn btn-danger btn-sm'>Delete</a></td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info'>0 results</div>";
        }

        $conn->close();
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
