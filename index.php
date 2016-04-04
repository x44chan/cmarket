<?php
	session_start();
    include 'config/title.php';
	include 'config/header.php';
    include 'config/conf.php';	
	if(isset($_SESSION['acc_id'])){
?>
<!-- Static navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div style = "float: bottom" class="navbar-header">
        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        		<span class="sr-only">Toggle navigation</span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        	</button>
        	<a class="navbar-brand" href="/cmarket"><span class="icon-office" style = "color: #009999;"></span> Calaca Market System.</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        	<ul class="nav navbar-nav navbar-left">
        		<li><a  role = "button" href="/cmarket"><span class="icon-home3" style = "font-weight: bold;"></span> Home</a></li>
        		<li class="dropdown">
	            	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-coin-dollar"></span> Collections <b class="caret"></b></a>
	            	<ul class="dropdown-menu" role="menu">
	            		<li><a role = "button" href = "?module=collection"><span class="icon-plus"></span> New Collection </a></li>
	            		<li><a role = "button" href = "?module=cashticket"><span class="icon-ticket"></span> Cash Ticket </a></li>
	            		<li><a role = "button" href = "?module=collection&action=daily"><span class="icon-file-text2"></span> Daily Collection </a></li>
	            		<li><a role = "button" href = "?module=collection&action=edit"><span class = "icon-quill"></span> Edit O.R. </a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-drawer"></span> Store Management <b class="caret"></b></a>
            		<ul class="dropdown-menu" role="menu">
                		<li><a role = "button" href = "?module=newstore"><span class="icon-plus"></span> New Store Application </a></li>
                		<li><a role = "button" href = "?module=storelist"><span class="icon-list"></span> Store List </a></li>
            			<li><a role = "button" href = "?module=issuance"><span class="icon-folder-plus"></span> OR Issuance </a></li>
            		
            			<!--<li><a role = "button" href = "?module=newowner"> Add New Owner </a></li>-->					
            		</ul>
            	</li>
            	<li class="dropdown">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-folder"></span> Reports <b class="caret"></b></a>
            		<ul class="dropdown-menu" role="menu">
                		<li><a role = "button" href = "?module=report"><span class="icon-file-text"></span> Cash Collection Report </a></li>
                		<li><a role = "button" href = "?module=reppaymentmo"><span class="icon-file-text"></span> Client Payment Report </a></li>
                		<li><a role = "button" href = "?module=reppayment"><span class="icon-file-text"></span> Client Payment Detailed Report </a></li>
                		<li><a role = "button" href = "?module=graph"><span class="icon-stats-bars"></span> Cash Collection Graph </a></li>
                	</ul>
            	</li>
            	<?php if($_SESSION['level']=="Administrator"){ ?>
				<li class="dropdown">
	            	<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="icon-cogs"></span> System Management <b class="caret"></b></a>
	            	<ul class="dropdown-menu" role="menu">
	            		<li><a role = "button" href = "?module=resettings"> <span class="icon-cog"></span> Report Settings </a></li>
						<li><a role = "button" href = "?module=newuser"> <span class = "icon-user-plus"></span> Add New User </a></li>
						<li><a role = "button" href = "?module=userlist"> <span class = "icon-users"></span> User List </a></li>
	            	</ul>
	            </li> 	<?php } ?></ul>
        	<ul class="nav navbar-nav navbar-right">
        		<li class="dropdown">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-user"></span> <?php echo $_SESSION['name']; ?> <b class="caret"></b></a>
            		<ul class="dropdown-menu" role="menu">
            			
						<li><a role = "button" href = "?module=changepass"><span class="icon-eye"></span> Change Password </a></li>
                		<li><a style = "color: red;" role = "button" href = "?module=logout"><span class="icon-switch"></span> Log Out </a></li>
						<!--<li><a role = "button" href = "?module=newowner"> Add New Owner </a></li>-->					
            		</ul>
            	</li> 
        	</ul>
        </div>
      </div>
    </nav>
    <!-- Page Content -->
    <div class = "container-fluid" style="margin-top: 60px; display: hidden;">
      <?php
      	include 'ajax/func.php';
      	if(!isset($_GET['module'])){
          include 'modules/main.php';
      	}elseif(!file_exists('modules/'.$_GET['module'].'.php')){
      		include 'config/404.php';
      	}else{
      		include 'modules/'.$_GET['module'].'.php';
      	}	
     }elseif((isset($_GET['module']) && $_GET['module'] == 'login' && !isset($_SESSION['acc_id'])) || (!isset($_SESSION['acc_id']))){
      ?>
<style type="text/css">
	.table {border-bottom:0px !important;}
	.table th, .table td {border: 0px !important;}
</style>
		<form role = "form" action = "" method = "post">	
			<table align = "center" class = "table form-horizontal" style = "margin-top: 0px; width: 800px;" >
				<thead>
					<tr style = "border: none;">
						<td colspan = 2 align = center><h3><i><span class="icon-lock"></span><i class="fa fa-desktop"></i> Login Form</i></h3></td> 
					</tr>
				</thead>
				<tr>
					<td><label for = "uname"><span class="icon-user"></span>  Username: </label><input <?php if(isset($_POST['uname'])){ echo 'value ="' . $_POST['uname'] . '"'; }else{ echo 'autofocus ';}?>placeholder = "Enter Username" id = "uname" title = "Input your username." type = "text" class = "form-control input-sm" required name = "uname"/></td>
				
					<td><label for = "pword"><span class="icon-eye"></span>  Password: </label><input <?php if(isset($_POST['uname'])){ echo 'autofocus '; }?> placeholder = "Enter Password" id = "pword" title = "Input your password." type = "password" class = "form-control  input-sm" required name = "password"/></td>
				</tr>
				<tr >
					<td colspan = 4 align = "center" ><button style = "width: 150px; margin: auto;" type="submit" name = "submit" class="btn btn-success btn-block btn-sm"><span class="icon-switch"></span> Login</button></td>
				</tr>
			</table>
		</form>
<?php
	if(isset($_SESSION['logout']) && $_SESSION['logout'] != null){
		echo  '<div class="alert alert-warning" align = "center">						
			<strong>You\'ve been logged out.</strong>
			</div>';
		$_SESSION['logout'] = null;
	}
?>
<?php
	if(isset($_POST['submit'])){
		$uname = mysqli_real_escape_string($conn, $_POST['uname']);
		$password =  mysqli_real_escape_string($conn, $_POST['password']);
		
		$sql = "SELECT * FROM `user` where uname = '$uname' and pword = '$password'";
		$result = $conn->query($sql);		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){								
				$_SESSION['acc_id'] = $row['account_id'];
				$_SESSION['name']=$row['fname']." ".$row['lname'];
				$_SESSION['level']=$row['level'];
			  	echo  '<div class="alert alert-success" align = "center">						
						<strong>Logging in ~!</strong>
						</div>';
			  	echo '<script type="text/javascript">setTimeout(function() {window.location.href = "/cmarket"},1000);; </script>';	
			}				
		}else{
	echo  '<div class="alert alert-warning" align = "center">						
				<strong>Warning!</strong> Incorrect Login.
			</div>';
			}
		$conn->close();
	}
}
include('config/footer.php');
?>