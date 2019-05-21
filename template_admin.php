<?php session_start(); ?>
<?php if (isset($_SESSION["session_admin"])): ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE'S SHOP OWNER</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-primary navbar-dark sticky-top">
      <!--
        navbar-expand-md -> menu akan dihidden ketika tampilan device berukuran medium
        bg-danger -> navbar akan mempunyai background warna merah
        navbar-dark -> tulisan menu pada navbar akan lebih gelap
        fixed-top -> navbar kan berposisi selalu di atas -->
        <a href="#" class="text-white">
          <h3>ONLINE'S SHOP OWNER</h3>
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
          <span class="navbar navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
          <ul class="navbar-nav">
            <li class="nav-item"><a href="template_admin.php?page=admin" class="nav-link">Admin</a></li>
            <li class="nav-item"><a href="template_admin.php?page=pembeli" class="nav-link">Pembeli</a></li>
            <li class="nav-item"><a href="template_admin.php?page=barang" class="nav-link">Barang</a></li>
            <li class="nav-item"><a href="template_admin.php?page=daftar_pembelian" class="nav-link">Daftar Pembeli</a></li>
            <li class="nav-item"><a href="proses_login_admin.php?logout=true" class="nav-link">Logout</a></li>
          </ul>
        </div>
        <h5 class="text-warning">Hello, <?php echo $_SESSION["session_admin"]["nama_admin"]; ?> ;)</h5>
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
  <a href="login_admin.php">Loginnya tuh disini</a>
<?php endif; ?>
