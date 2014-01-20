<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  	<title>kauc.net 해외 한인 커뮤니티</title>
  	<meta name="description" content="korean social network based on the google map" />
  	<meta name="keywords" content="google, map, Australia, korea, korean" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

	<!-- stylesheets -->

  	<link rel="stylesheet" href="/kauc/resources/css/style.css" type="text/css" media="screen" />

	<script type="text/javascript" src="/kauc/resources/js/ext-core-debug.js"></script>
	<script type="text/javascript" src="/kauc/resources/js/variables.js"></script>
    <script type="text/javascript" src="/kauc/resources/js/common_functions.js"></script>

    <script type="text/javascript">
		// google.load("ext-core", "3.1.0");
		// google.load('maps', '3', {other_params: 'sensor=false' });
        Ext.onReady(function() {

            var category_list_id = 'category_list';
        	console.log( Ext.fly(category_list_id).last() );
        	
        	Ext.fly('root_category').on('change', function(e, t) {
        		// console.log(this);
        		create_subcategory(category_list_id, e.target.value, 1);
			});

			Ext.fly('register_btn').on('click', function(e, t) {

				var parent_id = Ext.fly(category_list_id).last().getValue();
				if ( parent_id < 1 ) {
					alert( '마지막 카테고리를 선택해 주세요 !' );
				} else {
					Ext.Ajax.request({
						method: 'POST',
						params: {name : Ext.fly('category_name').getValue(), description : Ext.fly('category_description').getValue(), parent_id : parent_id},
					   	url: url_prefix + 'index.php/category/create',
					   	success: function(response, opts) {
					      	var obj = Ext.decode(response.responseText);
							alert(obj);
					   	},
					   	failure: function(response, opts) {
					      	console.log('server-side failure with status code ' + response.status);
					   	}
					});
				}
			});
		});
	</script>
</head>

<body>

<h1>Management Category!</h1>
<div id='category_list'>
<label>root category : </label>
<select name='rootCategory' id='root_category'>
	{rootCategories}
	<option value="{id}">{name}</option>
	{/rootCategories}
</select>
</div>

<p></p>

<div id='register_form'>
	category name : <input type="text" id="category_name" />
	<br />
	category description : <textarea id="category_description" row="30" cols="50"></textarea>
	<input type="button" id="register_btn" value="등록" />
</div>

<p>Page rendered in {elapsed_time} seconds</p>

</body>

</html>