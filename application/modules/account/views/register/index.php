<section class="page-banner">
    <div class="container-fluid">
        <div class="row">
            <div class="jobs-banner">
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                    <div class="box-title" style="margin-left: 20%;">
                        <h2>Đăng ký <br>tài khoản</h2>
                        <div class="text-summary">
                            <p>Kênh thông tin tuyển dụng liên  tục được <br>đăng tải hàng ngày.
                                Và cơ hội việc làm ngay <br> trong tầm tay bạn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="register-member">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <form id="registerForm" class="form-horizontal" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" />
                    </div>
                    <div class="form-group">
                        <select name="member_type" class="form-control">
                            <option value="">Lựa chọn tài khoản</option>
                            <option value="1">Ứng viên đăng ký</option>
                            <option value="2">Nhà tuyển dụng đăng ký</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="register_captcha" placeholder="Nhập mã captcha" />
                        </div>
                        <div class="col-lg-6">
                            <span id="captchaRegister" class="captcha"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-primary" value="Đăng ký" />
                            <span class="sending hidden"><img src="/public/admin/dist/sending.gif" height="24" alt=""></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

