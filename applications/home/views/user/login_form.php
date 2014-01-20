<!-- Login Form -->
<h1>로그인</h1>
<p>
	<label class="grey" for="log">Username : </label>
	<input class="field" type="text" name="log" id="log" value="" size="23" />
</p>
<p>
	<label class="grey" for="pwd">Password : </label>
	<input class="field" type="password" name="pwd" id="pwd" size="23" />
</p>
<div style="float: right;">
	<input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me
</div>
<div class="clear"></div>
<a id="lost-pwd-link" class="lost-pwd" href="#">Lost your password?</a>
<div style="float: right;">
	<input id="login_btn" type="submit" name="submit" value="로그인" class="bt_login" />
</div>
<div class="clear"></div>
<div id="lost-pwd-div" style="display: none">
	<label class="grey" for="login">이메일 또는 아이디 : </label>
	<input class="field" type="text" name="login" value="" id="login" maxlength="80" size="30" />
	<div style="float: right;">
		<input type="submit" name="reset" value="찾기" class="bt_login" />
	</div>
</div>