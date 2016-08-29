<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="javascript:void(0);">路由列表</a></li>
	</ul>
	<div class="row-fluid" style="margin-top: 100px;">
		<div class="span5" style="text-align: right;">
			<select id="program" size="20" multiple="multiple" style="height: auto;width: 50%;">
				<foreach name="program" item="value">
					<option value="{$value}">{$value}</option>
				</foreach>
			</select>
		</div>
		<div class="span2" style="text-align: center;">
			<br><br>
			<a class="btn btn-success btn-assign" href="javascript:add();" title="添加" data-target="program">&gt;&gt;
				<i class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display: none;"></i></a><br><br>
			<a class="btn btn-danger btn-assign" href="javascript:remove();" title="移除" data-target="database">&lt;&lt;
				<i class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display: none;"></i></a></div>
		<div class="span5" style="text-align: left;">
			<select id="database" size="20" multiple="multiple" style="height: auto;width: 50%;">
				<foreach name="database" item="value">
					<option value="{$value['id']}">{$value['route']}</option>
				</foreach>
			</select>
		</div>
	</div>
</div>
<script type="text/javascript">
	function add() {
		var data = $('#program').val();
		$.ajax({
			type: "Post",
			url: "{:U('/Admin/Route/add')}",
			data: {routes: data},
			dataType: "json",
			success: function (data) {
				refresh();
			}
		});

	}
	function remove() {
		var data = $('#database').val();
		$.ajax({
			type: "Post",
			url: "{:U('/Admin/Route/del')}",
			data: {id: data},
			dataType: "json",
			success: function (data) {
				refresh();
			}
		});
	}
	function refresh() {
		$.ajax({
			type: "Post",
			url: "{:U('/Admin/Route/refresh')}",
			dataType: "json",
			success: function (data) {
				var database = '';
				for (var i = 0; i < data['info']['database'].length; i++) {
					database += '<option value="' + data['info']['database'][i]['id'] + '">' + data['info']['database'][i]['route'] + '</option>'
				}
				$('#database').html(database);
				var program = '';
				for (var i = 0; i < data['info']['program'].length; i++) {
					program += '<option value="' + data['info']['program'][i] + '">' + data['info']['program'][i] + '</option>';
				}
				$('#program').html(program);
			}
		});
	}
</script>