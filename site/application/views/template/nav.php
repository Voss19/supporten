<nav class="navbar navbar-inverse">
	<div class="container">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand logo" href="<?php echo base_url(); ?>">SUP-PORT.EN</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_url(); ?>">Forside</a></li>
				<li><a href="<?php echo base_url('sag/opret'); ?>">Opret sag</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<?php if ($this->loader->user) { ?>
					<a href="<?php echo base_url('bruger'); ?>"><span class="glyphicon glyphicon-user"></span> 
					<?php echo $this->loader->user->u_first_name; ?>
				</a>
					<?php } else { ?>
					<a href="<?php echo base_url('bruger/login'); ?>"><span class="glyphicon glyphicon-user"></span> 
					Bruger
				</a>
					<?php } ?>
				</li>
				<li>
					<form class="navbar-form navbar-left" method="post">
						<div class="input-group">
							<input type="text" name="sb" class="form-control" placeholder="S&oslash;g">
							<div class="input-group-btn">
								<button class="btn btn-default" value="lel" type="submit" name="search">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">