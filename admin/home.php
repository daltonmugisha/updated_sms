<h1 class="">Welcome to
    <?php echo $_settings->info('name') ?>
</h1>
<hr>
<div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-light shadow">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PO Records</span>
                    <span class="info-box-number text-right">
                        <?php
                        echo $conn->query("SELECT * FROM `purchase_order_list`")->num_rows;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-light shadow">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-boxes"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Receiving Records</span>
                    <span class="info-box-number text-right">
                        <?php
                        echo $conn->query("SELECT * FROM `receiving_list`")->num_rows;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-light shadow">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-exchange-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">BO Records</span>
                    <span class="info-box-number text-right">
                        <?php
                        echo $conn->query("SELECT * FROM `back_order_list`")->num_rows;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-light shadow">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-undo"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Return Records</span>
                    <span class="info-box-number text-right">
                        <?php
                        echo $conn->query("SELECT * FROM `return_list`")->num_rows;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-light shadow">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales Records</span>
                    <span class="info-box-number text-right">
                        <?php
                        echo $conn->query("SELECT * FROM `sales_list`")->num_rows;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-light shadow">
                <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-truck-loading"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Suppliers</span>
                    <span class="info-box-number text-right">
                        <?php
                        echo $conn->query("SELECT * FROM `supplier_list` where `status` = 1")->num_rows;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-light shadow">
                <span class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-th-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Items</span>
                    <span class="info-box-number text-right">
                        <?php
                        echo $conn->query("SELECT * FROM `item_list` where `status` = 1")->num_rows;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <?php if ($_settings->userdata('type') == 1): ?>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-light shadow">
                    <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number text-right">
                            <?php
                            echo $conn->query("SELECT * FROM `users` where id != 1 ")->num_rows;
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        <?php endif; ?>



    </div>
    <h3>CHART</h3>

    <div class="row">
        <div class="col">
            <center><h4>Purchasing rate</h4></center>
        <div id="chart_Sec" class="bg-light p-3 rounded-5">
            </div>
        </div>
        <div class="col">
<center>            <h3>In Stock Product</h3>
</center>
        <div id="chart" class="bg-light p-3 rounded-5">
            </div>
        </div>
    </div>

</div>
<script>
    var options = {
        chart: {
            type: 'donut'
        },
        series:[30, 40, 45, 50, 49, 60, 70, 91, 125],
        chartOptions: {
    labels: ['Apple', 'Mango', 'Orange', 'Watermelon']
  }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
</script>