<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  	<title>kauc.net 해외 한인 커뮤니티</title>
  	<meta name="description" content="korean social network based on the google map" />
  	<meta name="keywords" content="google, map, Australia, korea, korean" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

	<!-- stylesheets -->

  	<link rel="stylesheet" href="<?php echo $media_url_prefix; ?>css/style.css" type="text/css" media="screen" />

  	<link rel="stylesheet" href="<?php echo $media_url_prefix; ?>css/slide.css" type="text/css" media="screen" />

  	<link rel="stylesheet" href="<?php echo $media_url_prefix; ?>css/tabs.css" type="text/css" media="screen" />

    <link rel="stylesheet" href="<?php echo $media_url_prefix; ?>css/extbox/lightbox/style.css" type="text/css"/>

	<script type="text/javascript" src="<?php echo $media_url_prefix; ?>js/ext-core-debug.js"></script>
	<script type="text/javascript" src="<?php echo $media_url_prefix; ?>js/variables.js"></script>
	<script type="text/javascript" src="<?php echo $media_url_prefix; ?>js/loader.js"></script>
	<script type="text/javascript" src="<?php echo $media_url_prefix; ?>js/ext-core-ux/tabs.js"></script>
    <script type="text/javascript" src="<?php echo $media_url_prefix; ?>js/ext-core-ux/extbox.js"></script>

    <!-- <script type="text/javascript" src="<?php echo $media_url_prefix; ?>js/ext-core-ux/jsonp.js"></script> -->

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 

    <script type="text/javascript">

		// google.load("ext-core", "3.1.0");
		// google.load('maps', '3', {other_params: 'sensor=false' });

		url_prefix = "<?php echo $url_prefix; ?>";
		app_mode = "<?php echo $app_mode; ?>";
		media_url_prefix = "<?php echo $media_url_prefix; ?>";

        Ext.onReady(function() {

			var google_map_utilities = ['markermanager', 'markerclusterer', 'keydragzoom', 'infobubble'];
	   		Ext.each(google_map_utilities, function(js, index) {
	   			google_map_utilities[index] = '<?php echo $media_url_prefix; ?>js/google-maps-utility-library-v3/' + js + '/src/' + js + '_packed.js';
	   		});

	   		var js_files = [ 'botombar', 'login', 'common' ]; // local test
			<?php if ($app_mode === 'production'): ?>
				centerLatLng = new google.maps.LatLng(<?php echo $start_latitude; ?>, <?php echo $start_longitude; ?>);
				js_files.push('google'); // production mode
				js_files.reverse();
			<?php else: ?>
				js_files.reverse();
			<?php endif; ?>

			Ext.each(js_files, function(js, index) {
	   			js_files[index] = '<?php echo $media_url_prefix; ?>js/' + js + '_functions.js';
	   		});

			<?php if ($app_mode === 'production'): ?>
				Ext.Loader.load( google_map_utilities.concat(js_files) );
			<?php else: ?>
				Ext.Loader.load( js_files );
			<?php endif; ?>

			Ext.fly('map_info_window').load(url_prefix + 'index.php/home/gmapInfoWindowForm', {}, function(data) {
				var tabs = new Ext.ux.Tabs('tabs', {width: '95%', height: '95%'});

				<?php if ($app_mode === 'production'): ?>
					gmapInfoWindow.setContent(Ext.fly("map_info_window").child('div', true));
				<?php else: ?>
					Ext.fly('map_info_window').setStyle( 'display', 'block' );
				<?php endif; ?>

				<?php if ($username): ?>
					Ext.Loader.load( media_url_prefix + 'js/gMapInfoWindow_functions.js' );
					create_subcategory('category_list', 0, 1);
				<?php endif; ?>
			});

			/*
			Ext.ux.extbox.register('a[rel^=single]', false, {close: '&#215;', hideInfo: 'auto'});
            Ext.ux.extbox.register('a.grouped', true, {easing: 'elasticOut', resizeDuration: 0.6, current: "{current} of {total}", close: '&#215;'});
            Ext.ux.extbox.register('a[rel^=scaled]', true, {maxWidth: '80%', maxHeight: '80%', overlayOpacity: 0.3, overlayDuration: 0.1, current: "{current} of {total}", close: '&#215;', hideInfo: 'auto'});
            Ext.ux.extbox.register('a.category_update', false, {innerWidth: 520, innerHeight: 420, title: 'Custom title', scale: false, current: "{current} of {total}", close: '&#215;'});
            Ext.ux.extbox.register('a.w3cblog', false, {width: 900, height: 500, iframe: true, title: 'Open <a href="http://www.w3.org/blog/CSS" target="_blank">W3C blog</a> in new window', current: "{current} of {total}", close: '&#215;'});
            Ext.ux.extbox.register('a.flashlink', false, {innerWidth: 520, innerHeight: 420, iframe: true, scale: false, current: "{current} of {total}", close: '&#215;'});
            Ext.ux.extbox.register('a.inline', false, {href: '#inline_example', innerWidth: 520, innerHeight: 420, inline: true, scale: false, current: "{current} of {total}", close: '&#215;', hideInfo: 'auto'}); 
            */

			<?php if ($username) { ?>

			Ext.fly('member_register').load(url_prefix + 'index.php/category/login_menu', {}, function(data) {
				Ext.Loader.load( media_url_prefix + 'js/setting_functions.js' );
			});
			Ext.fly('member_login').load(url_prefix + 'index.php/profile/login_menu');

			usernameTags[0].html = usernameTags[0].html + '<?php echo $username . ' !' ?>';
            Ext.fly('login_username').replaceWith( usernameTags );
			Ext.fly('logout_link').setStyle( 'display', 'block' );

			<?php } else { ?>

			<?php } ?>

	    	Ext.fly('search_results_close_btn').on('click', function(e, t) {
	    		Ext.fly('search_results').slideOut('t', {
		    		duration: .5,
					remove: false,
					useDisplay: false,
				    callback : function() {
				    	// console.log('sdlkfjasldfkjasdf');
					}
				});
	    	});

    		/*
			Ext.Ajax.request({
			   	url: '/kauc/index.php/home/map_info_window',
			   	success: function(response, opts) {
					Ext.fly("map_info_window").update(response.responseText);
			   		var tabs = new Ext.ux.Tabs('tabs');
			   		infowindow.setContent( Ext.getDom("map_info_window") );
			   		Ext.fly("map_info_window").setStyle('display', 'block');
			   	},
			   	failure: function(response, opts) {
			      	console.log('server-side failure with status code ' + response.status);
			   	}
			});
			*/
        })
    </script>
</head>

<body> 

<!-- Panel -->
<div id="top_login_panel">
	<div id="login_panel">
		<div class="content clearfix">
			<div class="left">
				<h1>kauc.net 베타 오픈 !</h1>
				<h2>해외 한인 커뮤니티</h2>		
				<p class="grey">
					<a href="http://www.google.com/chrome/">구글 크롬(google chrome)</a>, <a href="http://www.mozilla.or.kr/ko/">파이어폭스(firefox)</a>, <a href="http://www.mozilla.or.kr/ko/">사파리(safari)</a> 에 최적화 되어있습니다.<br />
					해외 거주 한인들의 소통과 공유를 위한 공간입니다.<br />
					여러분들의 이야기들을 공유해 주세요.
				</p>
				<h2>지도상의 여러분의 위치를 찿아 보세요.</h2>
				<p class="grey">
					내가 사는 주변 한인들이 궁금하세요?
					여러분들 주변 한인들을 쉽게 찾아 볼 수 있습니다.
					
				</p>
				<p class="grey">
					<a href="/kauc/license.txt" rel="lightbox">license</a>
				</p>
			</div>
			<div id="member_register" class="left">
				<!-- Register Form -->
				<h1>회원 가입!</h1>
				<div class='form-req'>
					<label class="grey" for="signup">Username : </label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
				</div>
				<div class='form-req'>
					<label class="grey" for="email">Email : </label>
					<input class="field" type="text" name="email" id="email" size="23" />
				</div>
				<div class='form-req'>
					<label class="grey" for="password">Password : </label>
					<input class="field" type="password" name="password" value="" id="password" maxlength="20" size="30" />
				</div>
				<div class='form-req'>
					<label class="grey" for="confirm_password">Confirm Password : </label>
					<input class="field" type="password" name="confirm_password" value="" id="confirm_password" maxlength="20" size="30" />
				</div>
				<br />
				<div class='form-req'>회원 가입 후 이메일 발송이 됩니다. 이메일을 확인해 주세요..</div>
				<div style="float: right;">
					<input id="register_btn" type="submit" name="submit" value="회원가입" class="bt_register" />
				</div>
			</div>
			<div id="member_login" class="left right">
				<!-- Login Form -->
				<h1>로그인</h1>
				<p>
					<label class="grey" for="geo_login_id">Username : </label>
					<input class="field" type="text" id="geo_login_id" size="23" />
				</p>
				<p>
					<label class="grey" for="geo_login_pwd">Password : </label>
					<input class="field" type="password" id="geo_login_pwd" size="23" />
				</p>
				<div style="float: right;">
            		<input id="remember" type="checkbox" value="1" /> &nbsp;Remember me
            	</div>
    			<div class="clear"></div>
    			<a id="lost-pwd-link" class="lost-pwd" href="#">Lost your password?</a>
    			<div style="float: right;">
					<input id="login_btn" type="submit" name="submit" value="로그인" class="bt_login" />
				</div>
				<div class="clear"></div>
				<div id="lost-pwd-div" style="display: none">
					<label class="grey" for="login">이메일 또는 아이디 : </label>
					<input class="field" type="text" name="login" value="" id="geo_lost_pwd_login_id" maxlength="80" size="30" />
					<div style="float: right;">
						<input id="lost-pwd_btn" type="submit" name="reset" value="찾기" class="bt_login" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab" id="login_tab">
		<ul class="search">
			<li class="left">&nbsp;</li>
			<li>
			  	<div class="search_form"> 
			  		<select id='search_type'>
			  			<option value='map'>지도</option>
			  			<option value='log'>로그</option>
			  			<option value='business'>사업체</option>
			  			<option value='job'>구인/구직</option>
			  			<option value='property'>부동산</option>
			  		</select>
    				<input id="searchTxtBox" class="field" type="textbox" value="Brisbane, QLD" /> 
    				<input id="searchBtn" type="button" value="검색" /> 
  				</div> 
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li id="login_username">
				Hello Guest!
			</li>
			<li id="logout_link" style="display: none;"><?php echo anchor('/auth/logout/', '<b>[로그 아웃]</b>'); ?></li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">로그인 | 회원가입</a>
				<a id="close" style="display: none;" class="close" href="#"> 로그인 창 닫기 </a>
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div>
	<!-- / top -->
</div>
<!--panel -->

	<div id="search_results" style="display: none; width:405px; height:auto; padding:10px; background:#FFFFFF;  
									border:2px solid #BBBBBB; z-index:100">
		<div id="search_result_contents"></div>
		<hr />
		<a id="search_results_close_btn" href="#"> [검색 결과 창 닫기] </a>
	</div> 

<div id="map_canvas"></div>

<div id="map_info_window" style="display: none"></div>

<div id="footpanel">
	<ul id="mainpanel">    	
        <li><a href="#" id="bt_home" class="home">kauc.net <small>kauc.net</small></a></li>
        <li><a href="#" id="bt_profile" class="profile">View Profile <small>View Profile</small></a></li>
        <li><a href="index.php/profile/register/" id="bt_editprofile" class="editprofile">Edit Profile <small>Edit Profile</small></a></li>
        <li><a href="#" id="bt_contacts" class="contacts">Contacts <small>Contacts</small></a></li>

        <li><a href="#" id="bt_messages" class="messages">Messages (10) <small>Messages</small></a></li>
        <li><a href="#" id="bt_playlist" class="playlist">Play List <small>Play List</small></a></li>
        <li><a href="#" id="bt_videos" class="videos">Videos <small>Videos</small></a></li>

		<li> </li>
		<li> </li>
		<li> </li>
		<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <li id="footpanel_board">
            <div id="bt_board_subpanel" style="height: auto; display: none;" class="board_subpanel">
            <h3><span id="bt_board_close_btn"> &#8211; </span>Notifications</h3>
	            <div style="padding: 4px 5px 5px 4px;">
	            <ul style="height: auto;">
	            	<li class="view"><a class="" href="#">View All</a></li>
	            	<li><p><a href="#" class="delete">X</a><a class="" href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a class="" href="#">lobortis facilisis</a>.</p></li>
	
	                <li><<p>a href="#" class="delete">X</a><a class="" href="#">Nonummy</a> nulla eum probo metuo nullus indoles os consequat commoveo <a class="" href="#">lobortis facilisis</a>.</p></li>
	                <li><p><a href="#" class="delete">X</a><a class="" href="#">Tego</a> minim autem aptent et jumentum metuo uxor nibh euismod si <a class="" href="#">lobortis facilisis</a>.</p></li>
	                <li><p><a href="#" class="delete">X</a><a class="" href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a class="" href="#">lobortis facilisis</a>.</p></li>
	
	            </ul>
	            </div>
            </div>
        </li>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		<li> </li>
		<li> </li>
		<li> </li>

        <li id="alertpanel">
        	<a href="#" id="bt_alerts" class="alerts">Alerts</a>

            <div id="bt_alerts_panel" style="height: auto; display: none;" class="subpanel">
            <h3><span id="bt_alerts_close_btn"> &#8211; </span>Notifications</h3>
            <ul style="height: auto;">
            	<li class="view"><a class="" href="#">View All</a></li>
            	<li><a href="#" class="delete">X</a><p><a class="" href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a class="" href="#">lobortis facilisis</a>.</p></li>

                <li><a href="#" class="delete">X</a><p><a class="" href="#">Nonummy</a> nulla eum probo metuo nullus indoles os consequat commoveo <a class="" href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a class="" href="#">Tego</a> minim autem aptent et jumentum metuo uxor nibh euismod si <a class="" href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a class="" href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a class="" href="#">lobortis facilisis</a>.</p></li>

            </ul>
            </div>
        </li>
        <li id="chatpanel">
        	<a href="#" id="bt_bookmark_area" class="chat">All Blacks (<strong>1</strong>) </a>
            <div style="height: 160px; display: none;" class="subpanel">
            <h3><span id="bt_bookmark_area_close_btn"> &#8211; </span>All Blacks</h3>

            <ul style="height: 150px;">
            	<li><span> </span></li>
            	<li><a class="" href="#"><img src="index_files/chat-thumb.gif" alt=""> Your Friend</a></li>
                <li><a class="" href="#"><img src="index_files/chat-thumb.gif" alt=""> Your Friend</a></li>
                <li><a class="" href="#"><img src="index_files/chat-thumb.gif" alt=""> Your Friend</a></li>
            </ul>
            </div>
        </li>
	</ul>
</div>

<!-- Page rendered in {elapsed_time} seconds -->
</body>
</html>