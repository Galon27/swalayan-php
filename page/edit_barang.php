<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Data Barang</h3>
    </div>
    <?php 
    include './db_conn/koneksi.php';
    $id_barang = $_GET['id_barang'];
    $query = mysqli_query($koneksi,"SELECT * FROM barang WHERE id_barang = '$id_barang'");
    $data = mysqli_fetch_array($query);
    ?>
    <form action="./db_conn/barang.php?aksi=update" method="post" class="form-horizontal">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Barang</label>
                <div class="col-sm-10">
                    <input type="text" name="id_barang" value="<?php echo $data['id_barang'] ?>" readonly class="
                        form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_barang" value="<?php echo $data['nama_barang'] ?>"
                        class=" form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" name="harga" value="<?php echo $data['harga'] ?>" class=" form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                    <input type="text" name="stok" value="<?php echo $data['stok'] ?>" class=" form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                    <!-- <input type="file" onchange="readURL(this);" name="gambar" class="form-control" /> -->
                    <img id="blah" src="gambar/<?php echo $data['gambar'] ?>" width="300px" height="300px" />
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=barang" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-info float-right">Update</button>
            </div>
        </div>
    </form>
</div>



<section class="section" id="content-types">
      <div class="row">
        <div class="col-sm-4">
          <div class="card d-flex shadow-sm" >
            <div class="card-header">
              <h4><?php echo $data['nama_barang'] ?></h4>
              <p class="float-end">Rp.<?php echo $data['harga'] ?></p>
            </div>
            <div class="card-body">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="gambar/<?php echo $data['gambar'] ?>" class="d-block w-100" alt="..." />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <thead>
            <tr>
              <th>ID Barang</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Gambar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include './db_conn/koneksi.php';
            $query = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($data = mysqli_fetch_array($query)) {
            ?>
              <tr>
                <td><?php echo $data['id_barang'] ?></td>
                <td><?php echo $data['nama_barang'] ?></td>
                <td><?php echo $data['harga'] ?></td>
                <td><?php echo $data['stok'] ?></td>
                <td><img src="gambar/<?php echo $data['gambar'] ?>" width="85px" height="85px"></td>
                <td>
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id_barang'] ?>">
                    Edit
                  </button>
                  <a href="db_conn/barang.php?aksi=delete&id_barang=<?php echo $data['id_barang'] ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>

            <?php } ?>
          </tbody>