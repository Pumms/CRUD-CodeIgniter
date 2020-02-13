<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900">Change Password for</h1>
                            <h5 class="mb-4"><?= $this->session->userdata('email_user'); ?></h5>
                        </div>
                        <form class="user" method="POST" action="<?= base_url('auth/changepassword'); ?>">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                                <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button class="btn btn-primary btn-block">
                                Change Password
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>