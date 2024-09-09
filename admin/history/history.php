<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><i class="fas fa-clock"></i> History</h3>
        <div class="card-tools">
			<!-- <a href="<?php echo base_url ?>admin/?page=purchase_order/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a> -->
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                   
                        <col width="20%">
                        <col width="100%">
                      
                    </colgroup>
                    <thead class='bg-info'>
                        <tr>
                            <th>#</th>
                            <th>Date Created</th>
                            <th>Name</th>
                            <th>Activity_performed</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT h.*, u.firstname as username, u.lastname as username2  , u.avatar as profile FROM `history` h inner join users u on h.owner = u.id order by h.`date` desc");
                        while($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo date("Y-m-d H:i",strtotime($row['date'])) ?></td>
                                <td> <img src="<?php echo validate_image($row['profile']) ?>" style="width: 30px;height:30px;" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar">  <?php echo $row['username'] ?> <?php echo $row['username2'] ?></td>
                                <td><?php echo $row['history'] ?></td>
                               
                                      
                              
                                
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