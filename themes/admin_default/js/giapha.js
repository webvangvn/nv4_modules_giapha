/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */
function nv_chang_status_location(cuid, parentid) {
	var nv_timer = nv_settimeout_disable('change_status_' + cuid, 5000);
	var new_status = document.getElementById('change_status_' + cuid).options[document.getElementById('change_status_' + cuid).selectedIndex].value;
	setTimeout('', 2000);
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_status_location&nocache=' + new Date().getTime(), 'cuid=' + cuid + '&parentid=' + parentid + '&new_status=' + new_status + '&num=' + nv_randomPassword(8) + '&nocache=' + new Date().getTime(), function(res) {
		if (res != 'OK') {
			alert(nv_is_change_act_confirm[2]);
		}
		window.location = 'index.php?' + nv_name_variable + '=' + nv_module_name + '&op=location&parentid=' + parentid;
	});
	return;
}
function nv_chang_weight_location(cuid, parentid) {
	var nv_timer = nv_settimeout_disable('change_weight_' + cuid, 5000);
	var new_weight = document.getElementById('change_weight_' + cuid).options[document.getElementById('change_weight_' + cuid).selectedIndex].value;
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_weight_location&nocache=' + new Date().getTime(), 'cuid=' + cuid + '&parentid=' + parentid + '&new_weight=' + new_weight, function(res) {
		window.location.href = window.location.href;
	});
}
function nv_del_location(cuid, parentid, num) {
	if (num > 0) {
		if (confirm("Danh mục này tồn tại " + num + " danh mục con, Nếu đồng ý, các danh mục con sẽ bị xóa. Bạn có muốn tiếp tục xóa?")) {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=location_del&nocache=' + new Date().getTime(), 'cuid=' + cuid + '&parentid=' + parentid + '&num=' + num, function(res) {
				window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=location';
			});
		}
	} else {
		if (confirm(nv_is_del_confirm[0])) {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=location_del&nocache=' + new Date().getTime(), 'cuid=' + cuid + '&parentid=' + parentid + '&num=' + num, function(res) {
				window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=location';
			});
		}
	}
	return false;
}
function get_alias(mod, id) {
	var title = strip_tags(document.getElementById('idtitle').value);
	if (title != '') {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=alias&nocache=' + new Date().getTime(), 'title=' + encodeURIComponent(title) + '&mod=' + mod + '&id=' + id, function(res) {
			if (res != "") {
				document.getElementById('idalias').value = res;
			} else {
				document.getElementById('idalias').value = '';
			}
			return false;
		});
	}
	return false;
}
function nv_del_family(fid) {
	if (confirm(nv_is_del_confirm[0])) {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_family&fid=' + fid + '&nocache=' + new Date().getTime(), '', function(res) {
			var r_split = res.split("_");
			if (r_split[0] == 'OK') {
				window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=family';
			} else if (r_split[0] == 'ERR') {
				alert(r_split[1]);
			} else {
				alert(nv_is_del_confirm[2]);
			}
			
			window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=family';
		});
	}
	return false;
}

function nv_chang_family(fid, mod) {
	var nv_timer = nv_settimeout_disable('id_' + mod + '_' + fid, 5000);
	var new_vid = document.getElementById('id_' + mod + '_' + fid).options[document.getElementById('id_' + mod + '_' + fid).selectedIndex].value;
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=chang_family&nocache=' + new Date().getTime(), 'fid=' + fid + '&mod=' + mod + '&new_vid=' + new_vid + '&num=' + nv_randomPassword(8)+ '&nocache=' + new Date().getTime(), function(res) {
		var r_split = res.split("_");
		if (r_split[0] != 'OK') {
			alert(nv_is_change_act_confirm[2]);
		}
		clearTimeout(nv_timer);
		window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=family';
	});
	return;
}
/*
function nv_show_list_family() {
	if (document.getElementById('module_show_list')) {
		//$.get(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_family&num=' + nv_randomPassword(8) + '&nocache=' + new Date().getTime() );
		$('module_show_list').reload(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_family&num=' + nv_randomPassword(8) + '&nocache=' + new Date().getTime() );
		
	}
	return;
}
*/
// ---------------------------------------
function nv_del_genealogy(gid) {
	if (confirm(nv_is_del_confirm[0])) {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_genealogy&nocache=' + new Date().getTime(), 'gid=' + gid, function(res) {
			var r_split = res.split("_");
			if (r_split[0] == 'OK') {
				nv_show_list_genealogy();
			} else if (r_split[0] == 'ERR') {
				alert(r_split[1]);
			} else {
				alert(nv_is_del_confirm[2]);
			}
			window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=genealogy';
		});
	}
	return false;
}
function nv_chang_genealogy(gid, mod) {
	var nv_timer = nv_settimeout_disable('id_' + mod + '_' + gid, 5000);
	var new_vid = document.getElementById('id_' + mod + '_' + gid).options[document.getElementById('id_' + mod + '_' + gid).selectedIndex].value;
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=chang_genealogy&nocache=' + new Date().getTime(), 'gid=' + gid + '&mod=' + mod + '&new_vid=' + new_vid + '&num=' + nv_randomPassword(8), function(res) {
		var r_split = res.split("_");
		if (r_split[0] != 'OK') {
			alert(nv_is_change_act_confirm[2]);
		}
		clearTimeout(nv_timer);
		nv_show_list_genealogy();
		window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=genealogy';
	});
	return;
}
function nv_chang_display(gid, mod) {
	var nv_timer = nv_settimeout_disable('id_' + mod + '_' + gid, 5000);
	var new_vid = document.getElementById('id_' + mod + '_' + gid).options[document.getElementById('id_' + mod + '_' + gid).selectedIndex].value;
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=chang_genealogy&nocache=' + new Date().getTime(), 'gid=' + gid + '&mod=' + mod + '&new_vid=' + new_vid + '&num=' + nv_randomPassword(8), function(res) {
		var r_split = res.split("_");
		if (r_split[0] != 'OK') {
			alert(nv_is_change_act_confirm[2]);
		}
		clearTimeout(nv_timer);
		nv_show_list_genealogy();
	});
	return;
}
function nv_show_list_genealogy() {
	if (document.getElementById('module_show_list')) {
		$.get(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_genealogy&nocache=' + new Date().getTime() );
	}
	return;
}