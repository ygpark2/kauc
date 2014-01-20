<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title> <?php echo $site_name; ?> 회원 가입 확인 메일.!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Welcome to <?php echo $site_name; ?>!</h2>
 <?php echo $site_name; ?>에 회원 가입해 주셔서 감사드립니다. 
 사용자 정보를 안전하게 잘 간직해 주십시오.<br />
 회원 가입 절차를 마무리하기 위해서는 아래 링크를 클릭해 주세요 : <br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">여기를 클릭하시면, 회원 가입이 완료됩니다...</a></b></big><br />
<br />
링크가 작동하지 않을 경우 아래 링크를 복사하셔서 브라우저 주소창에 붙혀넣기 해 주세요 : <br />
<nobr><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
 <?php echo $activation_period; ?> 안에 확인 작업을 해 주세요, 
그렇지 않으면 이 링크는 더 이상 유효하지 않습니다.<br />
<br />
<br />
<?php if (strlen($username) > 0) { ?>사용자 이름 : <?php echo $username; ?><br /><?php } ?>
사용자 이메일 : <?php echo $email; ?><br />
<?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
<br />
<br />
 행복하세요!<br />
 <?php echo $site_name; ?> 개발팀
</td>
</tr>
</table>
</div>
</body>
</html>