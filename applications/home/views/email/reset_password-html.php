<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title> 새로운 패스워드가 설정 되었습니다. <?php echo $site_name; ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"><?php echo $site_name; ?>의 새로운 패스워드</h2>
패스워드가 변경되었습니다.<br />
패스워드를 잘 간직해 주십시오.<br />
<br />
<?php if (strlen($username) > 0) { ?>아이디 : <?php echo $username; ?><br /><?php } ?>
이메일 주소 : <?php echo $email; ?><br />
<?php /* Your new password: <?php echo $new_password; ?><br /> */ ?>
<br />
<br />
감사합니다,<br />
 <?php echo $site_name; ?> 개발팀
</td>
</tr>
</table>
</div>
</body>
</html>