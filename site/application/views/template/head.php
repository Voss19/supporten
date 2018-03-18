<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<?php foreach ($css as $style) { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/'.$style.'.css'); ?>">
	<?php } ?>
	<title>
		<?php
			if (isset($title)) {
				echo $title;
			} else {
				echo "SUP-PORT.EN";
			}
		?>
	</title>
</head>
<body>
