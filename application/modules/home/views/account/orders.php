<style>
    .form-control { box-shadow: none; }
    input[type="text"], input[type="phone"], .textarea { border-radius: 0;     
        height: 28px;border:none;
        background: #fff;
        outline: none;}
    table { width: 100%; max-width: 100%; }
</style>
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

            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12" style="border-left: 1px solid #333;">
                <table class="table table-cart table-hover">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>ORDER</th>
                            <th>AMOUNT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $item) { ?>
                        <tr>
                            <td><?php echo date("m/d/Y", strtotime($item->date_create)); ?></td>
                            <td><?php echo $item->bill_id ?></td>
                            <td><?php echo number_format($item->total_price, 0, ',', '.') ?> VND</td>
                            <td width="140"><a href="#" style="margin-top:0;" class="btn btn-default">DOWNLOAD</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</section>
<script>
    $(document).ready(function() {
        $("#updateSale").validate({
            rules: {
                user_name: {
                    required: true
                },
                user_username: {
                    required: true,
                    remote: {
                        url: '/profile/check_username',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            site_name: function () {
                                return $('#updateSale :input[name="user_username"]').val();
                            }
                        }
                    }
                },
                user_email: {
                    required: true,
                    email: true
                },
                user_phone: {
                    required: true
                }
            },
            messages: {
                user_name: {
                    required: "Vui lòng nhập tên"
                },
                user_username: {
                    required: "Điền tên đăng nhập",
                    remote: "Tên đăng nhập này đã tồn tại"
                },
                user_email: {
                    required: "Vui lòng nhập email",
                    email: "Thiếu @ hoặc không đúng định dạng email"
                },
                user_phone: {
                    required: "Vui lòng nhập số điện thoại"
                }
            }
        });
    });
</script>

