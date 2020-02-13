<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password ?</h1>
                                    <p class="mb-4">Just enter your email address below and we'll send you a link to reset your password!</p>
                                </div>
                                <?= $this->session->flashdata('message') ?>
                                <form class="user" method="POST" action="<?= base_url('auth/forgotpassword') ?>">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button class="btn btn-primary btn-block">
                                        Forgot Password
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

    </div>

</div>