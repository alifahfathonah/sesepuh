<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Form Report</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('report/save_report'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="kode" name="kode" placeholder="kode user">
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control form-control-user" id="tgl_transaksi" name="tgl_transaksi" placeholder="date_transaksi">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="jumlah" name="jumlah" placeholder="Jumlah">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Submit
                            </button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Report</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td rowspan="2" style="text-align:center;">name</td>
                            <td colspan="<?= count($data) + 1 ?>" style="text-align:center;">Bulan</td>
                        </tr>
                        <tr>
                            <!-- <th>Name</th> -->
                            <?php foreach ($data as $key => $value) { ?>
                                <th style="text-align:center;"><?= date('d', strtotime($value->tgl_transaksi)); ?></th>
                            <?php } ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($name as $key => $userid) {
                            // $tgl = $value->tgl_transaksi;
                            $user = $userid->user_id;
                            ?>
                            <tr>
                                <td style="text-align:center;"><?= $user; ?></td>
                                <?php
                                foreach ($data as $key => $hasil) {
                                    if ($user == $hasil->user_id) {
                                        echo '<td style="text-align:center;">' . $hasil->jumlah . '</td>';
                                    } else {
                                        echo '<td style="text-align:center;">0</td>';
                                    }
                                } ?>

                                <th><?= $userid->total ?></th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
foreach ($yudi as $key => $va) {
    $jml[] = $va->jumlah;
    $tgl[] = $va->tanggal;
}
// print_r($tgl);
?>
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling

    // Area Chart Example
    var ctx = document.getElementById("chart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($jml); ?>,
            datasets: [{
                label: "Earnings",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: <?= json_encode($tgl); ?>
            }],
        }
    });
</script>