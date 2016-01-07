<div id = "sowner" class="container">
	<center><u><i><h4>Official Receipt Issuance</h4></i></u><center>
	<form action="" method="post">
		<table class="table" id = "bdless" style="width:600px">
		<?php
		$mydate=date('m/d/Y');
		?>
			<tr>
				<td><b>Invoice No: <font color="red">*</font></td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="Invoice No:" name = "invoiceno"/></td>
			</tr>
			<tr>
				<td><b>Invoice Date: <font color="red">*</font></td>
				<td><input required  id = "inputsm" class = "form-control input-sm"  value="<?php echo date('Y-m-d'); ?>"  type = "date" name = "invoicedate"/></td>
			</tr>
			<tr>
				<td><b>Issued To: <font color="red">*</font></td>
				<td>
				<select class="form-control input-sm" required name = "issuedto" id = "slctown">
						<option value=""> ---------- </option>	
						<?php
							$stmt = "SELECT * FROM user  where level = 'Collector' ORDER BY lname";
							$result = $conn->query($stmt);		
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc()){								
									echo '<option value ="' . $row['account_id'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';
								}
							} 
						?>	
					</select>
				</td>
			</tr>
			<tr>
				<td><b>From: <font color="red">*</font></td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm"  onKeyUp="optTotal()" placeholder="" name = "orfrom"/></td>
			</tr>
			<tr>
				<td><b>To: <font color="red">*</font></td>
				<td><input required type = "text" id = "inputsm" class = "form-control input-sm" placeholder="" name = "orto"/></td>
			</tr>
			
			<tr>
				<td><b>Issued Date: <font color="red">*</font></td>
				<td><input required type = "date" id = "issueddate" class = "form-control input-sm" value="<?php echo date('Y-m-d'); ?>" placeholder="Invoice Date" name = "issueddate"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><button class="btn btn-primary btn-sm" type = "submit" name = "submit">Submit</button></td>
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
	$issueddate = $_POST['issueddate'];

	$stmt = $conn->prepare("INSERT INTO orissuance (invoiceno, invoicedate, issuedto, orfrom, orto, issueddate) values (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssss", $invoiceno, $invoicedate, $issuedto, $orfrom, $orto, $issueddate);
	$stmt->execute();

	echo 'Successfully Issued Official Receipt';

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