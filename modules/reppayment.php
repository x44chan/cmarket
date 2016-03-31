<style type="text/css">
	#reports{
		font-size: 12px;
	}
	#reports label, #reports label{
		font-size: 13px;
	}
	th{
		text-align: center;
	}
	<?php
		if(isset($_GET['print'])){
			echo 'body *{ visibility: hidden;}';
		}
	?>
	@media print {
		body * {
    	visibility: hidden;    
  	}
  	#reportg, #reportg *{
  		visibility: visible;
  	}
	#reportg {
		width: 100%;
   		position: absolute;
    	left: 0;
    	top: 0;
    	right: 0;
    	font-size: 10.5px;
  	}
  	#reportg label{
  		font-size: 11px;
  	}
}
	 #tbl td, #tbl th{
	 	border-bottom: 1px solid !important;
	 }
</style>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h4 style="margin-left: -40px;"><u><i> Client Payment Report </i></u></h4>
		</div>
	</div>
	<form action="" method="get">
		<input type = "hidden" name = "module" value = "reppayment">
		<div class="row">
			<div class="col-xs-2">
				<label>Date From: </label>
				<input type="date" name = "datefr" class="form-control input-sm" required <?php if(isset($_GET['datefr'])){ echo ' value = "' . $_GET['datefr'] . '"'; } ?>>
			</div>
			<div class="col-xs-2">
				<label>Date To: </label>
				<input type="date" name = "dateto" class="form-control input-sm" required <?php if(isset($_GET['dateto'])){ echo ' value = "' . $_GET['dateto'] . '"'; } ?>>
			</div>
			<?php if(!isset($_GET['print'])){ ?>
			<div class="col-xs-4">
				<label>Store Owner: <font color="red">*</font></label>
				<select required name = "streown" class="form-control input-sm" >
					<option value=""> ---------- </option>	
					<?php
						$stmt = "SELECT * FROM `owner` ORDER BY `lname` ASC";
						$result = $conn->query($stmt);		
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){		

								if(isset($dataor['owner_id']) && $row['owner_id'] == $dataor['owner_id']){
									$s = ' selected ';
								}else{
									$s = '';
								}
								if(isset($_GET['streown']) && $_GET['streown'] == $row['owner_id']){
									$s = ' selected ';
								}
								echo '<option '.$s.' value ="' . $row['owner_id'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';
							}
						}
					?>	
				</select>
			</div>
			<?php } ?>
			<div class="col-xs-3" >
				<label style="text-align: left;">Action:</label>
				<div class="form-inline">					
					<button class="btn btn-sm btn-primary"><span class="icon-search"></span> Search </button>
					<a href = "?module=reppayment" class="btn btn-sm btn-danger"><span class="icon-spinner11"></span> Clear </a>
					<a href = "?module=reppayment<?php if(isset($_GET['datefr'])){ echo '&datefr=' . $_GET['datefr'];} if(isset($_GET['dateto'])){ echo '&dateto=' . $_GET['dateto'];} if(isset($_GET['streown'])){ echo '&streown=' . $_GET['streown'];}?>&print" class = "btn btn-success btn-sm"><span class ="icon-printer"></span> Print </a>
				</div>
			</div>
		</div>
	</form>
</div>
<div style="margin-top: 20px;"></div>
<?php 
	if( (isset($_GET['datefr']) && $_GET['datefr'] != "") && (isset($_GET['dateto']) && $_GET['dateto'] != "") && (isset($_GET['streown']) && $_GET['streown'] != "") ){ 
		$datefr = mysqli_real_escape_string($conn, $_GET['datefr']); $dateto = mysqli_real_escape_string($conn, $_GET['dateto']); $streown = mysqli_real_escape_string($conn, $_GET['streown']);
		$sql = "SELECT * FROM `collection`,`owner` where paydate BETWEEN '$datefr' and '$dateto' and collection.owner_id = '$streown' and owner.owner_id = '$streown' ORDER BY paydate ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$data = $conn->query($sql)->fetch_assoc();
			if($data['lname'] != " "){
				$data['lname'] = $data['lname'] . ', ';
			}
			$name = $data['lname'] . $data['fname'] . ' ' . $data['mname']; 
?>
	<div class = "container-fluid" style = "text-align: center; margin: 10px 20px" id = "reportg">	
		<div class="row">
			<div class="col-xs-12" align="center">
				<p style="margin-bottom: -.5px;">Republic of the Philippines</p>
				<p style="margin-bottom: -.5px;">Province of Batangas</p>
				<p style="margin-bottom: -.5px;">Municipality of <b>Calaca</b></p>
				<p>
					<i>
						Payment History of <b><?php echo $name;?></b><br>
						<b>( <?php echo date("M d, Y", strtotime($datefr)) . '</b> to <b>' . date("M d, Y", strtotime($dateto));?> )</b>
					</i>
				</p>
				<hr>				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label><u><i>Collection Date</i></u></label>
			</div>
			<div class="col-xs-4">
				<label><u><i>Amount</i></u></label>
			</div>
			<div class="col-xs-4">
				<label><u><i>Type</i></u></label>
			</div>
		</div>
		
		<?php
			$total = 0;
			while ($row = $result->fetch_assoc()) {
				echo '<div class="row">';
				echo '<div class = "col-xs-4">' . date("M d, Y", strtotime($row['paydate'])) . '</div>';
				echo '<div class = "col-xs-4">₱ ' . number_format($row['amount'],2) . '</div>';
				echo '<div class = "col-xs-4">' . $row['type'] . '</div>';
				echo '</div>';
				$total += $row['amount'];
			}
		?>
		<div class="row"><div class="col-xs-12"><hr></div></div>
		<div class="row">
			<div class="col-xs-4">
				<label>Total: </label>
			</div>
			<div class="col-xs-4">₱ <?php echo number_format($total,2)?></div>
		</div>
	</div>	

<?php 	}else{ echo '<div align="center"> <h4><i><u>No Record Found</u></i></h4></div>';} }	?>
<?php
	$datefr = ""; $dateto = ""; $streown = "";
	if(isset($_GET['datefr'])){ $sby = '&datefr=' . $_GET['datefr'];} 
	if(isset($_GET['dateto'])){ $search = '&dateto=' . $_GET['dateto'];}
	if(isset($_GET['streown'])){ $peri = '&streown=' . $_GET['streown'];}
	if(isset($_GET['print'])){
		echo '<script type = "text/javascript">	window.print();window.location.href = "?module=reppayment'.$sby.$search.$peri.'";</script>';
	}
?>