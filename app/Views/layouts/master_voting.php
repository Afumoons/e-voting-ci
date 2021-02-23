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

	<link rel="stylesheet" href="/assets/css/style.css">

	<?= $this->renderSection('css') ?>
</head>

<body>

	<div id="app">
		<?= $this->renderSection('content') ?>
	</div>
	<!-- Bootstrap -->
	<script src="/assets/bootstrap/jquery/jquery.min.js"></script>
	<script src="/assets/bootstrap/popper.js"></script>
	<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/e7d3e74a3e.js" crossorigin="anonymous"></script>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const burger = document.querySelector('div.navbar-toggler');
			const line1 = burger.querySelector('div.line1');
			const line2 = burger.querySelector('div.line2');
			const line3 = burger.querySelector('div.line3');
			burger.addEventListener('click', () => {
				line1.classList.toggle('active');
				line2.classList.toggle('active');
				line3.classList.toggle('active');
			});
		});
	</script>

	<?= $this->renderSection('script') ?>
</body>

</html>