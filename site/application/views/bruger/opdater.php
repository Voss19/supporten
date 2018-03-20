<div class="panel panel-default">
	<div class="panel-body">
		<div id="filetest" style="border: 1px solid #000; width: 200px; height: 200px;"></div>
		<div class="col-sm-8 col-sm-offset-2">
			<form class="form-horizontal" class="file" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Profilbillede:</label>
					<div class="col-sm-8">
						<input multiple type="file" class="form-control" name="img">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Fornavn:</label>
					<div class="col-sm-8">
						<input value="<?php echo $this->loader->user->u_first_name; ?>" type="text" class="form-control" name="fname">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Efternavn:</label>
					<div class="col-sm-8">
						<input value="<?php echo $this->loader->user->u_last_name; ?>" type="text" class="form-control" name="lname">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Email:</label>
					<div class="col-sm-8">
						<input value="<?php echo $this->loader->user->u_email; ?>" type="email" class="form-control" name="email">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="password">Ny adgangskode:</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="password">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="rpassword">Gentag adgangskode:</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="rpassword">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-8">
						<button value="1" name="opret" type="submit" class="btn btn-default">Opdater</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>