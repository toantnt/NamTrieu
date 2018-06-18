<style>
.woocommerce-breadcrumb { text-align: center; }
.woocommerce-ordering { padding: 15px 0; float: right; margin: 0 4%; }
.woocommerce-result-count { padding: 15px 0; display: block; float: left; margin: 0 4%; }
.item-collect img { width: 100%; height: auto; }
.woocommerce-loop-product__title {
	font-family: "Helvetica";
	font-weight: 400;
	margin: 5px 0 15px 0;
	font-size: 18px;
}
.item-collect { margin-bottom: 35px; }
</style>
<?php 
if($GLOBALS['lang_code'] == 'vi') {
	$this->lang->load('vi', 'vietnamese');
} else {
	$this->lang->load('en', 'english');
}
$this->load->helper('home/home'); ?>
<section class="main" style="background: #fcfaf3;">
	<div class="container woo-list">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<div class="shop-product">
					<?php foreach($list as $item) { ?>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->pro_slug.'-s'.$item->pro_id) ?>" title="<?php echo $item->pro_name ?>">
								<img src="<?php echo $item->pro_image ?>" alt="<?php echo $item->pro_name ?>" />
							</a>
		
							<h3 class="item-title">
								<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->pro_slug.'-s'.$item->pro_id) ?>" title="<?php echo $item->pro_name ?>"><?php echo $item->pro_name ?></a>
							</h3>
							<div class="item-desc"><?php echo mb_substr(strip_tags($item->pro_summary), 0, 50); ?>..</div>
		
							<p style="margin-top:5px;font-size: 13px; float: left; width: 100%;">
								<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$item->pro_slug.'-s'.$item->pro_id) ?>" title="<?php echo $this->lang->line('more_detail') ?>">
									<?php echo $this->lang->line('more_detail') ?>
								</a>
							</p>
						</div>
					</div>
					<?php } ?>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">
								<img src="/public/uploads/images/product/lp-ao-lech-vai-cut-out-do-01.jpg" alt="Shirt red">
							</a>
		
							<h3 class="item-title">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">Shirt red</a>
							</h3>
							<div class="item-desc">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
								labore et dolore magna aliqua.
							</div>
		
							<p style="margin-top:5px;font-size: 13px; float: left; width: 100%;">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="More detail">
									More detail								
								</a>
							</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">
								<img src="/public/uploads/images/product/lp-ao-lech-vai-cut-out-do-01.jpg" alt="Shirt red">
							</a>
		
							<h3 class="item-title">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">Shirt red</a>
							</h3>
							<div class="item-desc">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
								labore et dolore magna aliqua.
							</div>
		
							<p style="margin-top:5px;font-size: 13px; float: left; width: 100%;">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="More detail">
									More detail								
								</a>
							</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">
								<img src="/public/uploads/images/product/lp-ao-lech-vai-cut-out-do-01.jpg" alt="Shirt red">
							</a>
		
							<h3 class="item-title">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">Shirt red</a>
							</h3>
							<div class="item-desc">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
								labore et dolore magna aliqua.
							</div>
		
							<p style="margin-top:5px;font-size: 13px; float: left; width: 100%;">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="More detail">
									More detail								
								</a>
							</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">
								<img src="/public/uploads/images/product/lp-ao-lech-vai-cut-out-do-01.jpg" alt="Shirt red">
							</a>
		
							<h3 class="item-title">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">Shirt red</a>
							</h3>
							<div class="item-desc">Thiết kế cut out vạt và tay phối dây da trên vai, tay phối dây da trên vai..</div>
		
							<p style="margin-top:5px;font-size: 13px; float: left; width: 100%;">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="More detail">
									More detail								
								</a>
							</p>
						</div>
					</div>
					
					<div class="row" style="float:left;">
						<div class="col-sm-12">
							<?php echo $paginator; ?>
						</div>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
</section>

