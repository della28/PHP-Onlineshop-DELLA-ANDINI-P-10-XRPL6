<?php
  $koneksi = mysqli_connect("localhost","root","","onlineshop");
  $sql = "select * from barang";
  $result = mysqli_query($koneksi,$sql);
 ?>

 <div class="row my-5">
   <?php foreach ($result as $hasil): ?>
     <div class="card col-sm-4">
       <div class="card-body">
         <img src="img_barang/<?php echo $hasil["gambar"]; ?>" class="gambar" width="70%" height="200">
       </div>
       <div class="card-footer bg-primary">
         <h5 class="text-center"><?php echo $hasil["nama"]; ?></h5>
         <h6 class="text-center">Stok: <?php echo $hasil["stok"]; ?></h6>
         <h6 class="text-center"><?php echo $hasil["harga"]; ?></h6>
         <h6 class="text-center">Deskripsi: <?php echo $hasil["deskripsi"]; ?></h6>
         <a href="db_beli.php?transaksi=true&kode_barang=<?php echo $hasil["kode_barang"]; ?>"><button type="button" class="btn btn-danger btn-block">BELI</button></a>
       </div>
       <br>
     </div>
   <?php endforeach; ?>
 </div>
