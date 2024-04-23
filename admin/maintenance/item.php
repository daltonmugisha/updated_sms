<div class="card card-outline card-primary">
	<div class="card-header">	
		<h3 class="card-title">List of Item</h3>
		<div class="card-tools d-flex">
		<form method="GET" class="d-flex" action="./">
    <div class="d-flex align-items-center justify-content-center">
        <label class="mx-2">Filter:</label>
        <select name="cat_id" id="cat_id" class="custom-select select2">
            <option <?php echo !isset($cat_id) ? 'selected' : 'a' ?> disabled>Select item category</option>
			<option value="all">All</option>

		   <?php 
            $cat = $conn->query("SELECT * FROM `category` order by `name` asc");
            while($row=$cat->fetch_assoc()):
            ?>
            <option value="<?php echo $row['id'] ?>" <?php echo isset($cat_id) && $cat_id == $row['id'] ? "selected" : "" ?>><?php echo $row['name'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mx-3">Filter</button>
    <input type="hidden" name="page" value="maintenance/item">
</form>

			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Add New</a>
	
	      
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
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
						<th>Supplier</th>
						<th>Item Category</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					if ($_SERVER['REQUEST_METHOD'] == 'GET') {
						// Get selected category from the form
						$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
					
						// Modify your SQL query accordingly
						if($cat_id=="all"){
				 
							$qry = $conn->query("SELECT i.*, s.name as supplier, cat.name AS category_name FROM `item_list` i 
							LEFT JOIN supplier_list s ON i.supplier_id = s.id 
							LEFT JOIN category cat ON cat.id = i.cat_id 
							ORDER BY i.name ASC, s.name ASC");
						}else{
						
						$qry = $conn->query("SELECT i.*, s.name as supplier, cat.name AS category_name FROM `item_list` i 
											INNER JOIN supplier_list s ON i.supplier_id = s.id 
											INNER JOIN category cat ON cat.id = i.cat_id 
											" . ($cat_id ? "WHERE i.cat_id = '$cat_id'" : "") . "
											ORDER BY i.name ASC, s.name ASC");

						}
					}else{
						$qry = $conn->query("SELECT i.*, s.name as supplier, cat.name AS category_name FROM `item_list` i 
						LEFT JOIN supplier_list s ON i.supplier_id = s.id 
						LEFT JOIN category cat ON cat.id = i.cat_id 
						ORDER BY i.name ASC, s.name ASC");
					}
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['supplier'] ?></td>
							<td><?php echo $row['category_name'] ?></td>
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
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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