<div class="row">
    <div class="col-md-5">
        <form id="formMember" method="post" name="form1" action="<?php echo site_url("admin/user/save") ?>" accept-charset="utf-8">
            <?php if ($member == NULL) { ?>
                <div class="form-group">
                    <label>First name</label>
                    <input class="form-control" name="user_firstname" type="text" />
                </div>
                <div class="form-group">
                    <label>Last name</label>
                    <input class="form-control" name="user_lastname" type="text" />
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" name="user_username" type="text" />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="user_email" required="required" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="user_password" type="password" />
                    <br>
                    <button class="btn btn-default btn-flat" type="button" onclick="return randomString();">Random password</button>
                    <span class="showPass hidden"></span>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="user_role">
                        <option value="1">Super admin</option>
                        <option value="2">Manager</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('admin/user'); ?>" title="Về trang quản lý" class="btn btn-default">&larr; Back to users</a>
                </div>
            <?php } else { ?>
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <div class="form-group">
                    <label>First name</label>
                    <input class="form-control" name="user_firstname" value="<?php echo $member->user_firstname ?>" type="text" />
                </div>
                <div class="form-group">
                    <label>Last name</label>
                    <input class="form-control" name="user_lastname" value="<?php echo $member->user_lastname ?>" type="text" />
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" name="user_username" required="required" value="<?php echo $member->user_username ?>" type="text" />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="user_email" value="<?php echo $member->user_email ?>" required="required" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="user_password" type="password" />
                    <br>
                    <button class="btn btn-default btn-flat" type="button" onclick="return randomString();">Random password</button>
                    <span class="showPass hidden"></span>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role_id">
                        
                        <option value="1" <?php echo ($member->user_role == 1 ? "selected='selected'" : "") ?>>Super admin</option>
                        <option value="2" <?php echo ($member->user_role == 2 ? "selected='selected'" : "") ?>>Manager</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    <a href="<?php echo site_url('admin/user'); ?>" title="Về trang quản lý" class="btn btn-default">&larr; Back to users</a>
                </div>
            <?php } ?>
        </form>
    </div>
</div>
<script type="text/javascript">
    function randomString() {
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
        var string_length = 8;
        var randomstring = '';
        for (var i = 0; i < string_length; i++) {
            var rnum = Math.floor(Math.random() * chars.length);
            randomstring += chars.substring(rnum, rnum + 1);
        }
        document.form1.user_password.value = randomstring;
        $(".showPass").removeClass('hidden');
        $(".showPass").text(randomstring);
    }
    var site_url = location.protocol + '//' + location.host;
    $(document).ready(function() {
        $("#wrapper").on("click", "#statusChange", function() {
           var id = $(this).attr("data-id");
           var status = $(this).attr("data-value");
           $.ajax({
                type: 'POST',
                url: site_url + '/admin/user/user_status',
                data: {
                    user_id: id,
                    status: status
                },
                success: function(res) {
                    var data = '' + res + '',
                    json = JSON.parse(data);
                    if (json['success']) {
                        showalert(json['message']);
                        setTimeout(function () {
                            hiddenalert();
                        }, 1500);
                        $.ajax({
                            type: 'post',
                            url: site_url + '/' + json['url'],
                            data: {},
                            success: function (res1) {
                                var div = '#tblUsers';
                                reloadPage(res1, div);
                            }
                        });
                    } else {
                        showalertError(json['message']);
                        setTimeout(function () {
                            hiddenalertError();
                        }, 1500);
                        return false;
                    }
                }
            });
        });
    });

</script>
