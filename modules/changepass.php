<div id = "sowner" class="container">
	<center><u><i><h4>Account Change Password</h4></i></u><center>
	<form action="" method="post">
		<table class="table" id = "bdless" style="width:600px">
		<?php
		$mydate=date('m/d/Y');
		?>
			<tr>
				<td><b>Old Password: <font color="red">*</font></td>
				<td><input required type = "password" id = "inputsm" class = "form-control input-sm" placeholder="Old Password" name = "oldpass"/></td>
			</tr>
			<tr>
				<td><b>New Password: <font color="red">*</font></td>
				<td><input required type = "password" id = "inputsm" class = "form-control input-sm" onKeyUp="optTotal()" placeholder="New Password" name = "newpass1"/></td>
			</tr>
			
			<tr>
				<td><b>Confirm New Password: <font color="red">*</font></td>
				<td><input required type = "password" id = "inputsm" class = "form-control input-sm" onKeyUp="optTotal()" placeholder="Confirm New Password" name = "newpass2"/></td>
			</tr>
		
			
			<tr>
				<td colspan="2" align="center"><button class="btn btn-primary btn-sm" type = "submit" name = "submit">Submit</button></td>
			</tr>
		</div>
	</form>
</div>

<?php
if(isset($_POST['submit'])){
$uid=$_SESSION['acc_id'];
		$password =  mysqli_real_escape_string($conn, $_POST['oldpass']);
		$newpass1=$_POST['newpass1'];
		$newpass2=$_POST['newpass2'];
		$sql = "SELECT * FROM `user` where account_id = '$uid' and pword = '$password'";
		$result = $conn->query($sql);		
		if($result->num_rows > 0){
		
			if($newpass1==$newpass2){
			$stmt = $conn->prepare("UPDATE user SET pword=? WHERE account_id=?");
			$stmt->bind_param('sd',  $newpass2, $uid);
			$stmt->execute();
			if ($stmt->errno) { echo "FAILURE!!! " . $stmt->error;
			}
			else echo "Successfully Changed Password";
			$stmt->close();
			}else{
				
			echo "New Password Confirm Failed";
			}
			
			
		}else{
			echo "Old Password is Incorrect";
			
		}
}

?><script  type="text/javascript">

</script>	