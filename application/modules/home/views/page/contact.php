<style>
	
</style>

<section class="main" style="background: #fcfaf3;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h2 style="text-align:center; font-size:14.1px; text-transform:uppercase;"><?php echo $subtitle ?></h2>
			</div>
		</div>
	</div>
	<hr>
	<div class="container-fluid checkout">
		<div class="row">
			<?php //var_dump($member); ?>
			<div>
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="contact-content">
						<div class="row">
							<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
								<div class="row">
									
									<div class="col-lg-5 col-md-5 hidden-xs col-sm-4">
                                        <div class="row">
										    <img class="sub-image" src="/public/frontend/images/detail-collection.png" />
                                        </div>
									</div>
									<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
										<p style="text-align: left;margin-top:15px;">
											Subscribe to our newsletter and you’ll be the first to know about our newest arrivals, special offers and store events near you...
										</p>
                                        <form class="form-horizontal" id="form-sub" action="/home/page/subscriber" method="post">
                        					<div class="form-group">
                        						<label for="email" class="control-label col-md-2">Email</label>
                        						<div class="col-md-9">
                        							<input type="text" class="form-control" name="sub_email" />
                        						</div>
                        					</div>
                        					<div class="form-group">
                        						<label for="email" class="control-label col-md-2">Country</label>
                        						<div class="col-md-9">
                        							<select class="form-control" name="sub_country" id="subCountry"></section>
                        						</div>
                        					</div>
                        					<div class="form-group">
                        						<div class="col-md-12">
                        							<input type="submit" class="btn btn-default" value="SUBSCRIBE" />
                        						</div>
                        					</div>
                        				</form>
                                        <small>By submitting you confirm that you agree to our privacy policy</small>
									</div>
									
								</div>
							</div>
							
							<div class="col-lg-1 col-md-1 hidden-xs hidden-sm"></div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
			</div>
			
		</div>
	</div>
	
</section>
<script>
	populateCountries("subCountry");
</script>