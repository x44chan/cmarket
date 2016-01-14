
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<?php
		$jan = 0; $feb = 0; $mar = 0; $apr = 0; $may = 0; $jun = 0; $jul = 0; $aug = 0; $sep = 0; $oct = 0; $nov = 0; $dec = 0;
		if(!isset($_GET['year'])){
			$year = date("Y");	
		}else{
			$year = mysqli_real_escape_string($conn, $_GET['year']);
		}
		
		$cticket = "SELECT * FROM `collection` where YEAR(paydate) = '$year'";
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
<script type="text/javascript">
	$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Cash Collection Graph'
        },
        subtitle: {
            text: 'Total Collection: ₱ <?php echo number_format($cttotal,2)?>'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: '₱esos'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0"> </td>' +
                '<td style="padding:0"><b>₱ {point.y:,.2f}</b></td></tr>',
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
        series: [{
            name: 'Collection <?php echo date("Y");?>',
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

        }]
    });
});
</script>