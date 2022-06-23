<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
  <div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
        </div>
        <div class="card-body">
          <div>
            <?php flash(); ?>
          </div>
          <form action="<?= URLROOT; ?>/user/changeProfile" method="POST" enctype="multipart/form-data">
          <div class="form-group row">
            <div class="col-sm-12 avatar">
              <div class="avatar-upload">
                  <div class="avatar-edit">
                      <input type="file" id="imageUpload" name="avatar" onchange="return avatarUpload()" accept=".png, .jpg, .jpeg" />
                      <label for="imageUpload"><i class="fa fa-pen"></i></label>
                  </div>
                  <div class="avatar-preview">
                      <div id="imagePreview" style="background-image: url(<?= URLROOT; ?>/img/avatar/<?php echo ($_SESSION['avatar']) ? $_SESSION['avatar'] : 'boy.png'; ?>);">
                      </div>
                  </div>
                  </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="nip" class="col-sm-3 col-form-label">NIP</label>
              <div class="col-sm-9">
                <input type="text" name="nip" class="form-control" id="nip" placeholder="Email" readonly value="<?= $data['user']->nip ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="username" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <input type="text" name="username" class="form-control" id="username" value="<?= $data['user']->username ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" id="nama" value="<?= $data['user']->nama ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="no_telp" class="col-sm-3 col-form-label">No Telp/WA</label>
              <div class="col-sm-9">
                <input type="text" name="no_telp" class="form-control" id="no_telp" value="<?= $data['user']->no_telp ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" name="email" class="form-control" id="golongan" value="<?= $data['user']->email ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="golongan" class="col-sm-3 col-form-label">Golongan</label>
              <div class="col-sm-9">
                <input type="text" name="golongan" class="form-control" id="golongan" value="<?= $data['user']->golongan ?>" >
              </div>
            </div>
            <div class="form-group row">
              <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <input type="text" name="jabatan" class="form-control" id="jabatan" value="<?= $data['user']->jabatan ?>" >
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Perbarui</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
  <div class="col-lg-6">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>
        </div>
        <div class="card-body">
          <div>
            <?php flash(); ?>
          </div>
          <form action="<?= URLROOT; ?>/user/changePassword" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="passwordSaatIni">Password saat ini</label>
              <input type="password" name="password" class="form-control" id="passwordSaatIni" aria-describedby="emailHelp"
                placeholder="Password saat ini">
            </div>
            <div class="form-group">
              <label for="passwordBaru">Password Baru</label>
              <input type="password" name="password_baru" class="form-control" id="passwordBaru" placeholder="Password Baru">
            </div>
            <div class="form-group">
              <label for="konfPasswordBaru">Konfirmasi Password Baru</label>
              <input type="password" name="konfirmasi_password_baru" class="form-control" id="konfPasswordBaru" placeholder="Konfirmasi Password Baru">
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
          </form>
        </div>
      </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>