<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Breadcrumb -->
    <ol class="breadcrumb border-left-secondary">
        <li class="breadcrumb-item text-capitalize" aria-current="page"><a href='<?= base_url($menu_breadcrumbs . '/'); ?>'><?= $menu_breadcrumbs; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('user/changepassword'); ?>
                    <div class="form-group">
                        <label for="currentpassword">Current Password</label>
                        <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="Current Password">
                        <?= form_error('currentpassword', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="newpassword">New Password</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword1" placeholder=" New Password">
                        <?= form_error('newpassword1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="newpassword2">Repeat Password</label>
                        <input type="password" class="form-control" id="newpassword2" name="newpassword2" placeholder="Repeat Password">
                        <?= form_error('newpassword2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->