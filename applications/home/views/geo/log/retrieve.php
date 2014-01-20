
<div>
<p> 제목 : <?php echo $title ?></p>
<p> 본문 : <?php echo $content ?></p>
<p> 태그 : <?php echo $tag ?></p>

<?php if ($owner): ?>
	<p> <a id='modify_btn' href="#">[수정]</a>, <a id='delete_btn' href="#">[삭제]</a> </p>
<?php else: ?>
	<!--  -->
<?php endif; ?>

</div>
