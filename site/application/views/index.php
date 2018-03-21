<div class="col-md-4">
	<h2>Top supportere</h2>
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Navn</th>
						<th>Points</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($top_users as $key => $value) { ?>
					<tr>
						<td><?php echo $key + 1; ?></td>
						<td><a style="color: <?php echo $value['u_color']; ?>;" href="<?php echo base_url('bruger/profil/'.$value['u_id']); ?>"><?php echo $value['u_first_name']; ?></a></td>
						<td><?php echo $value['points']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-md-4">
	<h2>Top sager</h2>
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Titel</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td><a href="">Min computer vil ikke starte</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-md-4">
	<h2>Seneste sager</h2>
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Titel</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($latest_cases as $key => $value) { ?>
					<tr>
						<td><?php echo $key + 1; ?></td>
						<td><a href="<?php echo base_url('sag/'.$value['c_id']); ?>"><?php echo $value['c_title']; ?></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>