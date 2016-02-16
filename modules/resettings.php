<?php
	$stmt = "SELECT * FROM `references`";
	$data = $conn->query($stmt)->fetch_assoc();
?>
<div class="container">
	<form action = "" method="post">
		<div class="row">
			<div class="col-xs-7" style=""><h4><i>Report Settings</i></h4></div>
		</div>
		<div class="row">
			<div class="col-xs-5 col-xs-offset-1">
				<label>Market Supervisor</label>
				<input value = "<?php echo $data['mvisor'];?>" style = "text-transform: uppercase;" required type = "text" class="form-control input-sm" name = "mvisor" placeholder = "Enter Name"/>
			</div>
			<div class="col-xs-5">
				<label>Position</label>
				<input value = "<?php echo $data['post1'];?>" required type = "text" class="form-control input-sm" name = "post1" placeholder = "Enter Position"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-5 col-xs-offset-1">
				<label>Name</label>
				<input value = "<?php echo $data['aaide'];?>" style = "text-transform: uppercase;" required type = "text" class="form-control input-sm" name = "aaide" placeholder = "Enter Name"/>
			</div>
			<div class="col-xs-5">
				<label>Position</label>
				<input value = "<?php echo $data['post2'];?>" required type = "text" class="form-control input-sm" name = "post2" placeholder = "Enter Position"/>
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
		$stmt = $conn->prepare("UPDATE `references` set mvisor = ?, post1 = ?, aaide = ?, post2 = ?");
		$stmt->bind_param("ssss", strtoupper($_POST['mvisor']), $_POST['post1'], strtoupper($_POST['aaide']), $_POST['post2']);
		if($stmt->execute()){
			echo '<script type = "text/javascript"> alert("Record Updated"); window.location.href = "?module=resettings";</script>';
		}
	}
?>