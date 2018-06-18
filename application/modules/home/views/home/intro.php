<?php 
if($GLOBALS['lang_code'] == 'vi') {
	$this->lang->load('vi', 'vietnamese');
} else {
	$this->lang->load('en', 'english');
} ?>
<style type="text/css" media="screen">
	.aboutus h2 { font-size: 14px; margin: 0 0 30px 0; text-transform: uppercase; font-family: "Helvetica"; font-weight: bold; }
</style>
<section class="main">
	<div class="aboutus">
		<div class="container-fluid">
			
			<div class="row">
				<?php $gallery = explode(",", $about->post_gallery); 
					unset($gallery[count($gallery)-1]);
				?>
				<div class="gallery-img">
					<?php 
					$i = 1;
					foreach($gallery as $item) { ?>
					<div class="<?php echo ($i == 1 ?  'col-md-6 col-lg-6 col-sm-6 col-xs-12' : 'col-md-3 col-lg-3 col-sm-6 col-xs-12') ?>">
						<img src="<?php echo $item ?>" alt="<?php $about->post_name ?>" />
					</div>
					<?php $i++; ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<h2><?php echo $about->post_name ?></h2>
				</div>
				<div class="about-content">
					<?php $content_str = explode(" ", strip_tags($about->post_detail)); //var_dump($content_str);
					$total_str = count($content_str); $dem = 0; ?>
					<div class="col-md-6 col-lg-6 col-xs-12">
						<?php for($i = 0; $i < ($total_str * (2/3)); $i++) { 
							echo $content_str[$i]." ";
							$dem++;
						} ?>
					</div>
					<div class="col-md-6 col-lg-6 col-xs-12">
						<?php for($i = 0; $i < $total_str; $i++) { 
							echo $content_str[$dem]." ";
							$dem++;
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php unset($dem); ?>

	<div class="our-team">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><?php echo $ourTeam->c_name ?></h2>
				</div>
				<div class="col-md-9 col-lg-9 col-xs-12">
					<div class="row">
						<div class="team-person">
							<?php 
							//var_dump($personal);
							foreach($personal as $team) { 
							?>

							<div class="col-md-3 col-lg-3 col-xs-12">
								<span><a href="<?php echo site_url($GLOBALS['lang_code'].'/team/'.$team->post_slug) ?>#personal<?php echo $team->post_id ?>" title="<?php echo $team->post_name ?>">
									<img src="<?php echo $team->post_image ?>" alt="<?php echo $team->post_name ?>" />
									</a>
								</span>
								<h3>
									<a href="<?php echo site_url($GLOBALS['lang_code'].'/team/'.$team->post_slug) ?>#personal<?php echo $team->post_id ?>" title="<?php echo $team->post_name ?>">
										<?php echo $team->post_name ?>
									</a>
								</h3>
								<div class="personal"><?php echo $team->post_summary ?></div>
								<div class="intro-person">
									<?php echo mb_substr(strip_tags($team->post_detail), 0, 40); ?>..
								</div>
								<p style="font-size: 13px; margin-top: 8pt;"><a style="color:#333;" href="<?php echo site_url($GLOBALS['lang_code'].'/team/'.$team->post_slug) ?>#personal<?php echo $team->post_id ?>" title="<?php echo $this->lang->line('more_detail') ?>"><?php echo $this->lang->line('more_detail') ?></a></p>
							</div>
							<?php }
							?>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 hidden-xs hidden-sm"></div>
			</div>
		</div>
	</div>
</section>