<section class="main" style="background: #fcfaf3;">
    <div class="container">
	    <div class="row">
		    <div class="col-lg-12">
			    <h2><?php echo $subtitle ?></h2>
			    <p>Website will redirect to account login in short time. If you have an account, you can choose option <strong>Forgot password</strong>.</p>
		    </div>
	    </div>
    </div>
</section>
<script>
	setTimeout(function () { window.location.href= "<?php echo site_url($GLOBALS['lang_code'].'/account') ?>"; }, 10000);
</script>
<style type="text/css" media="screen">
	.main { padding: 0 50px; }
	h2, p, span { text-align: center; }
	h2 { margin-bottom: 20px; font-size: 15px; }
</style>