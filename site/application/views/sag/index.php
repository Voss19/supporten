<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-sm-2">
			<div style="width: 100%; overflow: hidden; max-height: 400px; padding-top: 20px;">
				<img style="width: 100%; height: auto;" src="<?php echo base_url('assets/images/profilepictures/'.$owner->u_pic); ?>">
				<hr>
				<a href="<?php echo base_url('bruger/profil/'.$owner->u_id); ?>" style="font-weight: 500; color: <?php echo $owner->u_color; ?>;">
					<?php echo $owner->u_first_name." ".$owner->u_last_name; ?>
				</a>
			</div>
		</div>
		<div class="col-sm-10">
			<div class="row">
				<div class="col-sm-9">
					<h3>
						<?php 

						echo $case->c_title;

						if (isset($is_solved)) {
							echo "<p style='float: right; font-size: 20px; color: #00cc00 !important;'>Løst</p>";
						}

						?>
					</h3>
					<?php if (isset($is_owner)) {
						if (!isset($is_solved)) {
							
							echo "

								<form method='post'>
									<button name='solved' type='submit' value='le' class='btn btn-default btn-success'>L&oslash;st</button>
								</form>

							";} else {
									echo "

										<form method='post'>
											<button name='nsolved' type='submit' value='le' class='btn btn-default btn-danger'>L&oslash;st</button>
										</form>

							";
							}
						} ?>
				</div>
				<div class="col-sm-3">
					<div class="col-sm-9">
						<p style="padding-top: 20px; float: right;">Antal votes:
							<?php echo $votes; ?>
						</p>
					</div>
					<?php 

					if ($this->loader->user) {
						if (!isset($voted)) {
							?>
					<div class="col-sm-3">
						<form method="post" style="padding-top: 12px;">
							<button value="lel" name="vote" type="submit" class="btn btn-default">&#9650;</button>
						</form>
					</div>
					<?php
						} else {
							?>
						<div class="col-sm-3">
							<form method="post" style="padding-top: 12px;">
								<button value="lel" name="rvote" type="submit" class="btn btn-default btn-primary">&#9650;</button>
							</form>
						</div>
						<?php
						}
					}


				 ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<hr>
					<p>
						<?php echo $case->c_content; ?>
					</p>
					<?php if ($case->c_image) { ?>
					<img style="max-height: 300px;" src="<?php echo base_url('assets/images/cases/'.$case->c_image); ?>">
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if ($this->loader->user) { ?>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-sm-2">
			<div style="width: 100%; overflow: hidden; max-height: 400px;">
				<img style="width: 100%; height: auto;" src="<?php echo base_url('assets/images/profilepictures/'.$this->loader->user->u_pic); ?>">
				<hr>
				<a href="<?php echo base_url('bruger/profil/'.$this->loader->user->u_id); ?>" style="font-weight: 500; color: <?php echo $this->loader->user->u_color; ?>;">
					<?php echo $this->loader->user->u_first_name." ".$this->loader->user->u_last_name; ?>
				</a>
			</div>
		</div>
		<div class="col-sm-10">
			<h3 style="margin-top: 0;">Kommenter</h3>
			<form method="post">
				<div class="form-group">
					<textarea name="content" rows="6" class="form-control"></textarea>
				</div>
				<button name="comment" type="submit" class="btn btn-default btn-primary" value="lel">Kommenter</button>
			</form>
		</div>
	</div>
</div>
<?php } else { ?>
<div class="panel panel-default">
	<div class="panel-body">
		<a href="<?php echo base_url('bruger/login'); ?>">Login for at kommentere</a>
	</div>
</div>
<?php } if (isset($comments)) { ?>
<?php foreach ($comments as $comment) { ?>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-sm-2">
			<div style="width: 100%; overflow: hidden; max-height: 400px;">
				<img style="width: 100%; height: auto;" src="<?php echo base_url('assets/images/profilepictures/'.$comment['user']->u_pic); ?>">
			</div>
		</div>
		<div class="col-sm-10">
			<a href="<?php echo base_url('bruger/profil/'.$comment['user']->u_id); ?>" style="font-weight: 500; color: <?php echo $comment['user']->u_color; ?>;">
				<?php echo $comment['user']->u_first_name." ".$comment['user']->u_last_name; ?>
			</a>
			<hr>
			<p>
				<?php echo $comment['com_content']; ?>
			</p>
		</div>
	</div>
</div>
<?php } ?>
<?php } else { ?>
<div class="panel panel-default">
	<div class="panel-body">
		<p>
			Der er ikke nogen kommentarer
		</p>
	</div>
</div>
<?php } ?>