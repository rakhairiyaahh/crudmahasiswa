<body class="bg-primary" <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
                    </div>
                    <?= $this->session->flashdata('message'); ?>
                    <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="email" name="email"
                                value="<?= set_value('email') ?>" placeholder="Masukkan Alamat Email">
                            <?= form_error('email', '<small class="text-danger p1-3">', '</small>') ?>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" id="password"
                                value="<?= set_value('nama') ?>" placeholder="Password">
                            <?= form_error('password', '<small class="text-danger p1-3">', '</small>') ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block w-100">Login</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Lupa Password</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?= base_url(); ?>auth/registrasi">Buat Akun!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>