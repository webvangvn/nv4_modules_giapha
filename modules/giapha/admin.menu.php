<?php

/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */

if( ! defined( 'NV_ADMIN' ) ) die( 'Stop!!!' );
if( ! function_exists('nv_giapha_array_cat_admin') )
{
	/**
	 * nv_giapha_array_cat_admin()
	 *
	 * @return
	 */
	function nv_giapha_array_cat_admin( $module_data )
	{
		global $db;

		$array_cat_admin = array();
		$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_admins ORDER BY userid ASC';
		$result = $db->query( $sql );

		while( $row = $result->fetch() )
		{
			$array_cat_admin[$row['userid']][$row['catid']] = $row;
		}

		return $array_cat_admin;
	}
}


$is_refresh = false;
$array_cat_admin = nv_giapha_array_cat_admin( $module_data );

if( ! empty( $module_info['admins'] ) )
{
	$module_admin = explode( ',', $module_info['admins'] );
	foreach( $module_admin as $userid_i )
	{
		if( ! isset( $array_cat_admin[$userid_i] ) )
		{
			$db->query( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_admins (userid, catid, admin, add_content, pub_content, edit_content, del_content) VALUES (' . $userid_i . ', 0, 1, 1, 1, 1, 1)' );
			$is_refresh = true;
		}
	}
}
if( $is_refresh )
{
	$array_cat_admin = nv_giapha_array_cat_admin( $module_data );
}


$admin_id = $admin_info['admin_id'];
$NV_IS_ADMIN_MODULE = false;
$NV_IS_ADMIN_FULL_MODULE = false;
if( defined( 'NV_IS_SPADMIN' ) )
{
	$NV_IS_ADMIN_MODULE = true;
	$NV_IS_ADMIN_FULL_MODULE = true;
}
else
{
	if( isset( $array_cat_admin[$admin_id][0] ) )
	{
		$NV_IS_ADMIN_MODULE = true;
		if( intval( $array_cat_admin[$admin_id][0]['admin'] ) == 2 )
		{
			$NV_IS_ADMIN_FULL_MODULE = true;
		}
	}
}
 
$submenu['main'] = $lang_module['main'];
$submenu['location'] = $lang_module['location'];
$submenu['change_weight_location'] = $lang_module['change_weight_location'];
$submenu['alias'] = $lang_module['alias'];
$submenu['change_status_location'] = $lang_module['change_status_location'];
$submenu['location_del'] = $lang_module['location_del'];
$submenu['genealogy'] = $lang_module['genealogy'];
$submenu['family'] = $lang_module['family'];
$submenu['list_family'] = $lang_module['list_family'];
$submenu['chang_family'] = $lang_module['chang_family'];
$submenu['del_family'] = $lang_module['del_family'];

$allow_func = array( 'main', 'location', 'change_weight_location', 'alias', 'change_status_location', 'location_del', 'genealogy', 'family', 'list_family', 'chang_family', 'del_family');
