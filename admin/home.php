<div class="message-home">
    <div>
    <h1 style="font-size: 25px;" class="">Welcome to
    <?php echo $_settings->info('name') ?>
</h1>

<a style="background-color: white;" class="btn rounded-pill" href="http://localhost/sms_1/admin/?page=calendar/calendar">📅Your calendar</a> <a style="background-color: white;" class="btn rounded-pill" href="http://localhost/sms_1/admin/?page=maintenance/item">📚 New item</a>

    </div>
    <?php 
                        $i = 1;
                        $money =  0 ;
                        $qry = $conn->query("SELECT * FROM `sales_list` order by `date_created` desc");
                        while($row = $qry->fetch_assoc()):
                           $money = $money + $row['amount'] ;                  
                        ?> 
                        <?php  endwhile ; ?>
    <div style="background-color: white; padding:5px;display:flex; border-radius:5px;" class="  shadow rounded-3">
        <a style="margin-top: 5px;font-weight:bold" class="text-dark " href=""> <?php echo $money ?> frw <br>
   <span style='font-size:13px; color: green ; '>

   <?php
// Fetch old money
$currentMonth = date('Y-m');

// Construct the query to select records for the current month
$oldMoneyQuery = "SELECT * FROM `sales_list` WHERE DATE_FORMAT(`date_created`, '%Y-%m') = '$currentMonth' ORDER BY `date_created` DESC ";

// Execute the query
$oldMoneyResult = $conn->query($oldMoneyQuery);

// Initialize moneynew variable
$moneynew = 0;

// Check if there are any records returned
if ($oldMoneyResult->num_rows > 0) {
    // Loop through the results and calculate the total amount
    while ($row = $oldMoneyResult->fetch_assoc()) {
        $moneynew += $row['amount'];
    }
    // echo "Money is " . $moneynew;

    // Fetch old money
    // Get the current month and year
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Calculate the previous month and year
    if ($currentMonth == 1) {
        // If the current month is January, the previous month is December of the previous year
        $previousMonth = 12;
        $previousYear = $currentYear - 1;
    } else {
        // Otherwise, the previous month is the month before the current month
        $previousMonth = $currentMonth - 1;
        $previousYear = $currentYear;
    }

    // Format the previous month and year as 'YYYY-MM'
    $previousMonthYear = sprintf("%04d-%02d", $previousYear, $previousMonth);
    // $previousMonthYear = date('Y-m'); // This line seems redundant

    $newMoneyQuery = "SELECT * FROM `sales_list` WHERE DATE_FORMAT(`date_created`, '%Y-%m') = '$previousMonthYear' ORDER BY `date_created` DESC ";
    $newMoneyResult = $conn->query($newMoneyQuery);

    // Loop through the results and calculate the total amount
    $oldmoneey = 0;
    while ($row = $newMoneyResult->fetch_assoc()) {
        $oldmoneey += $row['amount'];
    }
    // echo "Old money is " . $oldmoneey;

    // Old money
    $oldMoney = $oldmoneey; // PHP

    // New money
    $newMoney = $moneynew; // PHP

    // Calculate percentage change
    if ($oldMoney != 0) {
        $percentageChange = (($newMoney - $oldMoney) / $oldMoney) * 100;

        // Check if there's been a gain or loss
        if ($percentageChange > 0) {
            echo "<span style='color:green; font-size:12px;'>" . round($percentageChange,3) . "% <i class='fas fa-chart-line '></i></span>";
        } elseif ($percentageChange < 0) {
            echo " <span style='color:red; font-size:12px;'>" . abs(round($percentageChange,3)) . "% <i class='fas fa-chart-line'></i></span>  ";
        } else {
            echo "No percentage change";
        }
    } else {
        echo "No last month's record";
    }
} else {
    echo "No records";
}
?> </span>
    </a>
        <div class="mx-3" style="margin-top:8px;">
        <?php

// echo "Previous Month and Year: " . $previousMonthYear . "<br>";
        ?>
        <a class="btn btn-flat btn-primary" href="<?php echo base_url ?>admin/?page=maintenance/report">Get report</a>
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
                        // $result = $conn->query("SELECT SUM(quantity) as allsum FROM `stock_list`");
                            $in = $conn->query("SELECT SUM(quantity) as total FROM stock_list where type = 1")->fetch_array()['total'];
                            $out = $conn->query("SELECT SUM(quantity) as total FROM stock_list where type = 2")->fetch_array()['total'];
                            $sum = $in - $out;
                        // $sum = $row['allsum'];

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
          <?php
    $result = $conn->query("SELECT category.name AS category_name, SUM(stock_list.quantity) AS total_quantity
    FROM stock_list
    INNER JOIN item_list ON stock_list.item_id = item_list.id
    INNER JOIN category ON item_list.cat_id = category.id
    GROUP BY category_name;");

    $categoryData = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categoryData[] = [
                'category_name' => $row['category_name'],
                'total_quantity' => $row['total_quantity']
            ];
        }
        // echo $categoryData ; 
    } else {
        echo "Error: " . $conn->error;
    }
    ?>

        <div style="" class="col-6">
               <div style="display:flex;justify-content:center;flex-direction:column;background-color: white; border-radius:5px;">
               <center>            <h5 class="text-muted">In Stock Product</h5>
</center>

<center style='margin-top:50px'>
    
      <?php
            if(count($categoryData)==0){
                
                
                echo "NO DATA TO SHOW";
            }
            ?>
</center>
        <div id="chart" class=" p-3 rounded-5">
            
            </div>
          
        </div>
               </div>
        </div>

    </div>
 

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