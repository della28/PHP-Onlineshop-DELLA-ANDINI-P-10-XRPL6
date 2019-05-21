
      <script type="text/javascript">
        function Add() {
          // set action menjadi insert
          document.getElementById('action').value = "insert";
          // kosongkan inputannya
          document.getElementById("id_admin").value = "";
          document.getElementById("nama_admin").value = "";

        }

        function Edit(index) {
          // set input action menjadi update
          document.getElementById('action').value = "update";
          // set formnya berdasarkan tabel yang dipilih
          var table = document.getElementById("table_admin");
          // tampung data dari tabel
          var id_admin = table.rows[index].cells[0].innerHTML;
          var nama_admin = table.rows[index].cells[1].innerHTML;


          // keluarkan pada formnya
          document.getElementById("id_admin").value = id_admin;
          document.getElementById("nama_admin").value = nama_admin;

        }
      </script>
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Admin Penjual</h4>
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
            $sql = "select * from admin";
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
            <table class="table" id="table_admin">
              <thead>
                <tr>
                  <th>Id Admin</th>
                  <th>Nama Admin</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $hasil): ?>
                  <tr>
                    <td><?php echo $hasil["id_admin"]; ?></td>
                    <td><?php echo $hasil["nama_admin"]; ?></td>
                    <td><?php echo $hasil["username"] ?></td>
                    <td><?php echo $hasil["password"] ?></td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal" onclick="Edit(this.parentElement.parentElement.rowIndex);">Edit</button>
                      <a href="admin_proses.php?hapus=admin&id_admin=<?php echo $hasil["id_admin"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
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
          <form action="admin_proses.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Admin</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              <!-- untuk menyimpan aksi yang akan dialkukan entah itu insert atau upfdate -->
              ID ADMIN
              <input type="text" name="id_admin" id="id_admin" class="form-control">
              NAMA ADMIN
              <input type="text" name="nama_admin" id="nama_admin" class="form-control">
              USERNAME
              <input type="text" name="username" id="username" class="form-control">
              PASSWORD
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
