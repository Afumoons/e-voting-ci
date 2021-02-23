<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $this->renderSection('title') ?></title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/stisla/assets/css/style.css">
  <link rel="stylesheet" href="/assets/stisla/assets/css/components.css">
</head>

<body>

  <style>
    .min-vh-100 {
      min-height: 101vh !important;
    }
  </style>

  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <h4 class="text-dark font-weight-normal">Selamat Datang Di <span class="font-weight-bold">Evoting App</span></h4>

            <?= $this->renderSection('content') ?>

            <div class="text-center mt-5 text-small">
              Copyright &copy; Evoting App. Design with love by BLM Fasilkom.
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="assets/img/login-bg.webp">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">Hallo,</h1>
                <h5 class="font-weight-normal text-muted-transparent">Surabaya, Indonesia</h5>

                <div id="digital-clock" class="font-weight-bold text-muted-transparent">
                  <p id="time"></p>
                  <p id="date"></p>
                </div>
              </div>
              Photo by <a class="text-light bb" href="#">Justin Kauffman</a> on <a class="text-light bb" href="#">Unsplash</a>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>

  <!-- Bootstrap -->
  <script src="/assets/bootstrap/jquery/jquery.min.js"></script>
  <script src="/assets/bootstrap/popper.js"></script>
  <script src="/assets/bootstrap/js/bootstrap.min.js"></script>

  <script src="/assets/nicescroll/jquery.nicescroll.js"></script>
  <script src="/assets/stisla/assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="/assets/stisla/assets/js/scripts.js"></script>
  <script src="/assets/stisla/assets/js/custom.js"></script>

  <?= $this->renderSection('script') ?>
</body>

</html>