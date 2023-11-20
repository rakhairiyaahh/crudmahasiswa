
<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path



class Buku extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Buku_model');
		$this->load->model('User_model');
	}

	public function index()
	{
		$data['judul'] = "Halaman Buku";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['buku'] = $this->Buku_model->get();
		$this->load->view("layout/header", $data);
		$this->load->view(" buku/vw_buku", $data);
		$this->load->view("layout/footer", $data);
	}
	public function tambah()
	{

		$data['judul'] = "Halaman Tambah Buku";
		$data['user'] = $this->db->get_where('user', [
			'email' =>
				$this->session->userdata('email')
		])->row_array();
		$data['buku'] = $this->Buku_model->get();
		$this->form_validation->set_rules('nama_buku', 'Nama_buku', 'required', [
			'required' => 'Nama buku Wajib di isi'
		]);
		$this->form_validation->set_rules('nama_pengarang', 'Nama_pengarang', 'required', [
			'required' => 'Nama pengarang Wajib di isi'
		]);
		$this->form_validation->set_rules('nama_penerbit', 'Nama_penerbit', 'required', [
			'required' => 'Nama penerbit Wajib di isi'
		]);
		$this->form_validation->set_rules('kategori', 'Kategori', 'required', [
			'required' => 'Kategori Wajib di isi'
        ]);
		if ($this->form_validation->run() == false) {
			$this->load->view("layout/header", $data);
			$this->load->view("buku/vw_tambah_buku", $data);
			$this->load->view("layout/footer", $data);
		} else {
			$data = [
				'nama_buku' => $this->input->post('nama_buku'),
				'nama_pengarang' => $this->input->post('nama_pengarang'),
				'nama_penerbit' => $this->input->post('nama_penerbit'),
				'kategori' => $this->input->post('kategori')
			];
			$upload_image = $_FILES['gambar']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/buku/';


				$this->load->library('upload', $config);
				if ($this->upload->do_upload('gambar')) {
					$new_image = $this->upload->data('file_name');
					$this->db->set('gambar', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}
			$this->Buku_model->insert($data, $upload_image);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data
Buku Berhasil Ditambah!</div>');
			redirect('Buku');
		}
	}

	public function edit($id)
	{
		$data['judul'] = "Halaman Edit Buku";
		$data['Buku'] = $this->Buku_model->getById($id);
		$data['user'] = $this->db->get_where('user', [
			'email' =>
				$this->session->userdata('email')
		])->row_array();
		$this->form_validation->set_rules('nama_buku', 'Nama_buku', 'required', [
			'required' => 'Nama buku Wajib di isi'
		]);
		$this->form_validation->set_rules('nama_pengarang', 'Nama_pengarang', 'required', [
			'required' => 'Nama pengarang Wajib di isi'
		]);
		$this->form_validation->set_rules('nama_penerbit', 'Nama_penerbit', 'required', [
			'required' => 'Nama penerbit Wajib di isi'
		]);
		$this->form_validation->set_rules('kategori', 'Kategori', 'required', [
			'required' => 'Kategori Wajib di isi'
        ]);
		if ($this->form_validation->run() == false) {
			$this->load->view("layout/header", $data);
			$this->load->view("buku/vw_ubah_buku", $data);
			$this->load->view("layout/footer");
		} else {
			$data = [
				'nama_buku' => $this->input->post('nama_buku'),
				'nama_pengarang' => $this->input->post('nama_pengarang'),
				'nama_penerbit' => $this->input->post('nama_penerbit'),
				'kategori' => $this->input->post('kategori')
			];
			$upload_image = $_FILES['gambar']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/buku/';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('gambar')) {
					$old_image = $data['buku']['gambar'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/buku/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('gambar', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}
			$id = $this->input->post('id');
			$this->Buku_model->update(['id' => $id], $data, $upload_image);
			$this->session->set_flashdata('message', '<div class="alert alert-success"
role="alert">Data Buku Berhasil DiUbah!</div>');
			redirect('Buku');
		}
	}
	public function hapus($id)
	{
		$this->Buku_model->delete($id);
		$error = $this->db->error();
		$this->session->set_flashdata('message', '<div class="alert alert-success"
role="alert">Data Buku Berhasil dihapus!</div>');
		redirect('Buku');
	}

}
