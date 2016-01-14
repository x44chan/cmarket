<?php
	$id = mysqli_real_escape_string($conn, $_GET['x']);
	$stmt = "SELECT * FROM user where account_id = '$id'";
	$data = $conn->query($stmt)->fetch_assoc();

?>
<div id = "sowner" class="container"><hr>
	<center><u><i><h4>Edit User Info</h4></i></u></center>
	<form action="" method="post">
		<center>	
			<table class="table" style="width:400px">
				<tr>
					<td>First Name:</td>
					<td><input value = "<?php echo $data['fname'];?>" required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="First Name*" name = "fname"/></td>
				</tr>
				<tr>
					<td>Middle Name:</td>
					<td><input value = "<?php echo $data['mname'];?>" required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="Middle Name*" name = "mname"/></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input value = "<?php echo $data['lname'];?>" required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="Last Name*" name = "lname"/></td>
				</tr>
				<tr>
					<td>User level:</td>
					<td>
						<select class="form-control input-sm" required name = "level" id = "slctown">
							<option value=""> ---------- </option>
							<option <?php if($data['level'] == 'Collector') { echo ' selected '; } ?> value="Collector"> Collector </option>	
							<option <?php if($data['level'] == 'Administrator') { echo ' selected '; } ?>value="Administrator"> Administrator </option>	
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button class="btn btn-primary btn-sm" type = "submit" name = "submit" onclick = "return confirm('Are you sure?');"> <span class = "icon-checkmark"></span> Submit</button>
						<a href="?module=userlist" class="btn btn-danger btn-sm"><span class = "icon-arrow-left"></span> Back </a>
					</td>
				</tr>
			</table>
		</center>
	</form>		
</div>
<?php
	if(isset($_POST['submit'])){
		$level = $_POST['level'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$stmt = $conn->prepare("UPDATE user set level = ?, fname = ?, mname = ?, lname = ? where account_id = ?");
		$stmt->bind_param("ssssi", $level, $fname, $mname, $lname, $_GET['x']);
		if($stmt->execute()){
			echo '<script type = "text/javascript"> alert("Update successful"); window.location.href = "?module=userlist";</script>';
		}
	}	
?>