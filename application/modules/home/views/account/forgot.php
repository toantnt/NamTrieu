<style>
	.login, .register { width: 100%; } .checkbox label, .radio label { padding-left: 0; }
	.form-control { box-shadow: none; }
	.checkout .btn { margin-top: 0; }
	h2 { font-size: 13px; font-weight: 500; text-transform: uppercase; text-align: center; }
	.input-text { width: 85%; }
	.continue { margin-bottom: 30px; width: 100%; }
</style>

<section class="main" style="background: #fcfaf3;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h2><?php echo $subtitle ?></h2>
			</div>
		</div>
	</div>
	<hr>
	<div class="container-fluid checkout">
		<div class="row">
			<?php //var_dump($member); ?>
			<div id="customer_login">
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<form class="form-horizontal" method="post" id="forgot-form" action="<?php echo site_url('home/account/reset_password') ?>">
					
						<div class="form-group">
							<label for="username" class="control-label col-lg-4"><?php echo $this->lang->line('email') ?></label>
							<div class="col-lg-6">
								<input type="text" class="form-control" name="member_email" required="required" />
								<br />
								<input type="submit" class="btn btn-default button" name="continue" value="<?php echo $this->lang->line('continue') ?>">
							</div>
							
						</div>
						
						
					</form>
					
				</div>
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
			</div>
			
		</div>
	</div>
	
<script>
	jQuery(document).ready(function($) {
		
	});
	populateCountries("your_country");
</script>
</section>