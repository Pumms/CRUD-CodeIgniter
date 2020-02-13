<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Breadcrumb -->
    <ol class="breadcrumb border-left-secondary">
        <li class="breadcrumb-item text-capitalize" aria-current="page"><a href='<?= base_url($menu_breadcrumbs . '/'); ?>'><?= $menu_breadcrumbs; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>

    <div class="row">
        <div class="col-lg-8">

            <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <div class="row">
                <div class="col mb-3 ml-2">
                    <a href="<?= base_url('admin/tambah'); ?>" class="text-decoration-none">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-user-plus"></i> Tambah Role</button>
                    </a>
                </div>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($role as $r) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $r['role'] ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-user mr-1"></i>Access</a>
                                        <a href="<?= base_url('admin/edit/') . $r['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit mr-1"></i>Edit</a>
                                        <a href="<?= base_url('admin/hapus/') . $r['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus role?');"><i class=" far fa-trash-alt mr-1"></i>Hapus</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="RoleModal" tabindex="-1" role="dialog" aria-labelledby="RoleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RoleModal">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>