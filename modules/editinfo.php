<div id = "sowner" class="container"><hr>
					<center><u><i><h4>Edit User Info</h4></i></u>
	<form action="" method="post">
		<center>	<table class="table" style="width:400px">
			<tr>
				<td>First Name:</td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="First Name*" name = "fname"/></td>
		</tr>
		<tr>
				<td>Middle Name:</td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="Middle Name*" name = "mname"/></td>
		</tr>
		<tr>
				<td>Last Name:</td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="Last Name*" name = "lname"/></td>
		</tr>
			<tr>
				<td>Username:</td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="Username*" name = "uname"/></td>
		</tr>
		<tr>
				<td>Password:</td>
				<td><input required type = "password" id = "inputsm" class = "form-control input-sm" placeholder="Password*" name = "pword"/></td>
		</tr>
		<tr>
				<td>User level:</td>
				<td><select class="form-control input-sm" required name = "level" id = "slctown">
					<option value=""> ---------- </option>
					<option value="Collector"> Collector </option>	
					<option value="Administrator"> Administrator </option>	
					
				</select></td>
		</tr>
		
		<tr>
				<td colspan="2"><button class="btn btn-primary" type = "submit" name = "submit">Submit</button></td>
			
		</tr>

		
		</div>
	</form>
</div>


<?php
if(isset($_POST['submit'])){
	$uname = $_POST['uname'];
	$pword = $_POST['pword'];
	$level = $_POST['level'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$stmt = $conn->prepare("INSERT INTO user (uname, pword, level, fname, mname, lname) values (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssss", $uname, $pword, $level, $fname, $mname, $lname);
	$stmt->execute();

	echo 'inserted';

}

?>