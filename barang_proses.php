<?php
  session_start();
  $koneksi = mysqli_connect("localhost","root","","onlineshop");
  if (isset($_POST["action"])) {
    $kode_barang = $_POST["kode_barang"];
    $nama = $_POST["nama"];
    $stok = $_POST["stok"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $action = $_POST["action"];

    if ($_POST["action"] == "insert") {
      $path = pathinfo($_FILES["gambar"]["name"]);
      // ambil ekstensi gambarnya
      $extensi = $path["extension"];
      // rangkai nama file yang akan disimpan
      $filename = $kode_barang."-".rand(1,1000).".".$extensi;
      // rand() = untuk mengambil nlai random antara 1 - 1000

      $sql = "insert into barang values('$kode_barang','$nama','$stok','$harga','$deskripsi','$filename')";

      if (mysqli_query($koneksi,$sql)) {
        // jika berhasil
        move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_barang/$filename");
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
      header("location:template_admin.php?page=barang");

    }elseif ($_POST["action"] == "update") {
      if (!empty($_FILES["gambar"]["name"])) {
        // jika diedit
        $sql = "select * from barang where kode_barang='$kode_barang'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);
        //
        if (file_exists("img_barang/".$hasil["gambar"])) {
          // jika filenya Tersedia
          unlink("img_barang/".$hasil["gambar"]);
          // untuk menghapus file
        }

        // membuat nama file baru
        $path = pathinfo($_FILES["gambar"]["name"]);
        // ambil ekstensi gambarnya
        $extensi = $path["extension"];
        // rangkai nama file yang akan disimpan
        $filename = $kode_barang."-".rand(1,1000).".".$extensi;
        // rand() = untuk mengambil nlai random antara 1 - 1000

        // membuat perintah update
        $sql = "update barang set nama = '$nama',stok = '$stok',harga = '$harga',deskripsi = '$deskripsi',gambar='$filename' where kode_barang = '$kode_barang'";

        if (mysqli_query($koneksi,$sql)) {
          // jika query sukses
          move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_barang/$filename");
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          // jika query gagal
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
      }else {
        // jika gmbr tdk diedit
        $sql = "update barang set nama = '$nama',stok = '$stok',harga = '$harga',deskripsi = '$deskripsi' where kode_barang = '$kode_barang'";

        if (mysqli_query($koneksi,$sql)) {
          // jika query sukses
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          // jika query gagal
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
      }
      header("location:template_admin.php?page=barang");
    }
  }




  if (isset($_GET["hapus"])) {
    // jika yang dikirim adalah variable GET hapus
    $kode_barang = $_GET["kode_barang"];
     // ambil data dari databsase
    $sql = "select * from barang where kode_barang = '$kode_barang'";
    // eksekusi query
    $result = mysqli_query($koneksi,$sql);
    // konversi ke array
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_barang/".$hasil["gambar"])) {
      unlink("img_barang/".$hasil["gambar"]);
    }
    $sql = "delete from barang where kode_barang = '$kode_barang'";
    if (mysqli_query($koneksi,$sql)) {
      // jika query sukses
      $_SESSION["message"] = array(
        "type" => "succes",
        "message" => "Delete has been succes"
      );
    }else {
      // jika gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template_admin.php?page=barang");
  }
 ?>
