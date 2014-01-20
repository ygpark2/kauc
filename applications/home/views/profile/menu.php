
<?php if ($profile_registered) { ?>
	
	<!-- Profile -->
	<h1>사용자 정보</h1>
	<p>
		이름 : <?php echo $result->name; ?>
	</p>
	<p>
		휴대폰 : <?php echo $result->mobile; ?>
	</p>
	<p>
		전화 : <?php echo $result->phone; ?>
	</p>
	<p>
		생일 : <?php echo $result->birth; ?>
	</p>
	<p>
		직업 : <?php echo $result->occupation; ?>
	</p>
	<p>
		트워터 아이디 : <?php echo $result->twitter_id; ?>
	</p>
	<p>
		페이스북 아이디 : <?php echo $result->facebook_id; ?>
	</p>

<?php } else { ?>

<h1>사용자 정보</h1>
<p>
	사용자 정보가 아직 등록되지 않았습니다.
</p>
<?php } ?>

<div class="clear"></div>
<p style='text-align: right;'>
	<?php echo anchor($profile_link, $profile_label, array('title' => $profile_label, 'class' => 'user_info')); ?>
</p>