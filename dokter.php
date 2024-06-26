<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dokter</title>
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
        <h1>Data Dokter</h1>
        <form action="dokter.php" method="post" class="mb-4">
            <div class="form-group">
                <label for="spesialis_id">Jenis Spesialis:</label>
                <select class="form-control" id="spesialis_id" name="spesialis_id" required>
                    <?php
                    include 'db_connect.php';

                    // Query untuk mendapatkan daftar pegawai
                    $sql = "SELECT spesialis_id, jenis FROM spesialis";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["spesialis_id"] . "'>" . $row["jenis"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="form-group">
                <label for="biaya">Biaya:</label>
                <input type="text" class="form-control" id="biaya" name="biaya" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </form>

        <?php
        include 'db_connect.php';

        if (isset($_POST['submit'])) {
            $spesialis_id = $_POST['spesialis_id'];
            $nama = $_POST['nama'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $telepon = $_POST['telepon'];
            $biaya = $_POST['biaya'];

            $sql = "CALL tambah_dokter('$spesialis_id', '$nama', '$jenis_kelamin', '$alamat', '$email', '$telepon', '$biaya')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Data dokter berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        // Menampilkan data dokter
        $sql = "SELECT * FROM dokter";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'><thead><tr><th>ID</th><th>Spesialis ID</th><th>Nama</th><th>Jenis Kelamin</th><th>Alamat</th><th>Email</th><th>Telepon</th><th>Biaya</th><th>Action</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["dokter_ID"]. "</td><td>" . $row["spesialis_ID"]. "</td><td>" . $row["nama"]. "</td><td>" . $row["jenis_kelamin"]. "</td><td>" . $row["alamat"]. "</td><td>" . $row["email"]. "</td><td>" . $row["telepon"]. "</td><td>" . $row["biaya"]. "</td>
                <td><a href='dokter_edit.php?id=" . $row["dokter_ID"]. "' class='btn btn-warning btn-sm'>Edit</a> <a href='dokter_delete.php?id=" . $row["dokter_ID"]. "' class='btn btn-danger btn-sm'>Delete</a></td></tr>";
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
