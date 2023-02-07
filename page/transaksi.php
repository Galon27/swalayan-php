<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Transaksi.</h3>
                <p class="text-subtitle text-muted">
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Transaksi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card card-info" id="formInput" style="display: none;">
        <div class="card-header">
            <h3 class="card-title">Data Transaksi</h3>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <?php
                include './db_conn/koneksi.php';
                $querykode = mysqli_query(
                    $koneksi,
                    "SELECT max(id_transaksi) as idterbesar FROM transaksi"
                );
                $data = mysqli_fetch_array($querykode);
                $id_transaksi = $data['idterbesar'];
                $urutan = (int) substr($id_transaksi, 3, 3);
                $urutan++;
                $huruf = "INV";
                $idtransaksi = $huruf . sprintf("%03s", $urutan);
                ?>
                <form action="./db_conn/transaksi.php?aksi=simpan" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Transaksi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="id_transaksi" value="<?php echo $idtransaksi ?>" readonly class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="id_pelanggan" class="form-control">
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                                        while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                            <option value="<?php echo $data['id_pelanggan'] ?>">
                                                <?php echo $data['nama_pelanggan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tanggal" <?php $Now = new DateTime('now', new DateTimeZone('Asia/Jakarta')); ?> value="<?php echo $Now->format('Y-m-d H:i'); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User</label>
                                <div class="col-sm-10">
                                    <input type="text" name="id_user" value="<?php echo $_SESSION['id_user'] ?>" readonly class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Barang</label>
                                <div class="col-sm-10">
                                    <select name="id_barang" id="id_barang" onchange="changeValueBarang(this.value)" class="form-control">
                                        <option disabled="" selected="">Pilih Barang</option>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM barang");
                                        $jsBarang = "var dtBarang = new Array();\n";
                                        while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                            <option value="<?php echo $data['id_barang'] ?>">
                                                <?php echo $data['nama_barang'] ?></option>
                                            <?php $jsBarang .= "dtBarang['" . $data['id_barang'] . "'] = {harga:'" . addslashes($data['harga']) . "'};\n" ?>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" name="harga" id="harga" readonly class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text" name="jumlah" id="jumlah" onkeyup="hitung()" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Total</label>
                                <div class="col-sm-10">
                                    <input type="text" name="total" id="total" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="reset" class="btn btn-warning">Reset</button></button>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table" id="table1">
                <button type="button" class="btn btn-primary float-end ms-3 mt-2" id="btnShowForm">
                    <i class="bi bi-person-plus-fill"></i>
                </button>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include './db_conn/koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT * FROM transaksi");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $data['id_transaksi'] ?></td>
                            <td><?php echo $data['id_pelanggan'] ?></td>
                            <td><?php echo $data['tanggal'] ?></td>
                            <td><?php echo $data['id_barang'] ?></td>
                            <td><?php echo $data['jumlah'] ?></td>
                            <td><?php echo $data['total'] ?></td>
                            <td><?php echo $data['id_user'] ?></td>
                            <td>
                                <a href="page/cetak.php?id_transaksi=<?php echo $data['id_transaksi'] ?>" class="btn btn-info">Cetak</a>
                                <button type="button" class="btn btn-danger"  onclick="Delete('db_conn/transaksi.php?aksi=delete&id_transaksi=<?php echo $data['id_transaksi'] ?>')">Hapus</button>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

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

    <script>
        function hitung() {
            var harga = document.getElementById('harga').value;
            var jumlah = document.getElementById('jumlah').value;
            var total = harga * jumlah;
            document.getElementById('total').value = total;
        }
    </script>

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