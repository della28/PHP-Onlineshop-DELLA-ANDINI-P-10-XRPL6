
      <script type="text/javascript">
        function Add() {
          // set action menjadi insert
          document.getElementById('action').value = "insert";
          // kosongkan inputannya
          document.getElementById("id_pembeli").value = "";
          document.getElementById("nama_pb").value = "";
          document.getElementById("alamat").value = "";
          document.getElementById("kontak").value = "";

        }

        function Edit(index) {
          // set input action menjadi update
          document.getElementById('action').value = "update";
          // set formnya berdasarkan tabel yang dipilih
          var table = document.getElementById("table_pembeli");
          // tampung data dari tabel
          var id_pembeli = table.rows[index].cells[0].innerHTML;
          var nama_pb = table.rows[index].cells[1].innerHTML;
          var alamat = table.rows[index].cells[2].innerHTML;
          var kontak = table.rows[index].cells[3].innerHTML;

          // keluarkan pada formnya
          document.getElementById("id_pembeli").value = id_pembeli;
          document.getElementById("nama_pb").value = nama_pb;
          document.getElementById("alamat").value = alamat;
          document.getElementById("kontak").value = kontak;
        }
      </script>
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Daftar Pembeli</h4>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION["message"])): ?>
            <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
              <?php echo $_SESSION["message"]["message"]; ?>
              <?php unset($_SESSION["message"]); ?>
            </div>
          <?php endif; ?>
          <?php
            // koneksi ke database
            $koneksi = mysqli_connect("localhost","root","","onlineshop");
            // localhost = host name
            // root = username untuk akses databsenya
            // "" = pasword untuk akses databse
            // siswa = nama databasenya
            $sql = "select * from pembeli";
            $result = mysqli_query($koneksi,$sql);
            // digunakan untuk eksekusi sintax sql
            $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0): ?>
            <!-- jika data dari database kosong , maka akan muncul pesan informasi -->
            <div class="alert alert-info">
              Data belum tersedia
            </div>
          <?php else: ?>
            <!-- jika datanya ada, maka akan ditampilkan pada tabel -->
            <table class="table" id="table_pembeli">
              <thead>
                <tr>
                  <th>ID Pembeli</th>
                  <th>Nama Pembeli</th>
                  <th>Alamat</th>
                  <th>Kontak</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Gambar</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $hasil): ?>
                  <tr>
                    <td><?php echo $hasil["id_pembeli"]; ?></td>
                    <td><?php echo $hasil["nama_pb"]; ?></td>
                    <td><?php echo $hasil["alamat"]; ?></td>
                    <td><?php echo $hasil["kontak"]; ?></td>
                    <td><?php echo $hasil["username"] ?></td>
                    <td><?php echo $hasil["password"] ?></td>
                    <td>
                      <img src="<?php echo "img_pembeli/".$hasil["gambar"]; ?>"
                      class="img" width="100">
                    </td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal" onclick="Edit(this.parentElement.parentElement.rowIndex);">Edit</button>
                      <a href="pembeli_proses.php?hapus=pembeli&id_pembeli=<?php echo $hasil["id_pembeli"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                        <button type="button" class="btn btn-danger">Hapus</button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal" onclick="Add()">Tambah</button>
        </div>
      </div>
    </div>

    <!-- membuat pop up -->
    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="pembeli_proses.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Pustakawan</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              <!-- untuk menyimpan aksi yang akan dialkukan entah itu insert atau upfdate -->
              ID Pembeli
              <input type="text" name="id_pembeli" id="id_pembeli" class="form-control">
              NAMA Pembeli
              <input type="text" name="nama_pb" id="nama_pb" class="form-control">
              ALAMAT
              <input type="text" name="alamat" id="alamat" class="form-control">
              KONTAK
              <input type="text" name="kontak" id="kontak" class="form-control">
              USERNAME
              <input type="text" name="username" id="username" class="form-control">
              PASSWORD
              <input type="password" name="password" id="password" class="form-control">
              IMAGE
              <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
