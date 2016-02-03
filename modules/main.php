<?php
	$sql = "SELECT * FROM `store`,`owner` where store.owner_id = owner.owner_id";
	$result = $conn->query($sql);		
	if($result->num_rows > 0){
?>
<div class="container-fluid" id = "report" style="padding: 5px 10px; text-align: center;">
	<div class = "row">
		<div class = "col-xs-6" align = "left">
			<u><i><h4>Collection of <?php echo date("F 01") . ' - ' . date('t, Y'); ?></h4></i></u>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label> Store Owner </label>			
		</div>		
		<div class="col-xs-3">
			<label> Store Name </label>			
		</div>
		<div class="col-xs-2">
			<label> Monthly Fee </label>			
		</div>
		<div class="col-xs-2">
			<label> Collection </label>			
		</div>		
	
			<div class="col-xs-2">
			<label> Balance </label>			
		</div>		
	</div>
	<div class = "row">
		<div class = "col-xs-12">
			<hr>
		</div>
	</div>	
<?php 
		$totalmfee = 0;
		$totalamountpaid = 0;
		$totalbalance = 0;
		$month = date("m");
		while ($row = $result->fetch_assoc()) {
			$colid = $row['store_id'];
			//$sql1 = "SELECT sum(amount) as totalamount FROM `collection`,`store` where store.store_id = '$colid' and collection.store_id = '$colid' and CURDATE() BETWEEN datefr and dateto";
			$sql1 = "SELECT sum(amount) as totalamount FROM `collection`,`store` where store.store_id = '$colid' and collection.store_id = '$colid' and (month(datefr) = '$month' or month(dateto) = '$month')";
			$result1 = $conn->query($sql1);
			$data = $result1->fetch_assoc();
			$totalamount = $data['totalamount'];
			if($totalamount == ""){
				$totalamount = 0;
			}
			$balance = ($row['area'] * 4 * 30) - $totalamount;
			if($balance < 0){
				$balance = 0;
			}
			if($row['multi'] == ""){
				$row['multi'] = 4;
			}
			echo '<div class = "row">';
			echo '<div class = "col-xs-3">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</div>';
			echo '<div class = "col-xs-3">' . $row['sname']  . '</div>';
			echo '<div class = "col-xs-2">₱ ' . number_format($row['area'] * $row['multi'] * 30, 2)  . '</div>';
			echo '<div class = "col-xs-2">₱ ' . number_format($totalamount, 2) . '</div>';
			echo '<div class = "col-xs-2">₱ ' . number_format($balance, 2) . '</div>';
			echo '</div>';
			$totalmfee +=  $row['area'] * $row['multi'] * 30;	
			$totalamountpaid += $totalamount;
			$totalbalance += ($row['area'] * $row['multi'] * 30) - $totalamount;
		}
	echo '<div class = "row"><div class = "col-xs-12"><hr></div></div>';
	echo '<div class = "row"><div class = "col-xs-3 col-xs-offset-3"><b>Total Amount: </b></div><div class = "col-xs-2">₱ ' . number_format($totalmfee,2) . '</div><div class = "col-xs-2">₱ ' . number_format($totalamountpaid,2) . '</div><div class = "col-xs-2">₱ '.number_format($totalbalance,2).'</div>';
	echo '</div>';
	}
?>