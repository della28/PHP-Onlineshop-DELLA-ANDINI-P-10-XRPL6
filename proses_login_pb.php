<?php
  session_start();
  $username = $_POST["username"];
  $password = md5($_POST["password"]);

  // koneksi databse
  $koneksi = mysqli_connect("localhost","root","","onlineshop");
  $sql = "select * from pembeli where username='$username' and password='$password'";
  $result = mysqli_query($koneksi,$sql);
  $jumlah = mysqli_num_rows($result);

  if ($jumlah == 0) {
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => "Username/Password Salah"
    );
    // jika jumlah datanya = 0 berarti username atau password salah
    header("location:login_pembeli.php");
  } else {
    // buat variabel session
    $_SESSION["session_pembeli"] = mysqli_fetch_array($result);
    $_SESSION["session_beli"] = array();
    // ini buat tempat enampung data yang dipinjam
    header("location:template_pembeli.php");
  }


  if (isset($_GET["logout"])) {
    // hapus sessionnya
    session_destroy();
    header("location:login_pembeli.php");
  }

 ?>
