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
  	#reportg #red {
  		color: red !important;
  	}
  	#reportg #green{
  		color: green !important;
  	}
  	#reportg h4{
  		font-size: 15px;
  	}
  	#datepr{
  		margin-top: 25px;
  	}
  	#reportg, #reportg * {
    	visibility: visible;
 	}
	#reportg th{
  		font-size: 12px;
  		width: 0;
  		border-left: 1px solid black !important;
  		border-top: 1px solid black !important;
  		border-right: 1px solid black !important;
  		border-bottom: 1px solid black !important;
	} 
	#reportg td{
  		font-size: 12px;
  		bottom: 0;
  		padding: 3.5px;
  		border-left: 1px solid black !important;
  		border-top: 1px solid black !important;
  		border-right: 1px solid black !important;
  		border-bottom: 1px solid black !important;max-width: 210px;
	}
	#width{
		min-width: 90px;
	}
	#reportg p{
  		font-size: 11px;
	}
	#totss{
		font-size: 13px;
	}
	#reportg {
   		position: absolute;
    	left: 0;
    	top: 0;
    	right: 0;
    	font-size: 9.5px;
  	}
  	#backs{
  		display: none;
  	}
}
	 #tbl td, #tbl th{
	 	border-bottom: 1px solid !important;
	 }
</style>
<div class = "container-fluid" style = "text-align: center; margin: 10px 20px">
	<form action="" method="get">		
		<input type = "hidden" name = "module" value="storelist"/>	
		<div class="row">
			<div class="col-xs-3" style="text-align: left;">
				<label>Search by:</label>
				<select class="form-control input-sm" name = "sby" required>	
					<option value=""> - - - - - - - </option>		
					<option <?php if(isset($_GET['sby']) && $_GET['sby'] == 'block'){ echo ' selected '; } ?> value="block"> Block </option>
					<option <?php if(isset($_GET['sby']) && $_GET['sby'] == 'building'){ echo ' selected '; } ?> value="building"> Building </option>
					<option <?php if(isset($_GET['sby']) && $_GET['sby'] == 'sowner'){ echo ' selected '; } ?> value="sowner"> Store Owner </option>
					<option <?php if(isset($_GET['sby']) && $_GET['sby'] == 'sname'){ echo ' selected '; } ?> value="sname"> Store Name </option>
					<option <?php if(isset($_GET['sby']) && $_GET['sby'] == 'classification'){ echo ' selected '; } ?> value="classification"> Classification </option>
				</select>
			</div>
			<div class="col-xs-4" style="text-align: left;">
				<label>Search: </label>
				<input <?php if(isset($_GET['search'])){ echo ' value = "' . $_GET['search'] . '" '; } ?> type = "text" required name = "search" class="form-control input-sm" placeholder = "Enter what to search"/>
			</div>
			<div class="col-xs-1">
				<label>Periperals</label><br>
				<input type="checkbox" class="" name = "peri" <?php if(isset($_GET['peri'])){ echo ' checked '; } ?>>
			</div>
			<div class="col-xs-3" style="text-align: left;">
				<label >Action:</label>
				<div class="form-inline">					
					<button class="btn btn-sm btn-primary"><span class="icon-search"></span> Search </button>
					<a href = "?module=storelist" class="btn btn-sm btn-danger"><span class="icon-spinner11"></span> Clear </a>
					<a href = "?module=storelist<?php if(isset($_GET['sby'])){ echo '&sby=' . $_GET['sby'];} if(isset($_GET['search'])){ echo '&search=' . $_GET['search'];}?>&print" class = "btn btn-success btn-sm"><span class ="icon-printer"></span> Print </a>
				</div>
			</div>
		</div>	
	</form>
</div>
<?php
	$peri = "";
	if(isset($_GET['sby']) && isset($_GET['search'])){
		$sby = " and " . mysqli_real_escape_string($conn, $_GET['sby']) . " like '%". mysqli_real_escape_string($conn, $_GET['search'])."%'";
		if(mysqli_real_escape_string($conn, $_GET['sby']) == 'sowner'){
			$sby = " and (fname like '%". mysqli_real_escape_string($conn, $_GET['search'])."%' or mname like '%". mysqli_real_escape_string($conn, $_GET['search'])."%' or lname like '%". mysqli_real_escape_string($conn, $_GET['search'])."%')";
		}
		if(isset($_GET['peri'])){
			$sby .= " and periperals = '1' ";
			$peri = '( with Periperals )';
		}
		$sql = "SELECT * FROM `store`,`owner` where store.owner_id = owner.owner_id $sby ORDER BY lname ASC";
		$sum = "SELECT count(store_id) as summ FROM store,owner where store.owner_id = owner.owner_id $sby";
	}else{
		$sql = "SELECT * FROM `store`,`owner` where store.owner_id = owner.owner_id ORDER BY lname ASC";
		$sum = "SELECT count(store_id) as summ FROM store,owner where store.owner_id = owner.owner_id";
	}
	$result = $conn->query($sql);	
	if($result->num_rows > 0){
		$data = $conn->query($sum)->fetch_assoc();
		echo '<div class = "container-fluid" style = "text-align: left; margin: 10px 20px" id = "reportg">
			<div class = "row">
				<div class = "col-xs-6" align = "left">
					<u><i><h4>Store List</h4></i></u>					
				</div>
				<div class = "col-xs-5" align = "right" >
					<i style = "font-size: 15px;"><h5><strong> Number of Store '.$peri.': </strong><span class="label label-default" style = "font-size: 13px;">'.$data['summ'].'</span></h5></i>
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
			if(!isset($_GET['print'])){
				$link = 'href = "?module=viewstore&x='.$row['store_id'].'" data-toggle = "tooltip" title = "View Details"';
			}else{
				$link = "";
			}
			if($row['classification'] == ""){
				$row['classification'] = ' - ';
			}
			echo '<div class = "row">
					<div class = "col-xs-2">
						'. $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] .'
					</div>
					<div class = "col-xs-2">
						<a role = "button" '.$link.' >'.$row['sname'].'</a></li>
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
	}else{
		echo '<u align = "center"><i><h4>No record found</h4></i></u>';
	}
?>
</div>
<?php
	$sby = ""; $search = ""; $peri = "";
	if(isset($_GET['sby'])){ $sby = '&sby=' . $_GET['sby'];} 
	if(isset($_GET['search'])){ $search = '&search=' . $_GET['search'];}
	if(isset($_GET['peri'])){ $search = '&peri=' . $_GET['peri'];}
	if(isset($_GET['print'])){
		echo '<script type = "text/javascript">	window.print();window.location.href = "?module=storelist'.$sby.$search.$peri.'";</script>';
	}
?>