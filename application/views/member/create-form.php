<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('member/telegram') ?>" method="post">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama</th>
                            <th colspan="3" style="text-align:center;">Tidak Laporan / Hari</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($member as $m) { ?>
                            <tr>

                                <td align="center">
                                    <input type="hidden" name="id[]" id="id" value="<?= $m['id']; ?>">
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <input type="hidden" name="name[]" id="name" value="<?= $m['name']; ?>">
                                    <?= $m['name'] ?>
                                </td>
                                <td align="center">
                                    <input type="radio" value="1" name="check[]" id="check1">
                                </td>
                                <td align="center">
                                    <input type="radio" value="2" name="check[]" id="check2">
                                </td>
                                <td align="center">
                                    <input type="radio" value="3" name="check[]" id="check3">
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Quotes</label>
                    <textarea class="form-control" id="quotes" name="quotes"></textarea>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">By</label>
                    <input type="text" class="form-control" id="by_" name="by_">
                </div>
                <button type="submit" class="btn btn-primary mb-3 float-right" data-toggle="modal" data-target="#Create-form">Send</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Modal -->

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