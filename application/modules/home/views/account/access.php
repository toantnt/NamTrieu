<style>
    .form-control { box-shadow: none; }
    input[type="text"], input[type="phone"], .textarea, select { border-radius: 0;     
        height: 28px;border:none;
        background: #fff;
        outline: none;}
    input[type="password"] { border-radius: 0;     
        height: 28px;border:none;
        background: #fff;
        outline: none; }
    h3 { text-transform: uppercase; }
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
                        <li class="active">
                            <a href="<?php echo site_url($url2) ?>"><?php echo $this->lang->line('access_detail') ?></a>
                        </li>
                    </ul>
                    
                    <h3 class="profile-sidebar-title"><a href="<?php echo site_url($url3) ?>"><?php echo $this->lang->line('history_invoice') ?></a></h3>
                    <h3 class="profile-sidebar-title"><a href="<?php echo site_url('home/account/logout') ?>"><?php echo $this->lang->line('logout') ?></a></h3>
                </nav>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
	            <h3 class="profile-title"><?php echo $subtitle ?></h3>
	            <p class="profile-summary">
		            <?php echo $this->lang->line('access_summary') ?>
	            </p>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="row">
                        <h3><?php echo $this->lang->line('change_email'); ?></h3>
                        <p><?php echo $this->lang->line('current_email'). ': <br/>'. $profile->member_email; ?></p>
                    </div>
                    <form id="formEmail" action="/home/account/access" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label class="label-control"><?php echo $this->lang->line('new_email'); ?></label>
                            <input type="text" class="form-control" name="new_email" />
                        </div>
                        <div class="form-group">
                            <label class="label-control"><?php echo $this->lang->line('confirm_new_email'); ?></label>
                            <input type="text" class="form-control" name="confirm_new_email" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class='btn btn-default' value="<?php echo $this->lang->line('save') ?>" />
                        </div>
                    </form>
                </div>
                <div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="row">
                        <h3><?php echo $this->lang->line('change_password'); ?></h3>
                    </div>
                    <form id="formPassword" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label class="label-control"><?php echo $this->lang->line('current_pass'); ?></label>
                            <input type="password" class="form-control" name="current_pass" value="<?php echo $profile->member_password ?>" />
                        </div>
                        <div class="form-group">
                            <label class="label-control"><?php echo $this->lang->line('new_pass'); ?></label>
                            <input type="password" class="form-control" name="new_pass" />
                        </div>
                        <div class="form-group">
                            <label class="label-control"><?php echo $this->lang->line('confirm_new_pass'); ?></label>
                            <input type="password" class="form-control" name="confirm_new_pass" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class='btn btn-default' value="<?php echo $this->lang->line('save') ?>" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</section>

