<?php
  session_start();
    $koneksi = mysqli_connect("localhost","root","","onlineshop");

    if (isset($_POST["action"])) {
      $id_admin = $_POST["id_admin"];
      $nama_admin = $_post["nama_admin"];
      $username = $_POST["username"];
      $password = md5($_POST["password"]);
      $action = $_POST["action"];

      if ($action == "insert") {
        $sql = "insert into admin values('$id_admin','$nama_admin','$username','$password')";

        if (mysqli_query($koneksi,$sql)) {
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Insert has been success"
          );
        }else {
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
        header("location:template_admin.php?page=admin");
      }elseif ($action == "update") {
        $sql = "select * from admin where id_admin='$id_admin'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);

        $sql = "update admin set nama_admin='$nama_admin',username='$username',password='$password'";
        if (mysqli_query($koneksi,$sql)) {
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_query($koneksi)
          );
        }
      }
      header("location:template_admin.php?page=admin");
    }



    if (isset($_GET["hapus"])) {
      $id_admin = $_GET["id_admin"];
      $sql = "select * from admin where id_admin='$id_admin'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);
      $sql = "delete from admin where id_admin='$id_admin'";
      if (mysqli_query($koneksi,$sql)) {
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Delete has been success"
        );
      }else {
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
      header("location:template_admin.php?page=admin");
    }
 ?>
