<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title><?php echo ($subtitle == NULL ? 'Website Management' : $subtitle . ' | Website Management') ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="/public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="/public/admin/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="/public/admin/bower_components/Ionicons/css/ionicons.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="/public/admin/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/public/admin/bower_components/select2/dist/css/select2.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/public/admin/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="/public/admin/dist/css/skins/_all-skins.min.css">
  	<!-- iCheck for checkboxes and radio inputs -->
  	<link rel="stylesheet" href="/public/admin/plugins/iCheck/all.css">
  	<!-- bootstrap wysihtml5 - text editor -->
  	<link rel="stylesheet" href="/public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <link href="/public/admin/nestedSortable.css" rel="stylesheet" type="text/css" />
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<!-- jQuery 3 -->
	<script src="/public/admin/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="/public/admin/scripts/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/public/admin/scripts/cpanel.js"></script>
    <style> label.error { color: #ff0000; font-weight: normal; } textarea, .form-control, select, input, .checkbox label, .radio label { font-size:15px; }</style>
</head>
<body class="hold-transition skin-blue sidebar-mini"> <!--sidebar-collapse-->
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
		    <a href="<?php echo site_url('admin/dashboard') ?>" class="logo">
		      	<!-- mini logo for sidebar mini 50x50 pixels -->
		      	<span class="logo-mini"><b>C</b>MS</span>
		      	<!-- logo for regular state and mobile devices -->
		      	<span class="logo-lg"><b>Admin</b>CMS</span>
		    </a>

		    <nav class="navbar navbar-static-top">
				<a href="javascript:;" class="sidebar-toggle" data-toggle="push-menu" role="button">
        			<span class="sr-only">Toggle navigation</span>
      			</a>
      			<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="messages-menu<?php echo ($this->admin_lang == 'vi' ? ' active' : '') ?>"><a class="vi-lang" href="javascript:;" data-lang="vi" data-url="<?php echo $_SERVER['REQUEST_URI'] ?>">Tiếng Việt</a></li>
                        <li class="messages-menu<?php echo ($this->admin_lang == 'en' ? ' active' : '') ?>"><a class="en-lang" href="javascript:;" data-lang="en" data-url="<?php echo $_SERVER['REQUEST_URI'] ?>">English</a></li>
						<li class="messages-menu<?php echo ($this->admin_lang == 'jp' ? ' active' : '') ?>"><a class="jp-lang" href="javascript:;" data-lang="jp" data-url="<?php echo $_SERVER['REQUEST_URI'] ?>">日本語</a></li>
						<li class="dropdown user user-menu">
							<a href="index2.html#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="/public/admin/dist/user-default.png" class="user-image" alt="<?php echo $session_user ?>">
								<span class="hidden-xs"><?php echo $session_user ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="/public/admin/dist/user-default.png" class="img-circle" alt="<?php echo $session_user ?>">

									<p>
										<?php echo $session_user ?> - <?php echo $session_role ?>
									</p>
								</li>
								
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="index2.html#" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo site_url('account/auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
      			</div>
		    </nav>
		</header>

		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="/public/admin/dist/user-default.png" height="16" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?php echo $session_user ?></p>
						<a href="<?php echo site_url() ?>" target="_blank"><i class="fa fa-circle text-success"></i> Home</a>
					</div>
				</div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
      			<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li class="<?php echo ($active=='dashboard' ? 'active' : '') ?>">
						<a href="<?php echo site_url('admin/dashboard') ?>">
							<i class="fa fa-dashboard"></i> <span>Dashboard</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
					</li>

					<li <?php echo ($active=='appearance' ? 'class="active"' : '') ?>>
						<a href="<?php echo site_url('admin/appearance') ?>">
							<i class="fa fa-sliders"></i> <span>General setting</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
					</li>

                    <li class="treeview<?php echo ($active=='media' ? ' active menu-open' : '') ?>">
                        <a href="<?php echo site_url('admin/slide') ?>">
                            <i class="fa fa-home" aria-hidden="true"></i> <span>Home page</span>
                            <span class="pull-right-container">
				              	<i class="fa fa-angle-left pull-right"></i>
				            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php echo ($sub_active=='menu' ? 'class="active"' : '') ?>>
                                <a href="<?php echo site_url('admin/navigation') ?>"><i class="fa fa-circle-o"></i> Menus</a>
                            </li>
                            <li <?php echo ($sub_active=='group_menu' ? 'class="active"' : '') ?>><a href="<?php echo site_url('admin/group_menu') ?>"><i class="fa fa-circle-o"></i> Group menus</a></li>
                            <li <?php echo ($sub_active=='slide' ? 'class="active"' : '') ?>><a href="<?php echo site_url('admin/slide') ?>"><i class="fa fa-circle-o"></i> Slider</a></li>

                        </ul>
                    </li>

                    <li class="treeview<?php echo ($active=='pages' ? ' active menu-open' : '') ?>">
                        <a href="<?php echo site_url('admin/page') ?>">
                            <i class="fa fa-file-text" aria-hidden="true"></i> <span>Files Management</span>
                            <span class="pull-right-container">
				              	<i class="fa fa-angle-left pull-right"></i>
				            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php echo ($sub_active=='page' ? 'class="active"' : '') ?>>
                                <a href="<?php echo site_url('admin/page') ?>"><i class="fa fa-circle-o"></i> List pages</a>
                            </li>
                            <li><a href="<?php echo site_url('admin/page/add') ?>"><i class="fa fa-circle-o"></i> Create page</a></li>

                        </ul>
                    </li>

                    <li class="treeview<?php echo ($active=='member' ? ' active menu-open' : '') ?>">
						<a href="<?php echo site_url('member/controlpanel') ?>">
							<i class="fa fa-group"></i> <span>Members</span>
							<span class="pull-right-container">
				              	<i class="fa fa-angle-left pull-right"></i>
				            </span>
						</a>
						<ul class="treeview-menu">
							<li <?php echo ($sub_active=='company' ? 'class="active"' : '') ?>><a href="<?php echo site_url('admin/company') ?>"><i class="fa fa-circle-o"></i> Company</a></li>
							<li <?php echo ($sub_active=='candidate' ? 'class="active"' : '') ?>><a href="<?php echo site_url('admin/candidate') ?>"><i class="fa fa-circle-o"></i> Candidate</a></li></a></li>
			          	</ul>
					</li>
                   	
					<li class="treeview<?php echo ($active=='news' ? ' active menu-open' : '') ?>">
						<a href="<?php echo site_url('admin/post') ?>">
							<i class="fa fa-newspaper-o"></i> <span>News post</span>
							<span class="pull-right-container">
				              	<i class="fa fa-angle-left pull-right"></i>
				            </span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo site_url('admin/post') ?>"><i class="fa fa-circle-o"></i> All posts</a></li>
							<li><a href="<?php echo site_url('admin/post/add') ?>"><i class="fa fa-circle-o"></i> Add new post</a></li>
			            	<li><a href="<?php echo site_url('admin/category') ?>"><i class="fa fa-circle-o"></i> Category</a></li>
			          	</ul>
					</li>

                    <li class="treeview<?php echo ($active=='pages' ? ' active menu-open' : '') ?>">
                        <a href="<?php echo site_url('admin/page') ?>">
                            <i class="fa fa-file-text" aria-hidden="true"></i> <span>Static pages</span>
                            <span class="pull-right-container">
				              	<i class="fa fa-angle-left pull-right"></i>
				            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php echo ($sub_active=='page' ? 'class="active"' : '') ?>>
                                <a href="<?php echo site_url('admin/page') ?>"><i class="fa fa-circle-o"></i> List pages</a>
                            </li>
                            <li><a href="<?php echo site_url('admin/page/add') ?>"><i class="fa fa-circle-o"></i> Create page</a></li>

                        </ul>
                    </li>

					<li class="treeview<?php echo ($active=='user' ? ' active menu-open' : '') ?>">
						<a href="<?php echo site_url('admin/user') ?>">
							<i class="fa fa-user"></i> <span>System users</span>
							<span class="pull-right-container">
				              	<i class="fa fa-angle-left pull-right"></i>
				            </span>
						</a>
						<ul class="treeview-menu">
							<li <?php echo ($sub_active=='user' ? 'class="active"' : '') ?>><a href="<?php echo site_url('admin/user') ?>"><i class="fa fa-circle-o"></i> All users</a></li>
							<li <?php echo ($sub_active=='add_user' ? 'class="active"' : '') ?>><a href="<?php echo site_url('admin/user/edit') ?>"><i class="fa fa-circle-o"></i> Add new</a></li></a></li>
			          	</ul>
					</li>
					
      			</ul>
			</section>
		</aside>

		<div class="content-wrapper" style="min-height: 100%;">
			<section class="content-header">
				<h1>
					<?php echo $subtitle ?>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</section>
			<section class="content" id="wrapper">
				<?php $this->load->view($subview, TRUE) ?>
			</section>
		</div>

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0
			</div>
			<strong>Copyright &copy; 2017 </strong>
		</footer>
	</div>

	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="/public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/public/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/public/admin/scripts/jquery.mjs.nestedSortable.js"></script>
	<script type="text/javascript" src="/public/admin/scripts/slugify.js"></script>
	<script src="/public/admin/bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="/public/admin/dist/js/adminlte.min.js"></script>
	<script type="text/javascript" src="/public/admin/scripts/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/public/admin/scripts/ckfinder/ckfinder.js"></script>
	<!-- Sparkline -->
	<script src="/public/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- SlimScroll -->
	<script src="/public/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="/public/admin/plugins/iCheck/icheck.min.js"></script>
	<!-- ChartJS -->
	<script src="/public/admin/bower_components/Chart.js/Chart.js"></script>
	<script src="/public/admin/dist/js/demo.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="/public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="/public/admin/scripts/main.js"></script>
	<script type="text/javascript">
	    $(document).ready(function() {

            $('.select2').select2();

	    	$(".textarea").wysihtml5();

	    	$("#btnSelectImg").click(function () {
                var finder = new CKFinder();
                finder.selectActionFunction = function (fileUrl) {
                    $('#ImageUrl').val(fileUrl);
                };
                finder.popup();
            });
            $("#btnLogoFoot").click(function () {
                var finder = new CKFinder();
                finder.selectActionFunction = function (fileUrl) {
                    $('#logoFooter').val(fileUrl);
                };
                finder.popup();
            });

	        $(".vi-lang").click(function() {
	        	var uri = $(this).attr('data-url');
	            $.ajax({
	                type: 'POST',
	                url: '/admin/dashboard/set_language',
	                data: {
	                    lang: $(this).attr('data-lang')
	                },
	                success: function(res) {
	                    if(res === 'TRUE') {
	                        window.location = uri;
	                    }
	                }
	            });
	        });
	        $(".en-lang").click(function() {
	        	var uri = $(this).attr('data-url');
	            $.ajax({
	                type: 'POST',
	                url: '/admin/dashboard/set_language',
	                data: {
	                    lang: $(this).attr('data-lang')
	                },
	                success: function(res) {
	                    if(res === 'TRUE') {
	                        window.location = uri;
	                    }
	                }
	            });
	        });

	        $(".jp-lang").click(function() {
	        	var uri = $(this).attr('data-url');
	            $.ajax({
	                type: 'POST',
	                url: '/admin/dashboard/set_language',
	                data: {
	                    lang: $(this).attr('data-lang')
	                },
	                success: function(res) {
	                    if(res === 'TRUE') {
	                        window.location = uri;
	                    }
	                }
	            });
	        });

	        
	        //iCheck for checkbox and radio inputs
		    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		      	checkboxClass: 'icheckbox_minimal-blue',
		      	radioClass   : 'iradio_minimal-blue'
		    })
	    });
	    function getImage(id) {
	        var finder = new CKFinder();
	        finder.selectActionFunction = function (fileUrl) {
	            $('#'+id + '').val(fileUrl);
	        };
	        finder.popup();
	    }
	</script>
</body>
</html>