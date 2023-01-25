<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Data Barang</h3>
        <p class="text-subtitle text-muted">
        </p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="admin.php?page=dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Data Barang
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card">
      <div class="card-header">
        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#backdrop">
          <i class="bi bi-folder-plus"></i> Tambah Barang
        </button>
      </div>

      <div class="card-body">
        <table class="table table-striped" id="table1">
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
        </table>
      </div>
    </div>
  </section>

  <!-- modal create -->
  <div class="modal fade text-left" id="backdrop" tabindex="4" role="dialog" aria-labelledby="myModalLabel4" data-bs-backdrop="true" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel4">
            Tambah Data Barang
          </h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <?php
          include './db_conn/koneksi.php';
          $querykode = mysqli_query(
            $koneksi,
            "SELECT max(id_barang) as idterbesar FROM barang"
          );
          $data = mysqli_fetch_array($querykode);
          $id_barang = $data['idterbesar'];
          $urutan = (int) substr($id_barang, 3, 3);
          $urutan++;
          $huruf = "BRG";
          $id_barang = $huruf . sprintf("%03s", $urutan);
          ?>
          <form action="db_conn/barang.php?aksi=simpan" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Barang</label>
                <div class="col-sm-10">
                  <input type="text" name="id_barang" value="<?php echo $id_barang ?>" readonly class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                  <input type="text" name="nama_barang" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                  <input type="text" name="harga" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                  <input type="text" name="stok" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                  <input type="file" onchange="readURL(this)" name="gambar" class="form-control" />
                  <img id="thumb" src="#" alt="your image" width="300px" height="300px" />
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
              </button>
              <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Accept</span>
              </button>
            </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>
</div>
<!-- modal create end -->

<!-- modal edit -->
<?php
include './db_conn/koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM barang");
while ($data = mysqli_fetch_array($query)) {
?>
  <div class="modal fade text-left" id="edit<?php echo $data['id_barang'] ?>" tabindex="4" role="dialog" aria-labelledby="myModalLabel4" data-bs-backdrop="true" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel4">
            Edit Data Barang
          </h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Data Barang</h3>
            </div>
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
                    <input type="text" name="nama_barang" value="<?php echo $data['nama_barang'] ?>" class=" form-control">
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
        </div>
      <?php } ?>


      <script>
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#thumb').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
          }
        }
      </script>

      <script src="../assets/js/bootstrap.js"></script>
      <script src="../assets/js/app.js"></script>
      <script src="../assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
      <script src="../assets/js/pages/simple-datatables.js"></script>