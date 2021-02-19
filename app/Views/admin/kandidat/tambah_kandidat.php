<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/summernote/summernote.min.css">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-8">
				<?= form_open_multipart('admin/kandidat/add') ?>

				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama', '', true) ?>">
				</div>

				<div class="form-group">
					<label for="visisummernote">Visi</label>
					<textarea name="visi" id="visisummernote" class="summernote-simple"></textarea>
				</div>

				<div class="form-group">
					<label for="misisummernote">Misi</label>
					<textarea id="misisummernote" class="summernote-simple" name="misi"></textarea>
				</div>

				<div class="form-group">
					<label for="level">Jurusan</label>
					<select class="custom-select" id="jurusan" name="jurusan">
						<?php foreach ($jurusan as $item) : ?>
							<!-- Jika admin bisa menambahkan semua -->
							<?php if (session()->id_level == 1) : ?>
								<option value="<?= $item['id_jurusan'] ?>"><?= $item['jurusan'] ?></option>
							<?php else : ?>
								<!-- Cek sesuai jurusan -->
								<?php if ($item['id_jurusan'] == session()->id_jurusan) : ?>
									<option value="<?= $item['id_jurusan'] ?>"><?= $item['jurusan'] ?></option>
								<?php endif; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="level">Jenis Ormawa</label>
					<select class="custom-select" id="ormawa" name="ormawa">
						<option value="bem">Badan Eksekutif</option>
						<option value="blm">Badan Legislatif</option>
					</select>
				</div>
				<div class="form-group">
					<label for="avatar">Avatar</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="avatar" name="avatar">
						<label class="custom-file-label" for="avatar">Choose file</label>
					</div>
				</div>


				<button type="submit" class="btn btn-primary">Submit</button>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="/assets/summernote/summernote.min.js"></script>

<script>
	$(document).ready(function() {
		// show file selected in bootstrap form
		$('#avatar').on('change', function() {
			var fileName = $(this).val();
			$(this).next('.custom-file-label').html(fileName);
		});
	});
</script>
<?= $this->endSection() ?>