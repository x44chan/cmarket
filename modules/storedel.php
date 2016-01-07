<?php 
if(isset($_GET['x'])){
	$id =mysql_real_escape_string($_GET['x']);

	// sending query
	 	

$update = "UPDATE store set  status = '0' where store_id = '$id'";
		if($conn->query($update) == TRUE){
			echo '<script type = "text/javascript">
					alert("Delete Record Successful");
					window.location.replace("?module=storelist");
				</script>';
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	
	
	

	
	}

?>