<?php 
//print_r($cart); 
$this->load->helper('home/home');
$url = ($GLOBALS['lang_code'] == 'vi' ? $GLOBALS['lang_code'].'/gio-hang' : $GLOBALS['lang_code'].'/cart');
?>
<ul class="list-mini">
<?php foreach ($cart as $value) { 
	$product = get_product($value['id'], $GLOBALS['lang_code']);
?>
	<li>
		<a class="thumb" href="<?php echo site_url($GLOBALS['lang_code'].'/'.$product->pro_slug.'-s'.$product->pro_id) ?>"><img src="<?php echo $value['img'] ?>" alt=""></a>
		<h3><?php echo $value['name'] ?></h3>
		<label class="lbl_price"><?php echo number_format($value['price'], 0, ',', '.') ?></label>
		<div class="col_width_2"><label class="lbl_price_bold lbl_price"> x <?php echo $value['qty'] ?> = <?php echo number_format($value['price']*$value['qty'], 0, ',', '.') ?> VNĐ</label></div>
		
	</li>
<?php } ?>
</ul>
<p>
	<strong><?php echo $this->lang->line('sub_total') ?>: <?php echo number_format($total, 0, ',', '.') ?> VNĐ</strong>
	<span class="pull-right">
		<a href="<?php echo site_url($url) ?>"><?php echo $this->lang->line('view_cart') ?></a>
	</span>
</p>