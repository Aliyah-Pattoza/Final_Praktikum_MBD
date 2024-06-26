<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rekam Medis</title>
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
                <li class="nav-item active"><a class="nav-link" href="rekam_medis.php">Data Rekam Medis</a></li>
                <li class="nav-item"><a class="nav-link" href="resep.php">Data Resep</a></li>
                <li class="nav-item"><a class="nav-link" href="resep_detail.php">Data Resep Detail</a></li>
                <li class="nav-item"><a class="nav-link" href="transaksi.php">Data Transaksi</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Data Rekam Medis</h1>
        <form action="rekam_medis.php" method="post" class="mb-4">
            <div class="form-group">
                <label for="dokter_id">Pilih Dokter:</label>
                <select class="form-control" id="dokter_id" name="dokter_id" required>
                    <?php
                    include 'db_connect.php';

                    // Query untuk mendapatkan daftar dokter
                    $sql = "SELECT dokter_ID, nama FROM dokter";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["dokter_ID"] . "'>" . $row["nama"] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Tidak ada dokter tersedia</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="pasien_id">Pilih Pasien:</label>
                <select class="form-control" id="pasien_id" name="pasien_id" required>
                    <?php
                    // Query untuk mendapatkan daftar pasien
                    $sql = "SELECT pasien_ID, nama FROM pasien";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["pasien_ID"] . "'>" . $row["nama"] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Tidak ada pasien tersedia</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tgl_rm">Tanggal Rekam Medis:</label>
                <input type="date" class="form-control" id="tgl_rm" name="tgl_rm" required>
            </div>
            <div class="form-group">
                <label for="tinggi_badan">Tinggi Badan (cm):</label>
                <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" required>
            </div>
            <div class="form-group">
                <label for="berat_badan">Berat Badan (kg):</label>
                <input type="number" class="form-control" id="berat_badan" name="berat_badan" required>
            </div>
            <div class="form-group">
                <label for="tekanan_darah">Tekanan Darah:</label>
                <input type="text" class="form-control" id="tekanan_darah" name="tekanan_darah" required>
            </div>
            <div class="form-group">
                <label for="keluhan">Keluhan:</label>
                <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="tindakan">Tindakan:</label>
                <textarea class="form-control" id="tindakan" name="tindakan" rows="3" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Tambah Rekam Medis</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $dokter_id = $_POST['dokter_id'];
            $pasien_id = $_POST['pasien_id'];
            $tgl_rm = $_POST['tgl_rm'];
            $tinggi_badan = $_POST['tinggi_badan'];
            $berat_badan = $_POST['berat_badan'];
            $tekanan_darah = $_POST['tekanan_darah'];
            $keluhan = $_POST['keluhan'];
            $tindakan = $_POST['tindakan'];

            $sql = "CALL tambah_rekam_medis($dokter_id, $pasien_id, '$tgl_rm', $tinggi_badan, $berat_badan, '$tekanan_darah', '$keluhan', '$tindakan')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Rekam medis berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        // Menampilkan data rekam medis
        $sql = "SELECT * FROM rekam_medis";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='mt-4'>
                    <h2>Data Rekam Medis</h2>
                    <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Dokter ID</th>
                                <th>Pasien ID</th>
                                <th>Tanggal Rekam Medis</th>
                                <th>Tinggi Badan (cm)</th>
                                <th>Berat Badan (kg)</th>
                                <th>Tekanan Darah</th>
                                <th>Keluhan</th>
                                <th>Tindakan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["RM_ID"] . "</td>
                        <td>" . $row["dokter_ID"] . "</td>
                        <td>" . $row["pasien_ID"] . "</td>
                        <td>" . $row["tgl_rm"] . "</td>
                        <td>" . $row["tinggi_badan"] . "</td>
                        <td>" . $row["berat_badan"] . "</td>
                        <td>" . $row["tekanan_darah"] . "</td>
                        <td>" . $row["keluhan"] . "</td>
                        <td>" . $row["tindakan"] . "</td>
                        <td>
                            <a href='RM_edit.php?id=" . $row["RM_ID"] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='RM_delete.php?id=" . $row["RM_ID"] . "' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</tbody></table></div>";
        } else {
            echo "<div class='alert alert-info'>Tidak ada data rekam medis</div>";
        }

        $conn->close();
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
