<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-sm-4">
			<div style="width: 100%; overflow: hidden; max-height: 400px;">
				<img style="width: 100%; height: auto;" src="<?php echo base_url('assets/images/profilepictures/'.$this->loader->user->u_pic) ?>">
			</div>
			
		</div>
		<div class="col-sm-8">
			<h3><?php echo $this->loader->user->u_first_name; ?></h3>
			<h4><?php echo $this->loader->user->u_last_name; ?></h4>
			<p><?php echo $this->loader->user->u_email; ?></p>
			<p>Antal point: <?php echo $this->loader->user->points; ?></p>
			<a class="btn btn-primary" href="<?php echo base_url('bruger/opdater') ?>">Opdater</a>
		</div>
	</div>
</div>