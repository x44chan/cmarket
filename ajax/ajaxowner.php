<?php
if(isset($_GET['q'])){
	$q = intval($_GET['q']);
	include '../config/conf.php';
	$sql = "SELECT * FROM `store` where owner_id = '$q' ";
	$result = $conn->query($sql);		
	if($result->num_rows > 0){
		echo '<option value="">-------</option>';
		while($row = $result->fetch_assoc()){								
			echo '<option value = "'.$row['store_id'].'">' . $row['sname'] . '</option>';  
		}
	}
	$conn->close();
}
?>


<?php
if(isset($_GET['x'])){
	$q = intval($_GET['x']);
	include '../config/conf.php';
	$sql = "SELECT * FROM `orissuance` where issuanceid = '$q' ";
	$result = $conn->query($sql);		
	if($result->num_rows > 0){
		echo '<option value="">-------</option>';
		while($row = $result->fetch_assoc()){	
			$orfroms=$row['orfrom'];
			$ortos=$row['orto']+1;		
			while($orfroms < $ortos) {
				$sql = "SELECT * FROM `collection` where ornum = '$orfroms' ";
				$result = $conn->query($sql);
				if($result->num_rows >	 0){
				}else{
					echo '<option value = "'.$orfroms.'">' . $orfroms .' </option>'; 
				}
			$orfroms++;
			}
		}
	}
	$conn->close();
}
?>

<?php
	if(isset($_GET['o'])){
		$o = intval($_GET['o']);
		include '../config/conf.php';
		$sql = "SELECT * FROM `store` where store_id = '$o' ";
		$result = $conn->query($sql);		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				if($row['multi'] == ""){
					$row['multi'] = 4;
				}
				if($row['periperals']==0){
					$dmonthly=number_format($row['area'] * $row['multi'] * 30, 2);}
				else{
					$dmonthly=number_format($row['area'] * $row['multi'] * 30+100, 2);
				}
				$dmonthly = str_replace(",","",$dmonthly);
				$xplode = explode('.', number_format($dmonthly/30,3));

				$daily = $xplode[0] . '.' . substr($xplode[1], 0, 2);
				echo '				
					<div class="col-xs-2">
						<label>Daily Fee</label>
						<input type = "text" readonly id = "dailyfee" class = "form-control input-sm" value = "'. number_format($daily, 2) .'"/>
					</div>
					<div class="col-xs-2">
						<label>Weekly Fee</label>
						<input type = "text" readonly class = "form-control input-sm" value = "'. number_format($daily * 7, 2) .'"/>
					</div>				
					<div class="col-xs-2">
						<label>Monthly Fee</label>
						<input type = "text" readonly class = "form-control input-sm" value = "'. number_format($dmonthly, 2) .'"/>
					</div>';					  
			}
		}
		$conn->close();
	}
?>