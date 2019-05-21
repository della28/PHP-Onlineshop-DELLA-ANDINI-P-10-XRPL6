<?php
  session_start();
  $koneksi = mysqli_connect("localhost","root","","onlineshop");
    $id_pembeli = $_POST["id_pembeli"];
    $nama_pb = $_POST["nama_pb"];
    $alamat = $_POST["alamat"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $action = $_POST["action"];

    if ($_POST["action"] == "insert") {
      $path = pathinfo($_FILES["gambar"]["name"]);
      $extensi = $path["extension"];
      $filename = $id_pembeli."-".rand(1,1000).".".$extensi;

      $sql = "insert into pembeli values('$id_pembeli','$nama_pb','$alamat','$kontak','$username','$password','$filename')";

      if (mysqli_query($koneksi,$sql)) {
        // jika berhasil
        move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_pembeli/$filename");
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Insert data has been success"
        );
      } else {
        // jika gagal
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
      header("location:template_admin.php?page=pembeli");

    } elseif ($_POST["action"] == "update") {
      if (!empty($_FILES["gambar"]["name"])) {
        // jika diedit
        $sql = "select * pembeli where id_pembeli = '$id_pembeli'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);

        if (file_exists("img_pembeli/".$hasil["gambar"])) {
          unlink("img_pembeli/".$hasil["gambar"]);
        }

        $path = pathinfo($_FILES["gambar"]["name"]);
        $extensi = $path["extension"];
        $filename = $id_pembeli."-".rand(1,1000).".".$extensi;

        $sql = "update pembeli set nama_pb='$nama_pb',alamat='$alamat',kontak='$kontak',username='$username',password='$password',gambar='$filename' where id_pembeli='$id_pembeli'";

        if (mysqli_query($koneksi,$sql)) {
          move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_pembeli/$filename");
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        } else {
          // jika query gagal
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
      }else {
        // jika gambar tidak diedit
        $sql = "update pembeli set nama_pb='$nama_pb',alamat='$alamat',kontak='$kontak',username='$username',password='$password' where id_pembeli='$id_pembeli'";

        if (mysqli_query($koneksi,$sql)) {
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
      }
      header("location:template_admin.php?page=pembeli");
    }





  if (isset($_GET["hapus"])) {
    $id_pembeli = $_GET["id_pembeli"];
    $sql = "select * from pembeli where id_pembeli='$id_pembeli'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_pembeli/".$hasil["gambar"])) {
      unlink("img_pembeli/".$hasil["gambar"]);
    }
    $sql = "delete from pembeli where id_pembeli='$id_pembeli'";
    if (mysqli_query($koneksi,$sql)) {
      // jika query sukses
      $_SESSION["message"] = array(
        "type" => "succes",
        "message" => "Delete has been succes"
      );
    } else {
      // jika gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template_admin.php?page=pembeli");
  }
 ?>
