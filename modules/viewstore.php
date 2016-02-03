<div class="container">
	<form action="" method="post">
		<div id = "storename">
			<div class="row" style="margin-left: -50px;">
				<div class="col-xs-12">
					<u><i><h4>Store Owner Details</h4></i></u>
				</div>
			</div>
		<?php
			$storeid=mysql_escape_string($_GET['x']);
			$sql = "SELECT * FROM `store`,`owner` where owner.owner_id = store.owner_id and store_id = '$storeid' ";		
			$data = $conn->query($sql)->fetch_assoc();
			if($data['store_id'] != null){
				
		?>
			<div id = "storeowner" >
				<div class="row">
					<div class = "col-xs-4">
						<label for="inputsm">First Name: <font color="red"> * </font></label>
						<input value = "<?php echo $data['fname'];?>" type = "text" autocomplete = "off" autocomplete = "off" id = "fname" class = "form-control input-sm" name = "fname" placeholder = "Enter Store Owner First Name"/>
					</div>
					<div class = "col-xs-4">
						<label>Middle Name: </label>
						<input value = "<?php echo $data['mname'];?>" type = "text" autocomplete = "off" class = "form-control input-sm" id = "mname" name = "mname" placeholder = "Enter Store Owner Middle Name"/>
					</div>
					<div class = "col-xs-4">
						<label>Last Name: <font color="red"> * </font></label>
						<input value = "<?php echo $data['lname'];?>" type = "text" autocomplete = "off" class = "form-control input-sm" id = "lname" name = "lname" placeholder = "Enter Store Owner Last Name"/>
					</div>
				</div>
			</div>
	
			<div class="row" style="margin-left: -50px;">
				<div class="col-xs-12">
					<hr>
					<u><i><h4>Store Details</h4></i></u>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-12">
					<label>Store Name: <font color="red"> * </font></label> 
					<input type = "text" autocomplete = "off" class = "form-control input-sm" name = "sname" required placeholder = "Enter Store Name" value = "<?php echo $data['sname'];?>" />
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-3">
					<label>Area (sq.m.): <font color="red"> * </font></label> 
					<input type = "text" autocomplete = "off" class = "form-control input-sm" id = "sarea" name = "sarea" required value = "<?php echo $data['area'];?>" placeholder = "Enter Area"/>
				</div>
								<div class = "col-xs-3">
					<label>Multiply By: </label> 
					<select class="form-control input-sm" id="multiply" name = "multiply">
						<option value="">-------</option>
						<option <?php if($data['multi'] == '4'){ echo ' selected ';} ?> value="4">4</option>
						<option <?php if($data['multi'] == '3.75'){ echo ' selected ';} ?> value="3.75">3.75</option>
						<option <?php if($data['multi'] == '3.5'){ echo ' selected ';} ?> value="3.5">3.5</option>
						<option <?php if($data['multi'] == '3.25'){ echo ' selected ';} ?> value="3.25">3.25</option>
					</select>
				</div>
				<?php if($data['periperals'] > 0){ $peri = 100; } else { $peri = 0; }  ?>
				<div class="col-xs-6">
					<label>Monthly Fee</label>
					<input type = "text" value = "<?php echo '₱ ' . number_format($data['area'] * $data['multi'] * 30 + $peri, 2); ?>"readonly class="form-control input-sm" id = "mfee"/>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-6">
					<label>Building: </label> 
					<select class="form-control input-sm" name = "sbuilding">
						<?php
							$sela1 = "";
							$sela2 = "";
							if($data['building'] == '1'){
								$sela1 = "selected";
							}elseif($data['building'] == '2'){
								$sela2 = "selected";
							}
						?>
						<option value="">-------</option>
						<option <?php echo $sela1;?> value="1">Building 1</option>
						<option <?php echo $sela2; ?> value="2">Building 2</option>
					</select>
				</div>
				<div class = "col-xs-6">
					<label>Block: </label> 
					<select class="form-control input-sm" name = "block">
						<option value="">-------</option>
						<option value="A" <?php if($data['block'] == 'A'){ echo ' selected '; } ?>>A</option>
						<option value="B" <?php if($data['block'] == 'B'){ echo ' selected '; } ?>>B</option>
						<option value="C" <?php if($data['block'] == 'C'){ echo ' selected '; } ?>>C</option>
						<option value="D" <?php if($data['block'] == 'D'){ echo ' selected '; } ?>>D</option>
						<option value="E" <?php if($data['block'] == 'E'){ echo ' selected '; } ?>>E</option>
						<option value="F" <?php if($data['block'] == 'F'){ echo ' selected '; } ?>>F</option>
						<option value="G" <?php if($data['block'] == 'G'){ echo ' selected '; } ?>>G</option>
						<option value="EWS" <?php if($data['block'] == 'EWS'){ echo ' selected '; } ?>>EWS</option>
						<option value="NWS" <?php if($data['block'] == 'NWS'){ echo ' selected '; } ?>>NWS</option>
						<option value="SWS" <?php if($data['block'] == 'SWS'){ echo ' selected '; } ?>>SWS</option>
						<option value="WWS" <?php if($data['block'] == 'WWS'){ echo ' selected '; } ?>>WWS</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-12">
					<label>Classification: <font color="red"> * </font></label> 
					<select class="form-control input-sm" name = "classification">
						<option value="">---------</option>
						<option value="Canteen" <?php if($data['classification'] == 'Canteen'){ echo ' selected '; } ?>>Canteen</option>
						<option value="Fruits & Vegetables" <?php if($data['classification'] == 'Fruits & Vegetables'){ echo ' selected '; } ?>>Fruits & Vegetables</option>
						<option value="Groceries & Sari-Sari Store" <?php if($data['classification'] == 'Groceries & Sari-Sari Store'){ echo ' selected '; } ?>>Groceries & Sari-Sari Store</option>
						<option value="Miscellaneous" <?php if($data['classification'] == 'Miscellaneous'){ echo ' selected '; } ?>>Miscellaneous</option>
						<option value="Cereal & Grains" <?php if($data['classification'] == 'Cereal & Grains'){ echo ' selected '; } ?>>Cereal & Grains</option>
						<option value="Drugstore" <?php if($data['classification'] == 'Drugstore'){ echo ' selected '; } ?>>Drugstore</option>
						<option value="Footwear" <?php if($data['classification'] == 'Footwear'){ echo ' selected '; } ?>>Footwear</option>
						<option value="Giftshop/Glassware/Kitchenware" <?php if($data['classification'] == 'Giftshop/Glassware/Kitchenware'){ echo ' selected '; } ?>>Giftshop/Glassware/Kitchenware</option>
						<option value="Office Supplies" <?php if($data['classification'] == 'Office Supplies'){ echo ' selected '; } ?>>Office Supplies</option>
						<option value="Textile" <?php if($data['classification'] == 'Textile'){ echo ' selected '; } ?>>Textile</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label><input <?php if($data['periperals'] > 0){ echo ' checked '; } ?> type = "checkbox" id = "peri" name="periperals" /> Periperals </label>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12" align="center">
				<?php if($data['status'] > 0) { ?><button class="btn btn-primary btn-sm" type = "submit" name = "upsub"><span class = "icon-checkmark"></span> Update Record </button> <a href = "?module=storedel&x=<?php echo $data['store_id']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('Confirm Action');" ><span class="icon-cross"></span> Close Store </a> <?php } ?> &nbsp;<a href = "?module=storelist" class="btn btn-warning btn-sm"><span class = " icon-exit"></span> Back to List </a>
			</div>
		</div>
	</form>
</div>
	<?php
			$owner_id = $data['owner_id'];
			}
		?>
<?php
	if(isset($_POST['upsub'])){
		$sname = mysqli_real_escape_string($conn, $_POST['sname']);
		$sarea = mysqli_real_escape_string($conn, $_POST['sarea']);
		$sclassification = mysqli_real_escape_string($conn, $_POST['classification']);
		$sblock = mysqli_real_escape_string($conn, $_POST['block']);
		$sbuilding = mysqli_real_escape_string($conn, $_POST['sbuilding']);

		$fname = mysqli_real_escape_string($conn, $_POST['fname']);
		$mname = mysqli_real_escape_string($conn, $_POST['mname']);
		$lname = mysqli_real_escape_string($conn, $_POST['lname']);
		$update = "UPDATE owner set fname = '$fname', mname = '$mname', lname = '$lname' where owner_id = '$owner_id'";
		if($conn->query($update) == TRUE){

		}
		if(isset($_POST['periperals'])){
			$peri = '1';
		}else{
			$peri = '0';
		}
		$multi = mysqli_real_escape_string($conn, $_POST['multiply']);
		$update = "UPDATE store set multi = '$multi', sname = '$sname', classification = '$sclassification', periperals = '$peri', area = '$sarea', multi = '$multi', block = '$sblock', building = '$sbuilding' where store_id = '$storeid'";
		if($conn->query($update) == TRUE){
			echo '<script type = "text/javascript">
					alert("Update Record Successful");
					window.location.replace("?module=viewstore&x='.$storeid.'");
				</script>';
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	}	
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#peri').change(function(){
	    if($('#peri').is(":checked")){ 	        
	    	var mfee = ((Math.round($('#sarea').val() * $('#multiply').val() * 30 * 100)) / 100) + 100;
	    	mfee.toFixed(2);
			$('#mfee').val('₱ ' + mfee);
	    }else{
	    	var id = $('#mfee').val().replace('₱ ', "");
	    	var mfee = parseFloat(id - 100);
	    	mfee.toFixed(2);
	    	if(mfee < 0){
	    		mfee = 0;
	    	}
			$('#mfee').val('₱ ' + mfee);
	    }
	});
	$('#multiply').change(function(){
	    var select = $(this).val(); 	        
	    	var mfee = ((Math.round($('#sarea').val() * select * 30 * 100)) / 100);
	    	mfee.toFixed(2);
			$('#mfee').val('₱ ' + mfee);
	});
	$('#sarea').change(function(){
		var mfee = (Math.round($('#sarea').val() * $('#multiply').val() * 30 * 100)) / 100;
		mfee.toFixed(2);
		$('#mfee').val('₱ ' + mfee);
	});	
});
</script>