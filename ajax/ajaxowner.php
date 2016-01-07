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
				echo '
				<div class="col-xs-2">
					<label>Daily Fee</label>
					<input type = "text" readonly class = "form-control input-sm" value = "'. number_format($row['area'] * $row['multi'], 2) .'"/>
				</div>
				<div class="col-xs-2">
					<label>Weekly Fee</label>
					<input type = "text" readonly class = "form-control input-sm" value = "'. number_format($row['area'] * $row['multi'] * 7, 2) .'"/>
				</div>				
				<div class="col-xs-2">
					<label>Monthly Fee</label>
					<input type = "text" readonly class = "form-control input-sm" value = "'. number_format($row['area'] * $row['multi'] * 30, 2) .'"/>
				</div>';					  
			}
		}
		$conn->close();
	}
?>