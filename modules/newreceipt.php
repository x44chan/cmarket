<div id = "sowner" class="container">
	<form action="" method="post">
		<div class="row">
			<div class = "col-xs-4">
				<label for="inputsm">First Name: </label>
				<input required type = "text" id = "inputsm" class = "form-control input-sm" name = "fname"/>
			</div>
			<div class = "col-xs-4">
				<label>Middle Name: </label>
				<input type = "text" class = "form-control input-sm" name = "mname" required />
			</div>
			<div class = "col-xs-4">
				<label>Last Name: </label>
				<input type = "text" class = "form-control input-sm" name = "lname" required />
			</div>
		</div>
		<div class="row" >
			<div class="col-xs-12" align="center">
				<button class="btn btn-primary" type = "submit" name = "submit">Submit</button>
			</div>
		</div>
	</form>
</div>


<?php
if(isset($_POST['submit'])){
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$stmt = $conn->prepare("INSERT INTO owner (fname, mname, lname) values (?, ?, ?)");
	$stmt->bind_param("sss", $fname, $mname, $lname);
	$stmt->execute();

	echo 'inserted';

}

?>