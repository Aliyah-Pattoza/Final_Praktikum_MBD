<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-red">
        <a class="navbar-brand" href="#">Klinik</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
       <h1 class="text-center animated-heading">Selamat Datang di Klinik Astar</h1>
       <h4 class="text-center animated-heading">Our Members</h4>
       <div class="member-container d-flex mt-2">
           <div class="member-item d-flex align-items-center">
               <img src="foto/Naya.jpg" alt="Member 1" class="rounded-circle member-photo">
               <div class="ml-3">
                   <h5>Andi Aliyah Nur Inayah Pattoza</h5>
                   <p>5025221196</p>
               </div>
           </div>
       </div>
       <div class="member-container d-flex mt-2">
           <div class="member-item d-flex align-items-center">
               <img src="foto/Alin.jpg" alt="Member 2" class="rounded-circle member-photo">
               <div class="ml-3">
                   <h5>Aria Nalini Farzana</h5>
                   <p>5025221016</p>
               </div>
           </div>
       </div>
       <div class="member-container d-flex mt-2">
           <div class="member-item d-flex align-items-center">
               <img src="foto/Ayak.jpg" alt="Member 3" class="rounded-circle member-photo">
               <div class="ml-3">
                   <h5>Bianca Shaummaya Aryan</h5>
                   <p>5025221184</p>
               </div>
           </div>
       </div>
   </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
