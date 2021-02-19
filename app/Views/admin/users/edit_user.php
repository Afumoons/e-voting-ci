<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-6">
				<form action="<?= base_url('admin/user/edit/' . $user['id_user']) ?>" method="POST">
					<?= csrf_field(); ?>

					<input type="hidden" name="id" value="<?= $user['id_user'] ?>">

					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" class="form-control" name="nama" id="nama" value="<?= $user['nama'] ?>">
					</div>

					<div class="form-group">
						<label for="level">Level</label>
						<select class="custom-select" id="level" name="level">
							<?php foreach ($level as $item) : ?>
								<!-- Jika admin bisa menambahkan admin -->
								<?php if (session()->id_level == 1) : ?>
									<?php if ($item['id_level'] >= session()->id_level) : ?>
										<option value="<?= $item['id_level'] ?>" <?= $user['id_level'] == $item['id_level'] ? 'selected=""' : ''; ?>><?= $item['level'] ?></option>
									<?php endif; ?>
								<?php else : ?>
									<?php if ($item['id_level'] > session()->id_level) : ?>
										<option value="<?= $item['id_level'] ?>" <?= $user['id_level'] == $item['id_level'] ? 'selected=""' : ''; ?>><?= $item['level'] ?></option>
									<?php endif; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>