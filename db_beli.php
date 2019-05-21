<?php
  session_start();
  $koneksi = mysqli_connect("localhost","root","","onlineshop");
  if (isset($_GET["kode_barang"])) {
    $kode_barang = $_GET["kode_barang"];
    $sql = "select * from barang where kode_barang='$kode_barang'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);

    if (!in_array($hasil,$_SESSION["session_beli"])) {
      array_push($_SESSION["session_beli"],$hasil);
    }
    header("location:template_pembeli.php?page=list_barang");
  }


  if (isset($_GET["checkout"])) {
    $id_transaksi = rand(1,1000000).date("dmY");
    $id_pembeli = $_SESSION["session_pembeli"]["id_pembeli"];
    $tanggal = date("Y-m-d");
    $sql = "insert into transaksi values ('$id_transaksi','$id_pembeli','$tanggal')";
    if (mysqli_query($koneksi,$sql)) {
      foreach ($_SESSION["session_beli"] as $hasil) {
        $kode_barang = $hasil["kode_barang"];
        $jumlah = $_POST['jumlah'.$hasil["kode_barang"]];
        $harga_beli = $hasil["harga"];
        $sql = "insert into detail_transaksi values('$id_transaksi','$kode_barang','$jumlah','$harga_beli')";
        mysqli_query($koneksi,$sql);
      }
      $_SESSION["session_beli"] = array();
      header("location:template_pembeli.php?page=nota&id_transaksi=$id_transaksi");

    }
  }
 ?>
