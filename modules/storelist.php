<?php
	$sql = "SELECT * FROM `store`,`owner` where store.owner_id = owner.owner_id ORDER BY lname ASC";
	$result = $conn->query($sql);		
	if($result->num_rows > 0){
		echo '<div class = "container-fluid" style = "text-align: center; margin: 10px 20px">
			<div class = "row">
				<div class = "col-xs-12" align = "left">
					<u><i><h4>Store List</h4></i></u>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-2">
					<label> Store Owner </label>
				</div>
				<div class="col-xs-2">
					<label> Store Name </label>			
				</div>
				<div class="col-xs-2">
					<label> Classification </label>			
				</div>
				<div class = "col-xs-1">
					<label> Building/Blk </label>
				</div>
				<div class = "col-xs-2">
					<label> Area </label>
				</div>
					<div class = "col-xs-1">
					<label>Status </label>
				</div>

				<div class = "col-xs-2">
					<label> Monthly Fee </label>
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
			$amount = $row['area'] * $row['multi'] * 30;
			if($row['status']==0){
			$row['status']="Active";
			}else{
			$row['status']="Close";
			}
			$peri=0;
			if($row['periperals']==1){
			$peri=100;
			}else{
			$peri=0;
			}
			$amount=$amount+$peri;
			echo '<div class = "row">
					<div class = "col-xs-2">
						'. $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] .'
					</div>
					<div class = "col-xs-2">
						<a role = "button" href = "?module=viewstore&x='.$row['store_id'].'" data-toggle = "tooltip" title = "View Details">'.$row['sname'].'</a></li>
					</div>
					<div class = "col-xs-2">
						'. $row['classification'] .'
					</div>
					<div class = "col-xs-1">
						'. $row['building'] . ' / ' . $row['block'] .'
					</div>
					<div class = "col-xs-2">
						'. $row['area'] .' sq.m.
					</div>
					<div class = "col-xs-1">
						'. $row['status'] .' 
					</div>
					<div class = "col-xs-2">
						₱ '. number_format($amount,2) .'
					</div>
					
				</div>';
				$total += $amount;

		}
		echo '<div class = "row"><div class = "col-xs-12"><hr></div></div>';
		echo '<div class = "row">
					<div class = "col-xs-2 col-xs-offset-8">
						<label>Total Amount:</label>
					</div>
					<div class = "col-xs-2">
						 ₱ '. number_format($total, 2) .'
					</div>
				</div>';
		echo '</div>';
	}