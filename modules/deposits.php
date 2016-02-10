
	<?php

		if(isset($_GET['coldate'])){
			$date = mysqli_real_escape_string($conn, $_GET['coldate']);
		
		}else{
			$date = date("Y-m-d");	
			
		}

	//datefr <= '$date' and dateto >= '$date'
	$sql = "SELECT * FROM  `orissuance` where issueddate = '$date' ORDER by  invoiceno asc";
	$result = $conn->query($sql);		
?>
<div class="container-fuild" id = "tble"style="padding: 5px 10px; text-align: center;">
	<div class="row">
		<div class="col-xs-12">
			
		</div>
	</div>


<div class="container-fuild" id = "tble"style="padding: 5px 10px; text-align: center;">
	<div class="row">
		<div class="col-xs-12">
		
		</div>
	</div>
	<div class = "row">
		<form action="" method="get" style="margin-top: -20px;">
			<input type = 'hidden' name = "module" value = "deposits">
			<div class="col-xs-2" style="margin-top: -10px;">
				<label>Date Of Collection</label>
				<input required type = "date" name = "coldate" class="form-control input-sm"/>
			</div>
			<div class="col-xs-2" style="margin-top: -10px;">
				<label></label>
				<div class="form-inline">
					<button class="form-control btn btn-primary btn-sm"><span class="icon-search"></span> Search </button>
					<a href = "?module=deposits" class="form-control btn btn-danger btn-sm"><span class = "icon-spinner11" ></span> Clear </a>
				</div>
			</div>		<div class = "col-xs-5" style="margin-top: -10px;" >
			<i><h3><?php echo date("M d, Y", strtotime($date)); ?> / Report of Collection and Deposits</h4></i>
		</div>
		</form><div class="col-xs-12">
			<hr>	</div>
			
			<?php
				if($result->num_rows > 0){
					echo '<div class = "container-fluid" style = "text-align: center; margin: 10px 20px">
			<div class = "row">
				<div class = "col-xs-12" align = "left">
					<u><i><h4>A. COLLECTIONS </h4></i></u>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-1">
					<label>Invoice # </label>
				</div>
				<div class="col-xs-2">
					<label>FROM </label>		|	<label> TO </label>
				</div>
				<div class="col-xs-3">
					<label>PAYOR </label>			
				</div><div class="col-xs-2">
					<label>PARTICULARS </label>			
				</div>
				<div class="col-xs-2">
					<label> AMOUNT </label>			
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
			$isid=$row['issuedto'];
			$sql = "SELECT * FROM user where account_id =  '$isid' ORDER BY lname";
				$result2 = $conn->query($sql);		
			if($result2->num_rows > 0){
				$row2 = $result2->fetch_assoc();
					$userissued=$row2['lname'] . ', ' . $row2['fname'] . ' ' . $row2['mname'] ;
			}else{
				
				$userissued="No User Found";
			}
					$ct="0";
					$from=$row['orfrom'];
					$to=$row['orto']+1;
					while($from < $to) {
						$sql = "SELECT * FROM `collection` where ornum = '$from' ";
								$resulter = $conn->query($sql);
									if($resulter->num_rows >	 0){
												while ($row3 = $resulter->fetch_assoc()){
												$ct=$ct+$row3['amount'];
												}
												
									}else{
									
						}
					$from++;
					}	
			echo '<div class = "row">
			<div class = "col-xs-1">
						'. $row['invoiceno'] .'
					</div>
					<div class = "col-xs-2">
						'. $row['orfrom'] . ' - ' . $row['orto'] . ' 
					</div>
					
					<div class = "col-xs-3">
						'. $userissued.'
					</div>
						<div class = "col-xs-2">
						AF51
					</div>
					<div class = "col-xs-2">
						₱ '. $ct.'
					</div>
				</div><hr>';
				
				
				
				
		}		$ct2="";
				$sql3 = "SELECT * FROM `collection` where paydate = '$date'  AND  type = 'Cash Ticket' ";
								$resulter2 = $conn->query($sql3);
									if($resulter2->num_rows >	 0){
												while ($row4 = $resulter2->fetch_assoc()){
												$ct2=$ct2+$row4['amount'];
												}
												
									}else{
									
						}
						echo'		<div class = "col-xs-10">
						<div class = "col-xs-8">
					&nbsp;
					</div>
				<div class = "col-xs-2">
					<b>	CASH TICKET:</b>
					</div>	<div class = "col-xs-2">
						₱ '. $ct2.'
					</div>
					</div>';
					
					
				echo '<div class = "col-xs-12" align = "left">
					<u><i><h4>B. REMMITANCE/DEPOSITS </h4></i></u><hr>
				</div>
				<div class="row">
				<div class = "col-xs-2">
					<label>Accountable Officer </label>
				</div>
				<div class="col-xs-2">
					<label>Amount</label>
				</div></div>';
				
				
				$tamount="";
				$sql3 = "SELECT * FROM `collection` where paydate = '$date'  AND  type = 'Cash Ticket' ";
								$resulter2 = $conn->query($sql3);
									if($resulter2->num_rows >	 0){
												while ($row4 = $resulter2->fetch_assoc()){
													$isid=$row4['collector_id'];
																$sql = "SELECT * FROM user where account_id =  '$isid' ORDER BY lname";
																$result2 = $conn->query($sql);		
																if($result2->num_rows > 0){
																$row2 = $result2->fetch_assoc();
																$userissued=$row2['lname'] . ', ' . $row2['fname'] . ' ' . $row2['mname'] ;
																}else{
																$userissued="No User Found";
																}
													echo '<div class = "row">
													
													
													
													<div class = "col-xs-2">
													'. $userissued.'
													</div>
													<div class = "col-xs-2">
													₱ '. $row4['amount'] . ' 
													</div></div>';
												$tamount=$tamount+$row4['amount'];
												}
												echo '<div class = "row"><hr><div class = "col-xs-2"><label>&nbsp;</label></div><div class = "col-xs-2">₱ '.$tamount.'</div></div>';
												
									}else{
									
						}
				
			
					
				
					
				}
			
			
			
			
			?>