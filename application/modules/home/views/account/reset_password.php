<style>
	.form-control { box-shadow: none; }
	.checkout .btn { margin-top: 0; }
	h2 { font-size: 13px; font-weight: 500; text-transform: uppercase; text-align: center; }
	p { font-size: 13px; text-align: center; }
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
			<div id="thanks-register">
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php if(isset($account->member_id)) { ?>
					<div class="row">
						<h3 class="text-center">New password for <?php echo $account->member_nicename ?>: '123456'.</h3>
					</div>	
					<?php } else { ?> 
					<div class="row">
						<h3 class="text-center">Account not exists. Please register.</h3>
					</div>
					<?php } ?>
					<div class="row">
						<div class="link-button" style="margin-top: 30px;">
							<a href="<?php echo site_url($GLOBALS['lang_code'].'/account') ?>" class="button btn btn-default"><?php echo $this->lang->line('my_account') ?></a>
							<a href="<?php echo site_url($GLOBALS['lang_code']) ?>" class="button btn btn-default"><?php echo $this->lang->line('continue_shop') ?></a>
						</div>
					</div>
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