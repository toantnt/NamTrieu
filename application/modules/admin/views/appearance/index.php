<style type="text/css" media="screen">
	.tab-pane { padding-top: 20px; }
</style>
<div class="row">
	<div class="col-lg-12">
		<form id="formSetting" class="form-horizontal" accept-charset="utf-8" method="post">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>
				<div class="box-body">
					<ul class="nav nav-tabs">
			            <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
			            <li><a href="#tab_2" data-toggle="tab">Advanced</a></li>
			            <li><a href="#tab_3" data-toggle="tab">Socials</a></li>
			        </ul>
			        
			        <div class="tab-content">
	                    <div class="tab-pane active" id="tab_1">
		                    <div class="form-group">
								<div class="col-lg-6">
									<label class="label-control">Favicon</label>
									<div class="input-group">
		                                <input type="text" class="form-control" name="favicon" value="<?php echo $site->favicon ?>" id="favicon">
		                                <span class="input-group-btn">
		                                    <button class="btn btn-default" type="button" onclick="javascript:getImage('favicon');"><i class="glyphicon glyphicon-search"></i></button>
		                                </span>
		                            </div>
								</div>
								<div class="col-lg-6">
									<label class="label-control">Logo</label>
									<div class="input-group">
		                                <input type="text" class="form-control" name="logo" value="<?php echo $site->logo ?>" id="ImageUrl">
		                                <span class="input-group-btn">
		                                    <button class="btn btn-default" type="button" id="btnSelectImg"><i class="glyphicon glyphicon-search"></i></button>
		                                </span>
		                            </div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-6">
									<label for="" class="label-control">Title</label>
									<input type="text" class="form-control" name="title" value="<?php echo $site->title ?>" />
									<input type="hidden" name="id" value="<?php echo $site->id ?>" />
								</div>
								<div class="col-lg-6">
									<label class="label-control">Email</label>
									<input name="email" class="form-control" placeholder="Email for contact" value="<?php echo $site->email ?>" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12">
									<label class="label-control">Keyword</label>
									<textarea name="keyword" class="form-control" rows="2"><?php echo $site->keyword ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12">
									<label class="label-control">Description</label>
									<textarea name="description" class="form-control" rows="4"><?php echo $site->description ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12">
									<label class="label-control">Address</label>
									<textarea name="address" class="form-control" rows="2"><?php echo $site->address ?></textarea>
								</div>
							</div>
	                    </div>
	                    <div class="tab-pane" id="tab_2">
		                    <div class="">
								<div class="form-group">
									<div class="col-lg-6">
										<label class="label-control">Hotline</label>
										<input type="text" class="form-control" name="hotline" value="<?php echo $site->hotline ?>" />
									</div>
									<div class="col-lg-6">
										<label class="label-control">Phone</label>
										<input type="text" class="form-control" name="phone" value="<?php echo $site->phone ?>" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-6">
										<label class="label-control">Email server</label>
										<input type="text" class="form-control" placeholder="For email contact" name="email_server" value="<?php echo $site->email_server ?>" />
									</div>
									<div class="col-lg-6">
										<label class="label-control">Email port</label>
										<input type="text" class="form-control" placeholder="For email contact" name="email_port" value="<?php echo $site->email_port ?>" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-6">
										<label class="label-control">Email password</label>
										<input type="password" class="form-control" name="email_password" placeholder="For email contact" value="<?php echo $site->email_password ?>" />
									</div>
									<div class="col-lg-6">
										<label class="label-control">Email payment (PayPal)</label>
										<input type="text" class="form-control" name="email_payment" value="<?php echo $site->email_payment ?>" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-6">
										<label class="label-control">Shipping code</label>
										<input type="text" class="form-control" name="shipping_cost" value="<?php echo $site->shipping_cost ?>" placeholder="VNĐ" />
									</div>
									<div class="col-lg-6">
										<label class="label-control">Tax</label>
										<input type="text" class="form-control" name="tax" value="<?php echo $site->tax ?>" placeholder="VNĐ" />
									</div>
								</div>
							</div>
	                    </div>
						<div class="tab-pane" id="tab_3">
							<div class="form-group">
								<div class="col-lg-7">
									<label class="label-control">Facebook</label>
									<input type="text" class="form-control" name="facebook" value="<?php echo $site->facebook ?>" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-7">
									<label class="label-control">Instagrams</label>
									<input type="text" class="form-control" name="instagram" value="<?php echo $site->instagram ?>" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-7">
									<label class="label-control">Youtube</label>
									<input type="text" class="form-control" name="youtube" value="<?php echo $site->youtube ?>" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-7">
									<label class="label-control">Pinterest</label>
									<input type="text" class="form-control" name="pinterest" value="<?php echo $site->pinterest ?>" />
								</div>
							</div>
	                    </div>
			        </div>
				</div>
				<div class="box-footer">
	                <button type="submit" class="btn btn-info btn-flat">Save setting</button>
	                <span class="hidden sending"><img src="/public/admin/dist/sending.gif" height="24" alt="" /></span>
				</div>
			</div>
			
	    </form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#formSetting").validate({
			rules: {
				title: {
					required: true
				},
				email: { required: true },
				email_payment: {
					required: true
				},
				email_server: { required: true },
				email_port: { required: true }
			},
			messages: {},
			submitHandler: function(form) {
				$.ajax({
					type: $(form).attr('method'),
					url: '/admin/appearance/ajax_save',
					data: $(form).serialize(),
					beforeSend: function() {
						$('.sending').removeClass('hidden');
					},
					success: function(res) {
						$('.sending').addClass('hidden');
						if(res === 'TRUE') {
							$.ajax({
								type: 'post',
								url: '/admin/appearance',
								data: {},
								success: function(res1) {
									reloadPage(res1, '#formSetting');
								}
							});
						}
					}
				});
			}
		});
	});
</script>