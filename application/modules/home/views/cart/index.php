<section class="main" style="background: #fcfaf3;">
    <div class="container">
        <div class="row checkout">
			<?php //var_dump($cart); ?>
            <div class="div_prod_detail col-md-12 col-sm-12">
                <div class="your_cart">
                    <div class="tbl_inner_list_cart">
                        <table class="table-cart table-responsive">
                            <thead>
                                <tr class="tr-title">
                                    <th><label class="lbl_name_prod"><?php echo $this->lang->line('product'); ?></label></th>
                                    <th><label class="lbl_name_prod"><?php echo $this->lang->line('product_name'); ?></label></th>
									<th><label class="lbl_name_prod"><?php echo $this->lang->line('color'); ?></label></th>
									<th><label class="lbl_name_prod"><?php echo $this->lang->line('size'); ?></label></th>
                                    <th><label class="lbl_name_prod"><?php echo $this->lang->line('units'); ?></label></th>
                                    <th><label class="lbl_name_prod"><?php echo $this->lang->line('total_price'); ?></label></th>
                                    <th><label class="lbl_name_prod"><?php echo $this->lang->line('delete'); ?></label></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sum = 0;
                                    foreach ($cart as $value) {
                                ?>
                                <tr>
                                    <input type="hidden" class="rowid" name="rowid[]" value="<?php echo $value['rowid'] ?>" />
                                    <td>
                                        <a href="#" class="img_thumbnail" style="float:left; margin-right: 15px;"><img src="<?php echo $value['img'] ?>" height="100" alt="<?php echo $value['name'] ?>" /></a>
                                    </td>
                                    <td><?php echo $value['name'] ?></td>
									<td><?php 
									    	$res = single_attribute($value['attr']['color']); 
									    	echo $res->name;
									    ?>
									</td>
									<td><?php 
									    	$res = single_attribute($value['attr']['size']); 
									    	echo $res->name;
									    ?>
									</td>
                                    <td><?php echo $value['qty'] ?></td>
                                    <td><label class="lbl_price_bold lbl_price"><?php echo number_format($value['price']*$value['qty'], 0, ',', '.') ?> VNĐ</label></td>
                                    <td><a href="javascript:;" class="btn_del_cart" data-id="<?php echo $value['rowid'] ?>">X</a></td>
                                </tr>
                                <?php } ?>
                            
                            </tbody>
                        </table>
                    </div>

                    <div class="div_total_order">
						<div class="row">
	                        <div class="order_money_payment col-md-8 col-sm-8">
	                            <p>Basket: <strong><?php echo $total_item ?> item(s)</strong></p>
	                        </div>
	                        <div class="order_money_payment col-md-4 col-sm-4">
	                            <table>
	                                <tr>
	                                    <td class="td_align_left lbl_fee_money"><?php echo $this->lang->line('total_product_cost') ?></td>
	                                    <td class="td_align_right"><label class="lbl_total_money"><?php echo number_format($total, 0, ',', '.') ?> VNĐ</label></td>
	                                </tr>
	                                <tr>
	                                    <td class="td_align_left final-money"><?php echo $this->lang->line('total_payment') ?></td>
	                                    <td class="td_align_right">
	                                        <label class="lbl_total_money_pay final-money">
	                                        <?php 
	                                        	echo number_format(($total + $cart_config->shipping), 0, ',', '.');           
	                                        ?>
	                                        VNĐ</label>
	                                    </td>
	                                </tr>
	                            </table>
	                        </div>
						</div>
                    </div>

                    <div class="list_btn_payment">
                        <a type="button" class="btn btn_cart_detail" href="<?php  echo site_url($GLOBALS['lang_code'].'/shop'); ?>"><?php echo $this->lang->line('continue_shopping') ?></a>
						<div class="pull-right">
							<?php $checkout = ($GLOBALS['lang_code'] == 'vi' ? $GLOBALS['lang_code'].'/thanh-toan' : $GLOBALS['lang_code'].'/checkout'); ?>
							<?php if($total_item > 0) { ?>
							<a href="<?php echo site_url($checkout) ?>" class="btn_cart_order btn"><?php echo $this->lang->line('order') ?></a>
							<?php } else { ?>
							<a href="<?php echo site_url($GLOBALS['lang_code']) ?>" class="btn_cart_order btn"><?php echo $this->lang->line('home') ?></a>
							<?php } ?>
						</div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
	var lang = '<?php echo $GLOBALS['lang_code'] ?>';
	var confirmMsg;
	if(lang === 'en') {
		confirmMsg = 'Are you sure you want to delete?';
	} else {
		confirmMsg = 'Bạn chắc chắn muốn xóa ?';
	}
	$("#wrapper").on("click", ".btn_del_cart", function() {
	      
        if(confirm(confirmMsg)) {
            var id = $(this).attr("data-id");
            //alert(id);
            $.ajax({
                type: 'post',
                url: '/home/cart/delete_product_cart',
                data: {
                    rowid: id
                },
                success: function(res) {
                    $("#cartMini").html(res);
	                $("#cartMini1").html(res);
	                $("#cartMini2").html(res);
					if(lang === 'en') {
                    	location.href= '/' + lang + '/cart';
					} else {
						location.href= '/' + lang + '/gio-hang';
					}
                }
            });
        }
    });
});
</script>
