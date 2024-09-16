<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><i class="fas fa-wallet"></i> ADD ALL PEOPLE THAT OWE YOU OR YOU OWE MONEY</h3>
		<div class="card-tools">
			<!-- <a href="<?php echo base_url ?>admin/?page=purchase_order/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a> -->
		</div>
	</div>
	<div class="card-body">
		<div>
			<form id="myForm" method="post" action="http://localhost/sms_1/admin/?page=deps/action">
				<input id="person" class='form-control my-1' placeholder="Add a person's names" name="person" style="width:40%" required />

				<input id="money" class='form-control my-1' placeholder="Add money " name="money" style="width:40%" required />

				<select class='form-control my-1' style="width:40%" name='selected' id="SELECTIN" required>
					<option selected>SELECT OPTION</option>
					<option value="They-owe-me">THEY OWE ME MONEY</option>
					<option value="I-owe-them">I OWE THEM MONEY</option>

				</select><br>

				<button id="submitbutton" type="submit" name="submit" class="btn btn-primary my-2" disabled>Add this person</button>
			</form>
		</div>


		<table class="table table-bordered table-stripped">
			<colgroup>
				<col width="5%">
				<col width="35%">

				<col width="20%">
				<col width="100%">

			</colgroup>
			<thead class='bg-dark'>
				<tr>
					<th>N<sup>o</sup></th>
					<th>The Name</th>
					<th>The Money</th>
					<th>Status</th>
					<th>The Balance</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				$qry = $conn->query("SELECT * FROM cash");
				$count = 1;
				while ($row = $qry->fetch_assoc()):
				?>
					<tr>
						<td class="text-center <?php if ($row['whoowe'] == "OWEME") {
													echo 'bg-dark';
												} else {
													echo 'bg-info';
												} ?>"><?php echo $count++; ?></td>
						<td><?php echo $row['person'] ?></td>
						<td><?php echo $row['money'] ?></td>

						       <td>
								<?php if ($row['whoowe'] == 'OWETHE' && $row['status'] == 'I payed') { ?>
								<center>
								<p style=" display:inline-block ; padding-inline:5px; padding-block:3px" class='bg-success text-center rounded-pill'>I paid full</p>
								</center>
							    <?php } elseif ($row['whoowe'] == 'OWETHE' && $row['status'] != 'I payed') {  ?>
								<center> <?php if ($row['money'] <= $row['balance']) {
								?>
								<p style=" display:inline-block ; padding-inline:5px; padding-block:3px" class='bg-success text-center rounded-pill'>I paid full</p>
								<?php }else{
								?>
                                <p style="background:rgb(0,0,0,0.2); display:inline-block ; padding-inline:5px; padding-block:3px" class='bg-warning text-center rounded-pill'><?php echo $row['status'] ; ?></p>
								<?php } ?>
								</center>
								<?php }	?>
                                <?php if ($row['whoowe'] == 'OWEME' && $row['status'] == 'They paid me') { ?>


								<center>
									<p style=" display:inline-block ; padding-inline:5px; padding-block:3px" class='bg-success text-center rounded-pill'><?php echo $row['status']; ?></p>
								</center
									<?php } elseif ($row['whoowe'] == 'OWEME' && $row['status'] != 'They paid me') {  ?>
									<center>
									<?php if ($row['money'] <= $row['balance']) {   ?>
										<p style=" display:inline-block ; padding-inline:5px; padding-block:3px" class='bg-success text-center rounded-pill'>They paid me full</p>

										<?php }else{

										?>
								<p style="background:rgb(0,0,0,0.2); display:inline-block ; padding-inline:5px; padding-block:3px" class='bg-warning text-center rounded-pill'><?php echo $row['status']; ?></p>

										<?php } ?>

								</center>

							<?php }	?>








						</td>
						<td> <?php if ($row['status'] =='I payed'){
echo '0'; 
						} 
						
						else{
						 echo $row['money'] - $row['balance'];
						}
						?></td>
						<td align="center">

							<?php
							if ($row['whoowe'] == 'OWEME') { ?>
							<div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $row['id']; ?>" aria-hidden="true">

<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel"> <?php echo $row['person'] ?> is paying you
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">

			<p>Total money to be paid is <?php echo $row['money'] ?></p>


			</form>
			<form class='   align-items-center' method="post" action="http://localhost/sms_1/admin/?page=deps/action">
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">ALL PAID MONEY</label>
					<input type="text" name="balance" class="form-control" value="<?php echo $row['balance'] ?>" disabled id="recipient-name">
				</div>
				<input class='form-control' name="theypaidid" value="<?php echo $row['id'] ?>" hidden style="width:40%" />

				<input class='form-control' name="oldmoney" value="<?php echo $row['money'] ?>" hidden style="width:40%" />

				<div class="form-group">
					<label for="message-text" class="col-form-label">Add more money </label>
					<input placeholder="How much are you paying now" type="text" name="money" class="form-control" id="recipient-name">
				</div>

				<button type="submit" name="theypaid" class="btn btn-primary my-2">
					<p class=' mx-2 my-2'> <i class="fa fa-check text-light mx-2"></i>UPDATE</p>
				</button>


			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		</div>
	</div>
</div>
</div>
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<form class='dropdown-item d-flex align-items-center' style="height:30px ;" method="post" action="http://localhost/sms_1/admin/?page=deps/action">
										<input class='form-control' name="donepayid" value="<?php echo $row['id'] ?>" hidden style="width:40%" />
										<button type="submit" name="donepay" class="btn my-2">
											<p class=' mx-2 my-2'> <i class="fa fa-check text-success mx-2 "></i>THEY PAID ME</p>
										</button>
									</form>
									<form class='dropdown-item  d-flex align-items-center' style="height:30px;">
										<button data-toggle="modal" data-target="#exampleModal<?php echo $row['id']; ?>" data-whatever="@mdo" type="button" name="theypaid" class="btn my-2">
											<p class=' mx-2 my-2'> <i class="fa fa-check text-warning mx-2"></i>THEY PAID SOME</p>
										</button>
									</form>
									<form class='dropdown-item d-flex align-items-center' style="height:30px ; " method="post" action="http://localhost/sms_1/admin/?page=deps/action">
										<input class='form-control' name="notpayedid" value="<?php echo $row['id'] ?>" hidden style="width:40%" />
										<button type="submit" name="notpayed" class="btn my-2">
											<p class=' mx-2 my-2'> <i class="fa fa-question text-dark mx-2"></i>WAITING FOR PAYMENT</p>
										</button>
									</form>
									<form class='dropdown-item d-flex align-items-center' style="height:30px ;" method="post" action="http://localhost/sms_1/admin/?page=deps/action">
										<input class='form-control' name="deletei" value="<?php echo $row['id'] ?>" hidden style="width:40%" />
										<button type="submit" name="delete" class="btn  my-2">
											<p class=' mx-2 my-2'> <i class="fa fa-trash text-danger mx-2"></i>DELETE</p>
										</button>
									</form>




								</div>

							<?php } else { ?>
								<div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $row['id']; ?>" aria-hidden="true">

									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Pay money to <?php echo $row['person'] ?>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">

												<p>Total money to be paid is <?php echo $row['money'] ?></p>


												</form>
												<form class='   align-items-center' method="post" action="http://localhost/sms_1/admin/?page=deps/action">
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">ALL PAID MONEY</label>
														<input type="text" name="balance" class="form-control" value="<?php echo $row['balance'] ?>" disabled id="recipient-name">
													</div>
													<input class='form-control' name="half" value="<?php echo $row['id'] ?>" hidden style="width:40%" />
													<input class='form-control' name="oldmoney" value="<?php echo $row['money'] ?>" hidden style="width:40%" />

													<div class="form-group">
														<label for="message-text" class="col-form-label">Add more money </label>
														<input placeholder="How much are you paying now" type="text" name="money" class="form-control" id="recipient-name">
													</div>

													<button type="submit" name="ihalf" class="btn btn-primary my-2">
														<p class=' mx-2 my-2'> <i class="fa fa-check text-light mx-2"></i>UPDATE</p>
													</button>


												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

											</div>
										</div>
									</div>
								</div>
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<form class='dropdown-item d-flex align-items-center' style="height:30px ;" method="post" action="http://localhost/sms_1/admin/?page=deps/action">
										<input class='form-control' name="full" value="<?php echo $row['id'] ?>" hidden style="width:40%" />
										<button type="submit" name="ifull" class="btn my-2">
											<p class=' mx-2 my-2'> <i class="fa fa-check text-success mx-2"></i>I PAID FULL</p>
										</button>
									</form>


									<input class='form-control' name="half" value="<?php echo $row['id'] ?>" hidden style="width:40%" />

									<button data-toggle="modal" data-target="#exampleModal<?php echo $row['id']; ?>" data-whatever="@mdo" type="submit" name="ihalf" class="btn my-2">
										<p class=' mx-2 my-2'> <i class="fa fa-check text-warning mx-2"></i>I PAID SOME</p>
									</button>


									<!-- one -->













									<form class='dropdown-item  d-flex align-items-center' style="height:30px ; " method="post" action="http://localhost/sms_1/admin/?page=deps/action">
										<input class='form-control' name="waiting" value="<?php echo $row['id'] ?>" hidden style="width:40%" />
										<button type="submit" name="waitingfor" class="btn my-2">
											<p class=' mx-2 my-2'> <i class="fa fa-question text-dark mx-2"></i>I HAVE NOT PAID</p>
										</button>
									</form>

									<form class='dropdown-item  d-flex align-items-center' style="height:30px ;" method="post" action="http://localhost/sms_1/admin/?page=deps/action">
										<input class='form-control' name="deletei" value="<?php echo $row['id'] ?>" hidden style="width:40%" />
										<button type="submit" name="delete" class="btn  my-2">
											<p class=' mx-2 my-2'> <i class="fa fa-trash text-danger mx-2"></i>DELETE</p>
										</button>
									</form>




								</div>

							<?php } ?>
						</td>
						<!-- <td><form  method="post" action="http://localhost/sms_1/admin/?page=gu/action">

				<input class='form-control' name="deletei" value="<?php echo $row['person'] ?>" hidden style="width:40%"/>
				<button type="submit" name="delete" class="btn btn-danger my-2 rounded-pill">DELETE</button>
			</form></td> -->



					</tr>

				<?php endwhile; ?>
			</tbody>
		</table>
	</div>


</div>
</div>
</div>
<script>
	$(document).ready(function() {
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this Purchase Order permanently?", "delete_po", [$(this).attr('data-id')])
		})
		$('.view_details').click(function() {
			uni_modal("Payment Details", "transaction/view_payment.php?id=" + $(this).attr('data-id'), 'mid-large')
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})

	function delete_po($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_po",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}


	const selectElement = document.getElementById('SELECTIN');
	const submitButton = document.getElementById('submitbutton');

	selectElement.addEventListener('change', function() {
		if (selectElement.value) {
			submitButton.disabled = false;
		} else {
			submitButton.disabled = true;
		}
	});
</script>