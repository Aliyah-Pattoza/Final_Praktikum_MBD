<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Spesialis</title>
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
        <h1>Data Obat</h1>
        <form action="obat.php" method="post" class="mb-4">
            <div class="form-group">
                <label for="nama">Nama Obat:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="jenis">Jenis:</label>
                <input type="text" class="form-control" id="jenis" name="jenis" required>
            </div>
            <div class="form-group">
                <label for="merk">Merk:</label>
                <input type="email" class="form-control" id="merk" name="merk" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="text" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="text" class="form-control" id="harga" name="harga" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </form>

        <?php
        include 'db_connect.php';

        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $jenis = $_POST['jenis'];
            $merk = $_POST['merk'];
            $stok = $_POST['stok'];
            $harga = $_POST['harga'];

            $sql = "CALL tambah_obat('$nama', '$jenis', '$merk', '$stok', '$harga')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Data obat berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        // Menampilkan data dokter
        $sql = "SELECT * FROM obat";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'><thead><tr><th>ID</th><th>Nama</th><th>Jenis</th><th>Merk</th><th>Stok</th><th>Harga</th><th>Action</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["obat_ID"]. "</td><td>" . $row["nama"]. "</td><td>" . $row["jenis"]. "</td><td>" . $row["merk"]. "</td><td>" . $row["stok"]. "</td><td>" . $row["harga"]. "</td>
                <td><a href='obat_edit.php?id=" . $row["obat_ID"]. "' class='btn btn-warning btn-sm'>Edit</a> <a href='obat_delete.php?id=" . $row["obat_ID"]. "' class='btn btn-danger btn-sm'>Delete</a></td></tr>";
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
