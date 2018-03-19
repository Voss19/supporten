<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-sm-4">
			<img src="<?php echo $img; ?>">
		</div>
		<div class="col-sm-8">
			<?php 
				echo "<pre>";
					print_r($user);
					echo "</pre>";
				echo $this->loader->user->u_id;
			 ?>
		</div>
	</div>
</div>