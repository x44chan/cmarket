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
	.highcharts-button{
 		visibility: hidden;
 	}
	@media print {
		#xxxs, #tohide, .footer{
			visibility: hidden;
		}
	  	@page{ size: A4 landscape;}
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
	  	<?php if(isset($_GET['print'])){ ?>
	  	#reportg, #reportg * {
	    	visibility: visible;
	 	}
	 	body * {
	    	visibility: hidden;
	    
	  	}
	 	<?php }else{ ?>
	 	#reportg, #reportg * {
	    	visibility: hidden;
	 	}
	 	<?php } ?>
	 	.xcont{
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
<div class="container-fluid" id = "xxxs">
	<div class="col-xs-12 form-inline" align="right">
		<form action = "" method="get">
			<input type = 'hidden' name = "module" value = "repsum">
			<label>Starting Year: </label>
			<select class="form-control input-sm" name = "year" required/>
				<option <?php if(isset($_GET['year']) && $_GET['year'] == date("Y")){ echo ' selected '; } ?> value="<?php echo date('Y');?>"> <?php echo date('Y'); $year = 2016;?> </option>
				<?php
					for($i = date("Y"); $i >= 2016; $i--){
						if($i == date("Y")){
							continue;
						}
						$a = date("Y") - $i;
						$echdate = date("Y", strtotime("-".$a.' year', strtotime($year)));
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
			<a href="?module=repsum" class="btn btn-danger btn-sm"><span class = "icon-spinner11"></span> Clear </a>
			<a href = "?module=repsum<?php if(isset($_GET['year'])){ echo '&year=' . $_GET['year'];}?>&print"class="btn btn-success btn-sm"><span class = "icon-printer"></span> Print Report</a>
			<button class="btn btn-success btn-sm" onclick="window.print()"><span class = "icon-printer"></span> Print Graph</button>	
		</form>			
	</div>
</div>
<?php
	if(isset($_GET['year'])  && $_GET['year'] <= date("Y")){
		if($_GET['year'] != date('Y')){
			$repdate = 'For the Year of <b>'. mysqli_real_escape_string($conn, $_GET['year']);
		}else{
			$repdate = 'as of <b>' . date ("F Y");
		}
		$year = mysqli_real_escape_string($conn, $_GET['year']);
	}else{
		$repdate = 'as of <b>' . date ("F Y");
		$year = '2016';	
	}
?>
<div class="container-fluid" id = "reportg">
	<div class="row">
		<div class="col-xs-12" align="center">
			<p style="margin-bottom: -.5px;">Republic of the Philippines</p>
			<p style="margin-bottom: -.5px;">Province of Batangas</p>
			<p>Municipality of <b>Calaca</b></p>
			<p><b>OFFICE OF THE MARKET ADMINISTRATOR</b></p>
			<p style="margin-bottom: -.5px;"><b>CASH COLLECTION REPORT (YEARLY SUMMARY)</b></p>
			<p><?php echo $repdate;?></b></p>
		</div>
	</div>
	<table class="table" border = '1' id = "tbl" style="text-align: center">
		<thead>
			<th></th>
			<?php
				$d = 0;
				for($i = 1; $i <= 12; $i++){
					echo '<th>' . ($year + $d)  . '</th>';
					$arryear[] = ($year + $d);
					$d += 1;
				}
			?>
			<th style="display: none;">Total</th>
		</thead>
		<tbody>
			<?php
				$jan = 0; $feb = 0; $mar = 0; $apr = 0; $may = 0; $jun = 0; $jul = 0; $aug = 0; $sep = 0; $oct = 0; $nov = 0; $dec = 0;
				
				$ctjan = 0; $ctfeb = 0; $ctmar = 0; $ctapr = 0; $ctmay = 0; $ctjun = 0; $ctjul = 0; $ctaug = 0; $ctsep = 0; $ctoct = 0; $ctnov = 0; $ctdec = 0; $cttotal = 0;
				$cticket = "SELECT * FROM `collection` where month(paydate) = '01'";
				$ctres = $conn->query($cticket);
				if($ctres->num_rows > 0){
					while($row = $ctres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$ctjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$ctfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$ctmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$ctapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$ctmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$ctjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$ctjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$ctaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$ctsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$ctoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$ctnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$ctdec += $row['amount'];
						}
					}
					$cttotal = $ctjan + $ctfeb + $ctmar + $ctapr + $ctmay + $ctjun + $ctjul + $ctaug + $ctsep + $ctoct + $ctnov + $ctdec;
					$jan += $ctjan; $feb += $ctfeb; $mar += $ctmar; $apr += $ctapr; $may += $ctmay; $jun += $ctjun;
					$jul += $ctjul; $aug += $ctaug; $sep += $ctsep; $oct += $ctoct; $nov += $ctnov; $dec += $ctdec;
				}
			?>
			<tr>
				<td> January </td>
				<td> <?php if($ctjan > 0){ echo number_format($ctjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctfeb > 0){ echo number_format($ctfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctmar > 0){ echo number_format($ctmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctapr > 0){ echo number_format($ctapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctmay > 0){ echo number_format($ctmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctjun > 0){ echo number_format($ctjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctjul > 0){ echo number_format($ctjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctaug > 0){ echo number_format($ctaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctsep > 0){ echo number_format($ctsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctoct > 0){ echo number_format($ctoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctnov > 0){ echo number_format($ctnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ctdec > 0){ echo number_format($ctdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($cttotal > 0){ echo number_format($cttotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$btax = "SELECT * FROM `collection` where month(paydate) = '02'";
				$btres = $conn->query($btax);
				$btjan = 0; $btfeb = 0; $btmar = 0; $btapr = 0; $btmay = 0; $btjun = 0; $btjul = 0; $btaug = 0; $btsep = 0; $btoct = 0; $btnov = 0; $btdec = 0; $bttotal = 0;
				if($btres->num_rows > 0){
					while($row = $btres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$btjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$btfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$btmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$btapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$btmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$btjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$btjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$btaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$btsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$btoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$btnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$btdec += $row['amount'];
						}
					}
					$bttotal = $btjan + $btfeb + $btmar + $btapr + $btmay + $btjun + $btjul + $btaug + $btsep + $btoct + $btnov + $btdec;
					$jan += $btjan; $feb += $btfeb; $mar += $btmar; $apr += $btapr; $may += $btmay; $jun += $btjun;
					$jul += $btjul; $aug += $btaug; $sep += $btsep; $oct += $btoct; $nov += $btnov; $dec += $btdec;
				}
			?>
			<tr>
				<td> February </td>
				<td> <?php if($btjan > 0){ echo number_format($btjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btfeb > 0){ echo number_format($btfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btmar > 0){ echo number_format($btmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btapr > 0){ echo number_format($btapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btmay > 0){ echo number_format($btmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btjun > 0){ echo number_format($btjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btjul > 0){ echo number_format($btjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btaug > 0){ echo number_format($btaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btsep > 0){ echo number_format($btsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btoct > 0){ echo number_format($btoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btnov > 0){ echo number_format($btnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($btdec > 0){ echo number_format($btdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($bttotal > 0){ echo number_format($bttotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$ebax = "SELECT * FROM `collection` where month(paydate) = '03'";
				$ebres = $conn->query($ebax);
				$ebjan = 0; $ebfeb = 0; $ebmar = 0; $ebapr = 0; $ebmay = 0; $ebjun = 0; $ebjul = 0; $ebaug = 0; $ebsep = 0; $eboct = 0; $ebnov = 0; $ebdec = 0; $ebtotal = 0;
				if($ebres->num_rows > 0){
					while($row = $ebres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$ebjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$ebfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$ebmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$ebapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$ebmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$ebjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$ebjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$ebaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$ebsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$eboct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$ebnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$ebdec += $row['amount'];
						}
					}
					$ebtotal = $ebjan + $ebfeb + $ebmar + $ebapr + $ebmay + $ebjun + $ebjul + $ebaug + $ebsep + $eboct + $ebnov + $ebdec;
					$jan += $ebjan; $feb += $ebfeb; $mar += $ebmar; $apr += $ebapr; $may += $ebmay; $jun += $ebjun;
					$jul += $ebjul; $aug += $ebaug; $sep += $ebsep; $oct += $eboct; $nov += $ebnov; $dec += $ebdec;
				}
			?>
			<tr>
				<td> March </td>
				<td> <?php if($ebjan > 0){ echo number_format($ebjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebfeb > 0){ echo number_format($ebfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebmar > 0){ echo number_format($ebmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebapr > 0){ echo number_format($ebapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebmay > 0){ echo number_format($ebmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebjun > 0){ echo number_format($ebjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebjul > 0){ echo number_format($ebjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebaug > 0){ echo number_format($ebaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebsep > 0){ echo number_format($ebsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($eboct > 0){ echo number_format($eboct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebnov > 0){ echo number_format($ebnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ebdec > 0){ echo number_format($ebdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($ebtotal > 0){ echo number_format($ebtotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$rfax = "SELECT * FROM `collection` where month(paydate) = '04'";
				$rfres = $conn->query($rfax);
				$rfjan = 0; $rffeb = 0; $rfmar = 0; $rfapr = 0; $rfmay = 0; $rfjun = 0; $rfjul = 0; $rfaug = 0; $rfsep = 0; $rfoct = 0; $rfnov = 0; $rfdec = 0; $rftotal = 0;
				if($rfres->num_rows > 0){
					while($row = $rfres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$rfjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$rffeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$rfmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$rfapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$rfmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$rfjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$rfjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$rfaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$rfsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$rfoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$rfnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$rfdec += $row['amount'];
						}
					}
					$rftotal = $rfjan + $rffeb + $rfmar + $rfapr + $rfmay + $rfjun + $rfjul + $rfaug + $rfsep + $rfoct + $rfnov + $rfdec;
					$jan += $rfjan; $feb += $rffeb; $mar += $rfmar; $apr += $rfapr; $may += $rfmay; $jun += $rfjun;
					$jul += $rfjul; $aug += $rfaug; $sep += $rfsep; $oct += $rfoct; $nov += $rfnov; $dec += $rfdec;
				}
			?>
			<tr>
				<td> April </td>
				<td> <?php if($rfjan > 0){ echo number_format($rfjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rffeb > 0){ echo number_format($rffeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfmar > 0){ echo number_format($rfmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfapr > 0){ echo number_format($rfapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfmay > 0){ echo number_format($rfmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfjun > 0){ echo number_format($rfjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfjul > 0){ echo number_format($rfjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfaug > 0){ echo number_format($rfaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfsep > 0){ echo number_format($rfsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfoct > 0){ echo number_format($rfoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfnov > 0){ echo number_format($rfnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($rfdec > 0){ echo number_format($rfdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($rftotal > 0){ echo number_format($rftotal,2	); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$mfax = "SELECT * FROM `collection` where month(paydate) = '05'";
				$mfres = $conn->query($mfax);
				$mfjan = 0; $mffeb = 0; $mfmar = 0; $mfapr = 0; $mfmay = 0; $mfjun = 0; $mfjul = 0; $mfaug = 0; $mfsep = 0; $mfoct = 0; $mfnov = 0; $mfdec = 0; $mftotal = 0;
				if($mfres->num_rows > 0){
					while($row = $mfres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$mfjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$mffeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$mfmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$mfapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$mfmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$mfjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$mfjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$mfaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$mfsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$mfoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$mfnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$mfdec += $row['amount'];
						}
					}
					$mftotal = $mfjan + $mffeb + $mfmar + $mfapr + $mfmay + $mfjun + $mfjul + $mfaug + $mfsep + $mfoct + $mfnov + $mfdec;
					$jan += $mfjan; $feb += $mffeb; $mar += $mfmar; $apr += $mfapr; $may += $mfmay; $jun += $mfjun;
					$jul += $mfjul; $aug += $mfaug; $sep += $mfsep; $oct += $mfoct; $nov += $mfnov; $dec += $mfdec;
				}
			?>
			<tr>
				<td> May </td>
				<td> <?php if($mfjan > 0){ echo number_format($mfjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mffeb > 0){ echo number_format($mffeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfmar > 0){ echo number_format($mfmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfapr > 0){ echo number_format($mfapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfmay > 0){ echo number_format($mfmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfjun > 0){ echo number_format($mfjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfjul > 0){ echo number_format($mfjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfaug > 0){ echo number_format($mfaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfsep > 0){ echo number_format($mfsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfoct > 0){ echo number_format($mfoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfnov > 0){ echo number_format($mfnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mfdec > 0){ echo number_format($mfdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($mftotal > 0){ echo number_format($mftotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$mcax = "SELECT * FROM `collection` where month(paydate) = '06'";
				$mcres = $conn->query($mcax);
				$mcjan = 0; $mcfeb = 0; $mcmar = 0; $mcapr = 0; $mcmay = 0; $mcjun = 0; $mcjul = 0; $mcaug = 0; $mcsep = 0; $mcoct = 0; $mcnov = 0; $mcdec = 0; $mctotal = 0;
				if($mcres->num_rows > 0){
					while($row = $mcres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$mcjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$mcfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$mcmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$mcapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$mcmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$mcjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$mcjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$mcaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$mcsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$mcoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$mcnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$mcdec += $row['amount'];
						}
					}
					$mctotal = $mcjan + $mcfeb + $mcmar + $mcapr + $mcmay + $mcjun + $mcjul + $mcaug + $mcsep + $mcoct + $mcnov + $mcdec;
					$jan += $mcjan; $feb += $mcfeb; $mar += $mcmar; $apr += $mcapr; $may += $mcmay; $jun += $mcjun;
					$jul += $mcjul; $aug += $mcaug; $sep += $mcsep; $oct += $mcoct; $nov += $mcnov; $dec += $mcdec;
				}
			?>
			<tr>
				<td> June </td>
				<td> <?php if($mcjan > 0){ echo number_format($mcjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcfeb > 0){ echo number_format($mcfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcmar > 0){ echo number_format($mcmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcapr > 0){ echo number_format($mcapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcmay > 0){ echo number_format($mcmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcjun > 0){ echo number_format($mcjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcjul > 0){ echo number_format($mcjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcaug > 0){ echo number_format($mcaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcsep > 0){ echo number_format($mcsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcoct > 0){ echo number_format($mcoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcnov > 0){ echo number_format($mcnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($mcdec > 0){ echo number_format($mcdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($mctotal > 0){ echo number_format($mctotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$amax = "SELECT * FROM `collection` where month(paydate) = '07'";
				$amres = $conn->query($amax);
				$amjan = 0; $amfeb = 0; $ammar = 0; $amapr = 0; $ammay = 0; $amjun = 0; $amjul = 0; $amaug = 0; $amsep = 0; $amoct = 0; $amnov = 0; $amdec = 0; $amtotal = 0;
				if($amres->num_rows > 0){
					while($row = $amres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$amjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$amfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$ammar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$amapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$ammay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$amjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$amjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$amaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$amsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$amoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$amnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$amdec += $row['amount'];
						}
					}
					$amtotal = $amjan + $amfeb + $ammar + $amapr + $ammay + $amjun + $amjul + $amaug + $amsep + $amoct + $amnov + $amdec;
					$jan += $amjan; $feb += $amfeb; $mar += $ammar; $apr += $amapr; $may += $ammay; $jun += $amjun;
					$jul += $amjul; $aug += $amaug; $sep += $amsep; $oct += $amoct; $nov += $amnov; $dec += $amdec;
				}
			?>
			<tr>
				<td> July </td>
				<td> <?php if($amjan > 0){ echo number_format($amjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amfeb > 0){ echo number_format($amfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ammar > 0){ echo number_format($ammar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amapr > 0){ echo number_format($amapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($ammay > 0){ echo number_format($ammay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amjun > 0){ echo number_format($amjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amjul > 0){ echo number_format($amjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amaug > 0){ echo number_format($amaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amsep > 0){ echo number_format($amsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amoct > 0){ echo number_format($amoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amnov > 0){ echo number_format($amnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($amdec > 0){ echo number_format($amdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($amtotal > 0){ echo number_format($amtotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$pmax = "SELECT * FROM `collection` where month(paydate) = '08'";
				$pmres = $conn->query($pmax);
				$pmjan = 0; $pmfeb = 0; $pmmar = 0; $pmapr = 0; $pmmay = 0; $pmjun = 0; $pmjul = 0; $pmaug = 0; $pmsep = 0; $pmoct = 0; $pmnov = 0; $pmdec = 0; $pmtotal = 0;
				if($pmres->num_rows > 0){
					while($row = $pmres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$pmjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$pmfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$pmmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$pmapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$pmmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$pmjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$pmjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$pmaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$pmsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$pmoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$pmnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$pmdec += $row['amount'];
						}
					}
					$pmtotal = $pmjan + $pmfeb + $pmmar + $pmapr + $pmmay + $pmjun + $pmjul + $pmaug + $pmsep + $pmoct + $pmnov + $pmdec;
					$jan += $pmjan; $feb += $pmfeb; $mar += $pmmar; $apr += $pmapr; $may += $pmmay; $jun += $pmjun;
					$jul += $pmjul; $aug += $pmaug; $sep += $pmsep; $oct += $pmoct; $nov += $pmnov; $dec += $pmdec;
				}
			?>
			<tr>
				<td> August </td>
				<td> <?php if($pmjan > 0){ echo number_format($pmjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmfeb > 0){ echo number_format($pmfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmmar > 0){ echo number_format($pmmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmapr > 0){ echo number_format($pmapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmmay > 0){ echo number_format($pmmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmjun > 0){ echo number_format($pmjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmjul > 0){ echo number_format($pmjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmaug > 0){ echo number_format($pmaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmsep > 0){ echo number_format($pmsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmoct > 0){ echo number_format($pmoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmnov > 0){ echo number_format($pmnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($pmdec > 0){ echo number_format($pmdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($pmtotal > 0){ echo number_format($pmtotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$gwax = "SELECT * FROM `collection` where month(paydate) = '09'";
				$gwres = $conn->query($gwax);
				$gwjan = 0; $gwfeb = 0; $gwmar = 0; $gwapr = 0; $gwmay = 0; $gwjun = 0; $gwjul = 0; $gwaug = 0; $gwsep = 0; $gwoct = 0; $gwnov = 0; $gwdec = 0; $gwtotal = 0;
				if($gwres->num_rows > 0){
					while($row = $gwres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$gwjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$gwfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$gwmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$gwapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$gwmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$gwjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$gwjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$gwaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$gwsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$gwoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$gwnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$gwdec += $row['amount'];
						}
					}
					$gwtotal = $gwjan + $gwfeb + $gwmar + $gwapr + $gwmay + $gwjun + $gwjul + $gwaug + $gwsep + $gwoct + $gwnov + $gwdec;
					$jan += $gwjan; $feb += $gwfeb; $mar += $gwmar; $apr += $gwapr; $may += $gwmay; $jun += $gwjun;
					$jul += $gwjul; $aug += $gwaug; $sep += $gwsep; $oct += $gwoct; $nov += $gwnov; $dec += $gwdec;
				}
			?>
			<tr>
				<td> September </td>
				<td> <?php if($gwjan > 0){ echo number_format($gwjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwfeb > 0){ echo number_format($gwfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwmar > 0){ echo number_format($gwmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwapr > 0){ echo number_format($gwapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwmay > 0){ echo number_format($gwmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwjun > 0){ echo number_format($gwjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwjul > 0){ echo number_format($gwjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwaug > 0){ echo number_format($gwaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwsep > 0){ echo number_format($gwsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwoct > 0){ echo number_format($gwoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwnov > 0){ echo number_format($gwnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($gwdec > 0){ echo number_format($gwdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($gwtotal > 0){ echo number_format($gwtotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$tfax = "SELECT * FROM `collection` where month(paydate) = '10'";
				$tfres = $conn->query($tfax);
				$tfjan = 0; $tffeb = 0; $tfmar = 0; $tfapr = 0; $tfmay = 0; $tfjun = 0; $tfjul = 0; $tfaug = 0; $tfsep = 0; $tfoct = 0; $tfnov = 0; $tfdec = 0; $tftotal = 0;
				if($tfres->num_rows > 0){
					while($row = $tfres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$tfjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$tffeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$tfmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$tfapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$tfmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$tfjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$tfjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$tfaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$tfsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$tfoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$tfnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$tfdec += $row['amount'];
						}
					}
					$tftotal = $tfjan + $tffeb + $tfmar + $tfapr + $tfmay + $tfjun + $tfjul + $tfaug + $tfsep + $tfoct + $tfnov + $tfdec;
					$jan += $tfjan; $feb += $tffeb; $mar += $tfmar; $apr += $tfapr; $may += $tfmay; $jun += $tfjun;
					$jul += $tfjul; $aug += $tfaug; $sep += $tfsep; $oct += $tfoct; $nov += $tfnov; $dec += $tfdec;
				}
			?>
			<tr>
				<td> October </td>
				<td> <?php if($tfjan > 0){ echo number_format($tfjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tffeb > 0){ echo number_format($tffeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfmar > 0){ echo number_format($tfmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfapr > 0){ echo number_format($tfapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfmay > 0){ echo number_format($tfmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfjun > 0){ echo number_format($tfjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfjul > 0){ echo number_format($tfjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfaug > 0){ echo number_format($tfaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfsep > 0){ echo number_format($tfsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfoct > 0){ echo number_format($tfoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfnov > 0){ echo number_format($tfnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tfdec > 0){ echo number_format($tfdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($tftotal > 0){ echo number_format($tftotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$srax = "SELECT * FROM `collection` where month(paydate) = '11'";
				$srres = $conn->query($srax);
				$srjan = 0; $srfeb = 0; $srmar = 0; $srapr = 0; $srmay = 0; $srjun = 0; $srjul = 0; $sraug = 0; $srsep = 0; $sroct = 0; $srnov = 0; $srdec = 0; $srtotal = 0;
				if($srres->num_rows > 0){
					while($row = $srres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$srjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$srfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$srmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$srapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$srmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$srjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$srjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$sraug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$srsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$sroct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$srnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$srdec += $row['amount'];
						}
					}
					$srtotal = $srjan + $srfeb + $srmar + $srapr + $srmay + $srjun + $srjul + $sraug + $srsep + $sroct + $srnov + $srdec;
					$jan += $srjan; $feb += $srfeb; $mar += $srmar; $apr += $srapr; $may += $srmay; $jun += $srjun;
					$jul += $srjul; $aug += $sraug; $sep += $srsep; $oct += $sroct; $nov += $srnov; $dec += $srdec;
				}
			?>
			<tr>
				<td> November </td>
				<td> <?php if($srjan > 0){ echo number_format($srjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srfeb > 0){ echo number_format($srfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srmar > 0){ echo number_format($srmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srapr > 0){ echo number_format($srapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srmay > 0){ echo number_format($srmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srjun > 0){ echo number_format($srjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srjul > 0){ echo number_format($srjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($sraug > 0){ echo number_format($sraug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srsep > 0){ echo number_format($srsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($sroct > 0){ echo number_format($sroct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srnov > 0){ echo number_format($srnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($srdec > 0){ echo number_format($srdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($srtotal > 0){ echo number_format($srtotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<?php
				$tctax = "SELECT * FROM `collection` where month(paydate) = '12'";
				$tctres = $conn->query($tctax);
				$tctjan = 0; $tctfeb = 0; $tctmar = 0; $tctapr = 0; $tctmay = 0; $tctjun = 0; $tctjul = 0; $tctaug = 0; $tctsep = 0; $tctoct = 0; $tctnov = 0; $tctdec = 0; $tcttotal = 0;
				if($tctres->num_rows > 0){
					while($row = $tctres->fetch_assoc()){
						if(date("Y", strtotime($row['paydate'])) == $arryear[0]){
							$tctjan += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[1]){
							$tctfeb += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[2]){
							$tctmar += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[3]){
							$tctapr += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[4]){
							$tctmay += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[5]){
							$tctjun += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[6]){
							$tctjul += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[7]){
							$tctaug += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[8]){
							$tctsep += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[9]){
							$tctoct += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[10]){
							$tctnov += $row['amount'];
						}
						elseif(date("Y", strtotime($row['paydate'])) == $arryear[11]){
							$tctdec += $row['amount'];
						}
					}
					$tcttotal = $tctjan + $tctfeb + $tctmar + $tctapr + $tctmay + $tctjun + $tctjul + $tctaug + $tctsep + $tctoct + $tctnov + $tctdec;
					$jan += $tctjan; $feb += $tctfeb; $mar += $tctmar; $apr += $tctapr; $may += $tctmay; $jun += $tctjun;
					$jul += $tctjul; $aug += $tctaug; $sep += $tctsep; $oct += $tctoct; $nov += $tctnov; $dec += $tctdec;
				}
			?>
			<tr>
				<td> December </td>
				<td> <?php if($tctjan > 0){ echo number_format($tctjan,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctfeb > 0){ echo number_format($tctfeb,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctmar > 0){ echo number_format($tctmar,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctapr > 0){ echo number_format($tctapr,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctmay > 0){ echo number_format($tctmay,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctjun > 0){ echo number_format($tctjun,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctjul > 0){ echo number_format($tctjul,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctaug > 0){ echo number_format($tctaug,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctsep > 0){ echo number_format($tctsep,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctoct > 0){ echo number_format($tctoct,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctnov > 0){ echo number_format($tctnov,2); } else { echo ' - '; }?> </td>
				<td> <?php if($tctdec > 0){ echo number_format($tctdec,2); } else { echo ' - '; }?> </td>
				<td style="display: none;"> <b><?php if($tcttotal > 0){ echo number_format($tcttotal,2); } else { echo ' - '; }?> </td>
			</tr>
			<tr>
				<td colspan="14"></td>
			</tr>
			<tr>
				<?php $mototal = $jan + $feb + $mar + $apr + $may + $jun + $jul + $aug + $sep + $oct + $nov + $dec; ?>
				<td> <b>Total </td>
				<td> <b><?php if($jan > 0){ echo number_format($jan,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($feb > 0){ echo number_format($feb,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($mar > 0){ echo number_format($mar,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($apr > 0){ echo number_format($apr,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($may > 0){ echo number_format($may,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($jun > 0){ echo number_format($jun,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($jul > 0){ echo number_format($jul,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($aug > 0){ echo number_format($aug,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($sep > 0){ echo number_format($sep,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($oct > 0){ echo number_format($oct,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($nov > 0){ echo number_format($nov,2); } else { echo ' - '; } ?> </td>
				<td> <b><?php if($dec > 0){ echo number_format($dec,2); } else { echo ' - '; } ?> </td>
				<td style="display: none;"> <b><?php if($mototal > 0){ echo number_format($mototal,2); } else { echo ' - '; } ?> </td>
			</tr>
		</tbody>
	</table>
	<div class="row" style="margin-top: -15px;">
		<div class="col-xs-4 col-xs-offset-1">
			<br><p>Prepared by:</p>
		</div>
	</div>
	<?php
		$stmt = "SELECT * FROM `references`";
		$data = $conn->query($stmt)->fetch_assoc();
	?>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-1" style="text-align: center;">
			<p><b><?php echo strtoupper($data['aaide']);?></b></p>
			<p><?php echo strtoupper($data['post2']);?></p>
		</div>
		<div class="col-xs-4 col-xs-offset-3">
			<p>Noted by:</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-8" style="text-align: center;">
			<p><b><?php echo strtoupper($data['mvisor']);?></b></p>
			<p><?php echo strtoupper($data['post1']);?></p>
		</div>
	</div>
</div>
<div class = "xcont" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div class="row" style="margin-top: 25px;">
		<div class="col-xs-4 col-xs-offset-1">
			<br><p>Prepared by:</p>
		</div>
	</div>
	<?php
		$stmt = "SELECT * FROM `references`";
		$data = $conn->query($stmt)->fetch_assoc();
	?>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-1" style="text-align: center;">
			<p><b><?php echo strtoupper($data['aaide']);?></b></p>
			<p><?php echo strtoupper($data['post2']);?></p>
		</div>
		<div class="col-xs-4 col-xs-offset-3">
			<p>Noted by:</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-8" style="text-align: center;">
			<p><b><?php echo strtoupper($data['mvisor']);?></b></p>
			<p><?php echo strtoupper($data['post1']);?></p>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
    $('.xcont').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Cash Collection Graph (Yearly Summary)'
        },
        subtitle: {
            text: 'Total Collection: ₱ <?php echo number_format($mototal,2)?>'
        },
        xAxis: {
            categories: [
                <?php
					$d = 0;
					for($i = 1; $i <= 12; $i++){
						echo ($year + $d)  . ',';
						$arryear[] = ($year + $d);
						$d += 1;
					}
				?>
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: '₱esos'
            },
            labels: {
                formatter: function () {
                    return Highcharts.numberFormat(this.value, 2,'.',',');
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>₱ {point.y:,.2f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: 
        	[{
            name: 'January',
            data: [ <?php echo $ctjan;?>,
            		<?php echo $ctfeb;?>,
            		<?php echo $ctmar;?>,
            		<?php echo $ctapr;?>,
            		<?php echo $ctmay;?>,
            		<?php echo $ctjun;?>,
            		<?php echo $ctjul;?>,
            		<?php echo $ctaug;?>,
            		<?php echo $ctsep;?>,
            		<?php echo $ctoct;?>,
            		<?php echo $ctnov;?>,
            		<?php echo $ctdec;?>
            	  ]
        	},{
            name: 'February',
            data: [ <?php echo $btjan;?>,
            		<?php echo $btfeb;?>,
            		<?php echo $btmar;?>,
            		<?php echo $btapr;?>,
            		<?php echo $btmay;?>,
            		<?php echo $btjun;?>,
            		<?php echo $btjul;?>,
            		<?php echo $btaug;?>,
            		<?php echo $btsep;?>,
            		<?php echo $btoct;?>,
            		<?php echo $btnov;?>,
            		<?php echo $btdec;?>
            	  ]

        	},{
            name: 'March',
            data: [ <?php echo $ebjan;?>,
            		<?php echo $ebfeb;?>,
            		<?php echo $ebmar;?>,
            		<?php echo $ebapr;?>,
            		<?php echo $ebmay;?>,
            		<?php echo $ebjun;?>,
            		<?php echo $ebjul;?>,
            		<?php echo $ebaug;?>,
            		<?php echo $ebsep;?>,
            		<?php echo $eboct;?>,
            		<?php echo $ebnov;?>,
            		<?php echo $ebdec;?>
            	  ]

        	},{
            name: 'April',
            data: [ <?php echo $rfjan;?>,
            		<?php echo $rffeb;?>,
            		<?php echo $rfmar;?>,
            		<?php echo $rfapr;?>,
            		<?php echo $rfmay;?>,
            		<?php echo $rfjun;?>,
            		<?php echo $rfjul;?>,
            		<?php echo $rfaug;?>,
            		<?php echo $rfsep;?>,
            		<?php echo $rfoct;?>,
            		<?php echo $rfnov;?>,
            		<?php echo $rfdec;?>
            	  ]

        	},{
            name: 'May',
            data: [ <?php echo $mfjan;?>,
            		<?php echo $mffeb;?>,
            		<?php echo $mfmar;?>,
            		<?php echo $mfapr;?>,
            		<?php echo $mfmay;?>,
            		<?php echo $mfjun;?>,
            		<?php echo $mfjul;?>,
            		<?php echo $mfaug;?>,
            		<?php echo $mfsep;?>,
            		<?php echo $mfoct;?>,
            		<?php echo $mfnov;?>,
            		<?php echo $mfdec;?>
            	  ]

        	},{
            name: 'June',
            data: [ <?php echo $mcjan;?>,
            		<?php echo $mcfeb;?>,
            		<?php echo $mcmar;?>,
            		<?php echo $mcapr;?>,
            		<?php echo $mcmay;?>,
            		<?php echo $mcjun;?>,
            		<?php echo $mcjul;?>,
            		<?php echo $mcaug;?>,
            		<?php echo $mcsep;?>,
            		<?php echo $mcoct;?>,
            		<?php echo $mcnov;?>,
            		<?php echo $mcdec;?>
            	  ]

        	},{
            name: 'July',
            data: [ <?php echo $amjan;?>,
            		<?php echo $amfeb;?>,
            		<?php echo $ammar;?>,
            		<?php echo $amapr;?>,
            		<?php echo $ammay;?>,
            		<?php echo $amjun;?>,
            		<?php echo $amjul;?>,
            		<?php echo $amaug;?>,
            		<?php echo $amsep;?>,
            		<?php echo $amoct;?>,
            		<?php echo $amnov;?>,
            		<?php echo $amdec;?>
            	]

        	},{
            name: 'August',
            data: [ <?php echo $pmjan;?>,
            		<?php echo $pmfeb;?>,
            		<?php echo $pmmar;?>,
            		<?php echo $pmapr;?>,
            		<?php echo $pmmay;?>,
            		<?php echo $pmjun;?>,
            		<?php echo $pmjul;?>,
            		<?php echo $pmaug;?>,
            		<?php echo $pmsep;?>,
            		<?php echo $pmoct;?>,
            		<?php echo $pmnov;?>,
            		<?php echo $pmdec;?>
            	  ]

        	},{
            name: 'September',
            data: [ <?php echo $gwjan;?>,
            		<?php echo $gwfeb;?>,
            		<?php echo $gwmar;?>,
            		<?php echo $gwapr;?>,
            		<?php echo $gwmay;?>,
            		<?php echo $gwjun;?>,
            		<?php echo $gwjul;?>,
            		<?php echo $gwaug;?>,
            		<?php echo $gwsep;?>,
            		<?php echo $gwoct;?>,
            		<?php echo $gwnov;?>,
            		<?php echo $gwdec;?>
            	  ]

        	},{
            name: 'October',
            data: [ <?php echo $tfjan;?>,
            		<?php echo $tffeb;?>,
            		<?php echo $tfmar;?>,
            		<?php echo $tfapr;?>,
            		<?php echo $tfmay;?>,
            		<?php echo $tfjun;?>,
            		<?php echo $tfjul;?>,
            		<?php echo $tfaug;?>,
            		<?php echo $tfsep;?>,
            		<?php echo $tfoct;?>,
            		<?php echo $tfnov;?>,
            		<?php echo $tfdec;?>
            	  ]

        	},{
            name: 'November',
            data: [ <?php echo $srjan;?>,
            		<?php echo $srfeb;?>,
            		<?php echo $srmar;?>,
            		<?php echo $srapr;?>,
            		<?php echo $srmay;?>,
            		<?php echo $srjun;?>,
            		<?php echo $srjul;?>,
            		<?php echo $sraug;?>,
            		<?php echo $srsep;?>,
            		<?php echo $sroct;?>,
            		<?php echo $srnov;?>,
            		<?php echo $srdec;?>
            	  ]

        	},{
            name: 'December',
            data: [ <?php echo $tctjan;?>,
            		<?php echo $tctfeb;?>,
            		<?php echo $tctmar;?>,
            		<?php echo $tctapr;?>,
            		<?php echo $tctmay;?>,
            		<?php echo $tctjun;?>,
            		<?php echo $tctjul;?>,
            		<?php echo $tctaug;?>,
            		<?php echo $tctsep;?>,
            		<?php echo $tctoct;?>,
            		<?php echo $tctnov;?>,
            		<?php echo $tctdec;?>
            	  ]

        	},]
    });
});
</script>
<?php
	if(isset($_GET['year'])){ $search = '&year=' . $_GET['year']; }else{ $search = ""; }
	if(isset($_GET['print'])){
		echo '<script type = "text/javascript">	window.print(); setTimeout(function() { window.location.href = "?module=repsum'.$search.'" }, 100);;</script>';
	}
?>