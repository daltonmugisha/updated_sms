<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Stocks</h3>
        <!-- <div class="card-tools">
			<a href="<?php echo base_url ?>admin/?page=purchase_order/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
                    <colgroup>
                        <col width="5%">
                        <col width="22%">
                        <col width="23%">
                        <col width="20%">
                        <col width="11%">
                        <col width="13%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>N<sup>o</sup></th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Supplier</th>
                            <th>Available Stocks</th>
                            <th>Stock Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT i.*,s.name as supplier FROM `item_list` i inner join supplier_list s on i.supplier_id = s.id order by `name` desc");
                        while($row = $qry->fetch_assoc()):
                            $in = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 1")->fetch_array()['total'];
                            $out = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 2")->fetch_array()['total'];
							$value = is_null ($conn->query("SELECT SUM(price) as value FROM stock_list where item_id = '{$row['id']}' and type = 1")->fetch_array()['value']) ? 0 :  ($conn->query("SELECT price as valu FROM stock_list where item_id = '{$row['id']}' and type = 1")->fetch_array()['valu']) ;
                            $row['available'] = $in - $out;
                            $row['value'] = $value;
							$row['product'] = $value*$row['available'];
                            
						?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo $row['supplier'] ?></td>
                                <td  class="text-right"><p style="color:white;background:blue;display:inline-block;padding-inline:5px; border-radius:10px;">
								<?php echo number_format($row['available']) ?> items</p></td>
                                <td><?php echo $row['product'] ?> RWF</td>
                            </tr>
                        <?php endwhile; ?>
                       
                    </tbody>
                </table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Received Orders permanently?","delete_receiving",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Receiving Details","receiving/view_receiving.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_receiving($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_receiving",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>