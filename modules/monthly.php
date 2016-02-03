

<div class="container-fuild" id = "tble"style="padding: 5px 10px; text-align: center;">
	<div class = "row">
		<div class = "col-xs-12">
		
			<i><h4>COLLECTION REPORT FROM TO</h4></i>
			<hr>
		</div>
	</div>
	
	<?php
	if(isset($_GET['action']) && $_GET['action'] == 'monthly'){
	$date ="a";
	//datefr <= '$date' and dateto >= '$date'
	$sql = "SELECT * FROM `store`,`owner`,`collection` where collection.owner_id = owner.owner_id and collection.store_id = store.store_id and paydate = '$date' group by ornum";
	$result = $conn->query($sql);		
	
?>
	
	
	<table class="table table-responsive" style="overflow-x: auto;">
		<thead>
			<th>OR #</th>
			<th>Store Owner</th>
			<th>M.FEE</th>
			<th>MONTH</th>
			<th>E.BILL</th>
			<th>MONTH</th>
			<th>W.BILL</th>
			<th>MONTH</th>
			<th>MC</th>
			<th>BT/SR</th>
			<th>AM</th>
			<th>PM</th>
			<th>TF</th>
			<th>RF</th>
			<th>G</th>
			<th>TCT</th>
		</thead>
		<tbody>
			<tr><td colspan = "16"><hr></td></tr>
<?php 
	if($result->num_rows > 0){
		$total = 0;		
		$mfeetotal = 0;
		while ($row = $result->fetch_assoc()) {
			$ebill = " - ";
			$ecov = " - ";
			$mfeeamount = " - ";
			$mfeecov = " - ";
			$wbill = " - ";
			$wcov = " - ";
			$mc = " - ";
			$btsr = " - ";	
			$am = " - ";
			$pm = " - ";
			$tf = " - ";
			$rf = " - ";
			$g = " - ";
			$tct = " - ";		
			echo '<tr>';
			echo '<td>' . $row['ornum'] . '</td>';
			echo '<td>' . strtoupper($row['fname']) . ' ' . strtoupper($row['lname']) . '</td>';
			$query = "SELECT * FROM collection where ornum = '$row[ornum]' and paydate = '$date'";
			$res = $conn->query($query);
			if($res->num_rows > 0){
				while ($row2 = $res->fetch_assoc()){
					$date1 = $row2['datefr'];
					$date2 = $row2['dateto'];
					if($date1 != $date2){
						if(date('M', strtotime($date1)) != date('M', strtotime($date2))){
							$month = date("M j, Y", strtotime($row2['datefr'])) . ' - ' . date("M j, Y", strtotime($row2['dateto']));
						}else{
							$month = date("M j", strtotime($row2['datefr'])) . ' - ' . date("j, Y", strtotime($row2['dateto']));	
						}				
					}else{
						if($row2['datefr'] == date("Y-m-d")){
							$month = " - ";
						}else{
							$month = ' - ';
						}
						//$month = date("M j, Y", strtotime($row2['datefr']));
					}

					if($row2['type'] == "Market Fee"){
						$mfeeamount = '₱ ' . $row2['amount'];
						$mfeecov = strtoupper($month);
						$mfeetotal += $row2['amount'];
					}
					if($row2['type'] == "Electric Bill"){
						$ebill = '₱ ' . number_format($row2['amount']);
						$ecov = strtoupper($month);
					}
					if($row2['type'] == "Water Bill"){
						$wbill = '₱ ' . number_format($row2['amount']);
						$wcov = strtoupper($month);
					}
					if($row2['type'] == "Market Clearance"){
						$mc = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Business Tax" || $row2['type'] == "Space Rental"){
						$btsr = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Anti Mortem"){
						$am = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Post Mortem"){
						$pm = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Transfer Fee"){
						$tf = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Renewal Fee"){
						$rf = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Goodwill"){
						$g = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "TCT"){
						$tct = '₱ ' . number_format($row2['amount']);
					}

				}
				echo '<td>' . $mfeeamount . '</td>';
				echo '<td>' . $mfeecov . '</td>';
				echo '<td>'.$ebill.'</td>';
				echo '<td>'.$ecov.'</td>';
				echo '<td>'.$wbill.'</td>';
				echo '<td>'.$wcov.'</td>';
				echo '<td>'.$mc.'</td>';
				echo '<td>'.$btsr.'</td>';
				echo '<td>'.$am.'</td>';
				echo '<td>'.$pm.'</td>';
				echo '<td>'.$tf.'</td>';
				echo '<td>'.$rf.'</td>';
				echo '<td>'.$g.'</td>';
				echo '<td>'.$tct.'</td>';
				echo '</tr>';
			}
			
			

		}
	echo '<tr><td colspan = 16><hr></td><tr>';
	echo '<tr><td colspan = "2"><b>Total </b></td><td>₱ ' . $mfeetotal . '</td><td colspan = "14"></td></tr>';
	}else{
		echo '<div class = "row"><div class = "col-xs-12"><h4><i>No Record Found</i></h4></div></div>';
	}
 
?>	
	</tbody>
	</table>
</div>
<?php
	}
?>