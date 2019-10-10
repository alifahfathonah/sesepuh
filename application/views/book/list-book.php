<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add-book">Add New Book</a>
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Beli</th>
                        <th scope="col">Penullis</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($book as $m) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $m['date_buy'] ?></td>
                            <td><?= $m['author'] ?></td>
                            <td><?= $m['title'] ?></td>
                            <td><?= $m['publisher'] ?></td>
                            <td><?= $m['years'] ?></td>
                            <td><?= $m['isbn'] ?></td>
                            <td><?= $m['qty'] ?></td>
                            <td><?= $m['descrip'] ?></td>
                            <td>
                                <a href="#" data-id="<?= $m['id']; ?>" data-target="#edit-member" data-toggle="modal" class="badge badge-success btn-edit">Edit</a>
                                <a href="<?= base_url('book/delete/') . $m['id'] ?>" onclick="return myFunction()" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="add-book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('book/add') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tanggal Beli</label>
                        <input type="date" class="form-control" id="date_buy" name="date_buy">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Penulis</label>
                        <input type="text" class="form-control" name="author" id="author">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Judul</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Publisher</label>
                        <input type="text" class="form-control" name="years" id="years">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tahun</label>
                        <input type="text" class="form-control" name="publisher" id="publisher">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Jumlah</label>
                        <input type="text" class="form-control" name="qty" id="qty">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Deskcripsi</label>
                        <textarea name="descrip" id="descrip" class="form-control"></textarea>
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