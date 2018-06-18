<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title><?php echo ($options->title == NULL ? $subtitle : $subtitle.' | '.$options->title) ?></title>
    <link href="<?php echo $options->favicon ?>" rel="shortcut icon" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="Keywords" content="<?php echo $options->keyword ?>"/>
    <meta name="Description" content="<?php echo $options->description ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo site_url(); ?>"/>
    <meta property="og:site_name" content="<?php echo $options->title ?>"/>
    <meta property="og:image" content="<?php echo $options->logo ?>"/>
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:title" content="<?php echo $subtitle ?>"/>
    <meta property="og:description" content="<?php echo $options->description ?>"/>


    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/public/frontend/css/animate.min.css" />
    <link rel="stylesheet" href="/public/frontend/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/public/frontend/css/ionicons.min.css" />
    <link rel="stylesheet" href="/public/frontend/owl-carousel/owl.carousel.css" />

    <link rel="stylesheet" href="/public/frontend/css/style.css" media="screen" />
    <link rel="stylesheet" href="/public/frontend/css/responsive.css" />

    
</head>
<?php $this->load->helper('home/home'); ?>
<body id="bodyWrapper">
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.11&appId=1203554176363535';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                    <h1><a href="<?php echo site_url() ?>">
                            <img src="<?php echo $options->logo ?> " class="img-responsive" alt="<?php echo $options->title ?>" />
                        </a></h1>
                </div>
                <div class="col-lg-9 col-md-9 hidden-xs hidden-sm">
                    <nav>
                        <ul class="main-menu">
                            <li><a href="jobs.html">Tin tuyển dụng</a></li>
                            <li><a href="#">Năng lực tuyển dụng Nam Triều</a></li>
                            <li><a href="#">Đào tạo năng lực chuyên môn</a></li>
                            <li><a href="about.html">Giới thiệu về Nam Triều</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <div class="head-form pull-right">
                        <div class="search-box">
                            <a href="#" class="show-field">
                                <ion-icon name="search"></ion-icon>
                            </a>
                            <a href="#" class="show-field">
                                <ion-icon name="globe"></ion-icon>
                            </a>
                            <a href="#" class="show-field">
                                <ion-icon name="contact"></ion-icon>
                            </a>
                        </div>
                        <div class="lang">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="mobile-menu">

    </section>
    <?php $this->load->view($subview, TRUE); ?>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <ul class="mn-footer">
                        <li>Tìm Việc Làm</li>
                        <li>Đăng Tin Tuyển Dụng</li>
                        <li>Phỏng Vấn</li>
                        <li>Giới Thiệu Công Ty</li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="office">
                        <p class="text-red">Trụ sở chính</p>
                        <p>Công ty TNHH Đầu tư và Phát triển Nam Triều - Nam Trieu Japanese center</p>
                    </div>
                    <div class="office">
                        <p class="text-red">Địa chỉ</p>
                        <p>Tòa nhà T&H, Số 4/10, đường Hoàng Quốc Việt, phố Nghĩa Đô, quận Cầu Giấy, Hà Nội</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <ul class="mn-footer">
                        <p class="text-red">Tel</p>
                        (024).6269.3214

                        <p class="text-red">Fax</p>
                        (024).3755.5391
                        <p class="text-red">Email</p>
                        info@namtrieu.com.vn

                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="contact">
                        <a href="tel:0000" class="btn btn-default" role="button">Hotline 0967.632.215</a>
                    </div>
                </div>
            </div>
            <div class="row"><div class="col-md-12"><hr></div></div>
            <div class="row">
                <div class="col-md-1 col-lg-1">
                    <img src="img/logo-footer.png" class="img-responsive" alt="">
                </div>
                <div class="col-md-6 col-lg-6">
                    <p style="line-height: 65px;">2018 &copy; Nam Trieu Development & Invesment Co., Ltd. All Rights Reserved.</p>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="pull-right">
                        <div class="link-bottom">
                            <a href="#">Terms of user</a>
                            <a href="#">Privacy</a>
                            <a href="#">Site Map</a>
                            <a href="#">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- MODAL -->

    <div class="modal fade" id="registerSuccess" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo lang('register_success') ?></h4>
                </div>
                <div class="modal-body">
                    <p>Cảm ơn bạn đã đăng ký tại Nam Triều.</p>
                    <p>Vui lòng <a href="<?php echo site_url($this->web_lang.'/login') ?>">Đăng nhập tài khoản tại đây</a> để bổ sung hồ sơ của bạn.</p>
                </div>
            </div>
        </div>
    </div>


    <script src="/public/frontend/js/jquery.min.js"></script>
    <script src="/public/frontend/js/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js"></script>
    <script src="/public/frontend/owl-carousel/owl.carousel.js"></script>
    <script src="/public/frontend/js/bootstrap.min.js"></script>
    <script src="/public/frontend/js/main.js"></script>

    <script type="text/javascript">
        function openNav() {
			document.getElementById("mySidenav").style.width = "70%";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
		}
        function resetForm(form) {
            $('#' + form + '')[0].reset();
            $('#' + form + ' input').removeClass('valid');
            $('#' + form + ' label.error').html('');
            return true;
        }
    </script>
</body>
</html>