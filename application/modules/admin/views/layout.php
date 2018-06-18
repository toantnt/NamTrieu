<!doctype html>
<html class="no-js" lang="en">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title><?php echo ($subtitle == NULL ? 'Quản trị website' : $subtitle . ' | Website Management') ?></title>
        <meta name="description" content="">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="/public/admin/css/vendor.css" />
        <link rel="stylesheet" href="/public/admin/css/app.css" />
        <!-- Theme initialization -->
        <script src="/public/admin/js/jquery.min.js"></script>
        <script src="/public/admin/js/jquery.validate.min.js"></script>
        <script src="/public/admin/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="/public/admin/js/cpanel.js"></script>
        <style>
            .ad-language            { list-style: none; margin-left: 0; padding-left: 0; }
            .ad-language li         { display: inline-block; }
            .ad-language li a       { margin-right: 20px; cursor: pointer; }
            .ad-language li .active { color: #85CE36; }
        </style>
        
    </head>
	<body>
		<div class="main-wrapper">
			<div class="app" id="app">
				<header class="header">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="header-block header-block-search">
                        <ul class="ad-language">
                            <li><a class="zh-lang<?php echo ($this->admin_lang == 'zh' ? ' active' : '') ?> href="javascript:;" data-lang="zh">中國</a></li>
                            <li><a class="en-lang<?php echo ($this->admin_lang == 'en' ? ' active' : '') ?> href="javascript:;" data-lang="en">English</a></li>
                        </ul>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')"> </div>
                                    <span class="name"> <?php echo $session_user ?> </span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-user icon"></i> Profile 
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-gear icon"></i> Settings 
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo site_url('account/auth/logout') ?>">
                                        <i class="fa fa-power-off icon"></i> Logout 
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>

                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo">
                                    <span class="l l1"></span>
                                    <span class="l l2"></span>
                                    <span class="l l3"></span>
                                    <span class="l l4"></span>
                                    <span class="l l5"></span>
                                </div> Admin CMS </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li<?php echo ($active == 'dashboard' ? ' class="active"' : '') ?>>
                                    <a href="<?php echo site_url('admin/dashboard') ?>">
                                        <i class="fa fa-home"></i> Dashboard
                                    </a>
                                </li>
                                <li<?php echo ($active == 'post' ? ' class="active open"' : '') ?>>
                                    <a href="<?php echo site_url('posts/controlpanel') ?>">
                                        <i class="fa fa-th-large"></i> Posts
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="<?php echo site_url('posts/controlpanel') ?>"> All Posts </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('posts/controlpanel/create') ?>">  Add new post </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('posts/category') ?>"> Category </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-bar-chart"></i> Charts
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="charts-flot.html"> Flot Charts </a>
                                        </li>
                                        <li>
                                            <a href="charts-morris.html"> Morris Charts </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-table"></i> Tables
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="static-tables.html"> Static Tables </a>
                                        </li>
                                        <li>
                                            <a href="responsive-tables.html"> Responsive Tables </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="forms.html">
                                        <i class="fa fa-pencil-square-o"></i> Forms </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-desktop"></i> UI Elements
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="buttons.html"> Buttons </a>
                                        </li>
                                        <li>
                                            <a href="cards.html"> Cards </a>
                                        </li>
                                        <li>
                                            <a href="typography.html"> Typography </a>
                                        </li>
                                        <li>
                                            <a href="icons.html"> Icons </a>
                                        </li>
                                        <li>
                                            <a href="grid.html"> Grid </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-file-text-o"></i> Pages
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="login.html"> Login </a>
                                        </li>
                                        <li>
                                            <a href="signup.html"> Sign Up </a>
                                        </li>
                                        <li>
                                            <a href="reset.html"> Reset </a>
                                        </li>
                                        <li>
                                            <a href="error-404.html"> Error 404 App </a>
                                        </li>
                                        <li>
                                            <a href="error-404-alt.html"> Error 404 Global </a>
                                        </li>
                                        <li>
                                            <a href="error-500.html"> Error 500 App </a>
                                        </li>
                                        <li>
                                            <a href="error-500-alt.html"> Error 500 Global </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-sitemap"></i> Menu Levels
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="index.html#"> Second Level Item
                                                <i class="fa arrow"></i>
                                            </a>
                                            <ul class="sidebar-nav">
                                                <li>
                                                    <a href="index.html#"> Third Level Item </a>
                                                </li>
                                                <li>
                                                    <a href="index.html#"> Third Level Item </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="index.html#"> Second Level Item </a>
                                        </li>
                                        <li>
                                            <a href="index.html#"> Second Level Item
                                                <i class="fa arrow"></i>
                                            </a>
                                            <ul class="sidebar-nav">
                                                <li>
                                                    <a href="index.html#"> Third Level Item </a>
                                                </li>
                                                <li>
                                                    <a href="index.html#"> Third Level Item </a>
                                                </li>
                                                <li>
                                                    <a href="index.html#"> Third Level Item
                                                        <i class="fa arrow"></i>
                                                    </a>
                                                    <ul class="sidebar-nav">
                                                        <li>
                                                            <a href="index.html#"> Fourth Level Item </a>
                                                        </li>
                                                        <li>
                                                            <a href="index.html#"> Fourth Level Item </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>

				<?php $this->load->view($subview, TRUE) ?>
				<footer class="footer">
                    <div class="footer-block buttons">
                        <iframe class="footer-github-btn" src="https://ghbtns.com/github-btn.html?user=modularcode&amp;repo=modular-admin-html&amp;type=star&amp;count=true" frameborder="0" scrolling="0" width="140px" height="20px"></iframe>
                    </div>
                    <div class="footer-block author">
                        <ul>
                            <li>
                                <a href="http://danentang.com" target="_blank">danentang.com</a>
                            </li>
                        </ul>
                    </div>
                </footer>
                <div class="modal fade" id="modal-media">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Media Library</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                            </div>
                            <div class="modal-body modal-tab-container">
                                <ul class="nav nav-tabs modal-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.html#gallery" data-toggle="tab" role="tab">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.html#upload" data-toggle="tab" role="tab">Upload</a>
                                    </li>
                                </ul>
                                <div class="tab-content modal-tab-content">
                                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                                        <div class="images-container">
                                            <div class="row"> </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                        <div class="upload-container">
                                            <div id="dropzone">
                                                <form action="../index.html" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                                                    <div class="dz-message-block">
                                                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Insert Selected</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
			</div>
		</div>
        <script src="/public/admin/js/vendor.js"></script>
        <script src="/public/admin/js/app.js"></script>

        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script src="/public/admin/js/slugify.js"></script>

        <script src="/public/admin/js/jquery.mjs.nestedSortable.js"></script>
        <script src="/public/admin/js/main.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $(".zh-lang").click(function() {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/dashboard/set_language',
                        data: {
                            lang: $(this).attr('data-lang')
                        },
                        success: function(res) {
                            if(res === 'TRUE') {
                                window.location = '/admin/dashboard';
                            }
                        }
                    });
                });
                $(".en-lang").click(function() {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/dashboard/set_language',
                        data: {
                            lang: $(this).attr('data-lang')
                        },
                        success: function(res) {
                            if(res === 'TRUE') {
                                window.location = '/admin/dashboard';
                            }
                        }
                    });
                });

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
