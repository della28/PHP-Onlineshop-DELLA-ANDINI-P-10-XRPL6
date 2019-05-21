<?php session_start(); ?>
<?php if (isset($_SESSION["session_pembeli"])): ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE SHOP COOK TOOL</title>
    <!-- <style media="screen">
      .bggambar .img{
        width: 100%;
        height: 80px;
      }
    </style> -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </head>
  <body>
    <div class="bggambar">
      <h1 style="left:300px;position:absolute;margin-top:150px;color:white;">SELAMAT DATANG DI COOK TOOL'S SHOP</h1>
      <img src="dapur7.jpg" style="width:1370px;height:400px;margin-bottom:5px;margin-top:5px;" alt="">
    </div>
    <nav class="navbar navbar-expand-md bg-warning navbar-dark sticky-top">
      <!--
        navbar-expand-md -> menu akan dihidden ketika tampilan device berukuran medium
        bg-danger -> navbar akan mempunyai background warna merah
        navbar-dark -> tulisan menu pada navbar akan lebih gelap
        fixed-top -> navbar kan berposisi selalu di atas -->
        <a href="#" class="text-white">
          <h3>ONLINE SHOP COOK TOOL</h3>
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
          <span class="navbar navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
          <ul class="navbar-nav">
            <li class="nav-item"><a href="template_pembeli.php?page=list_barang" class="nav-link">List Barang</a></li>
            <li class="nav-item"><a href="template_pembeli.php?page=list_beli" class="nav-link">Keranjang Barang</a></li>
            <li class="nav-item"><a href="proses_login_pb.php?logout=true" class="nav-link">Logout</a></li>
          </ul>
        </div>
        <!-- <h5 class="text-white">Hello, <?php //echo $_SESSION["session_siswa"]["nama"]; ?></h5> -->
        <a href="template_pembeli.php?page=list_beli"><b class="text-white">Beli: <?php echo count($_SESSION["session_beli"]); ?></b></a>
    </nav>

    <div class="container my-2">
      <?php if (isset($_GET["page"])): ?>
        <?php if ((@include $_GET["page"].".php") === true): ?>
          <?php include $_GET["page"].".php"; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
<?php else: ?>
  <?php echo "Anda belum login!"; ?>
  <br>
  <a href="login_pembeli.php">Loginnya tuh disini</a>
<?php endif; ?>
