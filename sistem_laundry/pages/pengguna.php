<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil Pengguna</h1>
</div>

<div class="row">
  <div class="col-12 mb-3 col-xl-4 mb-xl-0">
    <div class="card shadow mb-5 h-100">
      <div class="card-body box-profile d-flex align-items-center justify-content-center">
        <div>
          <div class="text-center mb-4">
            <img class="profile-user-img img-fluid img-circle" src="assets/img/user.png" alt="User profile picture" width="135">
          </div>
          <?php  
            $pengguna = get_pengguna();
            foreach ($pengguna as $data) :
          ?>
            <h4 class="profile-username text-center mt-3"><?= $data['nama_pengguna']; ?></h4>
            <p class="text-muted text-center text-uppercase"><?= $data['level']; ?></p>
          <?php  
            endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 mb-5 col-xl-8 mb-xl-0">
    <div class="card shadow">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
      </div>
      <!-- /.card-header -->
      <?php  
          $profilPengguna = get_pengguna();
          foreach ($profilPengguna as $data) :
      ?>
        <div class="card-body">
          <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

          <p class="text-muted">
            <?= $data['email']; ?>
          </p>

          <hr>

          <strong><i class="fas fa-user mr-1"></i> Username</strong>

          <p class="text-muted"><?= $data['username']; ?></p>

          <hr>

          <strong><i class="fas fa-lock mr-1"></i> Password</strong>

          <p class="text-muted">
            *************
          </p>

          <hr>

          <div class="d-flex flex-column justify-content-xl-end mt-2 flex-xl-row">
            <button type="button" class="btn btn-primary btn-sm mr-xl-1 mb-2 mb-xl-0" 
            data-toggle="modal" 
            data-target="#exampleModalEditPengguna"
            data-id="<?= $data['id_pengguna']; ?>"
            data-nama_pengguna="<?= $data['nama_pengguna']; ?>"
            data-email="<?= $data['email']; ?>"
            data-username="<?= $data['username']; ?>"><b>Ubah Pengguna</b></button>

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalEditPassword"><b>Ubah Password</b></button>
          </div>
        </div>
        <!-- /.card-body -->
      <?php  
        endforeach;
      ?>
    </div>
  </div>
</div>

<!-- Modal ubah pengguna -->
<div class="modal fade" id="exampleModalEditPengguna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="controllers/penggunaController.php?proses=ubah_pengguna" method="post">
            <div class="modal-body">
                <input type="text" id="id" name="id" hidden>
                <div class="form-group">
                    <label for="nama_pengguna">Nama Pengguna</label>
                    <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
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

<!-- Modal ubah password -->
<div class="modal fade" id="exampleModalEditPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="controllers/penggunaController.php?proses=ubah_password" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="username_admin">Username</label>
                    <input type="text" class="form-control" id="username_admin" name="username" placeholder="Masukkan Username Anda" required>
                </div>
                <div class="form-group">
                    <label for="passwordlama">Masukkan Password Lama</label>
                    <input type="password" class="form-control" id="passwordlama" name="password_lama" placeholder="Password Lama" required>
                </div>
                <div class="form-group">
                    <label for="passwordBaru">Masukkan Password Baru</label>
                    <input type="password" class="form-control" id="passwordBaru" name="password_baru" placeholder="Password Baru" required>
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
