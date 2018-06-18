<?php 
if($GLOBALS['lang_code'] == 'vi') {
	$this->lang->load('vi', 'vietnamese');
} else {
	$this->lang->load('en', 'english');
} ?>
<section class="main">
	<div class="aboutus">
		<div class="container">
			<div class="row">
			<?php 
			$index = 1;
			foreach($posts as $item) { 
				$gallery = explode(",", $item->post_gallery);
				unset($gallery[count($gallery)-1]);
				if(!empty($gallery)) { 
			?>
				<div class="item-post-gallery">
					<div class="gallery-text">
						<p><?php echo $item->post_created; ?></p>
						<h2><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><?php echo $item->post_name ?></a></h2>
						<div class="item-post-desc">
							<?php echo mb_substr(strip_tags($item->post_summary), 0, 200) ?>..
						</div>
						<p class="more-link"><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $this->lang->line('read_more_post') ?>"><?php echo $this->lang->line('read_more_post') ?></a></p>
					</div>
				</div>
				<div class="row-gallery">
					<span class="col-md-4">
						<img src="<?php echo $item->post_image ?>" alt="<?php $item->post_name ?>" style="width: 100%; height: auto; float: left;" />
					</span>
					<?php foreach($gallery as $img) { ?>
						<span class="col-md-4">
							<img src="<?php echo $img ?>" alt="<?php $item->post_name ?>" style="width: 100%; height: auto; float: left;" />
						</span>
					<?php } ?>
				</div>
			<?php
				} else { ?>
				<?php 
				if($index <= 5):
					if($index % 2 != 0): ?>
					<div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 pull-left">
						<div class="item-post">
							<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><img src="<?php echo $item->post_image ?>" alt="<?php echo $item->post_name ?>"/></a>
							<p class="date"><?php echo $item->post_created ?></p>
							<h2><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><?php echo $item->post_name ?></a></h2>
							<div class="item-post-desc">
								<?php echo mb_substr(strip_tags($item->post_summary), 0, 200) ?>..
							</div>
							<p class="more-link"><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $this->lang->line('read_more_post') ?>"><?php echo $this->lang->line('read_more_post') ?></a></p>
							<hr>
						</div>
					</div>
					<?php else: ?>
					<div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 pull-right">
						<div class="item-post">
							<?php if($index == 4) { ?>
							<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><img src="<?php echo $item->post_image ?>" alt="<?php echo $item->post_name ?>"/></a>
							<p class="date"><?php echo $item->post_created ?></p>
							<h2><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><?php echo $item->post_name ?></a></h2>
							<div class="item-post-desc">
								<?php echo mb_substr(strip_tags($item->post_summary), 0, 200) ?>..
							</div>
							<p class="more-link"><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $this->lang->line('read_more_post') ?>"><?php echo $this->lang->line('read_more_post') ?></a></p>
							<hr>
							<?php } else { ?>
							<p><?php echo $item->post_created ?></p>
							<h2><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><?php echo $item->post_name ?></a></h2>
							<div class="item-post-desc">
								<?php echo mb_substr(strip_tags($item->post_summary), 0, 200) ?>..
							</div>
							<p class="more-link"><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $this->lang->line('read_more_post') ?>"><?php echo $this->lang->line('read_more_post') ?></a></p>
							<hr>
							<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><img src="<?php echo $item->post_image ?>" alt="<?php echo $item->post_name ?>"/></a>
							<?php } ?>
						</div>
					</div>
					<?php endif; ?>
				<?php else: 
					if($index % 2 == 0) { ?>
					<div class="item-full" style="margin-top: 25px;">
						<div class="item-post">
							<div class="col-md-5 col-lg-5 col-sm-5">
								<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><img src="<?php echo $item->post_image ?>" alt="<?php echo $item->post_name ?>"/></a>
							</div>
							<div class="col-md-7 col-lg-7 col-sm-7">
								<p class="date"><?php echo $item->post_created ?></p>
								<h2><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><?php echo $item->post_name ?></a></h2>
								<div class="item-post-desc">
									<?php echo mb_substr(strip_tags($item->post_summary), 0, 200) ?>..
								</div>
								<p class="more-link"><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $this->lang->line('read_more_post') ?>"><?php echo $this->lang->line('read_more_post') ?></a></p>
								<hr />
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="item-full" style="margin-top: 25px;">
						<div class="item-post">
							<div class="col-md-5 col-lg-5 col-sm-5">
								<p class="date"><?php echo $item->post_created ?></p>
								<h2><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><?php echo $item->post_name ?></a></h2>
								<div class="item-post-desc">
									<?php echo mb_substr(strip_tags($item->post_summary), 0, 200) ?>..
								</div>
								<p class="more-link"><a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $this->lang->line('read_more_post') ?>"><?php echo $this->lang->line('read_more_post') ?></a></p>
								<hr>
							</div>
							<div class="col-md-7 col-lg-7 col-sm-7">
								<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->post_slug.'-a'.$item->post_id) ?>" title="<?php echo $item->post_name ?>"><img src="<?php echo $item->post_image ?>" alt="<?php echo $item->post_name ?>"/></a>
							</div>
						</div>
					</div>
				<?php }
				endif; ?>
			<?php 
				}
				$index++;
				if($index > 7) $index = 1;
			}
			?>
			</div>
		</div>
	</div>
</section>