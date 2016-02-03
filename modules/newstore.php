<div class="container">
	<form action="" method="post">
		<div id = "storename">
			<div class="row" style="margin-left: -50px;">
				<div class="col-xs-12">
					<u><i><h4>Store Owner Details</h4></i></u>
				</div>
			</div>
			<div id = "ownslct" class="row">
				<div class = "col-xs-12">
					<label>Store Owner <font color="red"> * </font></label>
					<select class="form-control input-sm" required name = "sowner" id = "slctown">
						<option value=""> ---------- </option>	
						<?php
							$stmt = "SELECT * FROM owner ORDER BY lname";
							$result = $conn->query($stmt);		
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc()){								
									echo '<option value ="' . $row['owner_id'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';
								}
							}
						?>	
					</select>
				</div>
			</div>
			<div id = "storeowner" style="display: none;">
				<div class="row">
					<div class = "col-xs-4">
						<label for="inputsm">First Name: <font color="red"> * </font></label>
						<input type = "text" autocomplete = "off" autocomplete = "off" id = "fname" class = "form-control input-sm" name = "fname" placeholder = "Enter Store Owner First Name"/>
					</div>
					<div class = "col-xs-4">
						<label>Middle Name: </label>
						<input type = "text" autocomplete = "off" class = "form-control input-sm" id = "mname" name = "mname" placeholder = "Enter Store Owner Middle Name"/>
					</div>
					<div class = "col-xs-4">
						<label>Last Name: <font color="red"> * </font></label>
						<input type = "text" autocomplete = "off" class = "form-control input-sm" id = "lname" name = "lname" placeholder = "Enter Store Owner Last Name"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12" align="left">
					<label><input type = "checkbox" id = "ownertrig"/> Add New Owner</label>
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
					<input type = "text" autocomplete = "off" class = "form-control input-sm" name = "sname" required placeholder = "Enter Store Name"/>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-3">
					<label>Area (sq.m.): <font color="red"> * </font></label> 
					<input type = "text" autocomplete = "off" class = "form-control input-sm" id = "sarea" name = "sarea" required placeholder = "Enter Area"/>
				</div>
								<div class = "col-xs-3">
					<label>Multiply By: <font color="red"> * </font></label> 
					<select class="form-control input-sm" id="multiply" name = "multiply" required>
						<option value="">-------</option>
						<option value="4">4</option>
						<option value="3.75">3.75</option>
						<option value="3.5">3.5</option>
					<option value="3.25">3.25</option>
					</select>
				</div>
				<div class="col-xs-6">
					<label>Monthly Fee</label>
					<input type = "text" value = "₱ 0"readonly class="form-control input-sm" id = "mfee"/>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-6">
					<label>Building: </label> 
					<select class="form-control input-sm" name = "sbuilding">
						<option value="">-------</option>
						<option value="1">Building 1</option>
						<option value="2">Building 2</option>
					</select>
				</div>
				<div class = "col-xs-6">
					<label>Block: </label> 
					<select class="form-control input-sm" name = "block">
						<option value="">-------</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
						<option value="E">E</option>
						<option value="F">F</option>
						<option value="G">G</option>
						<option value="EWS">EWS</option>
						<option value="NWS">NWS</option>
						<option value="SWS">SWS</option>
						<option value="WWS">WWS</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class = "col-xs-12">
					<label>Classification: </label> 
					<select class="form-control input-sm" name = "classification" >
						<option value="">---------</option>
						<option value="Canteen">Canteen</option>
						<option value="Fruits & Vegetables">Fruits & Vegetables</option>
						<option value="Groceries & Sari-Sari Store">Groceries & Sari-Sari Store</option>
						<option value="Miscellaneous">Miscellaneous</option>
						<option value="Cereal & Grains">Cereal & Grains</option>
						<option value="Drugstore">Drugstore</option>
						<option value="Footwear">Footwear</option>
						<option value="Giftshop/Glassware/Kitchenware">Giftshop/Glassware/Kitchenware</option>
						<option value="Office Supplies">Office Supplies</option>
						<option value="Textile">Textile</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label><input type = "checkbox" id = "peri" name="periperals" /> Periperals </label>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12" align="center">
				<button class="btn btn-primary btn-sm" type = "submit" name = "storesubmit">Submit</button>
			</div>
		</div>
	</form>
</div>
<?php
	if(isset($_POST['storesubmit']) && !empty($_POST['sname'])){
		$sname = $_POST['sname'];
		$sarea = $_POST['sarea'];
		$sclassification = $_POST['classification'];
		$sblock = $_POST['block'];
		$sbuilding = $_POST['sbuilding'];
		if(isset($_POST['periperals'])){
			$_POST['periperals'] = 1;
		}else{
			$_POST['periperals'] = 0;
		}
		if(!empty($_POST['fname']) && !empty($_POST['mname']) && !empty($_POST['lname'])){
			$fname = $_POST['fname'];
			$mname = $_POST['mname'];
			$lname = $_POST['lname'];
			$stmt = $conn->prepare("INSERT INTO owner (fname, mname, lname) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $fname, $mname, $lname);
			$stmt->execute();
			$ownerid = $conn->insert_id;
		}else{
			$ownerid = $_POST['sowner'];
		}

		$stmt = $conn->prepare("INSERT INTO store (owner_id, sname, classification, area, building, block, periperals, multi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isssssss", $ownerid, $sname, $sclassification, $sarea, $sbuilding, $sblock, $_POST['periperals'], $_POST['multiply']);
		if($stmt->execute()){
			echo '<script type = "text/javascript">alert("Adding Record Successful");window.location.replace("/cmarket/?module=newstore");</script>';
		}
	}	
?>

<script type="text/javascript">
$(document).ready(function(){
    $('#ownertrig').change(function(){
	    if($('#ownertrig').is(":checked")){ 	        
	    	$("#ownslct").hide();
	    	$("#storeowner").show();
	    	$("#slctown").attr('required',false);
	    	$("#fname").attr('required',true);
	    	$("#mname").attr('required',true);
	    	$("#lname").attr('required',true);
	    }else{
	    	$("#ownslct").show();
	    	$("#storeowner").hide();
	    	$("#slctown").attr('required',true);
	    	$("#fname").attr('required',false);
	    	$("#mname").attr('required',false);
	    	$("#lname").attr('required',false);
	    }
	});
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