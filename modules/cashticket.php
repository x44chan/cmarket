<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<u><i><h4 style="margin-left: -10px;">Cash Ticket Collection</h4></i></u>
		</div>
	</div>
	<form action="" method="post">
		<div class="row">
			<div class="col-xs-4">
				<label>Collector: <font color="red">*</font></label>
				<select required name = "collector" class="form-control input-sm" id = "change">
					<option value=""> ---------- </option>	
					<?php
						$stmt = "SELECT * FROM user where level = 'Collector' order by lname";
						$result = $conn->query($stmt);		
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){								
								echo '<option value ="' . $row['account_id'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';
							}
						}
					?>	
				</select>
			</div>
			<div class="col-xs-4">
				<label>Collection Date <font color = "red">*</font></label>
				<input type = "date" name = "payday" value = "<?php echo date('Y-m-d');?>" class = "form-control input-sm"/>
			</div>
			<div class="col-xs-4">
				<label>Amount <font color="red">*</font></label>
				<input  class="form-control input-sm" name = "amount" placeholder = "Enter amount of collection"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12" align="center">
				<button class="btn btn-sm btn-primary" onclick = "return confirm('Are you sure?');" name = "ctsub"><span class = "icon-checkmark"></span> Submit </button>
				<a href = "?module=main" class="btn btn-sm btn-danger"><span class = "icon-arrow-left"></span> Back </a>
			</div>
		</div>
	</form>
</div>
<?php
	if(isset($_POST['ctsub']) && !empty($_POST['collector']) && !empty($_POST['amount'])){
		$type = "Cash Ticket";
		$stmt = $conn->prepare("INSERT INTO collection (collector_id, amount, paydate, type) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("isss", $_POST['collector'], $_POST['amount'], $_POST['payday'], $type);
		if($stmt->execute()){
			echo '<script type = "text/javascript">alert("Adding Record Successful");window.location.replace("/cmarket/?module=cashticket");</script>';
		}
	}