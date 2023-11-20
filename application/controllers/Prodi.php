<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Prodi extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Prodi_model');

  }

  public function index()
  {
    $data['judul'] = "Halaman Prodi";
    $data['prodi'] = $this->Prodi_model->get();

    $this->load->view("layout/header");
    $this->load->view("prodi/vw_prodi", $data);
    $this->load->view("layout/footer");
  }
  public function tambah()
  {
    $data['judul'] = "Halaman Tambah Prodi";
    $data['user'] = $this->db->get_where('user',['email'=>
    $this->session->userdata('email')])->row_array();

    $data['prodi']=$this->Prodi_model->get();
    $this->form_validation->set_rules('nama','Nama Prodi','required',[
      'required' => 'Nama prodi wajib diisi'
    ]);

   $this->form_validation->set_rules('ruangan','Ruangan','required',[
      'required' => 'Ruangan wajib diisi'
    ]);

   $this->form_validation->set_rules('jurusan','Jurusan','required',[
      'required' => 'Jurusan wajib diisi'
    ]);

    $this->form_validation->set_rules('akreditasi','Akreditasi','required',[
      'required' => 'Akreditasi wajib diisi'
    ]);

    $this->form_validation->set_rules('nama_kaprodi','Nama Kaprodi','required',[
      'required' => 'Nama Kaprodi wajib diisi'
    ]);
    
    $this->form_validation->set_rules('tahun_berdiri', 'Tahun Berdiri', 'required|integer', [
      'required' => 'Tahun Berdiri Mahasiswa Wajib di isi',
      'integer' => 'Tahun Berdiri harus Angka'
    ]);
      
    $this->form_validation->set_rules('output_lulusan', 'Output Lulusan', 'required', [
      'required' => 'Output Lulusan Mahasiswa Wajib di isi',
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view("layout/header", $data);
      $this->load->view("prodi/vw_tambah_prodi", $data);
      $this->load->view("layout/footer");
    } else {
      $data = [
        'nama' => $this->input->post('nama'),
        'ruangan' => $this->input->post('ruangan'),
        'jurusan' => $this->input->post('jurusan'),
        'akreditasi' => $this->input->post('akreditasi'),
        'nama_kaprodi' => $this->input->post('nama_kaprodi'),
        'tahun_berdiri' => $this->input->post('tahun_berdiri'),
        'output_lulusan' => $this->input->post('output_lulusan'),
      ];
      $this->Prodi_model->insert($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success"
      role="alert">Data Prodi Berhasil Ditambah!</div>');
      redirect('Prodi');
    };
  }
  
  public function edit($id){

$data['judul'] = "Halaman Edit Mahasiswa";
$data['prodi'] = $this->Prodi_model->getById($id);
$data['user'] = $this->db->get_where('user', ['email' =>
$this->session->userdata('email')])->row_array();

$data['prodi']=$this->Prodi_model->get();
    $this->form_validation->set_rules('nama','Nama Prodi','required',[
      'required' => 'Nama prodi wajib diisi'
    ]);

   $this->form_validation->set_rules('ruangan','Ruangan','required',[
      'required' => 'Ruangan wajib diisi'
    ]);

   $this->form_validation->set_rules('jurusan','Jurusan','required',[
      'required' => 'Jurusan wajib diisi'
    ]);

    $this->form_validation->set_rules('akreditasi','Akreditasi','required',[
      'required' => 'Akreditasi wajib diisi'
    ]);

    $this->form_validation->set_rules('nama_kaprodi','Nama Kaprodi','required',[
      'required' => 'Nama Kaprodi wajib diisi'
    ]);
    
    $this->form_validation->set_rules('tahun_berdiri', 'Tahun Berdiri', 'required|integer', [
      'required' => 'Tahun Berdiri Mahasiswa Wajib di isi',
      'integer' => 'Tahun Berdiri harus Angka'
    ]);
      
    $this->form_validation->set_rules('output_lulusan', 'Output Lulusan', 'required', [
      'required' => 'Output Lulusan Mahasiswa Wajib di isi',
    ]);
if ($this->form_validation->run() == false) {
$this->load->view("layout/header", $data);
$this->load->view("mahasiswa/vw_ubah_mahasiswa", $data);
$this->load->view("layout/footer");
} else {
$data = [
'nama' => $this->input->post('nama'),
'nim' => $this->input->post('nim'),
'email' => $this->input->post('email'),
'prodi' => $this->input->post('prodi'),
'alamat' => $this->input->post('alamat'),
'jenis_kelamin' => $this->input->post('jenis_kelamin'),
'no_hp' => $this->input->post('no_hp'),
'asal_sekolah' => $this->input->post('asal_sekolah'),
];
$id = $this->input->post('id');
$this->Mahasiswa_model->update(['id' => $id], $data);
$this->session->set_flashdata('message', '<div class="alert alert-success"
role="alert">Data Mahasiswa Berhasil DiUbah!</div>');
redirect('Mahasiswa');
}
  }

  public function hapus($id)
  {
  $this->Prodi_model->delete($id);
  $error = $this->db->error();
  if ($error['code'] != 0) {
  $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon
  fas fa-info-circle"></i>Data Prodi tidak dapat dihapus (sudah berelasi)!</div>');
  } else {
  $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i
  class="icon fas fa-check-circle"></i>Data Prodi Berhasil Dihapus!</div>');
  }
  redirect('Prodi');
}
}

