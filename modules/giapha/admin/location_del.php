<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 20-03-2011 20:08
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

if( ! defined( 'NV_IS_AJAX' ) ) die( 'Wrong URL' );

$id = $nv_Request->get_int( 'cuid', 'post', 0 );
$parentid = $nv_Request->get_int( 'parentid', 'post', 0 );
//$id = $nv_Request->get_int( 'cuid', 'get', 0 );
//$parentid = $nv_Request->get_int( 'parentid', 'get', 0 );
nv_location_del_sub( $id, $parentid );

nv_del_moduleCache( $module_name );

function nv_location_del_sub( $id, $parentid )
{
	global $module_data, $module_name, $db, $admin_info, $lang_module;
	$sql = 'SELECT title FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE location_id=' . $id . ' AND parent_id=' . $parentid;
	//echo $sql;
	$row = $db->query( $sql )->fetch();
	$title=$row['title'];
	//echo $title;
	if( empty( $row ) ) die( 'NO_' . $id );

	$sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE location_id=' . $id;
	//echo $sql;
	if( $db->exec( $sql ) )
	{
		//echo "xoa oke";
			nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['log_del_location'], $lang_module['location'].': ' . $title, $admin_info['userid'] );
	}
	else
	{
		die( 'NO_' . $id );
	}
}
include NV_ROOTDIR . '/includes/header.php';
echo 'OK_' . $id . '_' . $parentid;
include NV_ROOTDIR . '/includes/footer.php';
