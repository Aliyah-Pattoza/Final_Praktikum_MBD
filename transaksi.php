<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
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
        <h1>Data Transaksi</h1>

        <!-- Form untuk menambahkan data transaksi baru -->
        <form action="transaksi.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="pegawai_id">Pilih Pegawai:</label>
                <select class="form-control" id="pegawai_id" name="pegawai_id" required>
                    <?php
                    include 'db_connect.php';

                    // Query untuk mendapatkan daftar pegawai
                    $sql = "SELECT pegawai_ID, nama FROM pegawai";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["pegawai_ID"] . "'>" . $row["nama"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="RD_ID">Pilih Resep Detail:</label>
                <select class="form-control" id="RD_ID" name="RD_ID">
                    <option value="">Tidak ada</option>
                    <?php
                    // Query untuk mendapatkan daftar resep detail
                    $sql = "SELECT RD_ID FROM resep_detail";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["RD_ID"] . "'>" . $row["RD_ID"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dokter_id">Pilih Dokter:</label>
                <select class="form-control" id="dokter_id" name="dokter_id" required>
                    <?php
                    // Query untuk mendapatkan daftar dokter
                    $sql = "SELECT dokter_ID, nama FROM dokter";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["dokter_ID"] . "'>" . $row["nama"] . "</option>";
                        }
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
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tgl_transaksi">Tanggal Transaksi:</label>
                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Tambah Transaksi</button>
        </form>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pegawai</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Tagihan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connect.php';

                if (isset($_POST['submit'])) {
                    $pegawai_id = $_POST['pegawai_id'];
                    $RD_ID = $_POST['RD_ID'] ? $_POST['RD_ID'] : 'NULL';
                    $dokter_id = $_POST['dokter_id'];
                    $pasien_id = $_POST['pasien_id'];
                    $tgl_transaksi = $_POST['tgl_transaksi'];

                    // Memanggil prosedur tambah_transaksi
                    $sql = "CALL tambah_transaksi($pegawai_id, $RD_ID, $dokter_id, $pasien_id, '$tgl_transaksi')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<div class='alert alert-success'>Data transaksi berhasil ditambahkan</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                    }
                }

                $sql = "SELECT transaksi_ID, pegawai_ID, pasien_ID, dokter_ID, tgl_transaksi, calculateTotalBill(transaksi_ID) AS total_tagihan FROM transaksi";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["transaksi_ID"] . "</td>
                                <td>" . $row["pegawai_ID"] . "</td>
                                <td>" . $row["pasien_ID"] . "</td>
                                <td>" . $row["dokter_ID"] . "</td>
                                <td>" . $row["tgl_transaksi"] . "</td>
                                <td>" . $row["total_tagihan"] . "</td>
                                <td>
                                    <a href='transaksi_edit.php?id=" . $row["transaksi_ID"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='transaksi_delete.php?id=" . $row["transaksi_ID"] . "' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada hasil</td></tr>";
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
