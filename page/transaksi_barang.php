<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card shadow-sm">
            <?php
            include './db_conn/koneksi.php';
            $id_barang = $_GET['id_barang'];
            $query = mysqli_query($koneksi, "select * from barang where id_barang = '$id_barang'");
            $d = mysqli_fetch_array($query);
            ?>
            <div class="card-content p-4">
                <input type="text" name="id_barang" id="" value="<?php echo $d['id_barang'] ?>" hidden>
                <img id="blah" src="gambar/<?php echo $d['gambar'] ?>" class="rounded-3" style="width:100%; height:423px" />
                <div class="card-body">
                    <h4 class="d-inline" style="color: white;"><?php echo $d['nama_barang'] ?></h4>
                    <p class="float-end d-inline">Rp.<?php echo $d['harga'] ?></p>
                    <p class="position-absolute top-3 end-2">Stok : <?php echo $d['stok'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="card shadow-sm">
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
                            <div class="col-md-12">
                                <div class="form-group row" hidden>
                                    <label class="col-sm-3 col-form-label">ID Transaksi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="id_transaksi" value="<?php echo $idtransaksi ?>" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                    <div class="col-sm-10">
                                        <select name="id_pelanggan" class="choices form-select">
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
                                <div class="form-group row" hidden>
                                    <label class="col-sm-3 col-form-label">User</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="id_user" value="<?php echo $_SESSION['id_user'] ?>" readonly class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" hidden>
                                    <label class="col-sm-3 col-form-label">ID Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="id_barang" value="<?php echo $d['id_barang'] ?>" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row" hidden>
                                    <label class="col-sm-3 col-form-label">Harga</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="harga" id="harga" value=" <?php echo $d['harga'] ?>" readonly class="form-control">
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
                </div>




                <div class="card-footer">
                    <a href="javascript:history.back()" class="btn btn-info col-3"><i class="bi bi-arrow-left-square"></i> Back</a>
                    <button type="reset" class="btn btn-warning col-3"><i class="bi bi-arrow-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-primary float-right col-3"><i class="bi bi-save"></i> Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function hitung() {
        var harga = document.getElementById('harga').value;
        var jumlah = document.getElementById('jumlah').value;
        var total = harga * jumlah;
        document.getElementById('total').value = total;
    }
</script>