<?php 
if($GLOBALS['lang_code'] == 'vi') {
	$this->lang->load('vi', 'vietnamese');
} else {
	$this->lang->load('en', 'english');
}
$gallery = explode(",", $collection->cat_gallery) ?>
<style>.btn { width: 84pt; } </style>

<div class="banner-p" style="background: url(<?php echo $collection->cat_image ?>) no-repeat; background-size: cover; background-position: center; min-height: 643px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12"></div>
		</div>
	</div>
</div>


<section class="main" style="background: #FCFAF3; padding-bottom: 30px;">
	<div class="container">
		<?php //foreach($listCategories as $item) { ?>
		<div class="col-lg-12">
			<h1 class="collection-title"><?php echo $collection->cat_name ?></h1>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 hidden-xs hidden-sm"></div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="owl-collection-products">
					<div class="item">
						<?php foreach($products as $product) { ?>
						<span>
							<a href="<?php echo 'javascript:;';//site_url($GLOBALS['lang_code'].'/'.$product->pro_slug.'-s'.$product->pro_id) ?>" title="<?php echo $product->pro_name ?>">
								<img src="<?php echo $product->image_cat ?>" alt="<?php echo $product->pro_name ?>" class="img-responsive" />
							</a>
						</span>
						<?php } ?>
					</div>
					<div class="item">
						<span>
							<a href="javascript:;" title="Shirt red">
								<img src="/public/uploads/images/detail-collection.png" alt="Shirt red" class="img-responsive">
							</a>
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="content-collection">
					<h2><?php echo $this->lang->line('collection') ?> . <a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$collection->cat_slug) ?>" title="<?php echo $collection->cat_name ?>"><?php echo $collection->cat_name ?></a></h2>
					
					<h3><?php echo $collection->cat_name ?></h3>
					<div class="description">
						<?php echo $collection->cat_summary ?>
					</div>
				</div>
			</div>
							
			
		</div>
	</div>
	<hr style="width: 100%; float: left;background: #FCFAF3; margin: 0;" />
	<div class="container">
		<div class="row">
			
			<?php //var_dump($others); exit(); ?>
			<div class="col-lg-12" style="background: #FCFAF3;">
				<div class="related-collect">
					<div id="owl-related">
						<?php foreach($others as $item) { 
						?>
						<div class="item">
							<div class="item-collect">
								<a href="<?php echo site_url($GLOBALS['lang_code'].'/collection/'.$item->cat_slug) ?>" title="<?php echo $item->cat_name ?>">
									
									<img src="<?php echo $item->cat_image ?>" alt="<?php echo $item->cat_name ?>" />
								</a>
								<h3 class="item-title">
									<a href="<?php echo site_url($GLOBALS['lang_code'].'/collection/'.$item->cat_slug) ?>" title="<?php echo $item->cat_name ?>"><?php echo $item->cat_name ?></a>
								</h3>
								<div class="item-desc">
									<?php echo mb_substr(strip_tags($item->cat_summary), 0, 50) ?>...
								</div>
								<p style="margin-top:8pt; font-size: 12pt;"><a href="<?php echo site_url($GLOBALS['lang_code'].'/collection/'.$item->cat_slug) ?>" title="<?php echo $this->lang->line('more_detail') ?>"><?php echo $this->lang->line('more_detail') ?></a></p>
							</div>
						</div>
						<?php 
						} ?>
						<div class="item">
							<div class="item-collect">
								<a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="Fall Winter 2017">
									
									<img src="/public/uploads/images/DSC_1273.jpg" alt="Fall Winter 2017">
								</a>
								<h3 class="item-title">
									<a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="Fall Winter 2017">Fall Winter 2017</a>
								</h3>
								<div class="item-desc">
									Collection Fall Winter 2017..
								</div>
								<p style="margin-top:8pt; font-size: 12pt;"><a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="More detail">More detail</a></p>
							</div>
						</div>
						<div class="item">
							<div class="item-collect">
								<a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="Fall Winter 2017">
									
									<img src="/public/uploads/images/DSC_1273.jpg" alt="Fall Winter 2017">
								</a>
								<h3 class="item-title">
									<a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="Fall Winter 2017">Fall Winter 2017</a>
								</h3>
								<div class="item-desc">
									Collection Fall Winter 2017..
								</div>
								<p style="margin-top:8pt; font-size: 12pt;"><a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="More detail">More detail</a></p>
							</div>
						</div>
						<div class="item">
							<div class="item-collect">
								<a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="Fall Winter 2017">
									
									<img src="/public/uploads/images/DSC_1273.jpg" alt="Fall Winter 2017">
								</a>
								<h3 class="item-title">
									<a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="Fall Winter 2017">Fall Winter 2017</a>
								</h3>
								<div class="item-desc">
									Collection Fall Winter 2017..
								</div>
								<p style="margin-top:8pt; font-size: 12pt;"><a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="More detail">More detail</a></p>
							</div>
						</div>
						<div class="item">
							<div class="item-collect">
								<a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="Fall Winter 2017">
									
									<img src="/public/uploads/images/DSC_1273.jpg" alt="Fall Winter 2017">
								</a>
								<h3 class="item-title">
									<a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="Fall Winter 2017">Fall Winter 2017</a>
								</h3>
								<div class="item-desc">
									Collection Fall Winter 2017..
								</div>
								<p style="margin-top:8pt; font-size: 12pt;"><a href="http://lapham.com.vn/en/collection/fall-winter-2017" title="More detail">More detail</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

