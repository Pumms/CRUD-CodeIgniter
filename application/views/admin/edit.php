<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Breadcrumb -->
    <ol class="breadcrumb border-left-secondary">
        <li class="breadcrumb-item text-capitalize" aria-current="page"><a href='<?= base_url($menu_breadcrumbs . '/'); ?>'><?= $menu_breadcrumbs; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>

    <div class="row">
        <div class="col mb-3 ml-2">
            <a href="<?= base_url('admin/role'); ?>" class="text-decoration-none">
                <button class="btn btn-sm btn-primary"><i class="fas fa-angle-left"></i> Kembali ke Menu Role</button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group row">
                            <label for="role" class="col-sm-2 col-form-label">Nama Role</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id" value="<?= $role['id']; ?>">
                                <input type="text" class="form-control" id="role" placeholder="Role" name="role" value="<?= $role['role']; ?>">
                                <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->