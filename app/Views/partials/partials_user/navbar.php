<nav class="navbar navbar-expand-lg navbar-light bg-transparent ml-4 mr-4">

  <a class="navbar-brand" href="<?= base_url('/') ?>">
    <img src="/assets/img/undraw_security_o890.svg" width="80" alt="logo">
  </a>

  <div class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
  </div>

  <div class="collapse navbar-collapse text-center " id="navbarSupportedContent">
    <ul class="navbar-nav mx-md-auto">

      <li class="nav-item active">
        <a class="nav-link text-dark" href="<?= base_url('/') ?>">Home</a>
      </li>
      <?php if (session()->id_user) : ?>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= base_url('admin/') ?>">Dashboard</a>
        </li>
      <?php endif; ?>
    </ul>
    <div class="auth">
      <?php if (session()->id_user) : ?>
        <a href="<?= base_url('voting') ?>" class="btn btn-warning">Mulai Voting</a>
      <?php else : ?>
        <a href="<?= base_url('login') ?>" class="btn btn-warning">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>