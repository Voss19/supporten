<?php if (isset($search)) { 
	?>
<div class="panel panel-default">
	<div class="panel-body">
		<?php
	foreach ($search as $key => $value) {
	?>
			<a href="<?php echo base_url('sag/'.$value['c_id']); ?>">
				<h4><?php echo $value['c_title']; ?></h4>
			</a>
			<p>
				<?php echo substr($value['c_content'], 0, 330); ?>
			</p>
			<hr>
			<?php } ?>
	</div>
</div>
<?php } ?>