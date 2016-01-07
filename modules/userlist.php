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
					<a role = "button" href = "?module=editinfo&x='.$row['account_id'].'"> Edit</a></li>
					</div>
				</div>';
				
		}
		
	}