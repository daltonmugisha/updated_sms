<style>
	@media print {
    /* Hide unnecessary elements */
    .modal-header button.close,
    .modal-footer {
        display: none;
    }
    
    /* Adjust font size and spacing */
    body {
        font-size: 12pt;
        line-height: 1.5;
    }
    
    /* Ensure proper layout */
    .modal-body {
        padding: 20px; /* Adjust padding as needed */
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        border: 1px solid #ddd; /* Adjust border color */
        padding: 8px;
    }
    
    /* Preserve colors and icons */
    .bg-light {
        background-color: #f8f9fa; /* Adjust background color */
    }
    
    .info-box-icon {
        color: #007bff; /* Adjust icon color */
    }
    
    .info-box-content {
        color: #343a40; /* Adjust content color */
    }
}
</style>
<div class="alert alert-warning" role="alert">
This report by default, it displays the current month's information.
</div>
<div class="card card-outline card-primary">
	<div class="card-header">	
		<h2 style="font-weight: bold;font-size:20px;" class="card-title fw-bold">Report Generator</h2>
		
		<div class="card-tools d-flex">
		<form method="GET" class="d-flex" action="./">
    <div class="d-flex align-items-center justify-content-center">
        <label class='mx-3'>From:</label>
        <input type="date" name="from" class='form-control' value="<?php echo isset($_GET['from']) ? $_GET['from'] : '' ?>">

        <label class='mx-3'>To:</label>
        <input type="date" name="to" class='form-control' value="<?php echo isset($_GET['to']) ? $_GET['to'] : '' ?>">

        <label class="mx-2">Filter:</label>
        <select name="cat_id" id="cat_id" class="custom-select select2">
            <option <?php echo !isset($cat_id) ? 'selected' : 'a' ?> disabled>Select item category</option>
            <option value="All" <?php echo isset($_GET['cat_id']) && $_GET['cat_id'] == 'All' ? 'selected' : '' ?>>All</option> 
            <?php 
            $cat = $conn->query("SELECT * FROM `category` ORDER BY `name` ASC");
            while($row = $cat->fetch_assoc()):
            ?>
            <option value="<?php echo $row['id'] ?>" <?php echo isset($_GET['cat_id']) && $_GET['cat_id'] == $row['id'] ? "selected" : "" ?>><?php echo $row['name'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mx-3">Generate Report</button>
    <input type="hidden" name="page" value="maintenance/report">
</form>


			<!-- <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Add New</a> -->
	
	      
		</div>
	</div>

	<div class='text-center'>
		 <!-- <p>The report will appear here.</p> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
		<div class="row">

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
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-table"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text bg-info  text-center rounded-pill">All stock remaining</span>
                   <center>
				   <span style="width:35px;float:right; display:absolute; right: 33px ; margin-top: 8px;border-radius:50px;" class=" bg-dark text-right p-1 ">
                        <?php
$result = $conn->query("SELECT SUM(quantity) as allsum FROM `stock_list`");
$row = $result->fetch_assoc();
$sum = $row['allsum'];

echo $sum;                       
                       ?>
                    </span>
				   </center>
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
    
        <?php if ($_settings->userdata('type') == 1): ?>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-light shadow">
                    <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-print"></i></span>

                    <div class="info-box-content">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
				Printable report.
				</button>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

        <?php endif; ?>



<!-- Modal -->

    </div>

		<hr>
		<?php 
					$i = 1;
					
					if ($_SERVER['REQUEST_METHOD'] == 'GET') {

						if(isset($_GET['from']) && isset($_GET['to'])){
							
					
						// Get selected category from the form
						$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
					$from = $_GET['from'];
					$to = $_GET['to'];
						// Modify your SQL query accordingly
						if($cat_id =="All"){
							$qry = $conn->query("SELECT f.*,i.name,l.date_created,l.po_code, l.id AS ISD, l.status , i.status AS statusss,  s.name AS supplier, cat.name AS category_name 
                            FROM po_items f
							LEFT JOIN purchase_order_list l ON l.id = f.po_id
                            LEFT JOIN item_list i ON f.item_id = i.id 
							LEFT JOIN category cat   ON i.cat_id = cat.id

                            LEFT JOIN supplier_list s ON i.supplier_id = s.id 
							WHERE l.status = 2 AND l.date_created BETWEEN  '$from' AND '$to' ORDER BY date DESC");

						}else{
							$qry = $conn->query("SELECT f.*,i.name,l.date_created,l.po_code, l.id AS ISD, l.status , i.status AS statusss,  s.name AS supplier, cat.name AS category_name 
                            FROM po_items f
							LEFT JOIN purchase_order_list l ON l.id = f.po_id
                            LEFT JOIN item_list i ON f.item_id = i.id 
							LEFT JOIN category cat   ON i.cat_id = cat.id

                            LEFT JOIN supplier_list s ON i.supplier_id = s.id 
											WHERE l.status = 2 AND i.cat_id = '$cat_id'
											
							AND l.date_created BETWEEN  '$from' AND '$to' ORDER BY date DESC");
						}
						
					} else {
						$currentMonth = date('m');

						$qry = $conn->query("SELECT f.*,i.name,l.date_created,l.po_code, l.id AS ISD, l.status , i.status AS statusss,  s.name AS supplier, cat.name AS category_name 
						FROM po_items f
						LEFT JOIN purchase_order_list l ON l.id = f.po_id
						LEFT JOIN item_list i ON f.item_id = i.id 
						LEFT JOIN category cat ON i.cat_id = cat.id
						LEFT JOIN supplier_list s ON i.supplier_id = s.id 
						WHERE 
						l.status = 2 AND
						MONTH(l.date_created) = '$currentMonth'
						ORDER BY l.date_created DESC");
					}

				}

				?>
				<?php
				     $salestotalone = 0 ;
						while($row = $qry->fetch_assoc()){
							$salestotalone	 = $salestotalone + 1 ;
							}
						?>

								<h6 class="text-success fw-bold h5	">Purchased items recieved report | <?php echo $salestotalone ; 
					?> items entered the stock.</h6>



						
				
				<table class="table table-hovered table-striped text-center">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="20%">
					<col width="15%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Name</th>
							<th>Quantity Given</th>
						<th>Supplier</th>
					
						<th>Unit</th>
						<th>Item Category</th>
						<th>Reference</th>
						<th>Status</th>
						
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					
					if ($_SERVER['REQUEST_METHOD'] == 'GET') {

						if(isset($_GET['from']) && isset($_GET['to'])){
							
					
						// Get selected category from the form
						$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
					$from = $_GET['from'];
					$to = $_GET['to'];
						// Modify your SQL query accordingly
						if($cat_id =="All"){
							$qry = $conn->query("SELECT f.*,i.name,i.id AS ididsa ,r.id AS ides ,l.date_created,l.po_code, l.id AS ISD, l.status , i.status AS statusss,  s.name AS supplier, cat.name AS category_name 
                            FROM po_items f
							LEFT JOIN purchase_order_list l ON l.id = f.po_id
							LEFT JOIN receiving_list r ON r.form_id = l.id
                            LEFT JOIN item_list i ON f.item_id = i.id 
							LEFT JOIN category cat   ON i.cat_id = cat.id

                            LEFT JOIN supplier_list s ON i.supplier_id = s.id 
							WHERE l.status = 2 AND l.date_created BETWEEN  '$from' AND '$to' ORDER BY date DESC");

						}else{
							$qry = $conn->query("SELECT f.*,i.name,i.id AS ididsa ,r.id AS ides ,l.date_created,l.po_code, l.id AS ISD, l.status , i.status AS statusss,  s.name AS supplier, cat.name AS category_name 
                            FROM po_items f
							LEFT JOIN purchase_order_list l ON l.id = f.po_id
							LEFT JOIN receiving_list r ON r.form_id = l.id
                            LEFT JOIN item_list i ON f.item_id = i.id 
							LEFT JOIN category cat   ON i.cat_id = cat.id

                            LEFT JOIN supplier_list s ON i.supplier_id = s.id 
											WHERE l.status = 2 AND i.cat_id = '$cat_id'
											
							AND l.date_created BETWEEN  '$from' AND '$to' ORDER BY date DESC");
						}
						
					} else {
						$currentMonth = date('m');

						$qry = $conn->query("SELECT f.*,i.name,i.id AS ididsa ,r.id AS ides ,l.date_created,l.po_code, l.id AS ISD, l.status , i.status AS statusss,  s.name AS supplier, cat.name AS category_name 
						FROM po_items f
						LEFT JOIN purchase_order_list l ON l.id = f.po_id
						LEFT JOIN item_list i ON f.item_id = i.id 
						LEFT JOIN receiving_list r ON r.form_id = l.id
						LEFT JOIN category cat ON i.cat_id = cat.id
						LEFT JOIN supplier_list s ON i.supplier_id = s.id 
						WHERE 
						l.status = 2 AND
						MONTH(l.date_created) = '$currentMonth'
						ORDER BY l.date_created DESC");
					}

				}

				?>

				<?php
		
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['name'] ?></td>
							<td>
								<?php
							
                 
				echo $row['quantity'] ;
					?>
							</td>
							<td 	><?php echo $row['supplier'] ?></td>
							<td class='text-info'><?php echo $row['unit'] ?></td>
							<td><?php echo $row['category_name'] ?></td>
							<td><?php
							
							if($row['status'] == 0 ){
								
							
							?>
						<a href="http://localhost/sms_1/admin/?page=purchase_order/view_po&id=<?php echo $row['po_id'] ?>"><?php echo $row['po_code'] ?></a> 	
						<?php }else{

							?>
<a href="http://localhost/sms_1/admin/?page=receiving/view_receiving&id=<?php echo $row['ides'] ?>"><?php echo $row['po_code'] ?> </a> 

<?php } ?>
						</td>
							<td class="text-center">
                                <?php if($row['statusss'] == 1): ?>
                                    <span class="badge badge-success rounded-pill">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger rounded-pill">Inactive</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['ididsa'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['ididsa'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <!-- <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['ididsa'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a> -->
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			<?php 
					$i = 1;
					
					if ($_SERVER['REQUEST_METHOD'] == 'GET') {

						if(isset($_GET['from']) && isset($_GET['to'])){
							
					
						// Get selected category from the form
						$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
					$from = $_GET['from'];
					$to = $_GET['to'];
						// Modify your SQL query accordingly
						if($cat_id =="All"){
							$qry = $conn->query("SELECT f.*,i.name,i.status, l.id AS ISD, s.name AS supplier, cat.name AS category_name 
                            FROM `sales_list` f
							LEFT JOIN stock_list l ON FIND_IN_SET(l.id, f.stock_ids)
                            LEFT JOIN item_list i ON l.item_id = i.id 
							LEFT JOIN category cat   ON i.cat_id = cat.id

                            LEFT JOIN supplier_list s ON i.supplier_id = s.id 
							WHERE f.date_created BETWEEN  '$from' AND '$to' ORDER BY date DESC");

						}else{
							$qry = $conn->query("SELECT f.*,i.name,i.status, l.id AS ISD, s.name AS supplier, cat.name AS category_name 
                            FROM `sales_list` f
							LEFT JOIN stock_list l ON FIND_IN_SET(l.id, f.stock_ids)
                            LEFT JOIN item_list i ON l.item_id = i.id 
							LEFT JOIN category cat   ON i.cat_id = cat.id

                            LEFT JOIN supplier_list s ON i.supplier_id = s.id 
											WHERE i.cat_id = '$cat_id'
							AND f.date_created BETWEEN  '$from' AND '$to' ORDER BY date DESC");
						}
						
					} else {
						$currentMonth = date('m');

						$qry = $conn->query("SELECT f.*, i.name, i.status, l.id AS ISD, s.name AS supplier, cat.name AS category_name 
						FROM `sales_list` f
						LEFT JOIN stock_list l ON FIND_IN_SET(l.id, f.stock_ids)
						LEFT JOIN item_list i ON l.item_id = i.id 
						LEFT JOIN category cat ON i.cat_id = cat.id
						LEFT JOIN supplier_list s ON i.supplier_id = s.id 
						WHERE 
						MONTH(f.date_created) = '$currentMonth'
						ORDER BY f.date_created DESC");
					}

				}

				?>	
				
				<?php
				     $salestotal = 0 ;
						while($row = $qry->fetch_assoc()){
							$salestotal	 = $salestotal + 1 ;
							}
						?>

								<h6 class="text-success fw-bold h5	">Sales Report | <?php echo $salestotal ; 
					?> items went out of the stock.</h6>



						
				
				<table class="table table-hovered table-striped text-center">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="20%">
					<col width="15%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Name</th>
							<th>Quantity Given</th>
						<th>Supplier</th>
					
						<th>Guest</th>
						<th>Item Category</th>
						<th>Reference</th>
						<th>Status</th>
						
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					
					if ($_SERVER['REQUEST_METHOD'] == 'GET') {

						if(isset($_GET['from']) && isset($_GET['to'])){
							
					
						// Get selected category from the form
						$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
					$from = $_GET['from'];
					$to = $_GET['to'];
						// Modify your SQL query accordingly
						if($cat_id =="All"){
							$qry = $conn->query("SELECT f.*,i.name,i.status,i.id AS ididsa, l.id AS ISD, s.name AS supplier, cat.name AS category_name 
                            FROM `sales_list` f
							LEFT JOIN stock_list l ON FIND_IN_SET(l.id, f.stock_ids)
                            LEFT JOIN item_list i ON l.item_id = i.id 
							LEFT JOIN category cat   ON i.cat_id = cat.id

                            LEFT JOIN supplier_list s ON i.supplier_id = s.id 
							WHERE f.date_created BETWEEN  '$from' AND '$to' ORDER BY date DESC");

						}else{
							$qry = $conn->query("SELECT f.*,i.name,i.id AS ididsa,i.status, l.id AS ISD, s.name AS supplier, cat.name AS category_name 
                            FROM `sales_list` f
							LEFT JOIN stock_list l ON FIND_IN_SET(l.id, f.stock_ids)
                            LEFT JOIN item_list i ON l.item_id = i.id 
							LEFT JOIN category cat   ON i.cat_id = cat.id

                            LEFT JOIN supplier_list s ON i.supplier_id = s.id 
											WHERE i.cat_id = '$cat_id'
							AND f.date_created BETWEEN  '$from' AND '$to' ORDER BY date DESC");
						}
						
					} else {
						$currentMonth = date('m');

						$qry = $conn->query("SELECT f.*, i.name,i.id AS ididsa, i.status, l.id AS ISD, s.name AS supplier, cat.name AS category_name 
						FROM `sales_list` f
						LEFT JOIN stock_list l ON FIND_IN_SET(l.id, f.stock_ids)
						LEFT JOIN item_list i ON l.item_id = i.id 
						LEFT JOIN category cat ON i.cat_id = cat.id
						LEFT JOIN supplier_list s ON i.supplier_id = s.id 
						WHERE 
						MONTH(f.date_created) = '$currentMonth'
						ORDER BY f.date_created DESC");
					}

				}

				?>

				<?php
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['name'] ?></td>
							<td>
								<?php
							$total = 0;
                    $qryD = $conn->query("SELECT s.*FROM `stock_list` s inner join item_list i on s.item_id = i.id where s.id =$row[ISD]");
                    $rows = $qryD->fetch_assoc();
                       
                 
				echo $rows['quantity'] ;
					?>
							</td>
							<td 	><?php echo $row['supplier'] ?></td>
							<td class='text-info'><?php echo $row['client'] ?></td>
							<td><?php echo $row['category_name'] ?></td>
							<td><a href="http://localhost/sms_1/admin/?page=sales/view_sale&id=<?php echo $row['id'] ?>"><?php echo $row['sales_code'] ?></a> </td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success rounded-pill">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger rounded-pill">Inactive</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['ididsa'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['ididsa'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['ididsa'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
<div class="modal fade" id="staticBackdrop" aria-expanded="true" data-backdrop="static" tabindex="-1" role="dialog"  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">REPORT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
	<div>
    <div class="row">
     
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
     
   



    </div>
	<center>
	<?php if(isset($_GET['from']) && isset($_GET['to'])){

	 ?>
<h6>From: <?php echo isset($_GET['from']) ? $_GET['from'] : '' ?> To: <?php echo isset($_GET['to']) ? $_GET['to'] : '' ?></h6>

<?php }else {

?>

<h6>This month</h6>
<?php }?>
	</center>
	<table class=''>
        <thead>
            <tr>
                <th>Purchased Records</th>
                <th>Sold Records</th>
                <th>Remaining Records</th>
            </tr>
        </thead>
        <tbody>
            <!-- Replace the sample data with your actual data retrieved from the database -->
            <tr>
                <td><?php echo $salestotalone ?></td>
                <td><?php echo $salestotal ?></td>
                <td> <span class="info-box-number text-right">
                        <?php
$result = $conn->query("SELECT SUM(quantity) as allsum FROM `stock_list`");
$row = $result->fetch_assoc();
$sum = $row['allsum'];

echo $sum;                       
                       ?>
                    </span></td>
            </tr>
           
            <!-- Add more rows as needed -->
        </tbody>

    </table>
    <h3>Graphs</h3>

    <div class="row">
        <div  class="col">
            <center><h4>Category Chart | Recieved</h4></center>
       <div class="">
	   <div id="chart"  class="bg-light p-3 rounded-5">
            </div>
       </div>
        </div>
        <div class="col">
<center>            <h4>Category Chart | Out</h4>
</center>
        <div id="charts" class="bg-light p-3 rounded-5">
            </div>
        </div>
    </div>

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="printModalContent()" >PRINT</button>
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



// out of the stock



$results = $conn->query("SELECT cat.name AS category_name, SUM(l.quantity) AS total_quantity 
FROM `stock_list` l
INNER JOIN sales_list f ON l.id = f.stock_ids
INNER JOIN item_list i ON l.item_id = i.id 
INNER JOIN category cat ON i.cat_id = cat.id
GROUP BY cat.name
");

$categoryDatas = [];
if ($result) {
    while ($row = $results->fetch_assoc()) {
        $categoryDatas[] = [
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

	var categoryDatas = <?php echo json_encode($categoryDatas); ?>;

var optionss = {
chart: {
	type: 'donut'
},
series: categoryDatas.map(item => Number(item.total_quantity)),
labels: categoryDatas.map(item => item.category_name)
};

var charts = new ApexCharts(document.querySelector("#charts"), optionss);
charts.render();
</script>

<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Item permanently?","delete_category",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add New Item","maintenance/manage_item.php","mid-large")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Item Details","maintenance/manage_item.php?id="+$(this).attr('data-id'),"mid-large")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-box'></i> Item Details","maintenance/view_item.php?id="+$(this).attr('data-id'),"")
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_category($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_item",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				// _toast("An error occured.",'error');alert
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
						// alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
<script>
  function printModalContent() {
    var modalBodyContent = document.querySelector('.modal-body').innerHTML;
    var printWindow = window.open('', '_blank');
	printWindow.document.write('<html><head>\
    <meta charset="utf-8">\
    <meta name="viewport" content="width=device-width, initial-scale=1">\
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"> \
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/fontawesome-free/css/all.min.css">\
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/select2/css/select2.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/icheck-bootstrap/icheck-bootstrap.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/jqvmap/jqvmap.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/dist/css/adminlte.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/dist/css/custom.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/daterangepicker/daterangepicker.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/summernote/summernote-bs4.min.css">\
    <link rel="stylesheet" href="http://localhost/sms_1/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">\
</head><body>');
     printWindow.document.write('<style>table { width: 100%;border-collapse: collapse;}th, td {border: 1px solid #dddddd;padding: 8px;text-align: left;}th { background-color: #f2f2f2;}</style>')
    printWindow.document.write(modalBodyContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
  }
</script>