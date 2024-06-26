<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Biaya Obat</title>
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
        <h1>Total Biaya Obat pada Resep</h1>

        <div class="row">
            <div class="col-md-6">
                <form method="GET" action="">
                    <div class="form-group">
                        <label for="resep_id">Masukkan ID Resep:</label>
                        <input type="text" class="form-control" id="resep_id" name="resep_id" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Hitung Total Biaya Obat</button>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <?php
            if (isset($_GET['resep_id'])) {
                $resep_id = $_GET['resep_id'];

                include 'db_connect.php';

                // Panggil fungsi totalPrescriptionDrugCost dari database
                $sql = "SELECT totalPrescriptionDrugCost($resep_id) AS total_biaya";
                $result = $conn->query($sql);

                if ($result && $row = $result->fetch_assoc()) {
                    echo "<h4>Total Biaya Obat: Rp " . number_format($row['total_biaya'], 2) . "</h4>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Gagal mengambil data. Pastikan ID resep benar.</div>";
                }

                $conn->close();
            }
            ?>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dokter</th>
                    <th>Pasien</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connect.php';

                $sql = "SELECT * FROM resep";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["resep_ID"] . "</td>
                                <td>" . $row["dokter_ID"] . "</td>
                                <td>" . $row["pasien_ID"] . "</td>
                                <td>
                                    <a href='resep_edit.php?id=" . $row["resep_ID"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='resep_delete.php?id=" . $row["resep_ID"] . "' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>0 results</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
