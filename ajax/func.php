<script type="text/javascript">
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
	function showOR(str) {
		if (str == "") {
		    document.getElementById("ornom").innerHTML = "";
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
		            document.getElementById("ornom").innerHTML = xmlhttp.responseText;
		        }
		    };
		    xmlhttp.open("GET","ajax/ajaxowner.php?x="+str,true);
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