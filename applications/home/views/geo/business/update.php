
<input type="hidden" id="business_id" value="<?php echo $id ?>" />
<div class='form'>
	<p>
		<label for="name">제목 : </label>
		<input type="text" name="title" id="business_title" value="<?php echo $title ?>" size="70" />
	</p>
	<p>
		<label for="email">이메일 : </label>
		<input type="text" name="email" id="business_email" value="<?php echo $email ?>" size="70" />
	</p>
	<p>
		<label for="web">웹 사이트 : </label>
		<input type="text" name="url" id="business_url" value="<?php echo $url ?>" size="70" />
	</p>
	<p>
		<label for="web">전화 : </label>
		<input type="text" name="phone" id="business_phone" value="<?php echo $phone ?>" size="70" />
	</p>
	<p>
		<label for="web">카테고리 : </label>
		<div id="category_list"></div>
	</p>
	<p>
		<label for="message">업체 정보</label>
		<textarea name="business_message" id="business_content" cols="45" rows="10"><?php echo $content ?></textarea>
	</p>
	<p class="submit" style="padding-left: 450px;"><input id="update_btn" type="button" value="저장" /></p>
</div>