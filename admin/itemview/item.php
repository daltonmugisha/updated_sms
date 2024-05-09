<?php
$qry = $conn->query("SELECT i.*,s.name as supplier FROM `item_list` i inner join supplier_list s on i.supplier_id = s.id where  i.id = '{$_GET['id']}' ");
if ($qry->num_rows > 0) {
    foreach ($qry->fetch_assoc() as $k => $v) {
        $$k = $v;
    }
}

$qryStock = $conn->query("SELECT * FROM stock_list WHERE item_id  = '{$_GET['id']}' ");
$stocks = $qryStock->fetch_assoc();
?>


<div class="card card-outline card-primary container " id="print_out">
    <div id='transaction-printable-details' class='position-relative'>
        <div class="row">

            <div class="col-6">

                <dl>
                    <dt class="text-info">Item Name: <?php echo $_GET['id'] ?></dt>
                    <dd class="pl-3"><?php echo $name ?></dd>
                    <dt class="text-info">Description:</dt>
                    <dd class="pl-3"><?php echo isset($description) ? $description : '' ?></dd>
                    <dt class="text-info">Cost:</dt>
                    <dd class="pl-3"><?php echo isset($cost) ? number_format($cost, 2) : '' ?></dd>
                    <dt class="text-info">Supplier:</dt>
                    <dd class="pl-3"><?php echo isset($supplier) ? $supplier : '' ?></dd>
                    <dt class="text-info">Status:</dt>
                    <dd class="pl-3">
                        <?php if ($status == 1): ?>
                            <span class="badge badge-success rounded-pill">Active</span>
                        <?php else: ?>
                            <span class="badge badge-danger rounded-pill">Inactive</span>
                        <?php endif; ?>
                    </dd>
                </dl>
            </div>

            <div class="col-6">
                <P>
                <h5>All items available:</h5> <?php echo isset($stocks['quantity']) ? $stocks['quantity'] : ""; ?> items

                </P>
                <p>

                <h5> Stock price: </h5>
                <?php echo isset($stocks['price']) ? $stocks['price'] : ""; ?>

                </p>

            </div>
        </div>
    </div>
</div>



<script>
    $(function () {
        $('.table td,.table th').addClass('py-1 px-2 align-middle')

    })
</script>