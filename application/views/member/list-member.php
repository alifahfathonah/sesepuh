<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Baru</a>
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Active</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($member as $m) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $m['name'] ?></td>
                            <td><?= $m['email'] ?></td>
                            <td><?= $m['role'] ?></td>
                            <?php if ($m['is_active'] == 1) {
                                    $status = '<span class="badge badge-primary">Active</span>';
                                } else {
                                    $status = '<span class="badge badge-warning">In active</span>';
                                } ?>
                            <td><?= $status ?></td>
                            <td><?= date('d F Y', $m['date_created']); ?></td>
                            <td>
                                <a href="#" class="badge badge-success">Edit</a>
                                <a href="<?= base_url('member/deleteMember/') . $m['id'] ?>" onclick="return myFunction()" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="neMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                    <button class="btn btn-primary" type="submit">Add New Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        return confirm('Apakah anda yakin akan menghapus ?');
    }
</script>