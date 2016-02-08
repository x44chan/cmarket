<?php
	$sql = "SELECT ALL * FROM orissuance ORDER By  invoiceno desc";
	$result = $conn->query($sql);		
	if($result->num_rows > 0){
		echo '<div class = "container-fluid" style = "text-align: center; margin: 10px 20px">
			<div class = "row">
				<div class = "col-xs-12" align = "left">
					<u><i><h4>OR LIST</h4></i></u>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-1">
					<label>Invoice # </label>
				</div>
				<div class="col-xs-2">
					<label>OR # </label>			
				</div>
				<div class="col-xs-3">
					<label> Issued to </label>			
				</div><div class="col-xs-2">
					<label> Date Issued </label>			
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
										$ct=$ct;
									}else{
									$ct=$ct+1; 
						}
					$from++;
					}	
			echo '<div class = "row">
			<div class = "col-xs-1">
						'. $row['invoiceno'] .'
					</div>
					<div class = "col-xs-2">
						'. $row['orfrom'] . ' - ' . $row['orto'] . ' ('.$ct.')
					</div>
					
					<div class = "col-xs-3">
						'. $userissued.'
					</div>
						<div class = "col-xs-2">
						'. $row['issueddate'] .'
					</div>
					<div class = "col-xs-2">
						<a class = "btn btn-warning btn-sm" href = "?module=editissuance&x='.$row['issuanceid'].'"><span class = "icon-quill"></span> Edit</a>
						
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



