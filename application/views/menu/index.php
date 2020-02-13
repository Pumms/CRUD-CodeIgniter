<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Breadcrumb -->
    <ol class="breadcrumb border-left-secondary">
        <li class="breadcrumb-item text-capitalize" aria-current="page"><a href='<?= base_url($menu_breadcrumbs . '/'); ?>'><?= $menu_breadcrumbs; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>

    <!-- Page Heading -->
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

    <div class="row">
        <div class="col mb-3 ml-2">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#MenuModal"><i class="fas fa-plus"></i> Tambah Menu</button>
        </div>
    </div>

    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $m['menu'] ?></td>
                                    <td>
                                        <a href="" class="btn btn-success btn-sm"><i class="fas fa-edit mr-1"></i>Edit</a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fas fa-folder-minus mr-1"></i>Hapus</a>
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


<!-- Modal -->
<div class="modal fade" id="MenuModal" tabindex="-1" role="dialog" aria-labelledby="MenuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MenuModal">Tambah Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>