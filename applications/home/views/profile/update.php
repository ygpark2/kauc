
<script type="text/javascript">

Ext.fly('profile_update_btn').on('click', function(e, t) {
	var birth_date = Ext.fly('birth_year').getValue() + '-' + Ext.fly('birth_month').getValue() + '-' + Ext.fly('birth_day').getValue()
	var params = { id : <?PHP echo $id; ?>,
					user_id : <?PHP echo $user_id; ?>,
					name : Ext.fly('name').getValue(),
					mobile : Ext.fly('mobile').getValue(),
					phone : Ext.fly('phone').getValue(),
					birth : birth_date,
					twitter_id : Ext.fly('twitter').getValue(),
					facebook_id : Ext.fly('facebook').getValue(),
					occupation : Ext.fly('occupation').getValue(),
					website : Ext.fly('url').getValue(),
					introduction : Ext.fly('introduction').getValue() };
	// Ext.apply(params, getLatLng(marker));
	Ext.Ajax.request({
		method: 'POST',
		params: params,
	   	url: 'index.php/profile/update',
	   	success: function(response, opts) {
	      	alert(response.responseText);
	      	Ext.fly('member_login').load({url: url_prefix + 'index.php/profile/login_menu'});
	   	},
	   	failure: function(response, opts) {
	      	console.log('server-side failure with status code ' + response.status);
	   	}
	});
});
</script>

<!-- Profile -->
<h1>사용자 정보</h1>
<form id="form1">
	<fieldset>
		<legend>사용자 정보 듬록</legend>
		<p>
			<label class="grey" for="name">이름 : </label>
			<input type="text" id="name" size="15" value="<?php echo $name; ?>" />
	
			<label class="grey" for="mobile">핸드폰 : </label>
			<input type="text" id="mobile" size="15" value="<?php echo $mobile; ?>" />
		</p>
		<p>
			<label class="grey" for="phone">전화 : </label>
			<input type="text" id="phone" size="15" value="<?php echo $phone; ?>" />
	
			<label class="grey" for="birth">생 일 : </label>
			<select id='birth_year'>
				<?php 
				for ($start_year = 1960; $start_year < 2011; $start_year++) {
					echo "<option value='" . $start_year . "'>" . $start_year . "</option>";
				}
				?>
			</select>년 
			<select id='birth_month'>
				<?php 
				for ($start_month = 1; $start_month <= 12; $start_month++) {
					echo "<option value='" . $start_month . "'>" . $start_month . "</option>";
				}
				?>
			</select>월 
			<select id='birth_day'>
				<?php 
				for ($start_day = 1; $start_day <= 31; $start_day++) {
					echo "<option value='" . $start_day . "'>" . $start_day . "</option>";
				}
				?>
			</select>일 
		</p>
		<p>
			<label class="grey" for="twitter">트위터 아이디 : </label>
			<input type="text" id="twitter" size="15" value="<?php echo $twitter_id; ?>" />
	
			<label class="grey" for="facebook">페이스북 아이디 : </label>
			<input type="text" id="facebook" size="15" value="<?php echo $facebook_id; ?>" />
		</p>
		<p>
			<label class="grey" for="occupation">직업 : </label>
			<input type="text" id="occupation" size="30" value="<?php echo $occupation; ?>" />
		</p>
		<p>
			<label class="grey" for="url">홈 페이지 : </label>
			<input type="text" id="url" size="60" value="<?php echo $website; ?>" />
		</p>
		<p>
			<label class="grey" for="introduction">소개 : </label>
			<textarea id="introduction" cols="65" rows="7"><?php echo $introduction; ?></textarea>
		</p>
		<div class="clear"></div>
		<p class="submit" style="padding-left: 450px;"><input id="profile_update_btn" type="button" value="저장" /></p>
	</fieldset>
</form>
</div>
