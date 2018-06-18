<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8" />

  <title>Nam Triều Webiste</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>

<div>
<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;margin-bottom: 25px">Xin chào <?php echo $member_name;?>,</p>

<p>Chúng tôi gửi thông tin tài khoản đăng nhập vào webiste tới bạn:</p>
<div class="col-md-5">
	<div class="col-md-5">
		<p style="color: blue">Tên đăng nhập: <?php echo $member_username;?></p>
	</div>
	
</div>
<div class="col-md-5">
	<p style="color: blue">Mật khẩu: <?php echo $member_password;?></p>
</div>
<div class="col-md-5">
	<p style="color: blue">Vui lòng click vào link dưới đây để đăng nhập: </p>
	<a href='http://namtrieu.tn'>http://namtrieu.tn</a>
</div>
<p style="margin-top: 25px;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;margin-bottom: 25px"> Thanks & Regards </p>

</div>

</body>

</html>