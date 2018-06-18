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
					<?php if($account->member_id == null) { ?>
					<form class="form-horizontal" method="post" id="login-form" action="<?php echo site_url('home/account/save') ?>">
					
						<div class="form-group">
							<label for="username" class="label-control col-lg-1"><?php echo $this->lang->line('username_or_email') ?></label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="member_email" value="<?php echo $member['member_email'] ?>" />
							</div>
							<label for="password" class="control-label col-lg-3"><?php echo $this->lang->line('password') ?></label>
							<div class="col-lg-4">
								<input class="form-control" type="password" name="member_password" id="password">
							</div>
						</div>
						<div class="row">
							<div class="col-lg-8">
								<a href="<?php echo site_url($GLOBALS['lang_code'].'/account') ?>" style="width:128px;" class="button btn btn-default"><?php echo $this->lang->line('back') ?></a>	
							</div>
							<div class="col-lg-4">
								<div class="button-auth" style="margin-top:6px;">		
									<input type="submit" class="btn btn-default button" name="continue" value="<?php echo $this->lang->line('continue') ?>">
								</div>
							</div>
						</div>
						
					</form>
					<?php } else { 
					?>
					<h3 class="text-center">Account <strong><?php echo ($account->member_nicename == null ? $account->member_email : $account->member_nicename) ?></strong> already exists. Please <strong><a href="<?php echo site_url($GLOBALS['lang_code'].'/account'); ?>">back</a></strong> to register again.</h3>
					<?php } ?>
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