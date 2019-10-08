<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Baru</a> -->
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
                                <a href="#" data-id="<?= $m['id']; ?>" data-target="#edit-member" data-toggle="modal" class="badge badge-success btn-edit">Edit</a>
                                <a href="<?= base_url('member/delete/') . $m['id'] ?>" onclick="return myFunction()" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="edit-member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('member/update') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Role</label>
                        <select name="role" id="role" class="form-control" data-placeholder="Select One" id="role">
                            <option value=""></option>
                            <?php foreach ($role as $key) { ?>
                                <option value="<?= $key['id'] ?>"><?= $key['role'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script>
    function myFunction() {
        return confirm('Apakah anda yakin akan menghapus ?');
    }

    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        $.ajax({
            url: "<?= base_url('member/editMember/') ?>" + id,
            type: "post",
            dataType: 'JSON',
            success: function(data) {
                $('#email').val(data.email);
                $('#name').val(data.name);
                $('#role').val(data.role_id);
            }
        })
    });
</script>