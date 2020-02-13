<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Breadcrumb -->
    <ol class="breadcrumb border-left-secondary">
        <li class="breadcrumb-item text-capitalize" aria-current="page"><a href='<?= base_url($menu_breadcrumbs . '/'); ?>'><?= $menu_breadcrumbs; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>

    <div class="row">
        <div class="col-lg-12">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger mb-2" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col mb-3 ml-2">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#SubMenuModal"><i class="fas fa-plus"></i> Tambah Submenu</button>
                </div>
            </div>

            <?= $this->session->flashdata('message'); ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sub Menu</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sub Menu</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($submenu as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $m['title'] ?></td>
                                        <td><?= $m['menu'] ?></td>
                                        <td><?= $m['url'] ?></td>
                                        <td><i class="<?= $m['icon'] ?> mr-1"></i><?= $m['icon'] ?></td>
                                        <?php if ($m['is_active'] == '1') : ?>
                                            <td><?= 'Active'; ?></td>
                                        <?php else : ?>
                                            <td><?= 'Not Active'; ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm"><i class="fas fa-edit mr-1"></i>Edit</a>
                                            <a href="" class="btn btn-danger btn-sm"><i class="far fa-trash-alt mr-1"></i>Hapus</a>
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

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="SubMenuModal" tabindex="-1" role="dialog" aria-labelledby="SubMenuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SubMenuModal">Tambah Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
                    </div>
                    <div class="form-group">
                        <select name="menu" id="menu" class="form-control">Menu
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="url" id="url" placeholder="Url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" id="is_active" checked>
                            <label for="is_active" class="form-check-label">Active ?</label>
                        </div>
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