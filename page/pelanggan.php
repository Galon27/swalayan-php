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
              Data Pelanggan
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-12 order-md-1 order-last">
      <div class="card shadow">
        <h3 class="pb-3 pt-4 ps-3">Data Pelanggan.</h3>
        <div class="col-sm-2 d-inline">

        </div>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card shadow">
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <!-- Button trigger for primary themes modal -->
          <button type="button" class="btn btn-primary float-end ms-3 mt-2" data-bs-toggle="modal" data-bs-target="#backdrop">
            <i class="bi bi-person-plus-fill"></i>
          </button>
          <thead>
            <tr>
              <th>ID Pelanggan</th>
              <th>Nama Pelanggan</th>
              <th>Jenis Kelamin</th>
              <th>Alamat</th>
              <th>No HP</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include './db_conn/koneksi.php';
            $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
            while ($data = mysqli_fetch_array($query)) {
            ?>
              <tr>
                <td><?php echo $data['id_pelanggan'] ?></td>
                <td><?php echo $data['nama_pelanggan'] ?></td>
                <td><?php echo $data['jenis_kelamin'] ?></td>
                <td><?php echo $data['alamat'] ?></td>
                <td><?php echo $data['no_hp'] ?></td>
                <td>
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id_pelanggan'] ?>">
                    <i class="bi bi-person-check"></i>
                  </button>
                  <button type="button" class="btn btn-danger" onclick="Delete('db_conn/pelanggan.php?aksi=delete&id_pelanggan=<?php echo $data['id_pelanggan'] ?>')"><i class="bi bi-trash3"></i></button>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- modal create -->
  <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-bs-backdrop="true" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel4">
            Tambah Data Pelanggan
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
            "SELECT max(id_pelanggan) as idterbesar FROM pelanggan"
          );
          $data = mysqli_fetch_array($querykode);
          $id_pelanggan = $data['idterbesar'];
          $urutan = (int) substr($id_pelanggan, 3, 3);
          $urutan++;
          $huruf = "PEL";
          $id_pelanggan = $huruf . sprintf("%03s", $urutan);
          ?>
          <form action="db_conn/pelanggan.php?aksi=simpan" method="post" class="form-horizontal">
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID pelanggan</label>
                <div class="col-sm-10">
                  <input type="text" name="id_pelanggan" value="<?php echo $id_pelanggan ?>" readonly class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama pelanggan</label>
                <div class="col-sm-10">
                  <input type="text" name="nama_pelanggan" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select class="form-control" name="jenis_kelamin">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <input type="text" name="alamat" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">No HP</label>
                <div class="col-sm-10">
                  <input type="text" name="no_hp" class="form-control">
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
              </button>
              <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" onclick="Create()">
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
$data = mysqli_query($koneksi, "select * from pelanggan");
while ($d = mysqli_fetch_array($data)) {
?>
  <div class="modal-primary me-1 mb-1 d-inline-block">

    <!--primary theme Modal -->
    <div class="modal fade text-left" id="edit<?php echo $d['id_pelanggan'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
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
            <form action="./db_conn/pelanggan.php?aksi=update" method="post" class="form-horizontal">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">ID pelanggan</label>
                  <div class="col-sm-10">
                    <input type="text" name="id_pelanggan" value="<?php echo $d['id_pelanggan'] ?>" readonly class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama pelanggan</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_pelanggan" value="<?php echo $d['nama_pelanggan'] ?>" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="jenis_kelamin" value="<?php echo $d['jenis_kelamin'] ?>">
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" name="alamat" value="<?php echo $d['alamat'] ?>" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No HP</label>
                  <div class="col-sm-10">
                    <input type="text" name="no_hp" value="<?php echo $d['no_hp'] ?>" class="form-control">
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
              </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

<?php } ?>
<script>
  const btn = document.getElementById("btnShowForm");
  const form = document.getElementById("formInput");

  btn.addEventListener("click", function() {
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  });
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