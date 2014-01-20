
<input type="hidden" id="job_id" value="<?php echo $id ?>" />
<div class='form'>
	<p>
		<label for="name">제목 : </label>
		<input type="text" id="job_title" value="<?php echo $title ?>" size="70" />
	</p>
	<p>
		<label for="email">이메일 : </label>
		<input type="text" id="job_email" value="<?php echo $email ?>" size="70" />
	</p>
	<p>
		<label for="web">웹 사이트 : </label>
		<input type="text" id="job_url" value="<?php echo $url ?>" size="70" />
	</p>
	<p>
		<label for="web">전화 : </label>
		<input type="text" id="job_phone" value="<?php echo $phone ?>" size="70" />
	</p>
	<p>
		<label for="web">태그 : </label>
		<input type="text" id="job_tag" value="<?php echo $tag ?>" size="70" />
	</p>
	<p>
		<label for="message">구인/구직 상세 내역</label>
		<textarea id="job_content" cols="45" rows="10"><?php echo $content ?></textarea>
	</p>
	<p class="submit" style="padding-left: 450px;"><input id="update_btn" type="button" value="저장" /></p>
</div>