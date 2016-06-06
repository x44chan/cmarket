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