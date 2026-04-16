<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pelanggan</h1>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalAddPelanggan"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</button>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap">No</th>
                                <th class="text-nowrap">Nama Pelanggan</th>
                                <th class="text-nowrap">No Telepon</th>
                                <th class="text-nowrap">Alamat</th>
                                <th class="text-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $dataPelanggan = get_pelanggan();
                                if (is_array($dataPelanggan)) {
                                    $no = 0;
                                    foreach ($dataPelanggan as $data) :
                                    $no++;
                            ?>
                                <tr>
                                    <td class="text-center text-nowrap"><?= $no; ?></td>
                                    <td class="text-nowrap"><?= $data['nama']; ?></td>
                                    <td class="text-nowrap"><?= $data['no_hp']; ?></td>
                                    <td class="text-nowrap"><?= $data['alamat']; ?></td>
                                    <td class="text-nowrap">
                                        <center>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalEditPelanggan"
                                            data-id="<?= $data['id_pelanggan']; ?>"
                                            data-nama="<?= $data['nama']; ?>"
                                            data-telp="<?= $data['no_hp']; ?>"
                                            data-alamat="<?= $data['alamat']; ?>">Edit</button>
                                            
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalDeletePelanggan<?= $data['id_pelanggan']; ?>">Delete</button>
                                        </center>

                                        <!-- Modal hapus -->
                                        <div class="modal fade" id="exampleModalDeletePelanggan<?= $data['id_pelanggan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pelanggan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapusnya?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <a href="controllers/pelangganController.php?proses=hapus_pelanggan&id=<?= $data['id_pelanggan']; ?>" class="btn btn-primary">Hapus</a>
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
<div class="modal fade" id="exampleModalAddPelanggan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controllers/pelangganController.php?proses=tambah_pelanggan" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="exampleInputNama" placeholder="Masukkan Nama Pelanggan" name="nama_pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNoTelp">No Telepon</label>
                        <input type="text" class="form-control" id="exampleInputNoTelp" placeholder="Masukkan No Telp" name="no_telp" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlAlamat">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlAlamat" rows="3" placeholder="Masukkan Alamat" name="alamat" required></textarea>
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
<div class="modal fade" id="exampleModalEditPelanggan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controllers/pelangganController.php?proses=ubah_pelanggan" method="post">
                <div class="modal-body">
                    <input type="text" id="id" name="id" hidden>
                    <div class="form-group">
                        <label for="nama">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama" name="nama_pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="noTelp">No Telepon</label>
                        <input type="text" class="form-control" id="noTelp" name="no_telp" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" rows="3" name="alamat" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>