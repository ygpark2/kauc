<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title> <?php echo $site_name; ?>에 있는 이메일 주소입니다. </title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Your new email address on <?php echo $site_name; ?></h2>
 <?php echo $site_name; ?>에 있는 이메일 주소를 변경하셨습니다.<br />
당신의 새로운 이메일을 확인하기 위해서는 아래 링크를 클릭해주세요 : <br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">새로운 이메일 확인하기</a></b></big><br />
<br />
링크가 작동하지 않을 경우 아래 링크를 복사하셔서 브라우저 주소창에 붙혀넣기 해 주세요 :<br />
<nobr><a href="<?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
<br />
새로운 이메일 주소 : <?php echo $new_email; ?><br />
<br />
<br />
 이 메일은 <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a>의 사용자의 요청에 의하여 발송되었습니다. 
 만약 실수로 이메일을 발송하셨다면, 위 링크를 클릭하지 마세요.
 이 요청은 일정시간 후 자동적으로 시스템에서 삭제되도록 설정되었습니다.<br />
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