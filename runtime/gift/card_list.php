<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/admin.css";?>" />
	<link rel="shortcut icon" href="favicon.ico" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/systemjs/jquery/jquery-1.9.0.min.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/systemjs/jquery/jquery-migrate-1.1.1.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/runtime/systemjs/artdialog/skins/default.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/runtime/systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/common.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/admin.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/menu.js";?>"></script>
</head>
<body>
	<div class="container">
		<div id="header">
			<div class="logo">
				<a href="<?php echo IUrl::creatUrl("/system/default");?>"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/logo.gif";?>" width="303" height="43" /></a>
			</div>
			<div id="menu">
				<ul name="menu">
				</ul>
			</div>
			<p><a href="<?php echo IUrl::creatUrl("/systemadmin/logout");?>">退出管理</a> <a href="<?php echo IUrl::creatUrl("/system/default");?>">后台首页</a> <a href="<?php echo IUrl::creatUrl("");?>" target='_blank'>商城首页</a> <span>您好 <label class='bold'><?php echo isset($this->admin['admin_name'])?$this->admin['admin_name']:"";?></label>，当前身份 <label class='bold'><?php echo isset($this->admin['admin_role_name'])?$this->admin['admin_role_name']:"";?></label></span></p>
		</div>
		<div id="info_bar">
			<label class="navindex"><a href="<?php echo IUrl::creatUrl("/system/navigation");?>">快速导航管理</a></label>
			<span class="nav_sec">
			<?php $adminId = $this->admin['admin_id']?>
			<?php $query = new IQuery("quick_naviga");$query->where = "admin_id = $adminId and is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
			<a href="<?php echo isset($item['url'])?$item['url']:"";?>" class="selected"><?php echo isset($item['naviga_name'])?$item['naviga_name']:"";?></a>
			<?php }?>
			</span>
		</div>

		<div id="admin_left">
			<ul class="submenu"></ul>
			<div id="copyright"></div>
		</div>

		<div id="admin_right">
			<div class="headbar">
	<div class="position"><span>商品</span><span>></span><span>礼卡</span><span>></span><span>礼卡</span></div>
	<div class="operating">
		
		<a href="javascript:;"><button class="operating_btn" type="button" onclick="window.location='<?php echo IUrl::creatUrl("/gift/card_edit");?>'"><span class="addition">添加礼册</span></button></a>
		<a href="javascript:void(0)" onclick="selectAll('id[]')"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
	</div>
	
	<div class="field">
		<table class="list_table">
			<col width="40px" />
			<col width="100px" />
			<col width="100px" />
			<col width="70px" />
			<col width="70px" />
			<col width="70px" />
			<col width="70px" />
			<col width="80px" />
			<col width="70px" />
			<col width="300px" />
			<col  width="70px" />
			<thead>
				<tr role="head" class="flush_left th_c">
					<th>选择</th>
					<th>礼卡账号</th>
					<th>创建时间</th>
                                                                        <th>使用时间</th>
					<th>有效期</th>
					<th>礼卡状态</th>
					<th>礼册名称</th>
                                                                        <th>说明</th>
					<th>操作</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<form action="" method="post" name="orderForm">
	<div class="content">
		<table class="list_table">
			<col width="40px" />
			<col width="100px" />
			<col width="100px" />
			<col width="70px" />
			<col width="70px" />
			<col width="70px" />
			<col width="70px" />
			<col width="80px" />
			<col width="70px" />
			<col width="300px" />
			<col  width="70px"/>
			<tbody>
			          <?php $page= (isset($_GET['page'])&&(intval($_GET['page'])>0))?intval($_GET['page']):1;?>
                                                        <?php $card_list = new IQuery("gift_card as gift_card");$card_list->join = "left join volumes as volumes on gift_card.volume_id = volumes.id";$card_list->distinct = "volumes.id";$card_list->fields = "gift_card.id,gift_card.no,gift_card.expire,gift_card.is_used,gift_card.create_time,gift_card.use_time,gift_card.message,volumes.title";$card_list->page = "$page";$card_list->order = "id desc";$items = $card_list->find(); foreach($items as $key => $item){?>
				<tr class="flush_left td_c">
					<td><input name="id[]" type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" /></td>
					<td><a href="<?php echo IUrl::creatUrl("/site/card/id/$item[id]");?>" target="_blank" title="<?php echo isset($item['name'])?$item['name']:"";?>"><?php echo isset($item['no'])?$item['no']:"";?></a></td>
					<td><?php  echo date('Y-m-d H:i:s', $item['create_time'] );   ?></td>
                                                                        <td> <?php     if($item['is_used']==1)    echo date('Y-m-d H:i:s', $item['use_time'] );   ?></td>    
                                                                        <td><?php echo isset($item['expire'])?$item['expire']:"";?>月</td>
                                                                        <td><?php echo $item['is_used']==0?'未使用':'已使用';?></td>
                                                                        <td><?php echo isset($item['title'])?$item['title']:"";?></td>
                                                                        <td><?php echo isset($item['message'])?$item['message']:"";?></td>
					<td>
						<a href="<?php echo IUrl::creatUrl("/gift/card_edit/id/$item[id]");?>"><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_edit.gif";?>" alt="编辑" /></a>
                                                                                       <a href="javascript:void(0)" onclick="delModel({link:'<?php echo IUrl::creatUrl("/gift/card_del/id/$item[id]");?>'})" ><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" /></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</form>

<?php echo $card_list->getPageBar();?>

<script type="text/javascript">
    

//排序
function toSort(id)
{
	if(id!='')
	{
		var va = $('#s'+id).val();
		var part = /^\d+$/i;
		if(va!='' && va!=undefined && part.test(va))
		{
			$.get("<?php echo IUrl::creatUrl("/gift/gift_sort");?>",{'id':id,'sort':va}, function(data)
			{
				if(data=='1')
				{
					alert('修改商品排序成功!');
				}else
				{
					alert('修改商品排序错误!');
				}
			});
		}
	}
}
function gift_del()
{
	var flag = 0;
	$('input:checkbox[name="id[]"]:checked').each(
		function(i)
		{
			flag = 1;
		}
	);
	if(flag == 0 )
	{
		alert('请选择要删除的数据');
		return false;
	}
	$("form[name='orderForm']").attr('action','<?php echo IUrl::creatUrl("/gift/gift_del");?>');
	confirm('确定要删除所选中的信息吗？','formSubmit(\'orderForm\')');
}
//上下架操作
function gift_stats(type)
{
	if($('input:checkbox[name="id[]"]:checked').length > 0)
	{
		$("form[name='orderForm']").attr('action','<?php echo IUrl::creatUrl("/gift/gift_stats/type/");?>'+type);
		confirm('确定将选中的商品进行操作吗？',"formSubmit('orderForm')");
	}
	else
	{
		alert('请选择要操作的商品!');
		return false;
	}
}
</script>

		</div>
		<div id="separator"></div>
	</div>

	<script type='text/javascript'>
		//DOM加载完毕执行
		$(function(){
			//隔行换色
			$(".list_table tr:nth-child(even)").addClass('even');
			$(".list_table tr").hover(
				function () {
					$(this).addClass("sel");
				},
				function () {
					$(this).removeClass("sel");
				}
			);

			//后台菜单创建
			<?php $menu = new Menu();?>
			var data = <?php echo $menu->submenu();?>;
			var current = '<?php echo $menu->current;?>';
			var url='<?php echo IUrl::creatUrl("/");?>';
			initMenu(data,current,url);
		});
	</script>
</body>
</html>
