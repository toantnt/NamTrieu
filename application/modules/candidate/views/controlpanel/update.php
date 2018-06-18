<div class="row">
    <div class="col-lg-12">
		<div class="box box-default">
			<div class="box-heading"></div>
			<div class="box-body">
				<form id="formMember" method="post" class="form-horizontal" name="form1" action="<?php echo site_url("member/controlpanel/save") ?>" accept-charset="utf-8">
				    
					    <input type="hidden" name="id" value="<?php echo $id ?>" />
					    <div class="form-group">
					        <label class="label-control col-lg-2">Name/Surname</label>
							<div class="col-lg-4">
					        	<input class="form-control" name="member_name" value="<?php echo $member->member_name ?>" type="text" />
					        </div>
					        <label class="control-label col-lg-2">Account login</label>
							<div class="col-lg-4">
								<input class="form-control" name="member_nicename" value="<?php echo $member->member_nicename ?>" type="text" />
							</div>
						</div>
					    <div class="form-group">
					        <label class="label-control col-lg-2">Phone number</label>
							<div class="col-lg-4">
						        <input class="form-control" name="member_phone" value="<?php echo $member->member_phone ?>" type="text" />
						   	</div>
					        <label class="control-label col-lg-2">Email</label>
					        <div class="col-lg-4">
								<input type="email" name="member_email" value="<?php echo $member->member_email ?>" class="form-control" />
							</div>
						</div>
					    <div class="form-group">
					        <label class="label-control col-lg-2">Password</label>
					        <div class="col-lg-4">
								<input class="form-control" name="member_password" type="password" />
								<br />
								<button class="btn btn-default btn-flat" type="button" onclick="return randomString();">Random password</button>
								<span class="showPass hidden"></span>
							</div>
							
					        <label class="control-label col-lg-2">Status</label>
					        <div class="col-lg-4">
								<select class="form-control" name="member_status">
								    
								    <option value="1" <?php echo ($member->member_status == 1 ? "selected='selected'" : "") ?>>Active</option>
								    <option value="2" <?php echo ($member->member_status == 0 ? "selected='selected'" : "") ?>>Banner</option>
								</select>
							</div>
					    </div>
						<div class="form-group">
						    <label class="label-control col-lg-2">Address</label>
							<div class="col-lg-4">
								<input type="text" name="member_address" value="<?php echo $member->member_address ?>" class="form-control" />
							</div>
							<label class="control-label col-lg-1">State</label>
							<div class="col-lg-2">
								<input type="text" name="member_state" value="<?php echo $member->member_state ?>" class="form-control" />
							</div>
							<label class="control-label col-lg-1">Zipcode</label>
							<div class="col-lg-2">
								<input type="text" name="member_postal_code" value="<?php echo $member->member_postal_code ?>" class="form-control" />
							</div>
						</div>
						<div class="form-group">
						    <label class="label-control col-lg-2">Country</label>
							<div class="col-lg-4">
								<input type="text" name="member_national" value="<?php echo $member->member_national ?>" class="form-control" />
							</div>
							<label class="control-label col-lg-1">Birthday</label>
							<div class="col-lg-2">
								<input type="text" name="member_birth" value="<?php echo date('d-m-Y', strtotime($member->member_birth)) ?>" class="form-control" placeholder="dd-mm-yyyy" />
							</div>
						</div>
					    <div class="form-group">
							<div class="col-lg-2 col-md-2 hidden-xs hidden-sm"></div>
							<div class="col-lg-10">
						        <input type="submit" name="submit" class="btn btn-primary btn-flat" value="Update" />
						        <a href="<?php echo site_url('member/controlpanel'); ?>" title="Về trang quản lý" class="btn btn-default btn-flat">&larr; Back to member</a>
					    	</div>
					    </div>
					</form>
				
			</div>
		</div>
		
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
        document.form1.member_password.value = randomstring;
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
                url: site_url + '/admin/user/member_status',
                data: {
                    member_id: id,
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
