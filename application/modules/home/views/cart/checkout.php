<section class="main" style="background: #fcfaf3;">
    <div class="container">
        <div class="row">
			<div class="checkout" style="border-top:1px solid #000; padding: 30px 0;">
				
	            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
					<form class="form-horizontal checkoutForm" method="post" action="/home/cart/save_order">
						<h2><?php echo $subtitle ?></h2>
						<h3><?php echo $this->lang->line('shipping_address') ?></h3>
						<div class="form1">
							<div class="form-group">
								<label class="col-lg-2 col-md-2"><?php echo $this->lang->line('first_name') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" class="form-control" name="bill_firstname" />
								</div>
								<label class="col-lg-2 col-md-2 control-label"><?php echo $this->lang->line('last_name') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" class="form-control" name="bill_lastname" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-md-2"><?php echo $this->lang->line('address') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" class="form-control" name="bill_address" value="<?php echo $profile->member_address ?>" />
								</div>
								<label class="col-lg-2 col-md-2 col-sm-12 col-xs-12 control-label"><?php echo $this->lang->line('city') ?></label>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
									<input type="text" class="form-control" name="bill_state" value="<?php echo $profile->member_state ?>" />
								</div>
								<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
									<input type="text" class="form-control" name="bill_zipcode" placeholder="Zip Code" value="<?php echo $profile->member_postal_code ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-md-2"><?php echo $this->lang->line('phone_number') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" class="form-control" name="bill_phone" value="<?php echo $profile->member_phone ?>" />
								</div>
								<label class="col-lg-2 col-md-2 control-label"><?php echo $this->lang->line('country') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" name="bill_country" class="form-control" value="<?php echo $profile->member_national ?>" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12 col-md-12">
									<div class="checkbox">
										<label>
											<input type="checkbox" class="checkbox" name="same_value" id="check-same" value="1" /> <?php echo $this->lang->line('same_message_shipping') ?>
										</label>
									</div>
								</div>
							</div>
						</div>
						<h3><?php echo $this->lang->line('bill_address') ?></h3>
						<div class="form2">
							<div class="form-group">
								<label class="col-lg-2 col-md-2"><?php echo $this->lang->line('first_name') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" class="form-control" name="shipping_firstname" />
								</div>
								<label class="col-lg-2 col-md-2 control-label"><?php echo $this->lang->line('last_name') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" class="form-control" name="shipping_lastname" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-md-2"><?php echo $this->lang->line('address') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" class="form-control" name="shipping_address" />
								</div>
								<label class="col-lg-2 col-md-2 col-sm-12 col-xs-12 control-label"><?php echo $this->lang->line('city') ?></label>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
									<input type="text" class="form-control" name="shipping_state" />
								</div>
								<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
									<input type="text" class="form-control" name="shipping_zipcode" placeholder="Zip Code" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-md-2"><?php echo $this->lang->line('phone_number') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" class="form-control" name="shipping_phone" />
								</div>
								<label class="col-lg-2 col-md-2 control-label"><?php echo $this->lang->line('country') ?></label>
								<div class="col-lg-3 col-md-3">
									<input type="text" name="shipping_country" class="form-control" />
								</div>
							</div>
						</div>
						<p>
							<input type="submit" class="btn btn-default" id="checkoutContinue" value="Continue" />
						</p>
					</form>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="row">
						<h2><?php echo $this->lang->line('summary') ?></h2>
						<div class="price_review">
							<p>
								<span><?php echo $this->lang->line('sub_total') ?></span>
								<span class="pull-right"><?php echo number_format($total, 0, ',', '.') ?> VNĐ</span>
							</p>
							<p>
								<span><?php echo $this->lang->line('shipping_cost') ?></span>
								<span class="pull-right"><?php echo number_format($options->shipping_cost, 0, ',', '.') ?> VNĐ</span>
							</p>
							<p class="price-tax">
								<span><?php echo $this->lang->line('tax') ?></span>
								<span class="pull-right"><?php echo number_format($options->tax, 0, ',', '.') ?> VNĐ</span>
							</p>
						</div>
						<p>
							<span style="text-transform:uppercase;"><?php echo $this->lang->line('total') ?></span>
							<span class="pull-right"><?php echo number_format(($total+$options->tax+$options->shipping_cost), 0, ',', '.') ?> VNĐ</span>
						</p>
						<div class="short-qa">
							<p><?php echo $this->lang->line('have_question') ?> ? <br /> 0987654321</p>
							<p>What is return policy ?</p>
							<p><strong>When can i expect my order ?</strong></p>
						</div>
					</div>
				</div>
				
			</div>
        </div>

    </div>
</section>
<script type="text/javascript">
	//populateCountries("ship_country");
	//populateCountries("bill_country");
	
	jQuery(document).ready(function($) {
		
		$("#check-same").change(function () {
		    if ($(this).is(":checked")) {
		    	$("input[name=shipping_firstname]").val($("input[name=bill_firstname]").val());
		        $("input[name=shipping_lastname]").val($("input[name=bill_lastname]").val());
				$("input[name=shipping_address]").val($("input[name=bill_address]").val());
				$("input[name=shipping_state]").val($("input[name=bill_state]").val());
				$("input[name=shipping_zipcode]").val($("input[name=bill_zipcode]").val());
				$("input[name=shipping_phone]").val($("input[name=bill_phone]").val());
				$("input[name=shipping_country]").val($("input[name=bill_country]").val());
		    } else {
		        $("input[name=shipping_lastname]").val("");
				$("input[name=shipping_address]").val("");
				$("input[name=shipping_state]").val("");
				$("input[name=shipping_zipcode]").val("");
				$("input[name=shipping_phone]").val("");
				$("input[name=shipping_country]").val("");
		    }
		});
		
		$(".checkoutForm").validate({
			rules: {
				bill_firstname: { required: true },
				bill_lastname: { required: true },
				bill_address: { required: true },
				bill_state: { required: true },
				bill_zipcode: { required: true, number: true },
				bill_phone: { required: true, number: true },
				shipping_firstname: { required: true },
				shipping_lastname: { required: true },
				shipping_address: { required: true },
				shipping_state: { required: true },
				shipping_zipcode: { required: true, number: true },
				shipping_phone: { required: true, number: true }
			},
			messages: {}
		});
		
		
	});
</script>