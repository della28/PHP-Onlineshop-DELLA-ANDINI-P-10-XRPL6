
      <script type="text/javascript">
        function Add(){
          //set action menjadi insert
          document.getElementById('action').value = "insert";
          // kosongkan inputan formnya
          document.getElementById("kode_barang").value = "";
          document.getElementById("nama").value = "";
          document.getElementById("stok").value = "";
          document.getElementById("harga").value = "";
          document.getElementById("deskripsi").value = "";
        }

        function Edit(index){
          // set input action berdasarkan tabel yangg dipilih
          document.getElementById('action').value = "update";
          // set formnya berdarasarkan tabel yang dipilih
          var table = document.getElementById("table_barang");
          // tampung data dari tabel
          var kode_barang = table.rows[index].cells[0].innerHTML;
          var nama = table.rows[index].cells[1].innerHTML;
          var stok = table.rows[index].cells[2].innerHTML;
          var harga = table.rows[index].cells[3].innerHTML;
          var deskripsi = table.rows[index].cells[4].innerHTML;

          // keluarkan pada formnya
          document.getElementById("kode_barang").value = kode_barang;
          document.getElementById("nama").value = nama;
          document.getElementById("stok").value = stok;
          document.getElementById("harga").value = harga;
          document.getElementById("deskripsi").value = deskripsi;
        }
        
      </script>
      <div class="card col-sm-12">
        <br>
        <div class="card-header">
          <h4>LIST BARANG</h4>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION["message"])): ?>
            <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
              <?php echo $_SESSION["message"]["message"]; ?>
              <?php unset($_SESSION["message"]); ?>
            </div>
          <?php endif; ?>
          <?php
          $koneksi = mysqli_connect("localhost","root","","onlineshop");
          // localhost = host name
          // root = username untuk akses ke database
          // "" = password untuk diakses database
          // siswa = nama databasenya
          $sql = "select * from barang";
          $result = mysqli_query($koneksi,$sql);
          // digunakan untuk eksekusi sintax sql
          $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0): ?>
            <!-- jika data dari database kosong, maka akan muncul informasi -->
            <div class="alert alert-info">
              Data belum Tersedia
            </div>
          <?php else: ?>
            <!-- jika datanya ada, maka akan ditampilkan pada tabel -->
            <table class="table" id="table_barang">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Stok</th>
                  <th>Harga</th>
                  <th>Deskripsi</th>
                  <th>Image</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $hasil): ?>
                  <tr>
                    <td><?php echo $hasil ["kode_barang"]; ?></td>
                    <td><?php echo $hasil ["nama"]; ?></td>
                    <td><?php echo $hasil ["stok"]; ?></td>
                    <td><?php echo $hasil ["harga"]; ?></td>
                    <td><?php echo $hasil ["deskripsi"]; ?></td>
                    <td>
                      <img src="<?php echo "img_barang/".$hasil["gambar"]; ?>"
                      class="img" width="100">
                    </td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal" onclick="Edit(this.parentElement.parentElement.rowIndex);">Edit</button>
                      <a href="barang_proses.php?hapus=barang&kode_barang=<?php echo $hasil["kode_barang"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
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

      <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="barang_proses.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Barang</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              <!-- untuk menyimpan aksi yang aka dilakukan entah itu insert atau update -->
              KODE BARANG
              <input type="text" name="kode_barang" id="kode_barang" class="form-control">
              NAMA BARANG
              <input type="text" name="nama" id="nama" class="form-control">
              STOK
              <input type="number" name="stok" id="stok" class="form-control">
              HARGA
              <input type="text" name="harga" id="harga" class="form-control">
              DESKRIPSI
              <input type="text" name="deskripsi" id="deskripsi" class="form-control">
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
