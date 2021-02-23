<?= $this->extend('layouts/master_auth') ?>

<?= $this->section('title') ?>
<?= esc($title); ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<p class="text-muted">Silahkan register akun anda menggunakan NPM.</p>

<!-- untuk form validasi error -->
<?= $this->include('partials/msg_validation') ?>

<form method="POST" action="<?= base_url('register') ?>">
  <?= csrf_field() ?>

  <div class="form-group">
    <label for="npm">NPM</label>
    <input id="npm" type="text" class="form-control" name="npm" tabindex="1" value="<?= set_value('npm', '', true) ?>" required>
    <div class="invalid-feedback">
      NPM tidak boleh kosong
    </div>
  </div>

  <div class="form-group">
    <label for="nama">nama</label>
    <input id="nama" type="text" class="form-control" name="nama" tabindex="1" value="<?= set_value('nama', '', true) ?>" required>
    <div class="invalid-feedback">
      Nama tidak boleh kosong
    </div>
  </div>

  <div class="form-group">
    <div class="d-block">
      <label for="password" class="control-label">Password</label>
    </div>
    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
    <div class="invalid-feedback">
      password tidak boleh kosong
    </div>
  </div>
  <div class="form-group">
    <div class="d-block">
      <label for="password2" class="control-label">Masukkan kembali Password</label>
    </div>
    <input id="password2" type="password" class="form-control" name="password2" tabindex="2" required>
    <div class="invalid-feedback">
      password tidak boleh kosong
    </div>
  </div>
  <a href="<?= base_url('login'); ?>">login</a>
  <div class="form-group text-right">
    <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
      Register
    </button>
  </div>

</form>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  window.setInterval(ut, 1000);

  function ut() {
    var d = new Date();
    document.getElementById("time").innerHTML = d.toLocaleTimeString();
    document.getElementById("date").innerHTML = d.toLocaleDateString();
  }
</script>
<?= $this->endSection() ?>