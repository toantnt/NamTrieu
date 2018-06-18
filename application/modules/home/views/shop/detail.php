<meta name="keywords" content="<?php echo $product->pro_keywords ?>" />
<meta name="description" content="<?php echo $product->pro_description ?>" /> 
<style> .after-add-cart { font-family: "HelveticaLight"; margin-top: 20px; font-size: 13px; } </style>
<?php 
if($GLOBALS['lang_code'] == 'vi') {
	$this->lang->load('vi', 'vietnamese');
} else {
	$this->lang->load('en', 'english');
}
$this->load->helper('home/home') ?>
<section class="main detail-product">
	<div id="product-<?php echo $product->pro_id ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
				<div class="col-lg-1">
					<div class="gallery fancybox hidden-sm hidden-xs">
						<?php 
						$gallery = explode(",", $product->pro_gallery);
						unset($gallery[count($gallery)-1]);
						$html = '';
						for($i = 0; $i < count($gallery); $i++) {
							$html .= '<a class="img-thumbnails" href="javascript:;" rel="product-gallery" img-url="' . $gallery[$i] . '" />';
							$html .= '<img src="'.$gallery[$i].'" alt="'.$product->pro_name.'" />';
					 		$html .= '</a>';
						}
						echo $html;
						?>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="detail-image hidden-sm hidden-xs">
						<img src="<?php echo $product->pro_image ?>" class="detail-img-product" alt="<?php echo $product->pro_name ?>" />
					</div>
					
					<div class="hidden-lg hidden-md owl-products">
						<div class="item">
							<img src="<?php echo $product->pro_image ?>" alt="<?php echo $product->pro_name ?>" />
						</div> 
						<?php for($i = 0; $i < count($gallery); $i++) { ?>
						<div class="item">
							<img src="<?php echo $gallery[$i] ?>" alt="<?php echo $product->pro_name ?>" />
						</div>
						<?php } ?>
					</div>
				</div>

				<div class="col-lg-5">
					<nav class="woocommerce-breadcrumb" style="margin-bottom: 70px;">
						<a href="<?php echo site_url() ?>" title="<?php echo $this->lang->line('home') ?>"><?php echo $this->lang->line('home') ?></a> . 
						<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.($GLOBALS['lang_code'] == 'vi' ? 'san-pham' : 'shop')) ?>"><?php echo $this->lang->line('shop') ?></a> . 
						<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.($GLOBALS['lang_code'] == 'en' ? 'collection/' : 'bo-suu-tap/').$collection->cat_slug) ?>">Fall Winter 2017</a> . 
						<?php echo $product->pro_name ?>
					</nav>
					<div class="content-collection">
						<div class="description">
							<h1 class="product_title entry-title"><?php echo $product->pro_name ?></h1> 
							<?php echo $product->pro_summary; ?>
						</div>
						<?php 
							$mainPrice = ($product->pro_discount > 0 ? $product->pro_discount : $product->pro_price);
						?>
						<h3><?php echo number_format($mainPrice, 0, ',', '.') ?> VNĐ</h3>
						<div class="product-attr">
							<?php 
							$arrTemp = NULL;
                            $arrAttrValues = getOptions($product->pro_id);
                            foreach($arrAttrValues as $tmp) {
                                $arrTemp[] = $tmp->attrID;
                            }
                            $index = 0;
							foreach($proOptions as $attr) { 
                                $result = getAttribute($attr->groupID);
                                $group  = group_attribute($attr->groupID);
							?>
							<div class="attr-item">
								<strong style="margin-right:15px;"><?php echo $group->name; ?></strong>
								<?php foreach($result as $item) { 
	                                //$valueId = getAttrValue($attr->groupID);
	                                if(in_array($item->ID, $arrTemp)) { ?>
	                                <?php if($group->slug == 'color') { ?>
	                            	<span color-attribute-id="<?php echo $item->ID ?>" class="color-product detail-color" style="cursor:pointer; background: <?php echo $item->value ?>; margin-right: 10px;"></span>
	                            <?php } else { ?>
	                            	<span size-attribute-id="<?php echo $item->ID ?>" class="detail-size" style="margin: 0 10px;cursor:pointer;"><?php echo $item->name ?></span>
	                            <?php }
		                            }
		                        } ?>
							</div>
							
							<?php } ?>
							
							<p class="chosenAttr hidden"></p><p class="chooseAttr2 hidden"></p>
						</div>
						<div class="add-cart">
							<div class="cart">
								<input type="number" class="qty" min="1" name="quantity" id="quantity" value="1" />
								<button type="button" data-id="<?php echo $product->pro_id ?>" class="single_add_to_cart_button btn btn-default"><?php echo $this->lang->line('add_to_cart') ?></button>
							</div>
							<p class="hidden after-add-cart">"<?php echo $product->pro_name ?>" 
								<?php echo $this->lang->line('add_cart_success') ?> <a href="<?php echo site_url(($GLOBALS['lang_code'] == 'en' ? $GLOBALS['lang_code'].'/cart' : $GLOBALS['lang_code'].'/gio-hang')) ?>"><?php echo $this->lang->line('title_cart') ?></a>
							</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid related-like" style="background: #fcfaf3;">
		<section class="related products">
			<div class="container">
				<?php //var_dump($related); ?>
				<h3><?php echo $this->lang->line('related') ?></h3>
				<div class="row">
					<?php foreach ($related as $relate) { ?>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="item-collect">
								<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$relate->pro_slug.'-s'.$relate->pro_id) ?>" title="<?php echo $relate->pro_name ?>">
									<img src="<?php echo $relate->pro_image ?>" alt="<?php echo $relate->pro_name ?>" />
								</a>
	
								<h3 class="item-title">
									<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$relate->pro_slug.'-s'.$relate->pro_id) ?>" title="<?php echo $relate->pro_name ?>"><?php echo $relate->pro_name ?></a>
								</h3>
								<div class="item-desc"><?php echo mb_substr(strip_tags($relate->pro_summary), 0, 55); ?>..</div>
								<p style="margin-top:5pt; font-size: 13px;">
									<a href="<?php echo site_url($GLOBALS['lang_code'].'/'.$relate->pro_slug.'-s'.$relate->pro_id) ?>" title="<?php echo $this->lang->line('more_detail') ?>"><?php echo $this->lang->line('more_detail') ?></a>
								</p>	
							</div>
						</div>
					<?php } ?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">
								<img src="/public/uploads/images/product/lp-ao-lech-vai-cut-out-do-01.jpg" alt="Shirt red">
							</a>
		
							<h3 class="item-title">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">Shirt red</a>
							</h3>
							<div class="item-desc">Thiết kế cut out vạt và tay phối dây da trên vai..</div>
		
							<p style="margin-top:5pt; font-size: 13px;">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="More detail">
									More detail								
								</a>
							</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">
								<img src="/public/uploads/images/product/lp-ao-lech-vai-cut-out-do-01.jpg" alt="Shirt red">
							</a>
		
							<h3 class="item-title">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">Shirt red</a>
							</h3>
							<div class="item-desc">Thiết kế cut out vạt và tay phối dây da trên vai..</div>
		
							<p style="margin-top:5pt; font-size: 13px;">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="More detail">
									More detail								
								</a>
							</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">
								<img src="/public/uploads/images/product/lp-ao-lech-vai-cut-out-do-01.jpg" alt="Shirt red">
							</a>
		
							<h3 class="item-title">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">Shirt red</a>
							</h3>
							<div class="item-desc">Thiết kế cut out vạt và tay phối dây da trên vai..</div>
		
							<p style="margin-top:5pt; font-size: 13px;">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="More detail">
									More detail								
								</a>
							</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="item-collect">
							<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">
								<img src="/public/uploads/images/product/lp-ao-lech-vai-cut-out-do-01.jpg" alt="Shirt red">
							</a>
		
							<h3 class="item-title">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="Shirt red">Shirt red</a>
							</h3>
							<div class="item-desc">Thiết kế cut out vạt và tay phối dây da trên vai..</div>
		
							<p style="margin-top:5pt; font-size: 13px;">
								<a href="http://lapham.com.vn/en/shirt-red-s5" title="More detail">
									More detail								
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</section>

