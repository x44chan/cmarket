<?php
	$id = mysqli_real_escape_string($conn, $_GET['x']);
	$stmt = "SELECT * FROM orissuance where issuanceid = '$id'";
	$data = $conn->query($stmt)->fetch_assoc();

?>
<div id = "sowner" class="container">
	<center><u><i><h4>Official Receipt Issuance Update</h4></i></u><center>
	<form action="" method="post">
		<table class="table" id = "bdless" style="width:600px">
		<?php
		$mydate=date('m/d/Y');
		?>
			<tr>
				<td><b>Invoice No: <font color="red">*</font></td>
				<td><input required type = "text" id = "inputsm" value="<?php echo $data['invoiceno'];?>" class = "form-control input-sm" placeholder="Invoice No:" name = "invoiceno"/></td>
			</tr>
			<tr>
				<td><b>Invoice Date: <font color="red">*</font></td>
				<td><input required  id = "inputsm" class = "form-control input-sm"  value="<?php echo $data['invoicedate'];?>"  type = "date" name = "invoicedate"/></td>
			</tr>
			<tr>
				<td><b>Issued To: <font color="red">*</font></td>
				<td>
				<select class="form-control input-sm"  name = "issuedto" id = "slctown">
				<?php
					$isid=$data['issuedto'];
			$sql = "SELECT * FROM user where account_id =  '$isid' ORDER BY lname";
				$result2 = $conn->query($sql);		
			if($result2->num_rows > 0){
				$row2 = $result2->fetch_assoc();
					$userissued=$row2['lname'] . ', ' . $row2['fname'] . ' ' . $row2['mname'] ;
			}else{
				
				$userissued="No User Found";
			}
				?>
						<option value="<?php echo $isid;?>"><?php echo $userissued;?></option>	
						<?php
							$stmt = "SELECT * FROM user  where level = 'Administrator' ORDER BY lname";
							$result = $conn->query($stmt);		
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc()){
									if($isid!=$row['account_id']){									
									echo '<option value ="' . $row['account_id'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';}
								}
							} 
						?>	
					</select>
				</td>
			</tr>
			<tr>
				<td><b>From: <font color="red">*</font></td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm"  onKeyUp="optTotal()" placeholder="" value="<?php echo $data['orfrom'];?>" name = "orfrom"/></td>
			</tr>
			<tr>
				<td><b>To: <font color="red">*</font></td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm" placeholder=""  value="<?php echo $data['orto'];?>" name = "orto"/></td>
			</tr>
			
			<tr>
				<td><b>Issued Date: <font color="red">*</font></td>
				<td><input required type = "date" id = "issueddate" class = "form-control input-sm" value="<?php echo $data['issueddate'];?>" placeholder="Invoice Date" name = "issueddate"/></td>
			</tr>
			<tr>
				<td><b>Reason: <font color="red">*</font></td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="Reason"  value="" name = "reason"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><button class="btn btn-primary btn-sm" type = "submit" name = "submit">Update</button></td>
			</tr>
		</div>
	</form>
</div>

<?php
if(isset($_POST['submit'])){
	$invoiceno = $_POST['invoiceno'];
	$invoicedate = $_POST['invoicedate'];
	$issuedto = $_POST['issuedto'];
	$orfrom = $_POST['orfrom'];
	$orto = $_POST['orto'];
		$reason = $_POST['reason'];
	$issueddate = $_POST['issueddate'];
$stmt = $conn->prepare("UPDATE orissuance set invoiceno = ?, invoicedate = ?, issuedto = ?, orfrom = ?, orto = ?, issueddate = ?, reason = ? where issuanceid = ?");
$stmt->bind_param("issssssi", $invoiceno, $invoicedate, $issuedto, $orfrom, $orto, $issueddate, $reason, $_GET['x']);

	$stmt->execute();

	if($stmt->execute()){
			echo '<script type = "text/javascript"> alert("Update successful"); window.location.href = "?module=orlist";</script>';
		}

}

?><script  type="text/javascript">
function optTotal() {
		
        var a1 = document.forms[0].orfrom;


		
        if (a1.value && a1.value != "")
            a1 = parseFloat(a1.value);
        else
            a1 = 0;


		
		a1=a1 + 50;
		document.forms[0].orto.value = a1;

}	
</script>	