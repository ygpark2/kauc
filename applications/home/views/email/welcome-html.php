<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title> <?php echo $site_name; ?> 한인 커뮤니티 사이트 !</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"> 환영합니다 <?php echo $site_name; ?>!</h2>
 <?php echo $site_name; ?>에 회원가입을 감사드립니다. <br />
 <?php echo $site_name; ?> 사이트에 접속하기 위해서는 아래 링크를 클릭해주세요 : <br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/login/'); ?>" style="color: #3366cc;"> 사이트 방문하기 <?php echo $site_name; ?>!</a></b></big><br />
<br />
링크가 작동하지 않을 경우 아래 링크를 복사하셔서 브라우저 주소창에 붙혀넣기 해 주세요 : <br />
<nobr><a href="<?php echo site_url('/auth/login/'); ?>" style="color: #3366cc;"><?php echo site_url('/auth/login/'); ?></a></nobr><br />
<br />
<br />
<?php if (strlen($username) > 0) { ?>아이디 : <?php echo $username; ?><br /><?php } ?>
이메일 : <?php echo $email; ?><br />
<?php /* Your password: <?php echo $password; ?><br /> */ ?>
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