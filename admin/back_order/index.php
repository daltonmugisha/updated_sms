<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Retrieve values from the form
    $fromDate = $_GET['from_date'] ?? '';
    $toDate = $_GET['to_date'] ?? '';
    $catId = $_GET['cat_id'] ?? '';


    // Query to fetch items based on selected criteria
    $qry = $conn->query("SELECT 
    i.id as item_id,
    i.name as item_name,
    sl.date_created AS date_created,
    sls.date_created AS date_createds,
    sl.date_created AS date_created,

    COALESCE(SUM(sl.quantity), 0) as stock_quantity,
    COALESCE(COUNT(sls.id), 0) as sold_count,
    COALESCE(SUM(po.quantity), 0) as purchased_quantity
FROM 
    `item_list` i
LEFT JOIN 
    stock_list sl ON i.id = sl.item_id
LEFT JOIN 
    sales_list sls ON sl.id = sls.stock_ids
LEFT JOIN 
    po_items po ON i.id = po.item_id
WHERE 
    (DATE(sl.date_created) = DATE(sls.date_created) OR sls.date_created IS NULL)
    AND (i.cat_id = '$catId' OR '$catId' IS NULL)
    AND ((DATE(sl.date_created) BETWEEN '$fromDate' AND '$toDate') OR sl.date_created IS NULL)
GROUP BY 
    i.id, i.name
ORDER BY 
    i.name ASC");

}

// Display HTML content
?>
<div class="card card-outline card-primary">
    <div class="card-header">    
        <h3 class="card-title">Generate a report</h3>
        <div class="card-tools d-flex">
            <form method="GET" class="d-flex" action="./">
                <!-- Date Range and Category Filter Form -->
                <div class="d-flex align-items-center justify-content-center">
                    <label class="mx-2">From:</label>
                    <input type="date" name="from_date" />
                    <input type="hidden" name="page" value="back_order">
                </div>

                <div class="d-flex align-items-center justify-content-center">
                    <label class="mx-2">To:</label>
                    <input type="date" name="to_date" />
                </div>

                <div class="d-flex align-items-center justify-content-center">
                    <label class="mx-2">Filter:</label>
                    <select name="cat_id" id="cat_id" class="custom-select select2">
                        <option <?php echo !isset($catId) ? 'selected' : 'disabled' ?>>Select item category</option>
                        <?php 
                        $cat = $conn->query("SELECT * FROM `category` ORDER BY `name` ASC");
                        while ($row = $cat->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($catId) && $catId == $row['id'] ? "selected" : "" ?>><?php echo $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mx-3">Generate</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <!-- Display Report Table -->
            <?php if ($qry): ?>
                <table class="table table-hovered table-striped text-center">
                    <!-- Table Headers -->
                    <colgroup>
                        <!-- Column Widths -->
                    </colgroup>
                    <thead>
                       <th>#</th> 
                        <th>Item</th>
                       <th>Date purchased</th>
                       <th>Date recieved</th>
                       <th>Date sold</th>
                       <th>Quantity sold</th>
                       <th>Quantity in stock</th>
                     

                    </thead>
                    <tbody>
                        <?php 
                        // Loop through the query results and display them in the table
                        $i = 1;
                        while ($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo $row['item_name'] ?></td>

                            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?php echo $row['sold_count'] ?></td>
                            <td><?php echo $row['purchased_quantity'] ?></td>
                        
                         
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // JavaScript Event Handling
    $(document).ready(function(){
        $('.delete_data').click(function(){
            _conf("Are you sure to delete this Item permanently?", "delete_category", [$(this).attr('data-id')])
        })

        $('#create_new').click(function(){
            uni_modal("<i class='fa fa-plus'></i> Add New Item", "maintenance/manage_item.php", "mid-large")
        })

        $('.edit_data').click(function(){
            uni_modal("<i class='fa fa-edit'></i> Edit Item Details", "maintenance/manage_item.php?id=" + $(this).attr('data-id'), "mid-large")
        })

        $('.view_data').click(function(){
            uni_modal("<i class='fa fa-box'></i> Item Details", "maintenance/view_item.php?id=" + $(this).attr('data-id'), "")
        })

        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('.table').dataTable();
    })

    function delete_category($id){
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_item",
            method: "POST",
            data: {id: $id},
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occurred.", 'error');
                end_loader();
            },
            success: function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    location.reload();
                } else {
                    alert_toast("An error occurred.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>
