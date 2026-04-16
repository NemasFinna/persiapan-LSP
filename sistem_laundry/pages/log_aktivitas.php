<?php  
    $barisDataLog = count(get_log());
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Log Aktivitas</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
              <h6 class="m-0 font-weight-bold text-primary">Riwayat Aktivitas Sistem</h6>
              <span class="d-none d-lg-block">Keterangan</span>
            </div>
            <div class="card-body mb-2">
              <?php  
                if ($barisDataLog == 0) {
              ?>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    Belum data riwayat log sistem
                  </li>
                </ul>
              <?php  
                } else {
              ?>
                <?php  
                  $dataLog = get_log();
                  foreach ($dataLog as $data) :
                ?>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between border-bottom">
                      <span><i class="far fa-clock mr-2"></i><?= $data['aktivitas']; ?></span> 
                      <span class="d-none d-lg-block"><?= time_ago($data['waktu']); ?></span>
                    </li>
                  </ul>
                <?php  
                  endforeach;
                ?>

                <div class="d-flex flex-column flex-lg-row justify-content-end">
                  <button type="button" class="btn btn-primary btn-sm mt-4" data-toggle="modal" data-target="#hapusriwayat">Hapus Riwayat</button>
                </div>
              <?php  
                }
              ?>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->

<!-- Modal hapus -->
<div class="modal fade" id="hapusriwayat" 
tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Log Sistem</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          Anda ingin menghapus seluruh riwayat log sistem?
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="controllers/penggunaController.php?proses=reset_log" 
          class="btn btn-primary">Hapus</a>
      </div>
      </div>
  </div>
</div>