<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">
		<br>
		<?php echo $judul; ?>
	</h1>
	<div class="row ">
		<div class="col-md-7">
			<div class="card">
				<div class="card-header justify-content-center">
					Form Ubah Data Buku
				</div>
			</div>

			<div class="card-body">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?= $buku['id']; ?>">
					<div class="form-group">
						<label for="nama_prodi">Nama Buku</label>
						<input value="<?= set_value('nama_buku'); ?>" type="text" name="nama_buku" class="form-control"
							id="nama_buku" placeholder="Nama Buku">
						<?= form_error('nama_buku', '<small class="text-danger pl-3">', '<small>'); ?>
					</div>
					<div class="form-group">
						<label for="nama_pengarang">Nama Pengarang</label>
						<input value="<?= set_value('nama_pengarang'); ?>" type="text" name="nama_pengarang" class="form-control"
							id="nama_pengarang" placeholder="Nama Pengarang">
						<?= form_error('nama_pengarang', '<small class="text-danger pl-3">', '<small>'); ?>
					</div>
					<div class="form-group">
						<label for="nama_penerbit">Nama penerbit</label>
						<input value="<?= set_value('nama_penerbit'); ?>" type="text" name="nama_penerbit" class="form-control"
							id="nama_penerbit" placeholder="Nama Penerbit">
						<?= form_error('nama_penerbit', '<small class="text-danger pl-3">', '<small>'); ?>
					</div>
					<div class="form-group">
						<label for="kategori">Kategori</label>
						<input value="<?= set_value('kategori'); ?>" type="text" name="kategori"
							class="form-control" id="kategori" placeholder="Kategori">
						<?= form_error('kategori', '<small class="text-danger pl-3">', '<small>'); ?>
					</div>
					<a href="<?= base_url('Buku') ?>" class="btn btn-danger">Tutup</a>
					<button type="submit" name="tambah" class="btn btn-primary float-right">Ubah
						Buku</button>
				</form>
			</div>
		</div>
	</div>
