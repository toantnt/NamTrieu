<style>
.owl-theme .owl-controls {
    text-align: left !important;
    margin-left: 10%;
}
</style>
<meta name="keywords" content="<?php echo $detail->post_keywords ?>" />
<meta name="description" content="<?php echo $detail->post_description ?>" />
<section class="main">
	<div class="detail-post">
		<div class="container">
			<div class="row">
				<?php if($detail->post_image == NULL || $detail->post_image == "") { ?>
				<div class="col-md-9 col-lg-9 col-xs-12 col-sm-12">
					<div class="left-content">
						<p class="detail-date"><?php echo $detail->post_created ?></p>
						<h1><?php echo $detail->post_name ?></h1>
						<div class="detail-content">
							<?php echo $detail->post_detail ?>
						</div>
					</div>
				</div>
				<?php } else { ?>
				<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
					<div class="left-content">
						<p class="detail-date"><?php echo $detail->post_created ?></p>
						<h1><?php echo $detail->post_name ?></h1>
						<div class="detail-content">
							<?php echo $detail->post_detail ?>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
					<img src="<?php echo $detail->post_image ?>" alt="<?php echo $detail->post_name ?>" />
				</div>
				<?php } ?>
			</div>
		</div>

		<div class="container">
			<div class="related-post" style="min-height: 280px;">
				<div class="row">
					<div class="col-md-6">
						<hr style="margin-top:-50px; border-color: #333;" />
					</div>
				</div>
				<div class="row">
					<div class="owl-related-post">
						<?php foreach($news as $related):
						?>
						<div class="item">
							<div class="item-relate">
								<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$related->post_slug.'-a'.$related->post_id) ?>" title="<?php echo $related->post_name ?>">
									<img src="<?php echo $related->post_image ?>" alt="<?php echo $related->post_name ?>" />
								</a>
								<p><?php echo $related->post_created ?></p>
								<h3>
									<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$related->post_slug.'-a'.$related->post_id) ?>" title="<?php echo $related->post_name ?>"><?php echo $related->post_name ?></a>
								</h3>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>