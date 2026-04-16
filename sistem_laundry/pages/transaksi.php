<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalAddTransaksi"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</button>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap">No</th>
                                <th class="text-nowrap">Nama Pelanggan</th>
                                <th class="text-nowrap">Layanan</th>
                                <th class="text-nowrap">Berat (Kg)</th>
                                <th class="text-nowrap">Total Harga</th>
                                <th class="text-nowrap text-center">Tanggal</th>
                                <th class="text-center text-nowrap">Status</th>
                                <th class="text-center text-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $dataTransaksi = get_transaksi();
                                if (is_array($dataTransaksi)) {
                                    $no = 0;
                                    foreach ($dataTransaksi as $data) :
                                    $no++;
                            ?>
                                <tr>
                                    <td class="text-center text-nowrap"><?= $no; ?></td>
                                    <td class="text-nowrap"><?= $data['nama']; ?></td>
                                    <td class="text-nowrap"><?= $data['nama_layanan']; ?></td>
                                    <td class="text-nowrap"><?= $data['berat'] . ' Kg'; ?></td>
                                    <td class="text-nowrap"><?= formatRupiah($data['total_harga']); ?></td>
                                    <td class="text-nowrap text-center"><?= $data['tanggal']; ?></td>
                                    <td class="text-uppercase text-center text-nowrap">
                                        <?php  
                                            if ($data['status'] == 'proses') {
                                        ?>
                                            <span class="badge badge-secondary"><?= $data['status']; ?></span>
                                        <?php  
                                            } else if ($data['status'] == 'selesai') {
                                        ?>
                                            <span class="badge badge-success"><?= $data['status']; ?></span>
                                        <?php  
                                            } else if ($data['status'] == 'diambil') {
                                        ?>
                                            <span class="badge badge-primary"><?= $data['status']; ?></span>
                                        <?php  
                                            }
                                        ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <center>
                                            <a href="struk_transaksi/cetak_struk.php?id=<?= $data['id_transaksi']; ?>" target="_blank" class="btn btn-primary btn-sm" title="cetak struk">Cetak</a>

                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalEditTransaksi"
                                            data-id="<?= $data['id_transaksi']; ?>"
                                            data-nama="<?= $data['id_pelanggan']; ?>"
                                            data-layanan="<?= $data['id_layanan']; ?>"
                                            data-berat="<?= $data['berat']; ?>"
                                            data-tanggal="<?= $data['tanggal']; ?>"
                                            data-status="<?= $data['status']; ?>">Edit</button>

                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalDeleteTransaksi<?= $data['id_transaksi']; ?>">Delete</button>
                                        </center>

                                        <!-- Modal hapus -->
                                        <div class="modal fade" id="exampleModalDeleteTransaksi<?= $data['id_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Transaksi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapusnya?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <a href="controllers/transaksiController.php?proses=hapus_transaksi&id=<?= $data['id_transaksi']; ?>" class="btn btn-primary">Hapus</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                                    endforeach;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->

<!-- Modal tambah -->
<div class="modal fade" id="exampleModalAddTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controllers/transaksiController.php?proses=tambah_transaksi" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputNamaPelanggan">Nama Pelanggan</label>
                        <select class="form-control" aria-label="Default select example" id="exampleInputNamaPelanggan" name="pelanggan" required>
                          <option value="" selected>-- Pilih Nama Pelanggan --</option>
                          <?php  
                            foreach (get_pelanggan() as $data) :   
                          ?>
                            <option value="<?= $data['id_pelanggan']; ?>"><?= $data['nama']; ?></option>
                          <?php  
                            endforeach;
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLayanan">Layanan</label>
                        <select class="form-control" aria-label="Default select example" id="exampleInputLayanan" name="layanan" required>
                          <option value="" selected>-- Pilih Layanan --</option>
                          <?php  
                            foreach (get_layanan() as $data) :   
                          ?>
                            <option value="<?= $data['id_layanan']; ?>"><?= $data['harga_per_kg']; ?> - <?= $data['nama_layanan']; ?></option>
                          <?php  
                            endforeach;
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputBerat">Berat (Kg)</label>
                        <input type="number" class="form-control" id="exampleInputBerat" placeholder="Masukkan Berat" name="berat" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTanggal">Tanggal</label>
                        <input type="date" class="form-control" id="exampleInputTanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStatus">Status</label>
                        <select class="form-control" aria-label="Default select example" id="exampleInputStatus" name="status" required>
                          <option value="" selected>-- Pilih Status --</option>
                          <option value="proses">Proses</option>
                          <option value="selesai">Selesai</option>
                          <option value="diambil">Diambil</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ubah -->
<div class="modal fade" id="exampleModalEditTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controllers/transaksiController.php?proses=ubah_transaksi" method="post">
                <div class="modal-body">
                    <input type="text" id="id" name="id" hidden>
                    <div class="form-group">
                        <label for="pelanggan">Nama Pelanggan</label>
                        <select class="form-control" aria-label="Default select example" id="pelanggan" name="pelanggan" required>
                          <?php  
                            foreach (get_pelanggan() as $data) :   
                          ?>
                            <option value="<?= $data['id_pelanggan']; ?>"><?= $data['nama']; ?></option>
                          <?php  
                            endforeach;
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="layanan">Layanan</label>
                        <select class="form-control" aria-label="Default select example" id="layanan" name="layanan" required>
                          <?php  
                            foreach (get_layanan() as $data) :   
                          ?>
                            <option value="<?= $data['id_layanan']; ?>"><?= $data['nama_layanan']; ?></option>
                          <?php  
                            endforeach;
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="berat">Berat (Kg)</label>
                        <input type="number" class="form-control" id="berat" placeholder="Masukkan Berat" name="berat" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" aria-label="Default select example" id="status" name="status" required>
                          <option value="proses">Proses</option>
                          <option value="selesai">Selesai</option>
                          <option value="diambil">Diambil</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>