<!-- 
<script type="text/javascript" src="/kauc/resources/js/ext-core-debug.js"></script>
<script type="text/javascript" src="/kauc/resources/js/variables.js"></script>
<script type="text/javascript">
Ext.onReady(function() {
	Ext.fly('update_btn').on('click', function(e, t) {
		var params = { title : Ext.fly('log_title').getValue(),
						content : Ext.fly('log_content').getValue(),
						tags : Ext.fly('log_tag').getValue() };
		Ext.Ajax.request({
			method: 'POST',
			params: params,
		   	url: url_prefix + 'index.php/geo/log/update?id=' + '<?php echo $id; ?>',
		   	success: function(response, opts) {
		      	alert(response.responseText);
		   	},
		   	failure: function(response, opts) {
		      	console.log('server-side failure with status code ' + response.status);
		   	}
		});
	});
});
</script>
 -->

<div>
<input type="hidden" id="log_id" value="<?php echo $id ?>" />
<p> 제목 : <input type="text" id="log_title" value="<?php echo $title ?>" /></p>
<p> 본문 : <textarea id="log_content" rows="10" cols="50"><?php echo $content ?></textarea></p>
<p> 태그 : <input type="text" id="log_tag" value="<?php echo $tag ?>" /></p>
<p class="submit" style="padding-left: 450px;"><input id="update_btn" type="button" value="저장" /></p>
</div>
