<style type="text/css">
	#reports{
		font-size: 12px;
	}
	#reports label, #reports label{
		font-size: 13px;
	}
	<?php
		if(isset($_GET['print'])){
			echo 'body { visibility: hidden; }';
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
	  	}
	  	#backs{
	  		display: none;
	  	}
	}
	 #tbl td, #tbl th{
	 	border-bottom: 1px solid !important;
	 }
</style>
<div class="container-fluid">
	<div class="col-xs-12 form-inline" align="right">
		<form action = "" method="get">
			<input type = 'hidden' name = "module" value = "report">
			<select class="form-control input-sm" name = "year" required/>
				<option <?php if(isset($_GET['year']) && $_GET['year'] == date("Y")){ echo ' selected '; } ?> value="<?php echo date('Y');?>"> <?php echo date('Y'); $year = date("Y");?> </option>
				<?php
					for($i = 1; $i <= 4; $i++){
						$echdate = date("Y", strtotime("-".$i.' year', strtotime($year)));
						if(isset($_GET['year']) && $echdate == $_GET['year']){
							$sel = " selected ";
						}else{
							$sel = "";
						}
						echo '<option '. $sel . ' value = "' . $echdate . '"> ' . $echdate . '</option>';
					}
				?>
			</select>
			<button class="btn btn-primary btn-sm"><span class = "icon-search"></span> Search </button>
			<a href="?module=report" class="btn btn-danger btn-sm"><span class = "icon-spinner11"></span> Clear </a>
			<button class="btn btn-success btn-sm" onclick="window.print();"><span class = "icon-printer"></span> Print Report</button>
		</form>		
	</div>
</div>
<?php
	if(isset($_GET['year'])){
		$repdate = 'For the Year of <b>'. mysqli_real_escape_string($conn, $_GET['year']);
	}else{
		$repdate = 'For the Month of <b>' . date ("F Y");
	}
?>
<div class="container-fluid" id = "reportg">
	<div class="row">
		<div class="col-xs-12" align="center">
			<p style="margin-bottom: -.5px;">Republic of the Philippines</p>
			<p style="margin-bottom: -.5px;">Province of Batangas</p>
			<p>Municipality of <b>Calaca</b></p>
			<p><b>OFFICE OF THE MARKET ADMINISTRATOR</b></p>
			<p style="margin-bottom: -.5px;"><b>CASH COLLECTION REPORT</b></p>
			<p><?php echo $repdate;?></b></p>
		</div>
	</div>
	<table class="table" border = '1' id = "tbl" style="text-align: center">
		<thead>
			<th></th>
			<?php
				$d = 0;
				for($i = 1; $i <= 12; $i++){
					echo '<th>' . date("F", strtotime("+".$d." months", strtotime('Y-'.$i.'-d'))) . '</th>';
					$d += 1;
				}
			?>
			<th>Total</th>
		</thead>
		<tbody>
			<?php
				$jan = 0; $feb = 0; $mar = 0; $apr = 0; $may = 0; $jun = 0; $jul = 0; $aug = 0; $sep = 0; $oct = 0; $nov = 0; $dec = 0;
				if(!isset($_GET['year'])){
					$year = date("Y");	
				}else{
					$year = mysqli_real_escape_string($conn, $_GET['year']);
				}
				
				$cticket = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Cash Ticket'";
				$ctres = $conn->query($cticket);
				$ctjan = 0; $ctfeb = 0; $ctmar = 0; $ctapr = 0; $ctmay = 0; $ctjun = 0; $ctjul = 0; $ctaug = 0; $ctsep = 0; $ctoct = 0; $ctnov = 0; $ctdec = 0; $cttotal = 0;
				if($ctres->num_rows > 0){
					while($row = $ctres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$ctjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$ctfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$ctmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$ctapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$ctmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$ctjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$ctjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$ctaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$ctsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$ctoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$ctnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$ctdec += $row['amount'];
						}
					}
					$cttotal = $ctjan + $ctfeb + $ctmar + $ctapr + $ctmay + $ctjun + $ctjul + $ctaug + $ctsep + $ctoct + $ctnov + $ctdec;
					$jan += $ctjan; $feb += $ctfeb; $mar += $ctmar; $apr += $ctapr; $may += $ctmay; $jun += $ctjun;
					$jul += $ctjul; $aug += $ctaug; $sep += $ctsep; $oct += $ctoct; $nov += $ctnov; $dec += $ctdec;
				}
			?>
			<tr>
				<td> Cash Ticket </td>
				<td> <?php if($ctjan > 0){ echo number_format($ctjan); } else { echo ' - '; }?> </td>
				<td> <?php if($ctfeb > 0){ echo number_format($ctfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($ctmar > 0){ echo number_format($ctmar); } else { echo ' - '; }?> </td>
				<td> <?php if($ctapr > 0){ echo number_format($ctapr); } else { echo ' - '; }?> </td>
				<td> <?php if($ctmay > 0){ echo number_format($ctmay); } else { echo ' - '; }?> </td>
				<td> <?php if($ctjun > 0){ echo number_format($ctjun); } else { echo ' - '; }?> </td>
				<td> <?php if($ctjul > 0){ echo number_format($ctjul); } else { echo ' - '; }?> </td>
				<td> <?php if($ctaug > 0){ echo number_format($ctaug); } else { echo ' - '; }?> </td>
				<td> <?php if($ctsep > 0){ echo number_format($ctsep); } else { echo ' - '; }?> </td>
				<td> <?php if($ctoct > 0){ echo number_format($ctoct); } else { echo ' - '; }?> </td>
				<td> <?php if($ctnov > 0){ echo number_format($ctnov); } else { echo ' - '; }?> </td>
				<td> <?php if($ctdec > 0){ echo number_format($ctdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($cttotal > 0){ echo number_format($cttotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$btax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Business Tax'";
				$btres = $conn->query($btax);
				$btjan = 0; $btfeb = 0; $btmar = 0; $btapr = 0; $btmay = 0; $btjun = 0; $btjul = 0; $btaug = 0; $btsep = 0; $btoct = 0; $btnov = 0; $btdec = 0; $bttotal = 0;
				if($btres->num_rows > 0){
					while($row = $btres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$btjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$btfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$btmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$btapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$btmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$btjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$btjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$btaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$btsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$btoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$btnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$btdec += $row['amount'];
						}
					}
					$bttotal = $btjan + $btfeb + $btmar + $btapr + $btmay + $btjun + $btjul + $btaug + $btsep + $btoct + $btnov + $btdec;
					$jan += $btjan; $feb += $btfeb; $mar += $btmar; $apr += $btapr; $may += $btmay; $jun += $btjun;
					$jul += $btjul; $aug += $btaug; $sep += $btsep; $oct += $btoct; $nov += $btnov; $dec += $btdec;
				}
			?>
			<tr>
				<td> Business Tax </td>
				<td> <?php if($btjan > 0){ echo number_format($btjan); } else { echo ' - '; }?> </td>
				<td> <?php if($btfeb > 0){ echo number_format($btfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($btmar > 0){ echo number_format($btmar); } else { echo ' - '; }?> </td>
				<td> <?php if($btapr > 0){ echo number_format($btapr); } else { echo ' - '; }?> </td>
				<td> <?php if($btmay > 0){ echo number_format($btmay); } else { echo ' - '; }?> </td>
				<td> <?php if($btjun > 0){ echo number_format($btjun); } else { echo ' - '; }?> </td>
				<td> <?php if($btjul > 0){ echo number_format($btjul); } else { echo ' - '; }?> </td>
				<td> <?php if($btaug > 0){ echo number_format($btaug); } else { echo ' - '; }?> </td>
				<td> <?php if($btsep > 0){ echo number_format($btsep); } else { echo ' - '; }?> </td>
				<td> <?php if($btoct > 0){ echo number_format($btoct); } else { echo ' - '; }?> </td>
				<td> <?php if($btnov > 0){ echo number_format($btnov); } else { echo ' - '; }?> </td>
				<td> <?php if($btdec > 0){ echo number_format($btdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($bttotal > 0){ echo number_format($bttotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$ebax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Electric Bill'";
				$ebres = $conn->query($ebax);
				$ebjan = 0; $ebfeb = 0; $ebmar = 0; $ebapr = 0; $ebmay = 0; $ebjun = 0; $ebjul = 0; $ebaug = 0; $ebsep = 0; $eboct = 0; $ebnov = 0; $ebdec = 0; $ebtotal = 0;
				if($ebres->num_rows > 0){
					while($row = $ebres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$ebjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$ebfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$ebmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$ebapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$ebmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$ebjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$ebjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$ebaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$ebsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$eboct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$ebnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$ebdec += $row['amount'];
						}
					}
					$ebtotal = $ebjan + $ebfeb + $ebmar + $ebapr + $ebmay + $ebjun + $ebjul + $ebaug + $ebsep + $eboct + $ebnov + $ebdec;
					$jan += $ebjan; $feb += $ebfeb; $mar += $ebmar; $apr += $ebapr; $may += $ebmay; $jun += $ebjun;
					$jul += $ebjul; $aug += $ebaug; $sep += $ebsep; $oct += $eboct; $nov += $ebnov; $dec += $ebdec;
				}
			?>
			<tr>
				<td> Electric Bill </td>
				<td> <?php if($ebjan > 0){ echo number_format($ebjan); } else { echo ' - '; }?> </td>
				<td> <?php if($ebfeb > 0){ echo number_format($ebfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($ebmar > 0){ echo number_format($ebmar); } else { echo ' - '; }?> </td>
				<td> <?php if($ebapr > 0){ echo number_format($ebapr); } else { echo ' - '; }?> </td>
				<td> <?php if($ebmay > 0){ echo number_format($ebmay); } else { echo ' - '; }?> </td>
				<td> <?php if($ebjun > 0){ echo number_format($ebjun); } else { echo ' - '; }?> </td>
				<td> <?php if($ebjul > 0){ echo number_format($ebjul); } else { echo ' - '; }?> </td>
				<td> <?php if($ebaug > 0){ echo number_format($ebaug); } else { echo ' - '; }?> </td>
				<td> <?php if($ebsep > 0){ echo number_format($ebsep); } else { echo ' - '; }?> </td>
				<td> <?php if($eboct > 0){ echo number_format($eboct); } else { echo ' - '; }?> </td>
				<td> <?php if($ebnov > 0){ echo number_format($ebnov); } else { echo ' - '; }?> </td>
				<td> <?php if($ebdec > 0){ echo number_format($ebdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($ebtotal > 0){ echo number_format($ebtotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$rfax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Renewal Fee'";
				$rfres = $conn->query($rfax);
				$rfjan = 0; $rffeb = 0; $rfmar = 0; $rfapr = 0; $rfmay = 0; $rfjun = 0; $rfjul = 0; $rfaug = 0; $rfsep = 0; $rfoct = 0; $rfnov = 0; $rfdec = 0; $rftotal = 0;
				if($rfres->num_rows > 0){
					while($row = $rfres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$rfjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$rffeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$rfmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$rfapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$rfmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$rfjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$rfjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$rfaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$rfsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$rfoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$rfnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$rfdec += $row['amount'];
						}
					}
					$rftotal = $rfjan + $rffeb + $rfmar + $rfapr + $rfmay + $rfjun + $rfjul + $rfaug + $rfsep + $rfoct + $rfnov + $rfdec;
					$jan += $rfjan; $feb += $rffeb; $mar += $rfmar; $apr += $rfapr; $may += $rfmay; $jun += $rfjun;
					$jul += $rfjul; $aug += $rfaug; $sep += $rfsep; $oct += $rfoct; $nov += $rfnov; $dec += $rfdec;
				}
			?>
			<tr>
				<td> Renewal Fee </td>
				<td> <?php if($rfjan > 0){ echo number_format($rfjan); } else { echo ' - '; }?> </td>
				<td> <?php if($rffeb > 0){ echo number_format($rffeb); } else { echo ' - '; }?> </td>
				<td> <?php if($rfmar > 0){ echo number_format($rfmar); } else { echo ' - '; }?> </td>
				<td> <?php if($rfapr > 0){ echo number_format($rfapr); } else { echo ' - '; }?> </td>
				<td> <?php if($rfmay > 0){ echo number_format($rfmay); } else { echo ' - '; }?> </td>
				<td> <?php if($rfjun > 0){ echo number_format($rfjun); } else { echo ' - '; }?> </td>
				<td> <?php if($rfjul > 0){ echo number_format($rfjul); } else { echo ' - '; }?> </td>
				<td> <?php if($rfaug > 0){ echo number_format($rfaug); } else { echo ' - '; }?> </td>
				<td> <?php if($rfsep > 0){ echo number_format($rfsep); } else { echo ' - '; }?> </td>
				<td> <?php if($rfoct > 0){ echo number_format($rfoct); } else { echo ' - '; }?> </td>
				<td> <?php if($rfnov > 0){ echo number_format($rfnov); } else { echo ' - '; }?> </td>
				<td> <?php if($rfdec > 0){ echo number_format($rfdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($rftotal > 0){ echo number_format($rftotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$mfax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Market Fee'";
				$mfres = $conn->query($mfax);
				$mfjan = 0; $mffeb = 0; $mfmar = 0; $mfapr = 0; $mfmay = 0; $mfjun = 0; $mfjul = 0; $mfaug = 0; $mfsep = 0; $mfoct = 0; $mfnov = 0; $mfdec = 0; $mftotal = 0;
				if($mfres->num_rows > 0){
					while($row = $mfres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$mfjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$mffeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$mfmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$mfapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$mfmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$mfjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$mfjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$mfaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$mfsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$mfoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$mfnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$mfdec += $row['amount'];
						}
					}
					$mftotal = $mfjan + $mffeb + $mfmar + $mfapr + $mfmay + $mfjun + $mfjul + $mfaug + $mfsep + $mfoct + $mfnov + $mfdec;
					$jan += $mfjan; $feb += $mffeb; $mar += $mfmar; $apr += $mfapr; $may += $mfmay; $jun += $mfjun;
					$jul += $mfjul; $aug += $mfaug; $sep += $mfsep; $oct += $mfoct; $nov += $mfnov; $dec += $mfdec;
				}
			?>
			<tr>
				<td> Market Fee </td>
				<td> <?php if($mfjan > 0){ echo number_format($mfjan); } else { echo ' - '; }?> </td>
				<td> <?php if($mffeb > 0){ echo number_format($mffeb); } else { echo ' - '; }?> </td>
				<td> <?php if($mfmar > 0){ echo number_format($mfmar); } else { echo ' - '; }?> </td>
				<td> <?php if($mfapr > 0){ echo number_format($mfapr); } else { echo ' - '; }?> </td>
				<td> <?php if($mfmay > 0){ echo number_format($mfmay); } else { echo ' - '; }?> </td>
				<td> <?php if($mfjun > 0){ echo number_format($mfjun); } else { echo ' - '; }?> </td>
				<td> <?php if($mfjul > 0){ echo number_format($mfjul); } else { echo ' - '; }?> </td>
				<td> <?php if($mfaug > 0){ echo number_format($mfaug); } else { echo ' - '; }?> </td>
				<td> <?php if($mfsep > 0){ echo number_format($mfsep); } else { echo ' - '; }?> </td>
				<td> <?php if($mfoct > 0){ echo number_format($mfoct); } else { echo ' - '; }?> </td>
				<td> <?php if($mfnov > 0){ echo number_format($mfnov); } else { echo ' - '; }?> </td>
				<td> <?php if($mfdec > 0){ echo number_format($mfdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($mftotal > 0){ echo number_format($mftotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$mcax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Market Clearance'";
				$mcres = $conn->query($mcax);
				$mcjan = 0; $mcfeb = 0; $mcmar = 0; $mcapr = 0; $mcmay = 0; $mcjun = 0; $mcjul = 0; $mcaug = 0; $mcsep = 0; $mcoct = 0; $mcnov = 0; $mcdec = 0; $mctotal = 0;
				if($mcres->num_rows > 0){
					while($row = $mcres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$mcjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$mcfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$mcmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$mcapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$mcmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$mcjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$mcjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$mcaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$mcsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$mcoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$mcnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$mcdec += $row['amount'];
						}
					}
					$mctotal = $mcjan + $mcfeb + $mcmar + $mcapr + $mcmay + $mcjun + $mcjul + $mcaug + $mcsep + $mcoct + $mcnov + $mcdec;
					$jan += $mcjan; $feb += $mcfeb; $mar += $mcmar; $apr += $mcapr; $may += $mcmay; $jun += $mcjun;
					$jul += $mcjul; $aug += $mcaug; $sep += $mcsep; $oct += $mcoct; $nov += $mcnov; $dec += $mcdec;
				}
			?>
			<tr>
				<td> Market Clearance </td>
				<td> <?php if($mcjan > 0){ echo number_format($mcjan); } else { echo ' - '; }?> </td>
				<td> <?php if($mcfeb > 0){ echo number_format($mcfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($mcmar > 0){ echo number_format($mcmar); } else { echo ' - '; }?> </td>
				<td> <?php if($mcapr > 0){ echo number_format($mcapr); } else { echo ' - '; }?> </td>
				<td> <?php if($mcmay > 0){ echo number_format($mcmay); } else { echo ' - '; }?> </td>
				<td> <?php if($mcjun > 0){ echo number_format($mcjun); } else { echo ' - '; }?> </td>
				<td> <?php if($mcjul > 0){ echo number_format($mcjul); } else { echo ' - '; }?> </td>
				<td> <?php if($mcaug > 0){ echo number_format($mcaug); } else { echo ' - '; }?> </td>
				<td> <?php if($mcsep > 0){ echo number_format($mcsep); } else { echo ' - '; }?> </td>
				<td> <?php if($mcoct > 0){ echo number_format($mcoct); } else { echo ' - '; }?> </td>
				<td> <?php if($mcnov > 0){ echo number_format($mcnov); } else { echo ' - '; }?> </td>
				<td> <?php if($mcdec > 0){ echo number_format($mcdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($mctotal > 0){ echo number_format($mctotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$amax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Anti Mortem'";
				$amres = $conn->query($amax);
				$amjan = 0; $amfeb = 0; $ammar = 0; $amapr = 0; $ammay = 0; $amjun = 0; $amjul = 0; $amaug = 0; $amsep = 0; $amoct = 0; $amnov = 0; $amdec = 0; $amtotal = 0;
				if($amres->num_rows > 0){
					while($row = $amres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$amjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$amfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$ammar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$amapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$ammay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$amjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$amjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$amaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$amsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$amoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$amnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$amdec += $row['amount'];
						}
					}
					$amtotal = $amjan + $amfeb + $ammar + $amapr + $ammay + $amjun + $amjul + $amaug + $amsep + $amoct + $amnov + $amdec;
					$jan += $amjan; $feb += $amfeb; $mar += $ammar; $apr += $amapr; $may += $ammay; $jun += $amjun;
					$jul += $amjul; $aug += $amaug; $sep += $amsep; $oct += $amoct; $nov += $amnov; $dec += $amdec;
				}
			?>
			<tr>
				<td> Anti - Mortem </td>
				<td> <?php if($amjan > 0){ echo number_format($amjan); } else { echo ' - '; }?> </td>
				<td> <?php if($amfeb > 0){ echo number_format($amfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($ammar > 0){ echo number_format($ammar); } else { echo ' - '; }?> </td>
				<td> <?php if($amapr > 0){ echo number_format($amapr); } else { echo ' - '; }?> </td>
				<td> <?php if($ammay > 0){ echo number_format($ammay); } else { echo ' - '; }?> </td>
				<td> <?php if($amjun > 0){ echo number_format($amjun); } else { echo ' - '; }?> </td>
				<td> <?php if($amjul > 0){ echo number_format($amjul); } else { echo ' - '; }?> </td>
				<td> <?php if($amaug > 0){ echo number_format($amaug); } else { echo ' - '; }?> </td>
				<td> <?php if($amsep > 0){ echo number_format($amsep); } else { echo ' - '; }?> </td>
				<td> <?php if($amoct > 0){ echo number_format($amoct); } else { echo ' - '; }?> </td>
				<td> <?php if($amnov > 0){ echo number_format($amnov); } else { echo ' - '; }?> </td>
				<td> <?php if($amdec > 0){ echo number_format($amdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($amtotal > 0){ echo number_format($amtotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$pmax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Post Mortem'";
				$pmres = $conn->query($pmax);
				$pmjan = 0; $pmfeb = 0; $pmmar = 0; $pmapr = 0; $pmmay = 0; $pmjun = 0; $pmjul = 0; $pmaug = 0; $pmsep = 0; $pmoct = 0; $pmnov = 0; $pmdec = 0; $pmtotal = 0;
				if($pmres->num_rows > 0){
					while($row = $pmres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$pmjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$pmfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$pmmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$pmapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$pmmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$pmjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$pmjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$pmaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$pmsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$pmoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$pmnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$pmdec += $row['amount'];
						}
					}
					$pmtotal = $pmjan + $pmfeb + $pmmar + $pmapr + $pmmay + $pmjun + $pmjul + $pmaug + $pmsep + $pmoct + $pmnov + $pmdec;
					$jan += $pmjan; $feb += $pmfeb; $mar += $pmmar; $apr += $pmapr; $may += $pmmay; $jun += $pmjun;
					$jul += $pmjul; $aug += $pmaug; $sep += $pmsep; $oct += $pmoct; $nov += $pmnov; $dec += $pmdec;
				}
			?>
			<tr>
				<td> Post - Mortem </td>
				<td> <?php if($pmjan > 0){ echo number_format($pmjan); } else { echo ' - '; }?> </td>
				<td> <?php if($pmfeb > 0){ echo number_format($pmfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($pmmar > 0){ echo number_format($pmmar); } else { echo ' - '; }?> </td>
				<td> <?php if($pmapr > 0){ echo number_format($pmapr); } else { echo ' - '; }?> </td>
				<td> <?php if($pmmay > 0){ echo number_format($pmmay); } else { echo ' - '; }?> </td>
				<td> <?php if($pmjun > 0){ echo number_format($pmjun); } else { echo ' - '; }?> </td>
				<td> <?php if($pmjul > 0){ echo number_format($pmjul); } else { echo ' - '; }?> </td>
				<td> <?php if($pmaug > 0){ echo number_format($pmaug); } else { echo ' - '; }?> </td>
				<td> <?php if($pmsep > 0){ echo number_format($pmsep); } else { echo ' - '; }?> </td>
				<td> <?php if($pmoct > 0){ echo number_format($pmoct); } else { echo ' - '; }?> </td>
				<td> <?php if($pmnov > 0){ echo number_format($pmnov); } else { echo ' - '; }?> </td>
				<td> <?php if($pmdec > 0){ echo number_format($pmdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($pmtotal > 0){ echo number_format($pmtotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$gwax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Goodwill'";
				$gwres = $conn->query($gwax);
				$gwjan = 0; $gwfeb = 0; $gwmar = 0; $gwapr = 0; $gwmay = 0; $gwjun = 0; $gwjul = 0; $gwaug = 0; $gwsep = 0; $gwoct = 0; $gwnov = 0; $gwdec = 0; $gwtotal = 0;
				if($gwres->num_rows > 0){
					while($row = $gwres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$gwjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$gwfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$gwmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$gwapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$gwmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$gwjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$gwjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$gwaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$gwsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$gwoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$gwnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$gwdec += $row['amount'];
						}
					}
					$gwtotal = $gwjan + $gwfeb + $gwmar + $gwapr + $gwmay + $gwjun + $gwjul + $gwaug + $gwsep + $gwoct + $gwnov + $gwdec;
					$jan += $gwjan; $feb += $gwfeb; $mar += $gwmar; $apr += $gwapr; $may += $gwmay; $jun += $gwjun;
					$jul += $gwjul; $aug += $gwaug; $sep += $gwsep; $oct += $gwoct; $nov += $gwnov; $dec += $gwdec;
				}
			?>
			<tr>
				<td> Goodwill </td>
				<td> <?php if($gwjan > 0){ echo number_format($gwjan); } else { echo ' - '; }?> </td>
				<td> <?php if($gwfeb > 0){ echo number_format($gwfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($gwmar > 0){ echo number_format($gwmar); } else { echo ' - '; }?> </td>
				<td> <?php if($gwapr > 0){ echo number_format($gwapr); } else { echo ' - '; }?> </td>
				<td> <?php if($gwmay > 0){ echo number_format($gwmay); } else { echo ' - '; }?> </td>
				<td> <?php if($gwjun > 0){ echo number_format($gwjun); } else { echo ' - '; }?> </td>
				<td> <?php if($gwjul > 0){ echo number_format($gwjul); } else { echo ' - '; }?> </td>
				<td> <?php if($gwaug > 0){ echo number_format($gwaug); } else { echo ' - '; }?> </td>
				<td> <?php if($gwsep > 0){ echo number_format($gwsep); } else { echo ' - '; }?> </td>
				<td> <?php if($gwoct > 0){ echo number_format($gwoct); } else { echo ' - '; }?> </td>
				<td> <?php if($gwnov > 0){ echo number_format($gwnov); } else { echo ' - '; }?> </td>
				<td> <?php if($gwdec > 0){ echo number_format($gwdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($gwtotal > 0){ echo number_format($gwtotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$tfax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Transfer Fee'";
				$tfres = $conn->query($tfax);
				$tfjan = 0; $tffeb = 0; $tfmar = 0; $tfapr = 0; $tfmay = 0; $tfjun = 0; $tfjul = 0; $tfaug = 0; $tfsep = 0; $tfoct = 0; $tfnov = 0; $tfdec = 0; $tftotal = 0;
				if($tfres->num_rows > 0){
					while($row = $tfres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$tfjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$tffeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$tfmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$tfapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$tfmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$tfjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$tfjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$tfaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$tfsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$tfoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$tfnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$tfdec += $row['amount'];
						}
					}
					$tftotal = $tfjan + $tffeb + $tfmar + $tfapr + $tfmay + $tfjun + $tfjul + $tfaug + $tfsep + $tfoct + $tfnov + $tfdec;
					$jan += $tfjan; $feb += $tffeb; $mar += $tfmar; $apr += $tfapr; $may += $tfmay; $jun += $tfjun;
					$jul += $tfjul; $aug += $tfaug; $sep += $tfsep; $oct += $tfoct; $nov += $tfnov; $dec += $tfdec;
				}
			?>
			<tr>
				<td> Transfer Fee </td>
				<td> <?php if($tfjan > 0){ echo number_format($tfjan); } else { echo ' - '; }?> </td>
				<td> <?php if($tffeb > 0){ echo number_format($tffeb); } else { echo ' - '; }?> </td>
				<td> <?php if($tfmar > 0){ echo number_format($tfmar); } else { echo ' - '; }?> </td>
				<td> <?php if($tfapr > 0){ echo number_format($tfapr); } else { echo ' - '; }?> </td>
				<td> <?php if($tfmay > 0){ echo number_format($tfmay); } else { echo ' - '; }?> </td>
				<td> <?php if($tfjun > 0){ echo number_format($tfjun); } else { echo ' - '; }?> </td>
				<td> <?php if($tfjul > 0){ echo number_format($tfjul); } else { echo ' - '; }?> </td>
				<td> <?php if($tfaug > 0){ echo number_format($tfaug); } else { echo ' - '; }?> </td>
				<td> <?php if($tfsep > 0){ echo number_format($tfsep); } else { echo ' - '; }?> </td>
				<td> <?php if($tfoct > 0){ echo number_format($tfoct); } else { echo ' - '; }?> </td>
				<td> <?php if($tfnov > 0){ echo number_format($tfnov); } else { echo ' - '; }?> </td>
				<td> <?php if($tfdec > 0){ echo number_format($tfdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($tftotal > 0){ echo number_format($tftotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$srax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Space Rental'";
				$srres = $conn->query($srax);
				$srjan = 0; $srfeb = 0; $srmar = 0; $srapr = 0; $srmay = 0; $srjun = 0; $srjul = 0; $sraug = 0; $srsep = 0; $sroct = 0; $srnov = 0; $srdec = 0; $srtotal = 0;
				if($srres->num_rows > 0){
					while($row = $srres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$srjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$srfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$srmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$srapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$srmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$srjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$srjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$sraug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$srsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$sroct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$srnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$srdec += $row['amount'];
						}
					}
					$srtotal = $srjan + $srfeb + $srmar + $srapr + $srmay + $srjun + $srjul + $sraug + $srsep + $sroct + $srnov + $srdec;
					$jan += $srjan; $feb += $srfeb; $mar += $srmar; $apr += $srapr; $may += $srmay; $jun += $srjun;
					$jul += $srjul; $aug += $sraug; $sep += $srsep; $oct += $sroct; $nov += $srnov; $dec += $srdec;
				}
			?>
			<tr>
				<td> Space Rental </td>
				<td> <?php if($srjan > 0){ echo number_format($srjan); } else { echo ' - '; }?> </td>
				<td> <?php if($srfeb > 0){ echo number_format($srfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($srmar > 0){ echo number_format($srmar); } else { echo ' - '; }?> </td>
				<td> <?php if($srapr > 0){ echo number_format($srapr); } else { echo ' - '; }?> </td>
				<td> <?php if($srmay > 0){ echo number_format($srmay); } else { echo ' - '; }?> </td>
				<td> <?php if($srjun > 0){ echo number_format($srjun); } else { echo ' - '; }?> </td>
				<td> <?php if($srjul > 0){ echo number_format($srjul); } else { echo ' - '; }?> </td>
				<td> <?php if($sraug > 0){ echo number_format($sraug); } else { echo ' - '; }?> </td>
				<td> <?php if($srsep > 0){ echo number_format($srsep); } else { echo ' - '; }?> </td>
				<td> <?php if($sroct > 0){ echo number_format($sroct); } else { echo ' - '; }?> </td>
				<td> <?php if($srnov > 0){ echo number_format($srnov); } else { echo ' - '; }?> </td>
				<td> <?php if($srdec > 0){ echo number_format($srdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($srtotal > 0){ echo number_format($srtotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$tctax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'TCT'";
				$tctres = $conn->query($tctax);
				$tctjan = 0; $tctfeb = 0; $tctmar = 0; $tctapr = 0; $tctmay = 0; $tctjun = 0; $tctjul = 0; $tctaug = 0; $tctsep = 0; $tctoct = 0; $tctnov = 0; $tctdec = 0; $tcttotal = 0;
				if($tctres->num_rows > 0){
					while($row = $tctres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$tctjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$tctfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$tctmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$tctapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$tctmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$tctjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$tctjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$tctaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$tctsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$tctoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$tctnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$tctdec += $row['amount'];
						}
					}
					$tcttotal = $tctjan + $tctfeb + $tctmar + $tctapr + $tctmay + $tctjun + $tctjul + $tctaug + $tctsep + $tctoct + $tctnov + $tctdec;
					$jan += $tctjan; $feb += $tctfeb; $mar += $tctmar; $apr += $tctapr; $may += $tctmay; $jun += $tctjun;
					$jul += $tctjul; $aug += $tctaug; $sep += $tctsep; $oct += $tctoct; $nov += $tctnov; $dec += $tctdec;
				}
			?>
			<tr>
				<td> TCT </td>
				<td> <?php if($tctjan > 0){ echo number_format($tctjan); } else { echo ' - '; }?> </td>
				<td> <?php if($tctfeb > 0){ echo number_format($tctfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($tctmar > 0){ echo number_format($tctmar); } else { echo ' - '; }?> </td>
				<td> <?php if($tctapr > 0){ echo number_format($tctapr); } else { echo ' - '; }?> </td>
				<td> <?php if($tctmay > 0){ echo number_format($tctmay); } else { echo ' - '; }?> </td>
				<td> <?php if($tctjun > 0){ echo number_format($tctjun); } else { echo ' - '; }?> </td>
				<td> <?php if($tctjul > 0){ echo number_format($tctjul); } else { echo ' - '; }?> </td>
				<td> <?php if($tctaug > 0){ echo number_format($tctaug); } else { echo ' - '; }?> </td>
				<td> <?php if($tctsep > 0){ echo number_format($tctsep); } else { echo ' - '; }?> </td>
				<td> <?php if($tctoct > 0){ echo number_format($tctoct); } else { echo ' - '; }?> </td>
				<td> <?php if($tctnov > 0){ echo number_format($tctnov); } else { echo ' - '; }?> </td>
				<td> <?php if($tctdec > 0){ echo number_format($tctdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($tcttotal > 0){ echo number_format($tcttotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$wbax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Water Bill'";
				$wbres = $conn->query($wbax);
				$wbjan = 0; $wbfeb = 0; $wbmar = 0; $wbapr = 0; $wbmay = 0; $wbjun = 0; $wbjul = 0; $wbaug = 0; $wbsep = 0; $wboct = 0; $wbnov = 0; $wbdec = 0; $wbtotal = 0;
				if($wbres->num_rows > 0){
					while($row = $wbres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$wbjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$wbfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$wbmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$wbapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$wbmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$wbjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$wbjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$wbaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$wbsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$wboct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$wbnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$wbdec += $row['amount'];
						}
					}
					$wbtotal = $wbjan + $wbfeb + $wbmar + $wbapr + $wbmay + $wbjun + $wbjul + $wbaug + $wbsep + $wboct + $wbnov + $wbdec;
					$jan += $wbjan; $feb += $wbfeb; $mar += $wbmar; $apr += $wbapr; $may += $wbmay; $jun += $wbjun;
					$jul += $wbjul; $aug += $wbaug; $sep += $wbsep; $oct += $wboct; $nov += $wbnov; $dec += $wbdec;
				}
			?>
			<tr>
				<td> Water Bill </td>
				<td> <?php if($wbjan > 0){ echo number_format($wbjan); } else { echo ' - '; }?> </td>
				<td> <?php if($wbfeb > 0){ echo number_format($wbfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($wbmar > 0){ echo number_format($wbmar); } else { echo ' - '; }?> </td>
				<td> <?php if($wbapr > 0){ echo number_format($wbapr); } else { echo ' - '; }?> </td>
				<td> <?php if($wbmay > 0){ echo number_format($wbmay); } else { echo ' - '; }?> </td>
				<td> <?php if($wbjun > 0){ echo number_format($wbjun); } else { echo ' - '; }?> </td>
				<td> <?php if($wbjul > 0){ echo number_format($wbjul); } else { echo ' - '; }?> </td>
				<td> <?php if($wbaug > 0){ echo number_format($wbaug); } else { echo ' - '; }?> </td>
				<td> <?php if($wbsep > 0){ echo number_format($wbsep); } else { echo ' - '; }?> </td>
				<td> <?php if($wboct > 0){ echo number_format($wboct); } else { echo ' - '; }?> </td>
				<td> <?php if($wbnov > 0){ echo number_format($wbnov); } else { echo ' - '; }?> </td>
				<td> <?php if($wbdec > 0){ echo number_format($wbdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($wbtotal > 0){ echo number_format($wbtotal); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$certax = "SELECT * FROM `collection` where YEAR(paydate) = '$year' and type = 'Certification'";
				$certres = $conn->query($certax);
				$certjan = 0; $certfeb = 0; $certmar = 0; $certapr = 0; $certmay = 0; $certjun = 0; $certjul = 0; $certaug = 0; $certsep = 0; $certoct = 0; $certnov = 0; $certdec = 0; $certtotal = 0;
				if($certres->num_rows > 0){
					while($row = $certres->fetch_assoc()){
						if(date("m", strtotime($row['paydate'])) == '01'){
							$certjan += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '02'){
							$certfeb += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '03'){
							$certmar += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '04'){
							$certapr += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '05'){
							$certmay += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '06'){
							$certjun += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '07'){
							$certjul += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '08'){
							$certaug += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '09'){
							$certsep += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '10'){
							$certoct += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '11'){
							$certnov += $row['amount'];
						}
						elseif(date("m", strtotime($row['paydate'])) == '12'){
							$certdec += $row['amount'];
						}
					}
					$certtotal = $certjan + $certfeb + $certmar + $certapr + $certmay + $certjun + $certjul + $certaug + $certsep + $certoct + $certnov + $certdec;
					$jan += $certjan; $feb += $certfeb; $mar += $certmar; $apr += $certapr; $may += $certmay; $jun += $certjun;
					$jul += $certjul; $aug += $certaug; $sep += $certsep; $oct += $certoct; $nov += $certnov; $dec += $certdec;
				}
			?>
			<tr>
				<td> Certification </td>
				<td> <?php if($certjan > 0){ echo number_format($certjan); } else { echo ' - '; }?> </td>
				<td> <?php if($certfeb > 0){ echo number_format($certfeb); } else { echo ' - '; }?> </td>
				<td> <?php if($certmar > 0){ echo number_format($certmar); } else { echo ' - '; }?> </td>
				<td> <?php if($certapr > 0){ echo number_format($certapr); } else { echo ' - '; }?> </td>
				<td> <?php if($certmay > 0){ echo number_format($certmay); } else { echo ' - '; }?> </td>
				<td> <?php if($certjun > 0){ echo number_format($certjun); } else { echo ' - '; }?> </td>
				<td> <?php if($certjul > 0){ echo number_format($certjul); } else { echo ' - '; }?> </td>
				<td> <?php if($certaug > 0){ echo number_format($certaug); } else { echo ' - '; }?> </td>
				<td> <?php if($certsep > 0){ echo number_format($certsep); } else { echo ' - '; }?> </td>
				<td> <?php if($certoct > 0){ echo number_format($certoct); } else { echo ' - '; }?> </td>
				<td> <?php if($certnov > 0){ echo number_format($certnov); } else { echo ' - '; }?> </td>
				<td> <?php if($certdec > 0){ echo number_format($certdec); } else { echo ' - '; }?> </td>
				<td> <b><?php if($certtotal > 0){ echo number_format($certtotal); } else { echo ' - '; }?> </td>
			</tr>
			<tr>
				<?php $mototal = $jan + $feb + $mar + $apr + $may + $jun + $jul + $aug + $sep + $oct + $nov + $dec; ?>
				<td> <b>Total </td>
				<td> <b><?php if($jan > 0){ echo number_format($jan); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($feb > 0){ echo number_format($feb); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($mar > 0){ echo number_format($mar); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($apr > 0){ echo number_format($apr); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($may > 0){ echo number_format($may); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($jun > 0){ echo number_format($jun); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($jul > 0){ echo number_format($jul); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($aug > 0){ echo number_format($aug); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($sep > 0){ echo number_format($sep); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($oct > 0){ echo number_format($oct); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($nov > 0){ echo number_format($nov); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($dec > 0){ echo number_format($dec); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($mototal > 0){ echo number_format($mototal); } else { echo ' - '; } ?> </td>
			</tr>
		</tbody>
	</table>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-1">
			<br><p>Prepared by:</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-1" style="text-align: center;">
			<p><b><?php echo strtoupper($_SESSION['name']);?></b></p>
			<p>Admin Aide IV</p>
		</div>
		<div class="col-xs-4 col-xs-offset-3">
			<p>Noted by:</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-7" style="text-align: center;">
			<p><b>MARIA E. SISCAR</b></p>
			<p>Market Supervisor</p>
		</div>
	</div>
</div>