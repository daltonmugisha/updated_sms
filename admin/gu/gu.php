<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><i class="fas fa-circle"></i> Add all the Guests that you will be receiving.</h3>
        <div class="card-tools">
			<!-- <a href="<?php echo base_url ?>admin/?page=purchase_order/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a> -->
		</div>
	</div>
	<div class="card-body">
		<div>
			<form  method="post" action="http://localhost:8080/sms/admin/?page=gu/action">
				<input id="unit_input" class='form-control ' name="guests"  style="width:40%"/>
				<button id="submit_button"  type="submit" name="submit" class="btn btn-primary my-2 " disabled>ADD NEW GUIST</button>
			</form>
		</div>

		
		<table class="table table-bordered table-stripped">
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
                        $qry = $conn->query("SELECT * FROM guests");
						$count = 1 ; 
                        while($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $count++; ?></td>
                                <td><?php echo $row['guestn'] ?></td>
                                <td><form  method="post" action="http://localhost:8080/sms/admin/?page=gu/action">
				<input class='form-control' name="deletei" value="<?php echo $row['guestn'] ?>" hidden style="width:40%"/>
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


