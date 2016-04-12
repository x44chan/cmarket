<?php
	$sql = "SELECT * FROM `store`,`owner` where store.owner_id = owner.owner_id";
	$result = $conn->query($sql);		
	if($result->num_rows > 0){
?>
<div class="container-fluid" style="padding: 5px 10px; text-align: center; <?php if(!isset($_GET['print'])){ ?> margin-top: 51px; <?php } ?>" id = "reportg">
	<?php if(!isset($_GET['print'])){ ?> <nav class="navbar navbar-fixed-top" style = "margin-top: 51px; z-index: 900;">	<?php } ?>
    	<div class="container-fluid" style="background: #eaeaea;">
	     	<div class = "row" style=" background: #fff;">
				<div class = "col-xs-6" align = "left">
					<?php 
						if(isset($_GET['month'])){
							$month = mysqli_real_escape_string($conn, $_GET['month']);
						}else{
							$month = date('Y-m-d');
						}
						if(strlen($month) > 7){
							$month = substr($month, 0, 7);
						}
					?>
					<u><i><h4 style = 'margin-left: 10px;'>Collection of <?php echo date("F 01", strtotime($month)) . ' - ' . date('t, Y', strtotime($month)); ?></h4></i></u>
				</div>
				<form action = "" method = "get" id = "hidess">
					<div class="col-xs-3" style="margin-top: 10px; margin-bottom: 10px;">
	    				<input type = "month" class="form-control input-sm" name = "month" <?php if(isset($month)){ echo ' value = "' . $month . '"'; }?> >
	    			</div>
	    			<div class="col-xs-3" style="margin-top: 10px; margin-bottom: 10px;">
	    				<button class="btn btn-primary btn-sm pull-left"><span class="icon-search"></span> Search </button> 	
	    				<a href = "/cmarket" class="btn btn-danger btn-sm pull-left" style="margin-left: 5px; margin-right: 5px;"><span class="icon-spinner11"></span> Clear </a>
	    				<a href = "/cmarket?print<?php if(isset($month)){ echo '&month='.$month; } ?>" class="btn btn-success btn-sm pull-left"><span class = "icon-printer"></span> Print </a>
	    			</div>
	    		</form>
			</div>
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
   <?php if(!isset($_GET['print'])){ ?> </nav><?php } ?>
	<div class = "row">
		<div class = "col-xs-12" style="margin-top: 15px;">
			<hr>
		</div>
	</div>	
<?php 
		$totalmfee = 0;
		$totalamountpaid = 0;
		$totalbalance = 0;
		while ($row = $result->fetch_assoc()) {
			$colid = $row['store_id'];
			if($row['area'] == 0){
				$type = '';
			}else{
				$type = " and type = 'Market Fee' ";
			}
			//$sql1 = "SELECT sum(amount) as totalamount FROM `collection`,`store` where store.store_id = '$colid' and collection.store_id = '$colid' and CURDATE() BETWEEN datefr and dateto";
			$sql1 = "SELECT sum(amount) as totalamount FROM `collection`,`store` where store.store_id = '$colid' and collection.store_id = '$colid' $type and (datefr like '$month%' or dateto like '$month%')";
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
  	#hidess{
  		display: none;
  	}
}
	 #tbl td, #tbl th{
	 	border-bottom: 1px solid !important;
	 }
</style>
<?php
	if(isset($_GET['month'])){ $search = '&month=' . $_GET['month'];}
	if(isset($_GET['print'])){
		echo '<script type = "text/javascript">	window.print();window.location.href = "/cmarket?month='.$month.'";</script>';
	}
?>