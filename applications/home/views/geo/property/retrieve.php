<?php 
$sale_type = array("렌트(임대)-weekly(주당)", "렌트(임대)-monthly(월당)", "매매", "전세");
?>

<div>
<p> 제목 : <?php echo $title ?></p>
<p> 이메일 : <?php echo $email ?></p>
<p> 웹사이트 : <?php echo $url ?></p>
<p> 전화 : <?php echo $phone ?></p>
<p> 판매 형태 : <?php echo $sale_type[$type+1] ?></p>
<p> 가격 : <?php echo $price ?></p>
<p> 가격 단위 : <?php echo $price_unit ?></p>
<p> 내용 : <?php echo $content ?></p>

<?php if ($owner): ?>
	<p> <a id='modify_btn' href="#">[수정]</a>, <a id='delete_btn' href="#">[삭제]</a> </p>
<?php else: ?>
	<!--  -->
<?php endif; ?>

</div>
