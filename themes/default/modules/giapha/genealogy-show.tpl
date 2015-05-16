<!-- BEGIN: tree -->
<li>
	<span {DIRTREE.class} id="iduser_{DIRTREE.id}">{DIRTREE.full_name}</span>
	<!-- BEGIN: wife -->
	- <span {WIFE.class} id="iduser_{WIFE.id}">{WIFE.full_name}</span>
	<!-- END: wife -->
	<!-- BEGIN: tree_content -->
	<ul>
		<!-- BEGIN: loop -->
		{TREE_CONTENT} <!-- END: loop -->
	</ul>
	<!-- END: tree_content -->
</li>
<!-- END: tree -->
<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.dialog.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/jquery/jquery.treeview.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}js/jquery/jquery.treeview.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.dialog.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/contextmenu/jquery.contextmenu.r2.js"></script>
<div id="module_show_list">
	<center>
		<b>Hu?ng d?n:</b><i>Click chu?t ph?i l�n t?ng th�nh vi�n d? c� th? c?p nh?t ho?c th�m m?i v? con.</i>
	</center>
	<br>
	<!-- BEGIN: foldertree -->
	<ul id="foldertree" class="filetree">
		{DATATREE}
	</ul>
	<!-- END: foldertree -->
	<div class="contextMenu" id="menu_genealogy_show">
		<ul>
			<li id="news1">
				<img src="{NV_BASE_SITEURL}js/contextmenu/icons/copy.png" /> Th�m Con
			</li>
			<li id="news2">
				<img src="{NV_BASE_SITEURL}js/contextmenu/icons/copy.png" /> Th�m V?
			</li>
			<li id="news3">
				<img src="{NV_BASE_SITEURL}js/contextmenu/icons/copy.png" /> Th�m ch?ng
			</li>
			<li id="edit">
				<img src="{NV_BASE_SITEURL}js/contextmenu/icons/rename.png" /> S?a
			</li>
			<li id="delete">
				<img src="{NV_BASE_SITEURL}js/contextmenu/icons/delete.png" /> X�a
			</li>
		</ul>
	</div>
</div>
<div id="create_genealogy_users" style="overflow:auto;display:none;padding:10px;" title="{PAGE_TITLE}">
	<iframe id="modalIFrame" width="100%" height="100%" marginWidth="0" marginHeight="0" frameBorder="0" scrolling="auto"></iframe>
</div>
<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function() {
		$("#foldertree").treeview();
		$('#foldertree span').contextMenu('menu_genealogy_show', {
			menuStyle:{width:'120px'}, 
			onShowMenu : function(e, menu) {
				var idclass = $(e.target).attr('class');
				if(idclass.search('noadd')>0){
					$('#news1,#news2,#news3', menu).remove();
				}
				if(idclass== 'female' || idclass== 'female hover') {
					$('#news2', menu).remove();
				}
				else if(idclass== 'male' || idclass== 'male hover') {
					$('#news3', menu).remove();
				}
				return menu;
			},
			bindings : {
				'news1' : function(t) {
					var r_split = t.id.split("_");
					$("div#create_genealogy_users").dialog({
						autoOpen : false,
						width : 800,
						height : 500,
						modal : true,
						position : "center"
					}).dialog("open");
					$("#modalIFrame").attr('src', script_name + '?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=users&gid={GID}&relationships=1&parentid=' + r_split[1]);
				},
				'news2' : function(t) {
					var r_split = t.id.split("_");
					$("div#create_genealogy_users").dialog({
						autoOpen : false,
						width : 800,
						height : 500,
						modal : true,
						position : "center"
					}).dialog("open");
					$("#modalIFrame").attr('src', script_name + '?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=users&gid={GID}&relationships=2&parentid=' + r_split[1]);
				},
				'news3' : function(t) {
					var r_split = t.id.split("_");
					$("div#create_genealogy_users").dialog({
						autoOpen : false,
						width : 800,
						height : 500,
						modal : true,
						position : "center"
					}).dialog("open");
					$("#modalIFrame").attr('src', script_name + '?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=users&gid={GID}&relationships=3&parentid=' + r_split[1]);
				},
				'edit' : function(t) {
					var r_split = t.id.split("_");
					$("div#create_genealogy_users").dialog({
						autoOpen : false,
						width : 800,
						height : 500,
						modal : true,
						position : "center"
					}).dialog("open");
					$("#modalIFrame").attr('src', script_name + '?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=users&id=' + r_split[1]);
				},
				'delete' : function(t) {
					if(confirm('B?n c� ch?c ch?n x�a th�nh vi�n, x�a th�nh vi�n n�y h? th?ng x? x�a t?t c? c�c th�nh vi�n l� v?, con, ch�u ..')) {
						var r_split = t.id.split("_");
						window.location = script_name + '?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=shows&&gid={GID}&deleteid=' + r_split[1];
					}
				}
			}
		});
	});
	//]]>
</script>
<!-- BEGIN: create_users -->
<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function() {
		$("div#create_genealogy_users").dialog({
			autoOpen : false,
			width : 800,
			height : 500,
			modal : true,
			position : "center"
		}).dialog("open");
		$("#modalIFrame").attr('src', script_name + '?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=users&gid={GID}&parentid=0');
	});
	//]]>
</script>
<!-- END: create_users -->
<!-- END: main -->