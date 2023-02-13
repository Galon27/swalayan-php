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
              Data User
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-12 order-md-1 order-last">
      <div class="card shadow">
        <h3 class="pb-3 pt-4 ps-3">Data Peruseran.</h3>
        <div class="col-sm-2 d-inline">

        </div>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card shadow">
      <div class="card-body">
        <table class="table" id="table1">
          <button type="button" class="btn btn-primary float-end ms-3 mt-2" data-bs-toggle="modal" data-bs-target="#primary">
            <i class="bi bi-person-plus-fill"></i>
          </button>
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>ID User</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Jenis Kelamin</th>
              <th>No HP</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include './db_conn/koneksi.php';
            $no = 1;
            $data = mysqli_query($koneksi, "select * from user");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo $d['id_user']; ?></td>
                <td><?php echo $d['nama_user']; ?></td>
                <td><?php echo $d['username']; ?></td>
                <td><?php echo $d['jenis_kelamin']; ?></td>
                <td><?php echo $d['no_hp']; ?></td>
                <td>
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $d['id_user'] ?>">
                    <i class="bi bi-person-check"></i>
                  </button>
                  <button type="button" class="btn btn-danger" onclick="Delete('db_conn/user.php?aksi=delete&id_user=<?php echo $d['id_user'] ?>')"><i class="bi bi-trash3"></i></button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>




  <div class="row">
    <div class="col-12">
      <div class="modal-primary me-1 mb-1 d-inline-block">
        <!--primary theme Modal -->
        <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">
                  Tambah Data User
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <i data-feather="x"></i>
                </button>
              </div>
              <div class="modal-body">
                <form action="./db_conn/user.php?aksi=simpan" method="post">
                  <?php
                  include './db_conn/koneksi.php';
                  $querykode = mysqli_query($koneksi, "SELECT max(id_user) as idterbesar FROM user");
                  $data = mysqli_fetch_array($querykode);
                  $id_user = $data['idterbesar'];
                  $urutan = (int) substr($id_user, 3, 3);
                  $urutan++;
                  $huruf = "USR";
                  $iduser = $huruf . sprintf("%03s", $urutan);
                  ?>
                  <!-- Email input -->
                  <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="id_user" class="form-control" value="<?php echo $iduser ?>" readonly class="form-control" />
                    <div class="form-control-icon">
                      <i class="bi bi-people-fill"></i>
                    </div>
                  </div>
                  <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control" placeholder="Nama" name="nama_user" required autofocus />
                    <div class="form-control-icon">
                      <i class="bi bi-people-fill"></i>
                    </div>
                  </div>
                  <div class="form-group position-relative has-icon-left mb-4">
                    <select type="text" class="form-control" placeholder="Jenis Kelamin" name="jenis_kelamin" required>
                      <option value="Laki - laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="form-control-icon">
                      <i class="bi bi-gender-ambiguous"></i>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control" placeholder="Username" name="username" required />
                        <div class="form-control-icon">
                          <i class="bi bi-person"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control" placeholder="Password" name="password" required />
                        <div class="form-control-icon">
                          <i class="bi bi-shield-lock"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control" placeholder="No HP" name="no_hp" required />
                    <div class="form-control-icon">
                      <i class="bi bi-phone"></i>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end align-items-center">
                    <input type="submit" class="btn btn-primary" name="submit" style="padding-left: 2.5rem; padding-right: 2.5rem;" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <?php
      include './db_conn/koneksi.php';
      $no = 1;
      $data = mysqli_query($koneksi, "select * from user");
      while ($d = mysqli_fetch_array($data)) {
      ?>
        <div class="modal-primary me-1 mb-1 d-inline-block">

          <!--primary theme Modal -->
          <div class="modal fade text-left" id="edit<?php echo $d['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
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
                  <form action="./db_conn/user.php?aksi=update" method="post">
                    <div class="form-group position-relative has-icon-left mb-4">
                      <input type="text" class="form-control" placeholder="Nama" name="nama_user" value="<?php echo $d['nama_user'] ?>" required autofocus />
                      <input type="hidden" class="form-control" placeholder="Nama" name="id_user" value="<?php echo $d['id_user'] ?>" required autofocus />
                      <div class="form-control-icon">
                        <i class="bi bi-people-fill"></i>
                      </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                      <select type="text" class="form-control" placeholder="Jenis Kelamin" name="jenis_kelamin" required>
                        <option value="Laki - laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                      <div class="form-control-icon">
                        <i class="bi bi-gender-ambiguous"></i>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group position-relative has-icon-left mb-4">
                          <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $d['username'] ?>" required />
                          <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group position-relative has-icon-left mb-4">
                          <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $d['password'] ?>" required />
                          <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                      <input type="text" class="form-control" placeholder="No HP" name="no_hp" value="<?php echo $d['no_hp'] ?>" required />
                      <div class="form-control-icon">
                        <i class="bi bi-phone"></i>
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
              </div>
            </div>
          </div>
          </form>
        </div>
      <?php } ?>

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
    </div>
  </div>
</div>