<?php
	if(isset($_GET['action']) && $_GET['action'] == 'daily'){
		if(isset($_GET['coldate'])){
			$date = mysqli_real_escape_string($conn, $_GET['coldate']);
			$date2 = mysqli_real_escape_string($conn, $_GET['coldate2']);
			$xquery = " and paydate BETWEEN '$date' and '$date2' ";
		}else{
			$date = date("Y-m-d");	
			$xquery = " and paydate = '$date' ";
		}
	//datefr <= '$date' and dateto >= '$date'
	$sql = "SELECT * FROM `store`,`owner`,`collection` where collection.owner_id = owner.owner_id and collection.store_id = store.store_id $xquery group by ornum";
	$result = $conn->query($sql);	
	
?>

<div class="container-fuild" id = "tble"style="padding: 5px 10px; text-align: center;">
	<div class="row">
		<div class="col-xs-12">
			
		</div>
	</div>
	<div class = "row">
		<form action="" method="get">
			<input type = 'hidden' name = "module" value = "collection">
			<input type = 'hidden' name = "action" value = "daily">
			<div class="col-xs-2" style="margin-top: -10px;">
				<label>Date Of Collection</label>
				<input <?php if(isset($_GET['coldate'])){ echo ' value = "' . $_GET['coldate'] . '" '; } ?> required type = "date" name = "coldate" class="form-control input-sm"/>
			</div>
			<div class="col-xs-2" style="margin-top: -10px;"><label>&nbsp;</label>
				<input <?php if(isset($_GET['coldate'])){ echo ' value = "' . $_GET['coldate2'] . '" '; } ?> required type = "date" name = "coldate2" class="form-control input-sm"/>
			</div>
			<div class="col-xs-2" style="margin-top: -10px;">
				<label></label>
				<div class="form-inline">
					<button class="form-control btn btn-primary btn-sm"><span class="icon-search"></span> Search </button>
					<a href = "?module=collection&action=daily" class="form-control btn btn-danger btn-sm"><span class = "icon-spinner11" ></span> Clear </a>
				</div>
			</div>
		</form>
		<div class="col-xs-12">
			<hr>
		</div>
		<div class = "col-xs-12" >
			<i><h4><?php 
						if(isset($_GET['coldate']) && isset($_GET['coldate2']) && $_GET['coldate'] != $_GET['coldate2']){
							if(date("Y", strtotime($_GET['coldate'])) != date("Y", strtotime($_GET['coldate2']))){
								echo date("M j, Y", strtotime($_GET['coldate'])) . ' - ' . date("M j, Y", strtotime($_GET['coldate2']))  . ' COLLECTION';
							}else{
								echo date("M j ", strtotime($_GET['coldate'])) . ' - ' . date("M j, Y", strtotime($_GET['coldate2'])) . ' COLLECTION';
							}
						}else{
							echo date("M j, Y", strtotime($date)) . ' / DAILY COLLECTION';
						} 
					?>
			</h4></i>
		</div>
	</div>
	<table class='table table-bordered table-fixed-header'>
        <thead class='header' id = "thead">
			<tr>
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
			</tr>
		</thead>
		<tbody>
			<tr><td colspan = "16"><hr></td></tr>
<?php 
	
	$mfeetotal = 0;
	$ebilltotal = 0;
	$wbilltotal = 0;
	$mctotal = 0;
	$btsrtotal = 0;
	$amtotal = 0;
	$pmtotal = 0;
	$tftotal = 0;
	$tftotal = 0;
	$rftotal = 0;
	$gtotal = 0;
	$tctotal = 0;
	if($result->num_rows > 0){
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
			$btsr2 = 0;	
			echo '<tr>';
			echo '<td>' . $row['ornum'] . '</td>';
			echo '<td>' . strtoupper($row['fname']) . ' ' . strtoupper($row['lname']) . '</td>';
			$query = "SELECT * FROM collection where ornum = '$row[ornum]'  $xquery";
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
						$mfeeamount = '₱ ' . number_format($row2['amount'],2);
						$mfeecov = strtoupper($month);
						$mfeetotal += $row2['amount'];
					}
					if($row2['type'] == "Electric Bill"){
						$ebill = '₱ ' . number_format($row2['amount']);
						$ecov = strtoupper($month);
						$ebilltotal += $row['amount'];
					}
					if($row2['type'] == "Water Bill"){
						$wbill = '₱ ' . number_format($row2['amount']);
						$wcov = strtoupper($month);
						$wbilltotal += $row2['amount'];
					}
					if($row2['type'] == "Market Clearance"){
						$mc = '₱ ' . number_format($row2['amount']);
						$mctotal += $row['amount'];
					}
					if($row2['type'] == "Business Tax" || $row2['type'] == "Space Rental"){
						$btsr2 += $row2['amount'];
						$btsr = '₱ ' . number_format($btsr2);
						$btsrtotal += $row2['amount'];
					}
					if($row2['type'] == "Anti Mortem"){
						$am = '₱ ' . number_format($row2['amount']);
						$amtotal += $row2['amount'];
					}
					if($row2['type'] == "Post Mortem"){
						$pm = '₱ ' . number_format($row2['amount']);
						$pmtotal += $row2['amount'];
					}
					if($row2['type'] == "Transfer Fee"){
						$tf = '₱ ' . number_format($row2['amount']);
						$tftotal += $row2['amount'];
					}
					if($row2['type'] == "Renewal Fee"){
						$rf = '₱ ' . number_format($row2['amount']);
						$rftotal += $row2['amount'];
					}
					if($row2['type'] == "Goodwill"){
						$g = '₱ ' . number_format($row2['amount']);
						$gtotal += $row['amount'];
					}
					if($row2['type'] == "TCT"){
						$tct = '₱ ' . number_format($row2['amount']);
						$tctotal += $row2['amount'];
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
	}else{
		echo '<tr><td colspan = 16><h4><i>No Record Found</i></h4></td></tr>';
	}
	echo '<tr><td colspan = 16><hr></td><tr>';
	echo '<tr>
			<td><b>Total: </b></td>
			<td colspan = 2 style = "text-align: right !important;">₱' . number_format($mfeetotal,2) . '</td>
			<td colspan = 2 style = "text-align: right !important;">₱'.number_format($ebilltotal,2).'</td>
			<td colspan = 2 style = "text-align: right !important;">₱'.number_format($wbilltotal,2).'</td>
			<td colspan = 2 style = "text-align: right !important;">₱'.number_format($mctotal,2).'</td>
			<td>₱'.number_format($btsrtotal,2).'</td>
			<td>₱'.number_format($amtotal,2).'</td>
			<td>₱'.number_format($pmtotal,2).'</td>
			<td>₱'.number_format($tftotal,2).'</td>
			<td>₱'.number_format($rftotal,2).'</td>
			<td>₱'.number_format($gtotal,2).'</td>
			<td>₱'.number_format($tctotal,2).'</td>
		</tr>';
		$total = $mfeetotal + $ebilltotal + $wbilltotal + $mctotal + $btsrtotal + $amtotal + $pmtotal + $tftotal + $rftotal + $gtotal + $tctotal;
	$cashticket = "SELECT * FROM collection,user where user.account_id = collection.collector_id and type = 'Cash Ticket' $xquery ORDER BY lname";
	$restct = $conn->query($cashticket);
	$cttotal = 0;
	if($restct->num_rows > 0){
		echo '<tr><td colspan = 16><hr><h4><i>Cash Ticket Collection</i></h4></td></tr>';
		echo '<tr><td colspan = 7><b>Collector</td><td colspan = 8 style = "text-align: center;"><b>Amount</td><td></td></tr>';
		while ($ct = $restct->fetch_assoc()) {
			echo '<tr>';
				echo '<td colspan = 7>' . $ct['lname'] . ', ' . $ct['fname'] . '</td>';
				echo '<td></td>';
				echo '<td colspan = 4>₱ ' . number_format($ct['amount'],2) . '</td><td colspan = 4></td>';
			echo '</tr>';
			$cttotal += $ct['amount'];
		}
		echo '<tr><td colspan = 7></td><td><br><b>Total:</td><td colspan = 4><hr>₱ '.number_format($cttotal,2).'</td><td colspan = 4></td></tr>';
	}
	echo '<tr><td colspan = 16><hr></td><tr>';
	echo '<tr><td colspan = "8"><b>Total Collection: </b></td><td colspan = 4>₱ ' . number_format($total+$cttotal,2) . '</td><td colspan = 4></td></tr>';
?>	
</div>

<?php
	}
?>
