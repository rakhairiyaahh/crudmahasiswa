<div class="content">
	<div class="container-fluid">
		<h1 class="h3 mb-4 text-gray-800">
			<br>
			<?php echo $judul; ?>
		</h1>
		<div class="row">
			<div class="col-md-6">
				<a href="<?= base_url('Buku/tambah') ?>" class="btn btn-info mb-2">Tambah Buku</a>
			</div>
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
				<table class="table">
					<thead>
						<tr>
							<td>No</td>
							<td>Nama Buku</td>
							<td>Nama_pengarang</td>
							<td>Nama_penerbit</td>
							<td>Kategori</td>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($buku as $us): ?>
							<tr>
								<td>
									<?= $i; ?>.
								</td>
								<td>
									<?= $us['nama_buku']; ?>
								</td>
								<td>
									<?= $us['nama_pengarang']; ?>
								</td>
								<td>
									<?= $us['nama_penerbit']; ?>
								</td>
								<td>
									<?= $us['kategori']; ?>
								</td>
								<td><img src="<?= base_url('assets/images/buku/') . $us['gambar']; ?>"
										style="width: 100px;" class="img-thumbnail"></td>
								<td>
									<a href="<?= base_url('Buku/hapus/') . $us['id']; ?>"
										class="badge badge-danger">Hapus</a>
									<a href="<?= base_url('Buku/edit/') . $us['id']; ?>"
										class="badge badge-warning">Edit</a>
								</td>
								<?php $i++; ?>
							<?php endforeach; ?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
