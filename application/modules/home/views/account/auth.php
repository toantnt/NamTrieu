<style>
	.login, .register { width: 100%; } .checkbox label, .radio label { padding-left: 0; }
	.form-control { box-shadow: none; }
	.checkout .btn { margin-top: 0; }
	h2 { font-size: 13px; font-weight: 500; text-transform: uppercase; }
	.input-text { width: 85%; }
	.continue { margin-bottom: 30px; width: 100%; }
</style>

<section class="main" style="background: #fcfaf3;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>
			<div class="col-lg-5 col-md-5 col-sm-12">
				<h2><?php echo $this->lang->line('shipping_pay') ?></h2>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-12">
				<h2><?php echo $this->lang->line('purchase_guest') ?></h2>
			</div>
			<div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>
		</div>
	</div>
	<hr>
	
	<div class="container-fluid checkout">
		<div class="row">
			<div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>
			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<div class="">
					<h2><?php echo $subtitle ?></h2>
				</div>
				<form class="form-horizontal" method="post" id="loginForm" action="<?php echo site_url('home/account/login_account') ?>">
					<div class="form-group">
						<label class="label-control col-lg-3"><?php echo $this->lang->line('username_or_email') ?></label>
						<div class="col-lg-9">
							<input type="text" class="form-control input-text" name="nicename" />
						</div>
					</div>
					<div class="form-group">
						<label class="label-control col-lg-3"><?php echo $this->lang->line('password') ?></label>
						<div class="col-lg-9">
							<input class="form-control input-text" type="password" name="password" />
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="checkbox">
								<label for="remember"><input type="checkbox"  name="check1" value="1" onclick="getCheck('check1')" /> <?php echo $this->lang->line('remember_me') ?></label>	
							</div>
						</div>
						<div class="col-lg-6">
							<div class="checkbox">
								<label for="forgot"><input type="checkbox" name="check2" value="2" onclick="getCheck('check2')"/> <?php echo $this->lang->line('forgot_password') ?></label>	
							</div>
						</div>
						<!--
						<div class="col-lg-6">
							<div class="checkbox">
								<label for="account"><input type="checkbox"  name="check3" value="3" onclick="getCheck('check3')" /> <?php echo $this->lang->line('creat_account') ?></label>	
							</div>
						</div>
						-->
					</div>
					<div class="form-group">
						<div class="col-lg-12">		
							<input type="submit" style="margin-top: 25px;" class="btn btn-default button" name="login" value="<?php echo $this->lang->line('login') ?>">
						</div>
					</div>
				</form>
			</div>

			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<div class="">	
					<h2><?php echo $this->lang->line('register') ?></h2>
				</div>
				<form class="form-horizontal" method="post" id="registerForm" action="<?php echo site_url('home/account/save_session') ?>">
					<div class="form-group">
						<label class="label-control col-lg-4"><?php echo $this->lang->line('surname') ?> </label>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="member_name" />
						</div>
					</div>

					<div class="form-group">
						<label class="label-control col-lg-4"><?php echo $this->lang->line('email') ?> </label>
						<div class="col-lg-8">
							<input type="email" class="form-control" name="member_email" />
						</div>
					</div>
					<div class="form-group">
						<label class="label-control col-lg-4"><?php echo $this->lang->line('phone_number') ?> </label>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="member_phone" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="reg_password" class="label-control col-lg-4"><?php echo $this->lang->line('creat_account') ?> </label>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="member_nicename" />
						</div>
					</div>
					<div class="form-group">
						<label for="reg_password" class="label-control col-lg-4"><?php echo $this->lang->line('address') ?> </label>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="member_address" />
						</div>
					</div>
					<div class="form-group">
						<label for="reg_password" class="label-control col-lg-4"><?php echo $this->lang->line('city') ?> </label>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="member_state" />
						</div>
					</div>
					<div class="form-group">
						<label for="reg_password" class="label-control col-lg-4"><?php echo $this->lang->line('zipcode') ?> </label>
						<div class="col-lg-4">
							<input type="text" class="form-control" name="member_postal_code" />
						</div>
					</div>
					<div class="form-group">
						<label for="reg_password" class="label-control col-lg-4"><?php echo $this->lang->line('country') ?> </label>
						<div class="col-lg-4">
							<select class="form-control" name="member_national" id="your_country"></select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<input type="submit" style="margin-top: 15px;" class="btn btn-default button" name="continue" value="<?php echo $this->lang->line('continue') ?>">
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>
		</div>
	</div>
</section>

<script>
	populateCountries("your_country");
	$(document).ready(function() {
		$('#loginForm').validate({
			rules: {
				nicename: { required: true },
				password: { required: true }
			},
			messages: { }
		});

		$('#registerForm').validate({
			rules: {
				member_name: { required: true },
				member_email: { 
					required: true, 
					email: true,
					remote: {
						url: '/home/account/check_email',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            member_email: function () {
                                return $('#registerForm :input[name="member_email"]').val();
                            }
                        }
					}
				},
				member_phone: { required: true, number: true },
				member_nicename: { 
					required: true,
					remote: {
						url: '/home/account/check_username',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            member_nicename: function () {
                                return $('#registerForm :input[name="member_nicename"]').val();
                            }
                        }
					}
				},
				member_national: { required: true }
			},
			messages: { 
				member_email: { remote: "An email has been used for another account" },
				member_nicename: { remote: "Account has been an exists" }
			}
		});
	});
</script>