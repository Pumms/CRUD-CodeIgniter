<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Breadcrumb -->
    <ol class="breadcrumb border-left-secondary">
        <li class="breadcrumb-item text-capitalize" aria-current="page"><a href='<?= base_url($menu_breadcrumbs . '/'); ?>'><?= $menu_breadcrumbs; ?></a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="<?= base_url('admin/role'); ?>">Role</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>

    <div class="row">
        <div class="col mb-3 ml-2">
            <a href="<?= base_url('admin/role'); ?>" class="text-decoration-none">
                <button class="btn btn-sm btn-primary"><i class="fas fa-angle-left"></i> Kembali ke Menu Role</button>
            </a>
        </div>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-shield"></i> &nbsp;<?= $role['role']; ?></h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu</th>
                                <th scope="col" class="text-center">Access</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $m['menu'] ?></td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                        </div>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->