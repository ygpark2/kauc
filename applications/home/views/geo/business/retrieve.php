
<div>
<p> 제목 : <?php echo $title ?></p>
<p> 이메일 : <?php echo $email ?></p>
<p> 웹사이트 : <?php echo $url ?></p>
<p> 전화 : <?php echo $phone ?></p>
<p> 내용 : <?php echo $content ?></p>
<p> 카테고리 : <?php echo $category ?></p>

<?php if ($owner): ?>
	<p> <a id='modify_btn' href="#">[수정]</a>, <a id='delete_btn' href="#">[삭제]</a> </p>
<?php else: ?>
	<!--  -->
<?php endif; ?>

</div>
