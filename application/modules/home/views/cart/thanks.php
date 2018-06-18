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
					
					<div class="row">
						<div class="link-button">
							<a href="<?php echo site_url($GLOBALS['lang_code'].'/account') ?>" class="button btn btn-default"><?php echo $this->lang->line('my_account') ?></a>
							<a href="<?php echo site_url($GLOBALS['lang_code'].'/shop') ?>" class="button btn btn-default"><?php echo $this->lang->line('continue_shop') ?></a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
			</div>
			
		</div>
	</div>
	
</section>