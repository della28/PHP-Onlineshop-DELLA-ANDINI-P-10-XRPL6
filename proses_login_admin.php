<?php
    session_start();
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    // koneksi databse
    $koneksi = mysqli_connect("localhost","root","","onlineshop");
    $sql = "select * from admin where username='$username' and password='$password'";
    $result = mysqli_query($koneksi,$sql);
    $jumlah = mysqli_num_rows($result);

    if ($jumlah == 0) {
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => "Username/Password Salah"
      );
      // jika jumlah datanya = 0 berarti username atau password salah
      header("location:login_admin.php");
    } else {
      // buat variabel session
      $_SESSION["session_admin"] = mysqli_fetch_array($result);
      header("location:template_admin.php");
    }


    if (isset($_GET["logout"])) {
      // hapus sessionnya
      session_destroy();
      header("location:login_admin.php");
    }
 ?>
