<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `supplier_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: scale-down;
		object-position: center center;
	}
</style>
<div class="container-fluid">
	<form action="" id="supplier-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="name" class="control-label">Name</label>
			<input name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name : ''; ?>">
		</div>
		<div class="form-group">
			<label for="address" class="control-label">Address</label>
			<textarea name="address" id="address" cols="30" rows="2" class="form-control form no-resize"><?php echo isset($address) ? $address : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="cperson" class="control-label">Contact Person</label>
			<input name="cperson" id="cperson" class="form-control rounded-0" value="<?php echo isset($cperson) ? $cperson : ''; ?>">
		</div>
		<div class="form-group">
			<label for="contact" class="control-label">Contact #</label>
			<input name="contact" id="contact" class="form-control rounded-0" value="<?php echo isset($contact) ? $contact : ''; ?>">
		</div>
		<p>
  
 
</p>
<div class="" id="collapseExample">
  <div class="card card-body">
  <input type="hidden" name="push" value="0">
  <input style="height: 20px;width:20px ;margin-right:30px;margin-left:3px"  class="form-check-input " value="1" name="push" type="checkbox" <?php echo isset($push) && $push == 1 ? "checked" : ''; ?> id="invalidCheck2" required>
  <label for="" style="margin-left: 30px;" class="">Send notification to this email 	</label>
   <p>Leave it blank if you don't want to send email, once available, all purchase order are sent directly through email.</p>
	<div class="form-group">
			<label for="email" class="control-label">Supplier email</label>
			<input name="email" id="email" class="form-control rounded-0" value="<?php echo isset($email) ? $email : ''; ?>">
		</div> 
</div>
</div>
	
		
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="custom-select selevt">
			<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
			<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#supplier-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_supplier",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload();
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
	})
</script>