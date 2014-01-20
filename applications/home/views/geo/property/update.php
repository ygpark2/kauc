
<input type="hidden" id="property_id" value="<?php echo $id ?>" />
<div class='form' style="width: 480px">
	<p>
		<label for="name">제목 : </label>
		<input type="text" id="property_title" value="<?php echo $title ?>" size="60" />
	</p>
	<p>
		<label for="email">이메일 : </label>
		<input type="text" id="property_email" value="<?php echo $email ?>" size="60" />
	</p>
	<p>
		<label for="web">웹 사이트 : </label>
		<input type="text" id="property_url" value="<?php echo $url ?>" size="50" />
	</p>
	<p>
		<label for="web">전화 : </label>
		<input type="text" id="property_phone" value="<?php echo $phone ?>" size="50" />
	</p>
	<p>
		<label for="web">판매 형태 : </label>
		<?php echo form_dropdown('type', $type_options, $type); ?>
	</p>
	<p>
		<label for="web">가격 : </label>
		<input type="text" id="property_price" value="<?php echo $price ?>" size="30" />
		<input type="text" id="property_price_unit" value="<?php echo $price_unit ?>" size="20" />
	</p>
	<p>
		<label for="message">업체 정보</label>
		<textarea id="property_content" cols="55" rows="10"><?php echo $content ?></textarea>
	</p>
	<p class="submit" style="padding-left: 450px;"><input id="update_btn" type="button" value="저장" /></p>
</div>