<div class="message-home">
    <div>
    <h1 style="font-size: 25px;" class="">Welcome to
    <?php echo $_settings->info('name') ?>
</h1>

<a style="background-color: white;" class="btn rounded-pill" href="http://localhost:8080/sms/admin/?page=calendar/calendar">📅Your calendar</a> <a style="background-color: white;" class="btn rounded-pill" href="http://localhost:8080/sms/admin/?page=maintenance/item">📚 New item</a>

    </div>
    <div style="background-color: white; padding:5px;display:flex; border-radius:5px;" class="  shadow rounded-3">
        <a style="margin-top: 5px;font-weight:bold" class="text-dark " href=""> 500 5000 frw <br>
   <span style="color:green; font-size:12px;"> 18% <i class="fas fa-chart-line "></i></span>
    </a>
        <div class="mx-3" style="margin-top:8px;">
        <a class="btn btn-flat btn-primary" href="">Get financial report</a>
        </div>
    </div>
</div>
<hr>
<div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div style="background-color: white;" class="info-box  shadow ">
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
            <div style="background-color: white;" class="info-box  shadow ">
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
            <div style="background-color: white;" class="info-box  shadow ">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-table"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">All stock</span>
                    <span class="info-box-number text-right">
                        <?php
                        $result = $conn->query("SELECT SUM(quantity) as allsum FROM `stock_list`");
                        $row = $result->fetch_assoc();
                        $sum = $row['allsum'];

                        echo $sum;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div style="background-color: white;" class="info-box  shadow ">
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
            <div style="background-color: white;" class="info-box  shadow ">
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
            <div style="background-color: white;" class="info-box  shadow ">
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
            <div style="background-color: white;" class="info-box  shadow ">
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
                <div style="background-color: white;" class="info-box  shadow ">
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
    <h4>Main info</h4>

    <div class="row gap-3">
        <div style="background-color: white; border-radius:5px;" class="col-6 ">
            <center>
            <h5 class="text-muted">Activities</h4>
            </center>
            <div class="table">
                <table class="table text-center border">
                    <thead>
                        <th>Name</th>
                        <th>Activity</th>
                        <th>Date</th>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        $userId = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : 0; // Assuming 'id' is the correct key in your session array
                        
                        $qry = $conn->query("SELECT h.*, u.firstname as username, u.lastname as username2  , u.avatar as profile FROM `history` h inner join users u on h.owner = u.id WHERE u.id='$userId' order by h.`date` desc LIMIT 10");


                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['history'] ?></td>
                                <td>Done on: <p class="text-primary"><?php echo $row['date'] ?></p>
                                </td>
                            </tr>
                        <?php endwhile ?>

                    </tbody>
                </table>
                <center><a class="btn btn-primary rounded-pill" href="./?page=act/act">More activity</a></center>
            </div>
        </div>
        <div style="" class="col-6">
               <div style="display:flex;justify-content:center;flex-direction:column;background-color: white; border-radius:5px;">
               <center>            <h5 class="text-muted">In Stock Product</h5>
</center>
        <div id="chart" class=" p-3 rounded-5">
            </div>
        </div>
               </div>
        </div>

    </div>
    <?php
    $result = $conn->query("
    SELECT category.name AS category_name, SUM(stock_list.quantity) AS total_quantity
    FROM stock_list
    INNER JOIN item_list ON stock_list.item_id = item_list.id
    INNER JOIN category ON item_list.cat_id = category.id
    GROUP BY category_name;
");

    $categoryData = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categoryData[] = [
                'category_name' => $row['category_name'],
                'total_quantity' => $row['total_quantity']
            ];
        }
    } else {
        echo "Error: " . $conn->error;
    }
    ?>

    <script>
        var categoryData = <?php echo json_encode($categoryData); ?>;

        var options = {
            chart: {
                type: 'donut'
            },
            series: categoryData.map(item => Number(item.total_quantity)),
            labels: categoryData.map(item => item.category_name)
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>