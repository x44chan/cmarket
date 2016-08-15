<?php if(!isset($_GET['action'])) { 
	if(isset($_GET['or'])){
		$ornum = mysqli_real_escape_string($conn, $_GET['or']);
		$or = "SELECT * FROM collection,store where store.store_id = collection.store_id and ornum = '$ornum'";
		$resor = $conn->query($or);
		if($resor->num_rows > 0){
			$edmfee = 0; $edbill = 0; $edwbill = 0; $edmclear = 0; $edbtax = 0; $edsrental = 0; $edamortem = 0; $edpmortem = 0; $edtfee = 0; $edrfee = 0; $edgwill = 0; $edtct = 0; $edpfee = 0;
			$dataor = $conn->query($or)->fetch_assoc();
			while ($or = $resor->fetch_assoc()) {
				if($or['type'] == 'Market Fee'){
					$edmfee += $or['amount'];
					$tymfee = 1;
					if(!empty($or['checknum'])){
						$mchck = $or['checknum'];
					}else{
						$mchck = "";
					}
				}elseif($or['type'] == 'Electric Bill'){
					$edbill += $or['amount'];
					$tyebill = 1;
					if(!empty($or['checknum'])){
						$echck = $or['checknum'];
					}else{
						$echck = "";
					}
				}elseif($or['type'] == 'Water Bill'){
					$edwbill += $or['amount'];
					$tywbill = 1;
					if(!empty($or['checknum'])){
						$wchck = $or['checknum'];
					}else{
						$wchck = "";
					}
				}elseif($or['type'] == "Market Clearance"){
					$edmclear += $or['amount'];
					$tymclear = 1;
				}elseif($or['type'] == "Business Tax"){
					$edbtax += $or['amount'];
					$typbtax = 1;
				}elseif($or['type'] == "Space Rental"){
					$edsrental += $or['amount'];
					$tysrental = 1;
				}elseif($or['type'] == "Anti Mortem"){
					$edamortem += $or['amount'];
					$typamortem = 1;
				}elseif($or['type'] == 'Post Mortem'){
					$edpmortem += $or['amount'];
					$typmorem = 1;
				}elseif($or['type'] == 'Transfer Fee'){
					$edtfee += $or['amount'];
					$typtfee = 1;
				}elseif($or['type'] == 'Renewal Fee'){
					$edrfee += $amount;
					$typrfee = 1;
				}elseif($or['type'] == "Goodwill"){
					$edgwill += $or['amount'];
					$typgwill = 1;
					if(!empty($or['checknum'])){
						$gchck = $or['checknum'];
					}else{
						$gchck = "";
					}
				}elseif($or['type'] == "TCT"){
					$edtct += $or['amount'];
					$typtct = 1;
				}elseif($or['type'] == "Permit Fee"){
					$edpfee += $or['amount'];
					$typpfee = 1;
				}
			}
		}else{
			echo '<script>alert("No record found");window.location.href = "?module=collection&action=edit&or=' . $ornum . '";</script>';
		}
	}
?>
<script type="text/javascript">
	$(document).ready( function () {
		$("button[ name = 'collsub']").on("click", function(){
			if($('#trmfee').is(":checked") || $('#trebill').is(":checked") || $('#trwbill').is(":checked") || $('#trmc').is(":checked") || $('#trbt').is(":checked") || $('#trsrent').is(":checked") || $('#tramortem').is(":checked")  || $('#trpmortem').is(":checked") || $('#trtfee').is(":checked") || $('#trrfee').is(":checked") || $('#trgwill').is(":checked") || $('#trct').is(":checked") ||  $('#trpfee').is(":checked") ){
			}else{
				$("#err").show();
				return false;
			}
		});
		$("#numofdays").change(function(){
			var calfee = parseInt($("#numofdays").val()) * parseFloat($("#dailyfee").val());
			$("input[name='mfeeamount']").val(calfee.toFixed(2));
		});
		<?php if(isset($dataor['store_id'])){ ?>
		$("#ownerfee").ready(function(){
		    fee(<?php echo $dataor['store_id'];?>);
		});
		<?php } ?>
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
		    if($('#trpfee').is(":checked")){ 	        
		    	$("#pfee").show();
		    	$("input[name = 'pfeeamount']").attr('required',true);
		    }else{
		    	$("input[name = 'pfeeamount']").attr('required',false);
		    	$("#pfee").hide();
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
		    $("#wklymonto").attr("name","mfeedateto");
		    $("#wklymonfr").attr("name","mfeedatefr");       
		    $("#wklymonto").attr('required',true);
		    $("#wklymonfr").attr('required',true);
		  }else{
		    $("#dly").show();
		    $("#drange").hide();
		    $("#dlyto").attr('required',true);
		    $("#dlyto").attr("name", "mfeedatefr");
		    $("#wklymonto").attr("name","false");
		    $("#wklymonfr").attr("name","false");
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
		    $("#chckamount").attr('name',"mfeeamount");
		    $("#chcknum").attr('required',true);
		  }else{
		    $("#cash").show();
		    $("#chck").hide();
		    $("#mfeeamount").attr('required',true);       
		    $("#mfeeamount").attr('name',"mfeeamount");
		    $("#chckamount").attr('required',false);
		    $("#chckamount").attr('name',false);
		    $("#chcknum").attr('required',false);
		  }
		});
		$('#echckb').change(function(){
		  if($('#echckb').is(":checked")){           
		    $("#ecash").hide();
		    $("#echck").show();
		    $("#ebillamount").attr('required',false);        
		    $("#ebillamount").attr('name',"false");
		    $("#echckamount").attr('required',true);
		    $("#echckamount").attr('name',"ebillamount");
		    $("#echcknum").attr('required',true);
		  }else{
		    $("#ecash").show();
		    $("#echck").hide();
		    $("#ebillamount").attr('required',true);       
		    $("#ebillamount").attr('name',"ebillamount");
		    $("#echckamount").attr('required',false);
		    $("#echckamount").attr('name',false);
		    $("#echcknum").attr('required',false);
		  }
		});
		$('#wchckb').change(function(){
		  if($('#wchckb').is(":checked")){           
		    $("#wcash").hide();
		    $("#wchck").show();
		    $("#wbillamount").attr('required',false);        
		    $("#wbillamount").attr('name',"false");
		    $("#wchckamount").attr('required',true);
		    $("#wchckamount").attr('name',"wbillamount");
		    $("#wchcknum").attr('required',true);
		  }else{
		    $("#wcash").show();
		    $("#wchck").hide();
		    $("#wbillamount").attr('required',true);       
		    $("#wbillamount").attr('name',"wbillamount");
		    $("#wchckamount").attr('required',false);
		    $("#wchckamount").attr('name',false);
		    $("#wchcknum").attr('required',false);
		  }
		});
		$('#gchckb').change(function(){
		  if($('#gchckb').is(":checked")){           
		    $("#gcash").hide();
		    $("#gchck").show();
		    $("#gamount").attr('required',false);        
		    $("#gamount").attr('name',"false");
		    $("#gchckamount").attr('required',true);
		    $("#gchckamount").attr('name',"gamount");
		    $("#gchcknum").attr('required',true);
		  }else{
		    $("#gcash").show();
		    $("#gchck").hide();
		    $("#gamount").attr('required',true);       
		    $("#gamount").attr('name',"gamount");
		    $("#gchckamount").attr('required',false);
		    $("#gchckamount").attr('name',false);
		    $("#gchcknum").attr('required',false);
		  }
		});
	});
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
				<select required class="form-control input-sm" name = "invoicenum" placeholder = "Invoice #" id="invoice" autocomplete = "off" onchange="showOR(this.value)">
				<option value=""> ---------- </option>
					<?php
						if(isset($dataor['invoice'])){
							echo '<option selected value ="' . $dataor['invoice'] . '">' . $dataor['invoice'] . '</option>';
						}
					?>
					<?php
						$stmt = "SELECT * FROM orissuance where issueddate = curdate()";;
						$result = $conn->query($stmt);		
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){	
								$sql1 = "SELECT * FROM collection where invoice = '$row[invoiceno]' order by ornum desc";
								$data = $conn->query($sql1)->fetch_assoc();
								if($data['ornum'] != $row['orto']){
									echo '<option value ="' . $row['issuanceid'] . '">' . $row['invoiceno'] . '</option>';
								}
							}
						}
					?>					
				</select>
			</div>
			<div class="col-xs-4">
				<label>OR Number: <font color="red">*</font></label>
				<select required name="ornum" type="text" class="form-control input-sm" placeholder = "Enter OR #" id="ornom" autocomplete = "off"/>
				<option value=""> ---------- </option>
					<?php
						if(isset($dataor['ornum'])){
							echo '<option selected value = "' . $dataor['ornum'] . '">' . $dataor['ornum'] . '</option>';
						}
					?>			
				</select>
			</div>
			<div class="col-xs-4">
				<label>Date of Collection: <font color="red">*</font></label>
				<input required name = "datecollect" class="form-control input-sm" type = "date" value = "<?php if(isset($dataor['paydate'])){ echo $dataor['paydate']; }else{ echo date('Y-m-d'); }?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Store Owner: <font color="red">*</font></label>
				<select required name = "streown" class="form-control input-sm" id = "change" onchange="showUser(this.value)">
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
								echo '<option '.$s.' value ="' . $row['owner_id'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';
							}
						}
					?>	
				</select>
			</div>
			<div class="col-xs-6">
				<label>Store Name  <font color="red">*</font></label>
				<select required name = "strename" class = "form-control input-sm" id = "ownerfee" onchange="fee(this.value)">
					<option value="">-------</option>
					<?php
						if(isset($dataor['store_id'])){
							echo '<option selected value = "' . $dataor['store_id'] . '"> ' . $dataor['sname'] . '</option>';
						}
					?>
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
					<label><input <?php if(isset($tymfee)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($tymfee)){ echo ' disabled ';} ?> type = "checkbox" id = "trmfee"> M. Fee</label>
				</td>
				<td>
					<label><input <?php if(isset($tyebill)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($tyebill)){ echo ' disabled ';} ?> type = "checkbox" id = "trebill"> E. Bill</label>
				</td>
				<td>
					<label><input <?php if(isset($tywbill)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($tywbill)){ echo ' disabled ';} ?> type = "checkbox" id = "trwbill"> W. Bill</label>
				</td>
				<td>
					<label><input <?php if(isset($tymclear)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($tymclear)){ echo ' disabled ';} ?> type = "checkbox" id = "trmc"> M. Clearance</label>
				</td>				
				<td>
					<label><input <?php if(isset($typbtax)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($typbtax)){ echo ' disabled ';} ?> type = "checkbox" id = "trbt"> B. Tax</label>
				</td>
				<td>
					<label><input <?php if(isset($tysrental)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($tysrental)){ echo ' disabled ';} ?> type = "checkbox" id = "trsrent"> S. Rental</label>
				</td>				
				<td>
					<label><input <?php if(isset($typamortem)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($typamortem)){ echo ' disabled ';} ?> type = "checkbox" id = "tramortem"> A. Mortrem</label>
				</td>				
				<td>
					<label><input <?php if(isset($typmorem)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($typmorem)){ echo ' disabled ';} ?> type = "checkbox" id = "trpmortem"> P. Mortrem</label>
				</td>

				<td>
					<label><input <?php if(isset($typtfee)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($typtfee)){ echo ' disabled ';} ?> type = "checkbox" id = "trtfee"> T. Fee</label>
				</td>

				<td>
					<label><input <?php if(isset($typrfee)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($typrfee)){ echo ' disabled ';} ?> type = "checkbox" id = "trrfee"> R. Fee</label>
				</td>

				<td>
					<label><input <?php if(isset($typgwill)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($typgwill)){ echo ' disabled ';} ?> type = "checkbox" id = "trgwill"> G. Will</label>
				</td>

				<td>
					<label><input <?php if(isset($typtct)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($typtct)){ echo ' disabled ';} ?> type = "checkbox" id = "trct"> TCT</label>
				</td>
				<td>
					<label><input <?php if(isset($typpfee)){ echo ' checked '; }elseif(isset($_GET['or']) && !isset($typpfee)){ echo ' disabled ';} ?> type = "checkbox" id = "trpfee"> P. Fee </label>
				</td>
			</tr>
			<tr style="color: red; display: none;" id = "err">
				<td colspan="12" align="center"> <i><label>Select atleast 1 collection type.</label></td>
			</tr>
		</table>
		<div id = "mfee" <?php if(isset($tymfee) && $tymfee == 1){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h5 style="font-size: 15.5px;">Market Fee Collection</h5></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div id = "drange" <?php if(isset($dataor['datefr']) && $dataor['datefr'] == $dataor['dateto']){ echo 'style="display: none;"';}elseif(isset($dataor['datefr']) && $dataor['datefr'] != $dataor['dateto']){}else{echo ' style = "display: none;" ';}?>>
					<div class="col-xs-3">
						<label>Date of Payment From: <font color="red">*</font></label>
						<input type="date" id = "wklymonfr" class="form-control input-sm" <?php if(isset($dataor['datefr']) && $dataor['datefr'] != $dataor['dateto']){ echo 'value = "'. $dataor['datefr'] .'" name = "mfeedatefr"';}?>/>
					</div>
					<div class="col-xs-3">
						<label>Date of Payment To:  <font color="red">*</font></label>
						<input type="date" id = "wklymonto" class="form-control input-sm" <?php if(isset($dataor['datefr']) && $dataor['datefr'] != $dataor['dateto']){ echo 'value = "'. $dataor['dateto'] .'" name = "mfeedateto"';}?>/>
					</div>
				</div>
				<div id = "dly" <?php if(isset($dataor['datefr']) && $dataor['datefr'] != $dataor['dateto']){ echo 'style="display: none;"';}elseif(isset($dataor['datefr']) && $dataor['datefr'] == $dataor['dateto']){}?>>
					<div class="col-xs-6">
						<label>Date of Payment:  <font color="red">*</font></label>
						<input type="date" id = "dlyto" class="form-control input-sm" <?php if(isset($dataor['datefr']) && $dataor['datefr'] == $dataor['dateto']){ echo 'value = "'. $dataor['datefr'] .'" name = "mfeedatefr"';}elseif(!isset($dataor['datefr'])){ echo 'value = "'.date("Y-m-d").'" name = "mfeedatefr"';}?> />
					</div>
				</div>
				<div class="col-xs-5">
					<label>Number of Days: <font color="red">*</font></label>
					<input type="text" class="form-control input-sm" id = "numofdays" placeholder = "Enter Number of Days"/>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6" align="left">
					<label><input <?php if(isset($dataor['datefr']) && $dataor['datefr'] != $dataor['dateto']){ echo ' checked ';}?> type = "checkbox" id ="rngtrig" name = "rngtrig" /> Switch to Weekly/Monthly</label>
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
				<div class="col-xs-5" id = "cash" <?php if(isset($mchck) && $mchck != null && $edmfee > 0){ echo ' style = "display: none;" ';}?>>
					<label>Amount: <font color="red">*</font></label>
					<input id = "mfeeamount" autocomplete = "off" type="text" class="form-control input-sm" <?php if(isset($mchck) && $mchck == "" && isset($_GET['or']) && $edmfee > 0){ echo ' value = "' . $edmfee . '" name = "mfeeamount" ';}elseif(!isset($_GET['or'])){echo ' name = "mfeeamount" ';}?> placeholder = "Enter Amount Paid"/>
				</div>				
				<div id = "chck" <?php if(isset($mchck) && $mchck != null && $edmfee > 0){}else{ echo ' style = "display: none;"';}?>>
					<div class="col-xs-3">
						<label>Amount: <font color="red">*</font></label>
						<input id = "chckamount" autocomplete = "off" type="text" <?php if(isset($mchck) && $mchck != null && $edmfee > 0){ echo ' value = "' . $edmfee . '" name = "mfeeamount"';}?> class="form-control input-sm" placeholder = "Enter Amount Paid"/>
					</div>
					<div class="col-xs-3">
						<label>Check #: <font color="red">*</font></label>
						<input <?php if(isset($mchck) && $edmfee > 0){ echo ' value = "' . $mchck . '"'; } ?> id = "chcknum" name = "chcknum" type="text" class="form-control input-sm" placeholder = "Enter Check Number"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6" align="left">
					<label><input type = "checkbox" id ="chckb" name = "chcb" /> Switch to Check</label>
				</div>
			</div>
		</div>
		<div id = "ebill" <?php if(isset($tyebill) && $tyebill == 1){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Electric Bill</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3">
					<label>Date of Payment From: <font color="red">*</font></label>
					<input type="date" name = "ebilldatefr" id = "ewklymonfr" class="form-control input-sm" value="<?php if(isset($tyebill) && $tyebill == 1){ echo $dataor['datefr']; }else{ echo date("Y-m-d");} ?>"/>
				</div>
				<div class="col-xs-3">
					<label>Date of Payment To:  <font color="red">*</font></label>
					<input type="date" name = "ebilldateto" id = "ewklymonto" class="form-control input-sm" value="<?php if(isset($tyebill) && $tyebill == 1){ echo $dataor['dateto']; }else{ echo date("Y-m-d");} ?>"/>
				</div>
				<div class="col-xs-5" id = "ecash" <?php if(isset($echck) && $echck != null && $edbill > 0){ echo ' style = "display: none;" ';}?>>
					<label>Amount: <font color="red">*</font></label>
					<input id = "ebillamount" autocomplete = "off" type="text" class="form-control input-sm" <?php if(!isset($echck) && isset($_GET['or']) && $edbill > 0){ echo ' value = "' . $edbill . '" name = "ebillamount" ';}elseif(!isset($_GET['or'])){echo ' name = "ebillamount" ';}?> placeholder = "Enter Amount Paid"/>
				</div>
				<div id = "echck" <?php if(isset($echck) && $echck != null && $edbill > 0){}else{ echo ' style = "display: none;"';}?>>
					<div class="col-xs-3">
						<label>Amount: <font color="red">*</font></label>
						<input id = "echckamount" autocomplete = "off" type="text" <?php if(isset($echck) && $echck != null && $edbill > 0){ echo ' value = "' . $edbill . '" name = "ebillamount"';}?> class="form-control input-sm" placeholder = "Enter Amount Paid"/>
					</div>
					<div class="col-xs-3">
						<label>Check #: <font color="red">*</font></label>
						<input <?php if(isset($echck) && $edbill > 0){ echo ' value = "' . $echck . '"'; } ?> id = "echcknum" name = "echcknum" type="text" class="form-control input-sm" placeholder = "Enter Check Number"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-offset-6 col-xs-4" align="left">
					<label><input type = "checkbox" id ="echckb" <?php if(isset($echck) && $echck != ""){ echo ' checked '; } ?>  name = "echcb" /> Switch to Check</label>
				</div>
			</div>
		</div>
		<div id = "wbill" <?php if(isset($tywbill) && $tywbill == 1){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Water Bill</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3">
					<label>Date of Payment From: <font color="red">*</font></label>
					<input type="date" name = "wbilldatefr" class="form-control input-sm" value="<?php if(isset($tywbill) && $tywbill == 1){ echo $dataor['datefr']; }else{ echo date("Y-m-d");} ?>"/>
				</div>
				<div class="col-xs-3">
					<label>Date of Payment To:  <font color="red">*</font></label>
					<input type="date" name = "wbilldateto" class="form-control input-sm" value="<?php if(isset($tywbill) && $tywbill == 1){ echo $dataor['dateto']; }else{ echo date("Y-m-d");} ?>"/>
				</div>
				<div class="col-xs-5" id = "wcash" <?php if(isset($wchck) && $wchck != null && $edwbill > 0){ echo ' style = "display: none;" ';}?>>
					<label>Amount: <font color="red">*</font></label>
					<input id = "wbillamount" autocomplete = "off" type="text" class="form-control input-sm" <?php if(!isset($wchck) && isset($_GET['or']) && $edwbill > 0){ echo ' value = "' . $edwbill . '" name = "wbillamount" ';}elseif(!isset($_GET['or'])){echo ' name = "wbillamount" ';}?> placeholder = "Enter Amount Paid"/>
				</div>
				<div id = "wchck" <?php if(isset($wchck) && $wchck != null && $edwbill > 0){}else{ echo ' style = "display: none;"';}?>>
					<div class="col-xs-3">
						<label>Amount: <font color="red">*</font></label>
						<input id = "wchckamount" autocomplete = "off" type="text" <?php if(isset($wchck) && $wchck != null && $edwbill > 0){ echo ' value = "' . $edwbill . '" name = "wbillamount"';}?> class="form-control input-sm" placeholder = "Enter Amount Paid"/>
					</div>
					<div class="col-xs-3">
						<label>Check #: <font color="red">*</font></label>
						<input <?php if(isset($wchck) && $edwbill > 0){ echo ' value = "' . $wchck . '"'; } ?> id = "wchcknum" name = "wchcknum" type="text" class="form-control input-sm" placeholder = "Enter Check Number"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-offset-6 col-xs-4" align="left">
					<label><input type = "checkbox" id ="wchckb" <?php if(isset($wchck) && $wchck != ""){ echo ' checked '; } ?>  name = "wchcb" /> Switch to Check</label>
				</div>
			</div>
		</div>
		<div id = "mc" <?php if(isset($tymclear) && $tymclear == 1){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Market Clearance</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($tymclear) && $tymclear == 1 && $edmclear > 0 ){ echo ' value = "'.$edmclear.'" '; }?> autocomplete = "off" name="mcamount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "bt" <?php if(isset($typbtax)){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Business Tax</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($typbtax) && $edbtax > 0){ echo ' value = "'.$edbtax.'" '; }?> autocomplete = "off" name="btamount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "sr" <?php if(isset($tysrental)){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Space Rental</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($tysrental) && $edsrental > 0){ echo ' value = "'.$edsrental.'" '; }?> autocomplete = "off" name="sramount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "am" <?php if(isset($typamortem)){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Anti - Mortem</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($typamortem) && $edamortem > 0){ echo ' value = "'.$edamortem.'" '; }?> autocomplete = "off" name="amamount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "pm" <?php if(isset($typmorem)){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Post Mortem</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($typmorem) && $edpmortem > 0){ echo ' value = "'.$edpmortem.'" '; }?> autocomplete = "off" name="pmamount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "tf" <?php if(isset($typtfee)){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Transfer Fee</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($typtfee) && $edtfee > 0){ echo ' value = "'.$edtfee.'" '; }?>autocomplete = "off" name="tfamount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "rf" <?php if(isset($typrfee)){  }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Renewal Fee</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($typrfee) && $edrfee > 0){ echo ' value = "'. $edrfee .'" '; }?> autocomplete = "off" name="rfamount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "g" <?php if(isset($typgwill)){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" >
					<i><u><h4 style="font-size: 15.5px;">Goodwill</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5" id = "gcash" <?php if(isset($gchck) && $gchck != null && $edgwill > 0){ echo ' style = "display: none;" ';}?>>
					<label>Amount: <font color="red">*</font></label>
					<input id = "gamount" autocomplete = "off" type="text" class="form-control input-sm" <?php if(!isset($gchck) && isset($_GET['or']) && $edgwill > 0){ echo ' value = "' . $edgwill . '" name = "gamount" ';}elseif(!isset($_GET['or'])){echo ' name = "gamount" ';}?> placeholder = "Enter Amount Paid"/>
				</div>
				<div id = "gchck" <?php if(isset($gchck) && $gchck != null && $edwbill > 0){}else{ echo ' style = "display: none;"';}?>>
					<div class="col-xs-3">
						<label>Amount: <font color="red">*</font></label>
						<input id = "gchckamount" autocomplete = "off" type="text" <?php if(isset($gchck) && $gchck != null && $edgwill > 0){ echo ' value = "' . $edgwill . '" name = "gamount"';}?> class="form-control input-sm" placeholder = "Enter Amount Paid"/>
					</div>
					<div class="col-xs-3">
						<label>Check #: <font color="red">*</font></label>
						<input <?php if(isset($gchck) && $edgwill > 0){ echo ' value = "' . $gchck . '"'; } ?> id = "gchcknum" name = "gchcknum" type="text" class="form-control input-sm" placeholder = "Enter Check Number"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4" align="left">
					<label><input type = "checkbox" id ="gchckb" <?php if(isset($gchck) && $gchck != ""){ echo ' checked '; } ?> name = "gchcb" /> Switch to Check</label>
				</div>
			</div>
		</div>
		<div id = "tct" <?php if(isset($typtct)){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" > 
					<i><u><h4 style="font-size: 15.5px;">TCT</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($typtct) && $edtct > 0){ echo ' value = "'.$edtct.'" '; }?> autocomplete = "off" name="tctamount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
		<div id = "pfee" <?php if(isset($typpfee)){ echo ' checked '; }else{  ?> style="display: none;" <?php } ?>>
			<div class="row" style="margin-left: -40px;">
				<div class="col-xs-12" > 
					<i><u><h4 style="font-size: 15.5px;">Permit Fee</h4></u></i>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<label>Amount: <font color="red">*</font></label>
					<input <?php if(isset($typpfee) && $edpfee > 0){ echo ' value = "'.$edpfee.'" '; }?> autocomplete = "off" name="pfeeamount" type="text" class="form-control input-sm" placeholder = "Enter Amount"/>
				</div>
			</div>
		</div>
	<?php if(!isset($_GET['or'])) { ?>
		<div class="row">
			<div class="col-xs-12" align="center">
				<button class="btn btn-sm btn-primary" name = "collsub" onclick = "return confirm('Are you sure?');">Submit</button>
			</div>
		</div>
		<?php }else{ ?>
		<div class="row" style="margin-left: -40px;">
			<div class="col-xs-12" > 
				<i><u><h4 style="font-size: 15.5px;">Reason for editing</h4></u></i>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Enter reason <font color="red">*</font></label>
				<input type = "text" name = "edreason" required placeholder = "Enter reason" class="form-control input-sm"/> 
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12" align="center">
				<button class="btn btn-sm btn-primary" onclick = "return confirm('Are you sure?');" name = "collup" >Update</button>
			</div>
		</div>
		<?php } ?>
			
	</form>
</div>
<?php
	$count = 0;
	if(isset($_POST['collsub'])){
		if(!empty($_POST['invoicenum'])){
			$_POST['invoicenum'] = mysqli_real_escape_string($conn, $_POST['invoicenum']);
			$invoice = "SELECT * FROM orissuance where issuanceid = '$_POST[invoicenum]'";
			$datai = $conn->query($invoice)->fetch_assoc();
			$_POST['invoicenum'] = $datai['invoiceno'];
		}
		if(isset($_POST['mfeeamount']) && !empty($_POST['mfeeamount'])){
			$type = "Market Fee";
			if(isset($_POST['chcknum']) && !empty($_POST['chcknum'])){
				$_POST['chcknum'] = $_POST['chcknum'];
			}else{
				$_POST['chcknum'] = null;
			}
			if(empty($_POST['mfeedateto'])){
				$_POST['mfeedateto'] = $_POST['mfeedatefr'];
			}
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, datefr, dateto, type, checknum) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiidssss", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['mfeeamount'], $_POST['mfeedatefr'], $_POST['mfeedateto'], $type, $_POST['chcknum']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['ebillamount']) && !empty($_POST['ebillamount'])){
			$type = "Electric Bill";
			if(isset($_POST['echcknum']) && !empty($_POST['echcknum'])){
				$_POST['echcknum'] = $_POST['echcknum'];
			}else{
				$_POST['echcknum'] = null;
			}
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, datefr, dateto, type, checknum) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiidssss", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['ebillamount'], $_POST['ebilldatefr'], $_POST['ebilldateto'], $type, $_POST['echcknum']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['wbillamount']) && !empty($_POST['wbillamount'])){
			$type = "Water Bill";
			if(isset($_POST['wchcknum']) && !empty($_POST['wchcknum'])){
				$_POST['wchcknum'] = $_POST['wchcknum'];
			}else{
				$_POST['wchcknum'] = null;
			}
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, datefr, dateto, type, checknum) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiidssss", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['wbillamount'], $_POST['wbilldatefr'], $_POST['wbilldateto'], $type, $_POST['wchcknum']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['mcamount']) && !empty($_POST['mcamount'])){
			$type = "Market Clearance";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['mcamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['btamount']) && !empty($_POST['btamount'])){
			$type = "Business Tax";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['btamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['sramount']) && !empty($_POST['sramount'])){
			$type = "Space Rental";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['sramount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['amamount']) && !empty($_POST['amamount'])){
			$type = "Anti Mortem";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['amamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['pmamount']) && !empty($_POST['pmamount'])){
			$type = "Post Mortem";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['pmamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['tfamount']) && !empty($_POST['tfamount'])){
			$type = "Transfer Fee";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['tfamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['rfamount']) && !empty($_POST['rfamount'])){
			$type = "Renewal Fee";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['rfamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['gamount']) && !empty($_POST['gamount'])){
			$type = "Goodwill";
			if(isset($_POST['gchcknum']) && !empty($_POST['gchcknum'])){
				$_POST['gchcknum'] = $_POST['gchcknum'];
			}else{
				$_POST['gchcknum'] = null;
			}
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type, checknum) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiidss", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['gamount'], $type, $_POST['gchcknum']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['tctamount']) && !empty($_POST['tctamount'])){
			$type = "TCT";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['tctamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['pfeeamount']) && !empty($_POST['pfeeamount'])){
			$type = "Permit Fee";
			$stmt = $conn->prepare("INSERT INTO collection (paydate, invoice, store_id, owner_id, ornum, amount, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiiids", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['pfeeamount'], $type);	
			if($stmt->execute()){
				$count += 1;
			}
		}

		if($count > 0){
			echo '<script type = "text/javascript">alert("Adding Record Successful");window.location.replace("/cmarket/?module=collection");</script>';
		}		
	}

	if(isset($_POST['collup']) && !empty($_POST['edreason'])){
		$editdate = date("Y-m-d h:i A");
		if(isset($_POST['mfeeamount']) && !empty($_POST['mfeeamount'])){
			$type = "Market Fee";
			if(isset($_POST['chcknum']) && !empty($_POST['chcknum'])){
				$_POST['chcknum'] = $_POST['chcknum'];
			}else{
				$_POST['chcknum'] = null;
			}
			if(empty($_POST['mfeedateto'])){
				$_POST['mfeedateto'] = $_POST['mfeedatefr'];
			}
			$stmt = $conn->prepare("UPDATE `collection` set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, datefr = ?, dateto = ?, checknum = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidsssssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['mfeeamount'], $_POST['mfeedatefr'], $_POST['mfeedateto'], $_POST['chcknum'], $type, $_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['ebillamount']) && !empty($_POST['ebillamount'])){
			$type = "Electric Bill";
			$stmt = $conn->prepare("UPDATE `collection` set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, datefr = ?, dateto = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['ebillamount'], $_POST['ebilldatefr'], $_POST['ebilldateto'], $type,$_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['wbillamount']) && !empty($_POST['wbillamount'])){
			$type = "Water Bill";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, datefr = ?, dateto = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['wbillamount'], $_POST['wbilldatefr'], $_POST['wbilldateto'], $type,$_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['mcamount']) && !empty($_POST['mcamount'])){
			$type = "Market Clearance";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['mcamount'], $type, $_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['btamount']) && !empty($_POST['btamount'])){
			$type = "Business Tax";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['btamount'], $type, $_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['sramount']) && !empty($_POST['sramount'])){
			$type = "Space Rental";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['sramount'], $type, $_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['amamount']) && !empty($_POST['amamount'])){
			$type = "Anti Mortem";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['amamount'], $type, $_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['pmamount']) && !empty($_POST['pmamount'])){
			$type = "Post Mortem";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['pmamount'], $type, $_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['tfamount']) && !empty($_POST['tfamount'])){
			$type = "Transfer Fee";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['tfamount'], $type,$_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['rfamount']) && !empty($_POST['rfamount'])){
			$type = "Renewal Fee";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['rfamount'], $type, $_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['gamount']) && !empty($_POST['gamount'])){
			$type = "Goodwill";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['gamount'], $type, $_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}
		if(isset($_POST['tctamount']) && !empty($_POST['tctamount'])){
			$type = "TCT";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['tctamount'], $type,$_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}

		if(isset($_POST['pfeeamount']) && !empty($_POST['pfeeamount'])){
			$type = "Permit Fee";
			$stmt = $conn->prepare("UPDATE collection set paydate = ?, invoice = ?, store_id = ?, owner_id = ?, ornum = ?, amount = ?, type = ?, editreason = ?, editdate = ? where type = ? and ornum = ?");
			$stmt->bind_param("ssiiidssssi", $_POST['datecollect'], $_POST['invoicenum'], $_POST['strename'], $_POST['streown'], $_POST['ornum'], $_POST['pfeeamount'], $type,$_POST['edreason'], date("Y-m-d h:i A"), $type, $_GET['or']);	
			if($stmt->execute()){
				$count += 1;
			}
		}

		if($count > 0){
			echo '<script type = "text/javascript">alert("Updating Record Successful");window.location.replace("/cmarket/?module=collection&or='.$_GET['or'].'");</script>';
		}		
	}
?>

<?php } ?>

<?php if(isset($_GET['action']) && $_GET['action'] == 'edit'){ ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<b><i><h4 style="margin-left: -10px;">Edit O.R.</h4></i></b>
			</div>
		</div>
		<form action="" method="get">
			<input type = "hidden" name = "module" value = "collection"/>
			<div class="row">
				<div class="col-xs-4">
					<label>O.R. Number <font color="red">*</font></label>
					<input <?php if(isset($_GET['or'])){ echo " value = '" . $_GET['or'] . "' "; } ?> type = "text" name = "or" required class="form-control input-sm" placeholder = "Enter O.R. #">
				</div>
				<div class="col-xs-4">
					<label>Action</label>
					<div class="form-inline">
						<button class="btn btn-sm btn-primary"><span class="icon-checkmark"></span> Search</button>
						<a href = "?module=collection&action=edit" class="btn btn-sm btn-danger"><span class = "icon-spinner11"></span> Clear </a>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php } ?>

<?php
	if(isset($_GET['action']) && $_GET['action'] == 'daily'){
		if(isset($_GET['coldate'])){
			$date = mysqli_real_escape_string($conn, $_GET['coldate']);
			$date2 = mysqli_real_escape_string($conn, $_GET['coldate2']);
			$xquery = " and paydate BETWEEN '$date' and '$date2' ";
		}else{
			$date = date("Y-m-d");	
			$xquery = " and paydate = '$date' ";
		}
	//datefr <= '$date' and dateto >= '$date'
	$sql = "SELECT * FROM `store`,`owner`,`collection` where collection.owner_id = owner.owner_id and collection.store_id = store.store_id $xquery group by ornum";
	$result = $conn->query($sql);		
	
?>

<div class="container-fuild" id = "tble"style="padding: 5px 10px; text-align: center;">
	<div class="row">
		<div class="col-xs-12">
			
		</div>
	</div>
	<div class = "row">
		<form action="" method="get" style="margin-top: -20px;">
			<input type = 'hidden' name = "module" value = "collection">
			<input type = 'hidden' name = "action" value = "daily">
			<div class="col-xs-2" style="margin-top: -10px;">
				<label>Date Of Collection</label>
				<input <?php if(isset($_GET['coldate'])){ echo ' value = "' . $_GET['coldate'] . '" '; } ?> required type = "date" name = "coldate" class="form-control input-sm"/>
			</div>
			<div class="col-xs-2" style="margin-top: -10px;"><label>&nbsp;</label>
				<input <?php if(isset($_GET['coldate'])){ echo ' value = "' . $_GET['coldate2'] . '" '; } ?> required type = "date" name = "coldate2" class="form-control input-sm"/>
			</div>
			<div class="col-xs-2" style="margin-top: -10px;">
				<label></label>
				<div class="form-inline">
					<button class="form-control btn btn-primary btn-sm"><span class="icon-search"></span> Search </button>
					<a href = "?module=collection&action=daily" class="form-control btn btn-danger btn-sm"><span class = "icon-spinner11" ></span> Clear </a>
				</div>
			</div>
		</form>
		<div class="col-xs-12">
			<hr>
		</div>
		<div class = "col-xs-12" >
			<i><h4><?php 
						if(isset($_GET['coldate']) && isset($_GET['coldate2']) && $_GET['coldate'] != $_GET['coldate2']){
							if(date("Y", strtotime($_GET['coldate'])) != date("Y", strtotime($_GET['coldate2']))){
								echo date("M j, Y", strtotime($_GET['coldate'])) . ' - ' . date("M j, Y", strtotime($_GET['coldate2']))  . ' COLLECTION';
							}else{
								echo date("M j ", strtotime($_GET['coldate'])) . ' - ' . date("M j, Y", strtotime($_GET['coldate2'])) . ' COLLECTION';
							}
						}else{
							echo date("M j, Y", strtotime($date)) . ' / DAILY COLLECTION';
						} 
					?>
			</h4></i>
		</div>
	</div>
	<table class='table table-bordered table-fixed-header'>
        <thead class='header' id = "thead">
			<tr>
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
				<th>P.FEE</th>
			</tr>
		</thead>
		<tbody>
			<tr><td colspan = "17"><hr></td></tr>
<?php 
	
	$mfeetotal = 0;
	$ebilltotal = 0;
	$wbilltotal = 0;
	$mctotal = 0;
	$btsrtotal = 0;
	$amtotal = 0;
	$pmtotal = 0;
	$tftotal = 0;
	$tftotal = 0;
	$rftotal = 0;
	$gtotal = 0;
	$tctotal = 0;
	$pfeetotal = 0;
	if($result->num_rows > 0){
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
			$pfee = " - ";	
			$btsr2 = 0;	
			echo '<tr>';
			echo '<td>' . $row['ornum'] . '</td>';
			echo '<td>' . strtoupper($row['fname']) . ' ' . strtoupper($row['lname']) . '</td>';
			$query = "SELECT * FROM collection where ornum = '$row[ornum]'  $xquery";
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
						$mfeeamount = '₱ ' . number_format($row2['amount'],2);
						$mfeecov = strtoupper($month);
						$mfeetotal += $row2['amount'];
					}
					if($row2['type'] == "Electric Bill"){
						$ebill = '₱ ' . number_format($row2['amount']);
						$ecov = strtoupper($month);
						$ebilltotal += $row['amount'];
					}
					if($row2['type'] == "Water Bill"){
						$wbill = '₱ ' . number_format($row2['amount']);
						$wcov = strtoupper($month);
						$wbilltotal += $row2['amount'];
					}
					if($row2['type'] == "Market Clearance"){
						$mc = '₱ ' . number_format($row2['amount']);
						$mctotal += $row['amount'];
					}
					if($row2['type'] == "Business Tax" || $row2['type'] == "Space Rental"){
						$btsr2 += $row2['amount'];
						$btsr = '₱ ' . number_format($btsr2);
						$btsrtotal += $row2['amount'];
					}
					if($row2['type'] == "Anti Mortem"){
						$am = '₱ ' . number_format($row2['amount']);
						$amtotal += $row2['amount'];
					}
					if($row2['type'] == "Post Mortem"){
						$pm = '₱ ' . number_format($row2['amount']);
						$pmtotal += $row2['amount'];
					}
					if($row2['type'] == "Transfer Fee"){
						$tf = '₱ ' . number_format($row2['amount']);
						$tftotal += $row2['amount'];
					}
					if($row2['type'] == "Renewal Fee"){
						$rf = '₱ ' . number_format($row2['amount']);
						$rftotal += $row2['amount'];
					}
					if($row2['type'] == "Goodwill"){
						$g = '₱ ' . number_format($row2['amount']);
						$gtotal += $row['amount'];
					}
					if($row2['type'] == "TCT"){
						$tct = '₱ ' . number_format($row2['amount']);
						$tctotal += $row2['amount'];
					}
					if($row2['type'] == "Permit Fee"){
						$pfee = '₱ ' . number_format($row2['amount']);
						$pfeetotal += $row2['amount'];
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
				echo '<td>'.$pfee.'</td>';
				echo '</tr>';
			}
		}
	}else{
		echo '<tr><td colspan = 17><h4><i>No Record Found</i></h4></td></tr>';
	}
	echo '<tr><td colspan = 17><hr></td><tr>';
	echo '<tr>
			<td><b>Total: </b></td>
			<td colspan = 2 style = "text-align: right !important;">₱' . number_format($mfeetotal,2) . '</td>
			<td colspan = 2 style = "text-align: right !important;">₱'.number_format($ebilltotal,2).'</td>
			<td colspan = 2 style = "text-align: right !important;">₱'.number_format($wbilltotal,2).'</td>
			<td colspan = 2 style = "text-align: right !important;">₱'.number_format($mctotal,2).'</td>
			<td>₱'.number_format($btsrtotal,2).'</td>
			<td>₱'.number_format($amtotal,2).'</td>
			<td>₱'.number_format($pmtotal,2).'</td>
			<td>₱'.number_format($tftotal,2).'</td>
			<td>₱'.number_format($rftotal,2).'</td>
			<td>₱'.number_format($gtotal,2).'</td>
			<td>₱'.number_format($tctotal,2).'</td>
			<td>₱'.number_format($pfeetotal,2).'</td>
		</tr>';
		$total = $mfeetotal + $ebilltotal + $wbilltotal + $mctotal + $btsrtotal + $amtotal + $pmtotal + $tftotal + $rftotal + $gtotal + $tctotal + $pfeetotal;
	$cashticket = "SELECT * FROM collection,user where user.account_id = collection.collector_id and type = 'Cash Ticket' $xquery ORDER BY lname";
	$restct = $conn->query($cashticket);
	$cttotal = 0;
	if($restct->num_rows > 0){
		echo '<tr><td colspan = 17><hr><h4><i>Cash Ticket Collection</i></h4></td></tr>';
		echo '<tr><td colspan = 7><b>Collector</td><td colspan = 6 style = "text-align: center;"><b>Amount</td><td colspan = 4></td></tr>';
		while ($ct = $restct->fetch_assoc()) {
			echo '<tr>';
				echo '<td colspan = 7>' . $ct['lname'] . ', ' . $ct['fname'] . '</td>';
				echo '<td></td>';
				echo '<td colspan = 4>₱ ' . number_format($ct['amount'],2) . '</td><td colspan = 5></td>';
			echo '</tr>';
			$cttotal += $ct['amount'];
		}
		echo '<tr><td colspan = 7></td><td><br><b>Total:</td><td colspan = 4><hr>₱ '.number_format($cttotal,2).'</td><td colspan = 5></td></tr>';
	}
	echo '<tr><td colspan = 17><hr></td><tr>';
	echo '<tr><td colspan = "8"><b>Total Collection: </b></td><td colspan = 4>₱ ' . number_format($total+$cttotal,2) . '</td><td colspan = 5></td></tr>';
?>	
</div>

<?php
	}
?>
