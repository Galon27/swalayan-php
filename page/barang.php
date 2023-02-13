<link rel="stylesheet" type="text/css" href="style/dashboard.css">

<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 me-3 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Data Barang
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-12 order-md-1 order-last">
      <div class="card shadow">
        <h3 class="pb-3 pt-4 ps-3">Data Barang.</h3>
        <div class="col-sm-2 d-inline">
        </div>
      </div>
    </div>
  </div>

  <section class="section">
    <div class="card-header">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backdrop">
        <i class="bi bi-folder-plus"></i> Tambah Barang
      </button>
    </div>

    <div class="card-body mt-4">
      <div class="row">
        <?php
        include './db_conn/koneksi.php';
        $query = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($data = mysqli_fetch_array($query)) {

          $check = mysqli_num_rows($query) > 0;

          if ($check) {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
              <div class="col-sm-4">
                <div class="card d-flex shadow" id="card-bg">
                  <div class="card-header" id="card-bg">
                    <h4 class="d-inline"><?php echo $row['nama_barang'] ?></h4>
                    <p class="float-end d-inline">Rp.<?php echo $row['harga'] ?></p>
                    <p class="position-absolute top-3 end-2">Stok : <?php echo $row['stok'] ?></p>
                  </div>
                  <div class="card-body pb-0">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="gambar/<?php echo $row['gambar'] ?>" class="w-100" alt="..." style="height: 170px;" />
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-contect-between pt-2 pb-2">
                      <button type="button" class="btn btn-warning col-3 me-2" id="text" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['id_barang'] ?>">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <button type="button" class="btn btn-danger col-3 me-4" id="text" onclick="Delete('db_conn/barang.php?aksi=delete&id_barang=<?php echo $row['id_barang'] ?>')">
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                      <a href="admin.php?page=transaksi_barang&id_barang=<?php echo $row['id_barang'] ?>" class="btn btn-primary icon icon-left" id="text"><i class="bi bi-cart-plus-fill"></i> Order</a>
                    </div>
                  </div>

                </div>
              </div>
          <?php
            }
          } else {
            echo "Tidak ada biasa aja";
          }
          ?>


      </div>
    <?php } ?>
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
                <img id="thumb" src="#" alt="..." width="300px" height="300px" />
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

  $check = mysqli_num_rows($query) > 0;

  if ($check) {
    while ($row = mysqli_fetch_assoc($query)) {
?>
      <div class="modal-primary me-1 mb-1 d-inline-block">

        <!--primary theme Modal -->
        <div class="modal fade text-left" id="edit<?php echo $row['id_barang'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">
                  Form Edit
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <i data-feather="x"></i>
                </button>
              </div>
              <div class="modal-body">
                <form action="./db_conn/barang.php?aksi=update" method="post" class="form-horizontal">
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">ID Barang</label>
                      <div class="col-sm-10">
                        <input type="text" name="id_barang" value="<?php echo $row['id_barang'] ?>" readonly class="
                        form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nama Barang</label>
                      <div class="col-sm-10">
                        <input type="text" name="nama_barang" value="<?php echo $row['nama_barang'] ?>" class=" form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Harga</label>
                      <div class="col-sm-10">
                        <input type="text" name="harga" value="<?php echo $row['harga'] ?>" class=" form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Stok</label>
                      <div class="col-sm-10">
                        <input type="text" name="stok" value="<?php echo $row['stok'] ?>" class=" form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Gambar</label>
                      <div class="col-sm-10">
                        <img id="blah" src="gambar/<?php echo $row['gambar'] ?>" width="300px" height="300px" />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                      <i class="bx bx-x d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Close</span>
                    </button>
                    <input type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" />
                    <i class="bx bx-check d-block d-sm-none"></i>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  <?php
    }
  } else {
    echo "Tidak ada biasa aja";
  }
  ?>

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

<script>
  function Delete(url) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Data ini akan dihapus!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Data pelanggan berhasil dihapus.',
          'success',
          window.location.href = url
        )
      }

    })
  }
</script>

<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/app.js"></script>
<script src="../assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="../assets/js/pages/simple-datatables.js"></script>