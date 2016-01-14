<?php
	$sql = "SELECT ALL * FROM user";
	$result = $conn->query($sql);		
	if($result->num_rows > 0){
		echo '<div class = "container-fluid" style = "text-align: center; margin: 10px 20px">
			<div class = "row">
				<div class = "col-xs-12" align = "left">
					<u><i><h4>User List</h4></i></u>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-4">
					<label> Name </label>
				</div>
				<div class="col-xs-2">
					<label> Username </label>			
				</div>
				<div class="col-xs-2">
					<label> Level </label>			
				</div>
				<div class="col-xs-2">
					<label> Actions </label>			
				</div>
				
			</div>
			<div class = "row">
				<div class = "col-xs-12">
					<hr>
				</div>
			</div>
			';
		$total = 0;
		while ($row = $result->fetch_assoc()) {
			
			echo '<div class = "row">
					<div class = "col-xs-4">
						'. $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] .'
					</div>
					<div class = "col-xs-2">
						'. $row['uname'] .'
					</div>
					<div class = "col-xs-2">
						'. $row['level'] .'
					</div>
					<div class = "col-xs-2">
						<a class = "btn btn-warning btn-sm" href = "?module=editinfo&x='.$row['account_id'].'"><span class = "icon-quill"></span> Edit</a>
						<a class = "btn btn-danger btn-sm" onclick = "return confirm(\'Are you sure?\');" href = "?module=userlist&del=' . $row['account_id'] . '"><span class = "icon-cross"></span> Delete </a>
					</div>
				</div>';
				
		}
		
	}
	if(isset($_GET['del'])){
		$stmt = $conn->prepare("DELETE FROM user where account_id = ?");
		$stmt->bind_param("i", $_GET['del']);
		if($stmt->execute()){
			echo '<script type = "text/javascript"> alert("Account deleted"); window.location.href = "?module=userlist";</script>';
		}
	}



