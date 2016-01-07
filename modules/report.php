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
	  		border-bottom: 1px solid black !important;
		} 
		#reportg td{
	  		font-size: 12px;
	  		bottom: 0;
	  		padding: 3.5px;
	  		border-bottom: 1px solid black !important;
	  		max-width: 210px;
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

<div class="container-fluid" id = "reportg">
	<div class="row">
		<div class="col-xs-12" align="center">
			<p style="margin-bottom: -.5px;">Republic of the Philippines</p>
			<p style="margin-bottom: -.5px;">Province of Batangas</p>
			<p>Municipality of <b>Calaca</b></p>
			<p><b>OFFICE OF THE MARKET ADMINISTRATOR</b></p>
			<p style="margin-bottom: -.5px;"><b>CASH COLLECTION REPORT</b></p>
			<p>For the Month of <b><?php echo date("F Y");?></b></p>
		</div>
	</div>
	<table class="table" border = '1' id = "tbl">
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
			$arr = array('Cash Ticket' => "1", 'Business Tax' => "2", 'Electric Bill' => "3", 'Renewal Fee' => "4", 'Market Fee' => "5", 'Market Clearance' => "6", 'Anti - Mortem' => "7", 
					'Post - Mortem' => "8", 'Goodwil' => "9", 'Transfer Fee' => "10", 'Space Rental' => "11", 'TCT' => "12", 'Water Bill' => "13", 'Certification' => "14");
			foreach ($arr as $key => $value) {
					echo '<tr>';
						echo '<td id = "width">' . $key . '</td>';
						for($i = 1; $i <= 13; $i++){
							echo '<td>1,000,000</td>';
						}	
					echo '<tr>';
			}
		?>
			<tr>
				<td>Total</td>
				<?php
					for($i = 1; $i <= 13; $i++){
						echo '<td>11,000,000</td>';
					}
				?>
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
			<p><b>JENNIFER A. APEGO</b></p>
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