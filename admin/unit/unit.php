<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Hello!</strong> Here you add all your units you will be using so that you can select them next time you are going to use it/ Hano wongeramo units zose ukoresha kugirango utaza uhora uzandika.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><i class="fas fa-circle"></i> Add all the Units you will be using.</h3>
        <div class="card-tools">
			<!-- <a href="<?php echo base_url ?>admin/?page=purchase_order/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a> -->
		</div>
	</div>
	<div class="card-body">
		<div>
			<form  method="post" action="http://localhost/sms_1/admin/?page=unit/action">
				<input id="unit_input" class='form-control ' name="item_unit"  style="width:40%" requierd/>
				<button id="submit_button" type="submit" name="submit" class="btn btn-primary my-2" disabled>ADD NEW UNIT</button>
			</form>
		</div>

		
	<div >
	<table style='width:100%' class="table w-100 text-center table-bordered table-stripped">
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                   
                        <col width="20%">
                        <col width="100%">
                      
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#index</th>
                            <th>The Quantity</th>
                            <th>Delete</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT * FROM unit");
						$count = 1 ; 
                        while($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $count++; ?></td>
                                <td><?php echo $row['unit_name'] ?></td>
                                <td><form  method="post" action="http://localhost/sms_1/admin/?page=unit/action">
				<input class='form-control' name="deletei" value="<?php echo $row['unit_name'] ?>" hidden style="width:40%"/>
				<button type="submit" name="delete" class="btn btn-danger my-2 rounded-pill">DELETE</button>
			</form></td>
       
                              
                                
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
	</div>
		</div>
		

		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Purchase Order permanently?","delete_po",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Payment Details","transaction/view_payment.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_po($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_po",
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
<script>
    document.getElementById("unit_input").addEventListener("input", function() {
        var input = document.getElementById("unit_input").value.trim();
        var submitButton = document.getElementById("submit_button");
        if (input.length > 0) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    });
</script>

<!-- HTML form -->
<!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="item_name" placeholder="Item Name">
    <input type="text" name="item_price" placeholder="Item Price">
    <input type="submit" name="submit" value="Add Item">
</form> -->


