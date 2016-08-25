<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="javascript:;">权限设置</a></li>
	</ul>
	<form class="js-ajax-form" action="{:U('Admin/Role/doSetPower')}" method="post">
		<div class="table_full">
			<table width="100%" cellspacing="0" id="dnd-example">
				<tbody>
				<foreach name="ruleList" item="value">
					<tr id="node-{$value['id']}" <?=empty($value['parent_id'])?'':'class="child-of-node-'.$value['parent_id'].'"'?>>
						<td style="padding-left:30px;">
							<?=str_repeat("&nbsp;&nbsp;&nbsp;│",$value['level']-2).str_repeat("&nbsp;&nbsp;&nbsp;├─&nbsp;",$value['level']>1?1:0);?>
							<?php $power = $value['route'] ;?>
							<input type="checkbox" name="power[]" value="{$power}" level="{$value['level']-1}" <?= (stripos($roleData['power'],$power) === false)?'':'checked';?>>
							{$value['menu_name']}
						</td>
					</tr>
				</foreach>
				</tbody>
			</table>
		</div>
		<div class="form-actions">
			<input type="hidden" name="id" value="{$roleData['id']}"/>
			<button class="btn btn-primary js-ajax-submit" type="submit">保存</button>
			<a class="btn" href="{:U('Admin/Role/list')}">返回</a>
		</div>
	</form>
</div>
<script type="text/javascript">


	$(document).ready(function () {
		Wind.css('treeTable');
		Wind.use('treeTable', function () {
			$("#dnd-example").treeTable({
				indent: 20
			});
		});
	});

	$('.table_full tbody tr input').on('click',function(){
		var obj = this;
		var chk = $("input[type='checkbox']");
		var count = chk.length;
		var num = chk.index(obj);
		var level_top = level_bottom = chk.eq(num).attr('level');
		for (var i = num; i >= 0; i--) {
			var le = chk.eq(i).attr('level');
			if (eval(le) < eval(level_top)) {
				chk.eq(i).attr("checked", true);
				var level_top = level_top - 1;
			}
		}
		for (var j = num + 1; j < count; j++) {
			var le = chk.eq(j).attr('level');
			if (chk.eq(num).attr("checked") == "checked") {
				if (eval(le) > eval(level_bottom)) {
					chk.eq(j).attr("checked", true);
				}
				else if (eval(le) == eval(level_bottom)) {
					break;
				}
			} else {
				if (eval(le) > eval(level_bottom)) {
					chk.eq(j).attr("checked", false);
				} else if (eval(le) == eval(level_bottom)) {
					break;
				}
			}
		}
	});
</script>