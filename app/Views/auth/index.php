<?= $this->extend('layouts/master_auth') ?>

<?= $this->section('title') ?>
<?= esc($title); ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<p class="text-muted">Silahkan masuk dengan akun anda.</p>

<!-- untuk form validasi error -->
<?= $this->include('partials/msg_validation') ?>

<form method="POST" action="<?= base_url('login') ?>">
  <?= csrf_field() ?>
  <div class="form-group">
    <label for="npm">npm</label>
    <input id="npm" type="text" class="form-control" name="npm" tabindex="1" value="<?= set_value('npm', '', true) ?>" required>
    <div class="invalid-feedback">
      npm tidak boleh kosong
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
  <a href="<?= base_url('register'); ?>">register</a>
  <div class="form-group text-right">
    <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
      Login
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