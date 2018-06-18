<style>
    .form-control { box-shadow: none; }
    input[type="text"], input[type="phone"], .textarea, select { border-radius: 0;     
        height: 28px;border:none;
        background: #fff;
        outline: none;}
</style>
<script src="/public/frontend/js/countries.js"></script>
<?php 
$url = ($GLOBALS['lang_code'] == 'vi' ? $GLOBALS['lang_code'].'/tai-khoan' : $GLOBALS['lang_code'].'/account'); 
$url2 = ($GLOBALS['lang_code'] == 'vi' ? 'vi/tai-khoan/truy-cap' : 'en/account/access'); 
$url3 = ($GLOBALS['lang_code'] == 'vi' ? 'vi/tai-khoan/lich-su-thanh-toan' : 'en/account/invoices');
?>
<section class="main" style="background: #fcfaf3;">
    <div class="container-fluid">
        <div class="checkout">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <nav>
	                <h3 class="profile-sidebar-title"><?php echo $this->lang->line('setting') ?></h3>
                    <ul class="profile-sidebar-nav">
                        <li>
                            <a href="<?php echo site_url($url) ?>"><?php echo $this->lang->line('dashboard') ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url($url2) ?>"><?php echo $this->lang->line('access_detail') ?></a>
                        </li>
                    </ul>
                    
                    <h3 class="profile-sidebar-title"><a href="<?php echo site_url($url3) ?>"><?php echo $this->lang->line('history_invoice') ?></a></h3>
                    <h3 class="profile-sidebar-title"><a href="<?php echo site_url('home/account/logout') ?>"><?php echo $this->lang->line('logout') ?></a></h3>
                </nav>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
	            <h3 class="profile-title"><?php echo $this->lang->line('dashboard') ?></h3>
	            <p class="profile-summary">
		            <?php echo $this->lang->line('account_summary') ?>
	            </p>
                <form class="form-horizontal" id="profile" action="<?php echo site_url('home/account/update'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <input type="hidden" name="member_id" value="<?php echo $profile->member_id ?>" />
                    <div class="form-group">
	                    <div class="col-lg-4">
	                        <label><?php echo $this->lang->line('full_name') ?></label>
	                        <input type="text" name="member_name" value="<?php echo $profile->member_name ?>" />
	                    </div>
	                    <div class="col-lg-4">
	                        <label class="text-center"><?php echo $this->lang->line('nice_name') ?></label>
	                        <input type="text" name="member_nicename" value="<?php echo $profile->member_nicename ?>" />
	                    </div>
                    </div>
                    <!--
                    <div class="form-group">
                        <label class="col-lg-3 label-control"><?php echo $this->lang->line('user_image') ?></label>
                        <div class="col-lg-8">
                            <input type="file" value="<?php echo $profile->user_image ?>" />
                        </div>
                    </div>-->
                    <div class="form-group">
	                    <div class="col-lg-4">
	                        <label><?php echo $this->lang->line('address') ?></label>
	                        <input type="text" name="member_address" value="<?php echo $profile->member_address ?>" />
	                    </div>
	                    <div class="col-lg-4">
	                        <label class="text-center"><?php echo $this->lang->line('city') ?></label>
	                        <input type="text" name="member_state" value="<?php echo $profile->member_state ?>" />
	                    </div>
	                    <div class="col-lg-4">
	                        <label class="text-center"><?php echo $this->lang->line('zipcode') ?></label>
	                        <input type="text" name="member_postal_code" style="width: 40%; float:left;" value="<?php echo $profile->member_postal_code ?>" />
	                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
	                        <label><?php echo $this->lang->line('phone_number') ?></label>
                            <input type="phone" name="member_phone" value="<?php echo $profile->member_phone ?>" />
                        </div>
                        <div class="col-lg-4">
	                        <label class="text-center"><?php echo $this->lang->line('country') ?></label>
	                        <input type="phone" name="member_national" value="<?php echo $profile->member_national ?>" />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
	                        <label><?php echo $this->lang->line('date_birth') ?></label>
                            <input type="phone" name="member_birth" value="<?php echo date('d-m-Y', strtotime($profile->member_birth)) ?>" /> 
                        </div>
                        <span>Day/Month/Year</span>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 label-control"></label>
                        <div class="col-lg-9">
                            <input style="margin-right: 25px;" type="submit" name="sm" class="btn btn-default" value="<?php echo $this->lang->line('update_account') ?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</section>
<script>
    populateCountries("mem_country");
</script>

