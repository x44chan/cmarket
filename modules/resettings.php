<?php
	$stmt = "SELECT * FROM `references`";
	$data = $conn->query($stmt)->fetch_assoc();
?>
<div class="container">
	<form action = "" method="post">
		<div class="row" align="center">
			<div class="col-xs-7" style="margin-left: -40px;"><h4><i>Report Settings</i></h4></div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">
				<label>Market Supervisor</label>
				<input value = "<?php echo $data['mvisor'];?>" style = "text-transform: uppercase;" required type = "text" class="form-control input-sm" name = "mvisor" placeholder = "Enter Market Supervisor Name"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">
				<label>Admin Aide IV</label>
				<input value = "<?php echo $data['aaide'];?>" style = "text-transform: uppercase;" required type = "text" class="form-control input-sm" name = "aaide" placeholder = "Enter Admin Aide IV Name"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12" align="center">
				<button class="btn btn-primary btn-sm" name = "repset" onclick="return confirm('Are you sure?');"> <span class = "icon-checkmark"></span> Update </button>
				<a href="?module=main" class="btn btn-danger btn-sm"> <span class = "icon-arrow-left"></span> Back </a>
			</div>
		</div>
	</form>
</div>
<?php
	if(isset($_POST['repset'])){
		$stmt = $conn->prepare("UPDATE `references` set mvisor = ?, aaide = ?");
		$stmt->bind_param("ss", strtoupper($_POST['mvisor']), strtoupper($_POST['aaide']));
		if($stmt->execute()){
			echo '<script type = "text/javascript"> alert("Record Updated"); window.location.href = "?module=resettings";</script>';
		}
	}
?>