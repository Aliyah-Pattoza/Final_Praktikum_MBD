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
        <h1>Data Spesialis</h1>
        
        <?php
        include 'db_connect.php';

        // Menampilkan data spesialis
        $sql = "SELECT * FROM spesialis";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'><thead><tr><th>ID</th><th>Jenis</th><th>Deskripsi</th><th>Action</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["spesialis_ID"]. "</td><td>" . $row["jenis"]. "</td><td class='deksripsi'>" . $row["deksripsi"]. "</td>
                <td><a href='spesialis_edit.php?id=" . $row["spesialis_ID"]. "' class='btn btn-warning btn-sm'>Edit</a> <a href='spesialis_delete.php?id=" . $row["spesialis_ID"]. "' class='btn btn-danger btn-sm'>Delete</a></td></tr>";
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
