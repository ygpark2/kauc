<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title> 새로운 패스워드 생성하기 <?php echo $site_name; ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Create a new password</h2>
패스워드를 잊어버리셨나요?.<br />
새로운 패스워드를 생성하기 위해서는 아래 링크를 따라가주세요:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;">새로운 패스워드 생성하기</a></b></big><br />
<br />
링크가 클릭이 되지 않을 경우, 아래 주소를 복사하셔서 웹 브라우저 주소창에 붙여넣기 하신 후 접속해 주세요:<br />
<nobr><a href="<?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?></a></nobr><br />
<br />
<br />
<a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a> 의 사용자에 의해서 이 메일은 발송 요청 되었습니다. 
이 메일은 새로운 패스워드를 생성하기 위한 절차입니다. 만약 새로운 패스워드를 생성하기를 원하지 않으신다면 이 메일을 무시하시고, 기존의 패스워드를 그대로 사용하시면 됩니다. 
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