<section class="main" style="background:#FBFAF2;">
	<div class="detail-post">
		<div class="container">
			<?php foreach($list as $item) { ?>
			<div class="personal-single" id="personal<?php echo $item->post_id ?>">
				<div class="row">
					<div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
						<span><img src="<?php echo $item->post_image ?>" alt="<?php echo $item->post_name ?>" /></span>
					</div>
					<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
						<div class="personal-content">
							<h2><?php echo $item->post_name ?></h2>
							<div class="position"><?php echo $item->post_summary ?></div>
							<?php echo $item->post_detail ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>