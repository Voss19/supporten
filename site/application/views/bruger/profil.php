<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-sm-4">
			<div style="width: 100%; overflow: hidden; max-height: 400px;">
				<img style="width: 100%; height: auto;" src="<?php echo base_url('assets/images/profilepictures/'.$user->u_pic) ?>">
			</div>
			
		</div>
		<div class="col-sm-8">
			<h3 style="margin-top: 0; color: <?php echo $user->u_color; ?>;"><?php echo $user->u_first_name; ?></h3>
			<h4 style="color: <?php echo $user->u_color; ?>;"><?php echo $user->u_last_name; ?></h4>
			<p>Antal point: <?php echo $user->points; ?></p>
			<?php if (isset($latest_cases)) { ?>
			<p>Seneste sager</p>
			<table class="table table-striped" style="max-width: 400px;">
				<tbody>
					<?php foreach ($latest_cases as $key => $value) { ?>
					<tr>
						<td><a href="<?php echo base_url('sag/'.$value['c_id']); ?>"><?php echo $value['c_title']; ?></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
		</div>
	</div>
</div>