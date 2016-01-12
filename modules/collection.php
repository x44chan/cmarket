<?php if(!isset($_GET['action'])) { ?>
<script type="text/javascript">
	$(document).ready( function () {
		$("button[ name = 'collsub']").on("click", function(){
			if($('#trmfee').is(":checked") || $('#trebill').is(":checked") || $('#trwbill').is(":checked") || $('#trmc').is(":checked") || $('#trbt').is(":checked") || $('#trsrent').is(":checked") || $('#tramortem').is(":checked")  || $('#trpmortem').is(":checked") || $('#trtfee').is(":checked") || $('#trrfee').is(":checked") || $('#trgwill').is(":checked") || $('#trct').is(":checked") ){
			}else{
				$("#err").show();
				return false;
			}
		});
	  	$('input:checkbox').change(function(){
	  		$("#err").hide();
		    if($('#trmfee').is(":checked")){ 	        
		    	$("#mfee").show();
		    	$("input[name = 'mfeeamount']").attr('required',true);
		    }else{
		    	$("input[name = 'mfeeamount']").attr('required',false);
		    	$("#mfee").hide();
		    }
		    if($('#trebill').is(":checked")){ 	        
		    	$("#ebill").show();
		    	$("input[name = 'ebillamount']").attr('required',true);
		    }else{
		    	$("input[name = 'ebillamount']").attr('required',false);
		    	$("#ebill").hide();
		    }
		    if($('#trwbill').is(":checked")){ 	        
		    	$("#wbill").show();
		    	$("input[name = 'wbillamount']").attr('required',true);
		    }else{
		    	$("input[name = 'wbillamount']").attr('required',false);
		    	$("#wbill").hide();
		    }
		    if($('#trmc').is(":checked")){ 	        
		    	$("#mc").show();
		    	$("input[name = 'mcamount']").attr('required',true);
		    }else{
		    	$("input[name = 'mcamount']").attr('required',false);
		    	$("#mc").hide();
		    }
		    if($('#trbt').is(":checked")){ 	        
		    	$("#bt").show();
		    	$("input[name = 'btamount']").attr('required',true);
		    }else{
		    	$("input[name = 'btamount']").attr('required',false);
		    	$("#bt").hide();
		    }
		    if($('#trsrent').is(":checked")){ 	        
		    	$("#sr").show();
		    	$("input[name = 'sramount']").attr('required',true);
		    }else{
		    	$("input[name = 'sramount']").attr('required',false);
		    	$("#sr").hide();
		    }
		    if($('#tramortem').is(":checked")){ 	        
		    	$("#am").show();
		    	$("input[name = 'amamount']").attr('required',true);
		    }else{
		    	$("input[name = 'amamount']").attr('required',false);
		    	$("#am").hide();
		    }
		    if($('#trpmortem').is(":checked")){ 	        
		    	$("#pm").show();
		    	$("input[name = 'pmamount']").attr('required',true);
		    }else{
		    	$("input[name = 'pmamount']").attr('required',false);
		    	$("#pm").hide();
		    }
		    if($('#trtfee').is(":checked")){ 	        
		    	$("#tf").show();
		    	$("input[name = 'tfamount']").attr('required',true);
		    }else{
		    	$("input[name = 'tfamount']").attr('required',false);
		    	$("#tf").hide();
		    }
		    if($('#trrfee').is(":checked")){ 	        
		    	$("#rf").show();
		    	$("input[name = 'rfamount']").attr('required',true);
		    }else{
		    	$("input[name = 'rfamount']").attr('required',false);
		    	$("#rf").hide();
		    }
		    if($('#trgwill').is(":checked")){ 	        
		    	$("#g").show();
		    	$("input[name = 'gamount']").attr('required',true);
		    }else{
		    	$("input[name = 'gamount']").attr('required',false);
		    	$("#g").hide();
		    }
		    if($('#trct').is(":checked")){ 	        
		    	$("#tct").show();
		    	$("input[name = 'tctamount']").attr('required',true);
		    }else{
		    	$("input[name = 'tctamount']").attr('required',false);
		    	$("#tct").hide();
		    }
		});
		var date = "<?php echo date('Y-m-d');?>";
		$('#rngtrig').change(function(){
		  if($('#rngtrig').is(":checked")){           
		    $("#dly").hide();
		    $("#drange").show();
		    $("#dlyto").attr('required',false);
		    $("#dlyto").attr("name", "asd");
		    $("#wklymonto").val(date);
		    $("#wklymonfr").val(date);       
		    $("#wklymonto").attr('required',true);
		    $("#wklymonfr").attr('required',true);
		  }else{
		    $("#dly").show();
		    $("#drange").hide();
		    $("#dlyto").attr('required',true);
		    $("#dlyto").attr("name", "datefr");
		    $("#dlyto").val(date);
		    $("#wklymonfr").attr('required',false);
		    $("#wklymonto").attr('required',false);
		  }
		});
		$('#chckb').change(function(){
		  if($('#chckb').is(":checked")){           
		    $("#cash").hide();
		    $("#chck").show();
		    $("#mfeeamount").attr('required',false);        
		    $("#mfeeamount").attr('name',"false");
		    $("#chckamount").attr('required',true);
		    $("#chcknum").attr('required',true);
		  }else{
		    $("#cash").show();
		    $("#chck").hide();
		    $("#mfeeamount").attr('required',true);       
		    $("#mfeeamount").attr('name',"amount");
		    $("#chckamount").attr('required',false);
		    $("#chcknum").attr('required',false);
		  }
		});
	});
function showUser(str) {
	if (str == "") {
	    document.getElementById("ownerfee").innerHTML = "";
	    return;
	} else { 
	    if (window.XMLHttpRequest) {
	        // code for IE7+, Firefox, Chrome, Opera, Safari
	        xmlhttp = new XMLHttpRequest();
	    } else {
	        // code for IE6, IE5
	        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("ownerfee").innerHTML = xmlhttp.responseText;
	        }
	    };
	    xmlhttp.open("GET","ajax/ajaxowner.php?q="+str,true);
	    xmlhttp.send();
	}
}

function fee(str) {
    if (str == "") {
        document.getElementById("dfee").innerHTML = '<div class="col-xs-2"><label>Daily Fee</label><input type = "text" readonly class = "form-control input-sm" value = "0"/></div><div class="col-xs-2"><label>Weekly Fee</label><input type = "text" readonly class = "form-control input-sm" value = "0"/></div><div class="col-xs-2"><label>Monthly Fee</label><input type = "text" readonly class = "form-control input-sm" value = "0"/></div>';
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("dfee").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajax/ajaxowner.php?o="+str,true);
        xmlhttp.send();
    }
}
</script>
<div class="container">
	<div class="row" style="margin-left: -40px;">
		<div class="col-xs-12" >
			<i><u><h4>Collection</h4></u></i>
			<hr>
		</div>
	</div>
	<form action="" method = "post" class="form-group">
		<div class="row">
			<div class="col-xs-2">
				<label>Invoice #: <font color="red">*</font></label>
				<input type = "text" pattern = "[0-9]*" required class="form-control input-sm" name = "invoicenum" placeholder = "Invoice #" autocomplete = "off">
			</div>
			<div class="col-xs-4">
				<label>OR Number: <font color="red">*</font></label>
				<input required name="ornum" type="text" class="form-control input-sm" placeholder = "Enter OR #" autocomplete = "off" pattern = "[0-9]*"/>
			</div>
			<div class="col-xs-4">
				<label>Date of Collection: <font color="red">*</font></label>
				<input required name = "datecollect" class="form-control input-sm" type = "date" value = "<?php echo date('Y-m-d');?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Store Owner: <font color="red">*</font></label>
				<select required name = "streown" class="form-control input-sm" id = "change" onchange="showUser(this.value)">
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
			<div class="col-xs-6">
				<label>Store Name  <font color="red">*</font></label>
				<select required name = "strename" class = "form-control input-sm" id = "ownerfee" onchange="fee(this.value)">
					<option value="">-------</option>
				</select>
			</div>
		</div>
		<div class="row" style="margin-left: -40px;">
			<div class="col-xs-12" >
				<i><u><h4>Collection Type</h4></u></i>
				<i><h6 style = "color: red; font-size: 13px;">Note: You can check more than 1 Collection Type if the O.R. Number is the same.</h6></i> 
				<hr>
			</div>
		</div>
		<table style = "margin-top: -10px;" class="table" id = "table" align="left">
			<tr>
				<td>
					<label><input type = "checkbox" id = "trmfee"> M. Fee</label>
				</td>
				<td>
					<label><input type = "checkbox" id = "trebill"> E. Bill</label>
				</td>
				<td>
					<label><input type = "checkbox" id = "trwbill"> W. Bill</label>
				</td>
				<td>
					<label><input type = "checkbox" id = "trmc"> M. Clearance</label>
				</td>				
				<td>
					<label><input type = "checkbox" id = "trbt"> B. Tax</label>
				</td>
				<td>
					<label><input type = "checkbox" id = "trsrent"> S. Rental</label>
				</td>				
				<td>
					<label><input type = "checkbox" id = "tramortem"> A. Mortrem</label>
				</td>				
				<td>
					<label><input type = "checkbox" id = "trpmortem"> P. Mortrem</label>
				</td>

				<td>
					<label><input type = "checkbox" id = "trtfee"> T. Fee</label>
				</td>

				<td>
					<label><input type = "checkbox" id = "trrfee"> R. Fee</label>
				</td>

				<td>
					<label><input type = "checkbox" id = "trgwill"> G. Will</label>
				</td>

				<td>
					<label><input type = "checkbox" id = "trct"> TCT</label>
				</td>
			</tr>
			<tr style="color: red; display: none;" id = "err">
				<td colspan="12" align="center"> <i><label>Select atleast 1 collection type.</label></td>
			</tr>
		</table>
		<div id = "mfee" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h5 style="font-size: 15.5px;">Market Fee Collection</h5></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div id = "drange" style="display: none;">
					<div class="col-xs-3">
						<label>Date of Payment From: <font color="red">*</font></label>
						<input type="date" name = "mfeedatefr" id = "wklymonfr" class="form-control input-sm" />
					</div>
					<div class="col-xs-3">
						<label>Date of Payment To:  <font color="red">*</font></label>
						<input type="date" name = "mfeedateto" id = "wklymonto" class="form-control input-sm" value="<?php echo date('Y-m-d');?>"/>
					</div>
				</div>
				<div id = "dly">
					<div class="col-xs-6">
						<label>Date of Payment:  <font color="red">*</font></label>
						<input type="date" name = "mfeedatefr" id = "dlyto" class="form-control input-sm" value="<?php echo date('Y-m-d');?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6" align="left">
					<label><input type = "checkbox" id ="rngtrig" name = "rngtrig" /> Switch to Weekly/Monthly</label>
				</div>
			</div>
			<div class="row">
				<div id = "dfee">
					<div class="col-xs-2">
						<label>Daily Fee</label>
						<input type = "text" readonly class = "form-control input-sm" value = "0"/>
					</div>
					<div class="col-xs-2">
						<label>Weekly Fee</label>
						<input type = "text" readonly class = "form-control input-sm" value = "0"/>
					</div>				
					<div class="col-xs-2">
						<label>Monthly Fee</label>
						<input type = "text" readonly class = "form-control input-sm" value = "0"/>
					</div>
				</div>
				<div class="col-xs-5" id = "cash">
					<label>Amount: <font color="red">*</font></label>
					<input id = "amount" name = "mfeeamount" type="text" class="form-control input-sm" placeholder = "Enter Amount Paid"/>
				</div>				
				<div id = "chck" style="display: none;">
					<div class="col-xs-3">
						<label>Amount: <font color="red">*</font></label>
						<input id = "chckamount" name = "chckamount" type="text" class="form-control input-sm" placeholder = "Enter Amount Paid"/>
					</div>
					<div class="col-xs-3">
						<label>Check #: <font color="red">*</font></label>
						<input id = "chcknum" name = "chcknum" type="text" class="form-control input-sm" placeholder = "Enter Check Number"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6" align="left">
					<label><input type = "checkbox" id ="chckb" name = "chcb" /> Switch to Check</label>
				</div>
			</div>
		</div>
		<div id = "ebill" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Electric Bill</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3">
					<label>Date of Payment From: <font color="red">*</font></label>
					<input type="date" name = "ebilldatefr" id = "ewklymonfr" class="form-control input-sm" value="<?php echo date('Y-m-d');?>"/>
				</div>
				<div class="col-xs-3">
					<label>Date of Payment To:  <font color="red">*</font></label>
					<input type="date" name = "ebilldateto" id = "ewklymonto" class="form-control input-sm" value="<?php echo date('Y-m-d');?>"/>
				</div>
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="ebillamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "wbill" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Water Bill</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3">
					<label>Date of Payment From: <font color="red">*</font></label>
					<input type="date" name = "wbilldatefr" class="form-control input-sm" value="<?php echo date('Y-m-d');?>"/>
				</div>
				<div class="col-xs-3">
					<label>Date of Payment To:  <font color="red">*</font></label>
					<input type="date" name = "wbilldateto" class="form-control input-sm" value="<?php echo date('Y-m-d');?>"/>
				</div>
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="wbillamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "mc" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Market Clearance</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="mcamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "bt" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Business Tax</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="btamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "sr" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Space Rental</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="sramount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "am" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Anti - Mortem</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="amamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "pm" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Post Mortem</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="pmamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "tf" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Transfer Fee</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="tfamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "rf" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Renewal Fee</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="rfamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "g" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Goodwill</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="gamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "tct" style="display: none;">
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">TCT</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input name="tctamount" type="text" class="form-control input-sm" required placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12" align="center">
				<button class="btn btn-sm btn-primary" name = "collsub" onclick = "return confirm('Are you sure?');">Submit</button>
			</div>
		</div>
	</form>
</div>
<?php
	$count = 0;
	if(isset($_POST['collsub'])){
		if(isset($_POST['mfeeamount']) && !empty($_POST['mfeeamount'])){
			$type = "Market Fee";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, datefr, dateto, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiisss", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['mfeeamount'], $_POST['mfeedatefr'], $_POST['mfeedateto'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['ebillamount']) && !empty($_POST['ebillamount'])){
			$type = "Electric Bill";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, datefr, dateto, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiisss", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['ebillamount'], $_POST['ebilldatefr'], $_POST['ebilldateto'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['wbillamount']) && !empty($_POST['wbillamount'])){
			$type = "Water Bill";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, datefr, dateto, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiisss", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['wbillamount'], $_POST['wbilldatefr'], $_POST['wbilldateto'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['mcamount']) && !empty($_POST['mcamount'])){
			$type = "Market Clearance";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['mcamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['btamount']) && !empty($_POST['btamount'])){
			$type = "Business Tax";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['btamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['sramount']) && !empty($_POST['sramount'])){
			$type = "Space Rental";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['sramount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['amamount']) && !empty($_POST['amamount'])){
			$type = "Anti Mortem";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['amamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['pmamount']) && !empty($_POST['pmamount'])){
			$type = "Post Mortem";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['pmamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['tfamount']) && !empty($_POST['tfamount'])){
			$type = "Transfer Fee";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['tfamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['rfamount']) && !empty($_POST['rfamount'])){
			$type = "Renewal Fee";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['rfamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['gamount']) && !empty($_POST['gamount'])){
			$type = "Goodwill";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['gamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['tctamount']) && !empty($_POST['tctamount'])){
			$type = "TCT";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiiis", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['tctamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}

		if($count > 0){
			echo '<script type = "text/javascript">alert("Adding Record Successful");window.location.replace("/cmarket/?module=collection&action=daily");</script>';
		}		
	}
?>

<?php } ?>


<?php
	if(isset($_GET['action']) && $_GET['action'] == 'daily'){
		if(isset($_GET['coldate'])){
			$date = mysqli_real_escape_string($conn, $_GET['coldate']);
		}else{
			$date = date("Y-m-d");	
		}
	//datefr <= '$date' and dateto >= '$date'
	$sql = "SELECT * FROM `store`,`owner`,`collection` where collection.owner_id = owner.owner_id and collection.store_id = store.store_id and paydate = '$date' group by ornum";
	$result = $conn->query($sql);		
	
?>

<div class="container-fuild" id = "tble"style="padding: 5px 10px; text-align: center;">
	<div class="row">
		<div class="col-xs-12">
			
		</div>
	</div>
	<div class = "row">
		<form action="" method="get" >
			<input type = 'hidden' name = "module" value = "collection">
			<input type = 'hidden' name = "action" value = "daily">
			<div class="col-xs-2" style="margin-top: -10px;">
				<label>Date Of Collection</label>
				<input required type = "date" name = "coldate" class="form-control input-sm"/>
			</div>
			<div class="col-xs-2" style="margin-top: -10px;">
				<label></label>
				<div class="form-inline">
					<button class="form-control btn btn-primary btn-sm"> Search </button>
					<a href = "?module=collection&action=daily" class="form-control btn btn-danger btn-sm"> Clear </a>
				</div>
			</div>
		</form>
		<div class = "col-xs-4">
			<i><h4><?php echo date("M d, Y", strtotime($date)); ?> / DAILY COLLECTION</h4></i>
		</div>
		<div class="col-xs-12">
			<hr>
		</div>
	</div>
	<table class="table table-responsive" style="overflow-x: auto;">
		<thead>
			<th>OR #</th>
			<th>Store Owner</th>
			<th>M.FEE</th>
			<th>MONTH</th>
			<th>E.BILL</th>
			<th>MONTH</th>
			<th>W.BILL</th>
			<th>MONTH</th>
			<th>MC</th>
			<th>BT/SR</th>
			<th>AM</th>
			<th>PM</th>
			<th>TF</th>
			<th>RF</th>
			<th>G</th>
			<th>TCT</th>
		</thead>
		<tbody>
			<tr><td colspan = "16"><hr></td></tr>
<?php 
	if($result->num_rows > 0){
		$total = 0;		
		$mfeetotal = 0;
		while ($row = $result->fetch_assoc()) {
			$ebill = " - ";
			$ecov = " - ";
			$mfeeamount = " - ";
			$mfeecov = " - ";
			$wbill = " - ";
			$wcov = " - ";
			$mc = " - ";
			$btsr = " - ";	
			$am = " - ";
			$pm = " - ";
			$tf = " - ";
			$rf = " - ";
			$g = " - ";
			$tct = " - ";		
			echo '<tr>';
			echo '<td>' . $row['ornum'] . '</td>';
			echo '<td>' . strtoupper($row['fname']) . ' ' . strtoupper($row['lname']) . '</td>';
			$query = "SELECT * FROM collection where ornum = '$row[ornum]' and paydate = '$date'";
			$res = $conn->query($query);
			if($res->num_rows > 0){
				while ($row2 = $res->fetch_assoc()){
					$date1 = $row2['datefr'];
					$date2 = $row2['dateto'];
					if($date1 != $date2){
						if(date('M', strtotime($date1)) != date('M', strtotime($date2))){
							$month = date("M j, Y", strtotime($row2['datefr'])) . ' - ' . date("M j, Y", strtotime($row2['dateto']));
						}else{
							$month = date("M j", strtotime($row2['datefr'])) . ' - ' . date("j, Y", strtotime($row2['dateto']));	
						}				
					}else{
						if($row2['datefr'] == date("Y-m-d")){
							$month = " - ";
						}else{
							$month = ' - ';
						}
						//$month = date("M j, Y", strtotime($row2['datefr']));
					}

					if($row2['type'] == "Market Fee"){
						$mfeeamount = '₱ ' . number_format($row2['amount']);
						$mfeecov = strtoupper($month);
						$mfeetotal += $row2['amount'];
					}
					if($row2['type'] == "Electric Bill"){
						$ebill = '₱ ' . number_format($row2['amount']);
						$ecov = strtoupper($month);
					}
					if($row2['type'] == "Water Bill"){
						$wbill = '₱ ' . number_format($row2['amount']);
						$wcov = strtoupper($month);
					}
					if($row2['type'] == "Market Clearance"){
						$mc = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Business Tax" || $row2['type'] == "Space Rental"){
						$btsr = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Anti Mortem"){
						$am = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Post Mortem"){
						$pm = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Transfer Fee"){
						$tf = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Renewal Fee"){
						$rf = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "Goodwill"){
						$g = '₱ ' . number_format($row2['amount']);
					}
					if($row2['type'] == "TCT"){
						$tct = '₱ ' . number_format($row2['amount']);
					}

				}
				echo '<td>' . $mfeeamount . '</td>';
				echo '<td>' . $mfeecov . '</td>';
				echo '<td>'.$ebill.'</td>';
				echo '<td>'.$ecov.'</td>';
				echo '<td>'.$wbill.'</td>';
				echo '<td>'.$wcov.'</td>';
				echo '<td>'.$mc.'</td>';
				echo '<td>'.$btsr.'</td>';
				echo '<td>'.$am.'</td>';
				echo '<td>'.$pm.'</td>';
				echo '<td>'.$tf.'</td>';
				echo '<td>'.$rf.'</td>';
				echo '<td>'.$g.'</td>';
				echo '<td>'.$tct.'</td>';
				echo '</tr>';
			}
			
			

		}
	echo '<tr><td colspan = 16><hr></td><tr>';
	echo '<tr><td colspan = "2"><b>Total </b></td><td>₱ ' . number_format($mfeetotal) . '</td><td colspan = "14"></td></tr>';
	}else{
		echo '<div class = "row"><div class = "col-xs-12"><h4><i>No Record Found</i></h4></div></div>';
	}
 
?>		</tbody>
	</table>
</div>
<?php
	}
?>

<?php
	if(isset($_GET['action'])  && $_GET['action'] == 'err'){ 
	$date = date("Y-m-d");
	//datefr <= '$date' and dateto >= '$date'
	$sql = "SELECT * FROM `store`,`owner`,`collection` where collection.owner_id = owner.owner_id and collection.store_id = store.store_id and paydate = '$date'";
	$result = $conn->query($sql);		
	
?>
<div class="container-fuild" style="padding: 5px 10px; text-align: center;">
	<div class = "row">
		<div class = "col-xs-12">
			<i><h4><?php echo date("M d, Y", strtotime($date)); ?> / DAILY COLLECTION</h4></i>
		</div>
	</div>
	<div class="row">
		<div class = "col-xs-1">
			<label> OR Number </label>
		</div>
		<div class="col-xs-3">
			<label> Store Owner </label>			
		</div>
		<div class="col-xs-1">
			<label> M.Fee</label>			
		</div>
		<div class="col-xs-2">
			<label>Coverage</label>
		</div>		
		<div class="col-xs-1">
			<label>E.Bill</label>
		</div>		
		<div class="col-xs-1">
			<label>Month</label>
		</div>
		<div class="col-xs-1">
			<label>W.Bill</label>
		</div>		
		<div class="col-xs-1">
			<label>Month</label>
		</div>		
		<div class="col-xs-1">
			<label>BT/SR</label>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-12">
			<hr>
		</div>
	</div>	
<?php 
	if($result->num_rows > 0){
		$total = 0;
		while ($row = $result->fetch_assoc()) {
			$date1 = $row['datefr'];
			$date2 = $row['dateto'];
			if($date1 != $date2){
				if(date('M', strtotime($date1)) != date('M', strtotime($date2))){
					$month = date("M j, Y", strtotime($row['datefr'])) . ' - ' . date("M j, Y", strtotime($row['dateto']));
				}else{
					$month = date("M j", strtotime($row['datefr'])) . ' - ' . date("j, Y", strtotime($row['dateto']));	
				}				
			}else{
				if($row['datefr'] == date("Y-m-d")){
					$month = "";
				}
				//$month = date("M j, Y", strtotime($row['datefr']));
			}
			echo '<div class = "row">';
			echo '<div class = "col-xs-1">' . $row['ornum'] . '</div>';
			echo '<div class = "col-xs-3">' . strtoupper($row['fname']) . ' ' . strtoupper($row['lname']) . '</div>';
			echo '<div class = "col-xs-1">₱ ' . number_format($row['amount']) . '</div>';
			echo '<div class = "col-xs-2">' . strtoupper($month) . '</div>';
			echo '<div class="col-xs-1">₱ 10,000</div><div class="col-xs-1">₱ 10,000</div><div class="col-xs-1">₱ 10,000</div>';
			echo '<div class="col-xs-1">₱ 10,000</div><div class="col-xs-1">₱ 10,000</div>';
			echo '</div>';
			$total += $row['amount'];
		}
	
	echo '<div class = "row"><div class = "col-xs-12"><hr></div></div>';
	echo '<div class = "row"><div class = "col-xs-3 col-xs-offset-1"><b>Total Amount </b></div><div class = "col-xs-1">₱ ' . number_format($total) . '</div></dvi>';
	echo '</div>';
	}else{
		echo '<div class = "row"><div class = "col-xs-12"><h4><i>No Record Found</i></h4></div></div>';
	}
} 
?>