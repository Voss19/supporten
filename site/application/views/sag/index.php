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
			<h3>
				<?php echo $case->c_title; ?>
			</h3>
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