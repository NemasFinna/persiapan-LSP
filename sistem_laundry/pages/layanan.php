<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Layanan</h1>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalAddLayanan"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</button>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Layanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap">No</th>
                                <th class="text-nowrap">Layanan</th>
                                <th class="text-nowrap">Harga per Kg</th>
                                <th class="text-nowrap text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $dataLayanan = get_layanan();
                                if (is_array($dataLayanan)) {
                                    $no = 0;
                                    foreach ($dataLayanan as $data) :
                                    $no++;
                            ?>
                                <tr>
                                    <td class="text-center text-nowrap"><?= $no; ?></td>
                                    <td class="text-nowrap"><?= $data['nama_layanan']; ?></td>
                                    <td class="text-nowrap"><?= formatRupiah($data['harga_per_kg']); ?></td>
                                    <td class="text-nowrap">
                                        <center>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalEditLayanan"
                                            data-id="<?= $data['id_layanan']; ?>"
                                            data-nama_layanan="<?= $data['nama_layanan']; ?>"
                                            data-harga="<?= $data['harga_per_kg']; ?>">Edit</button>

                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalDeleteLayanan<?= $data['id_layanan']; ?>">Delete</button>
                                        </center>
                                        <!-- Modal hapus -->
                                        <div class="modal fade" id="exampleModalDeleteLayanan<?= $data['id_layanan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Layanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapusnya?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <a href="controllers/layananController.php?proses=hapus_layanan&id=<?= $data['id_layanan']; ?>" class="btn btn-primary">Hapus</a>
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
<div class="modal fade" id="exampleModalAddLayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controllers/layananController.php?proses=tambah_layanan" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputLayanan">Nama Layanan</label>
                        <input type="text" class="form-control" id="exampleInputLayanan" placeholder="Masukkan Nama Layanan" name="nama_layanan" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputHarga">Harga Per Kg</label>
                        <input type="text" class="form-control" id="exampleInputHarga" placeholder="Masukkan Harga" name="harga" required>
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
<div class="modal fade" id="exampleModalEditLayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controllers/layananController.php?proses=ubah_layanan" method="post">
                <div class="modal-body">
                    <input type="text" id="id" name="id" hidden>
                    <div class="form-group">
                        <label for="layanan">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="layanan" name="nama_layanan" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">No Telepon</label>
                        <input type="text" class="form-control" id="harga" name="harga" required>
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