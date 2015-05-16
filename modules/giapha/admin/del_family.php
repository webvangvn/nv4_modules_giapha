<?php

/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */


if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$fid = $nv_Request->get_int( 'fid', 'get', 0 );
$checkss = $nv_Request->get_string( 'checkss', 'post' );

$contents = 'NO_' . $fid;

list( $fid ) = $db->query( 'SELECT fid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_family WHERE fid=' . intval( $fid ) )->fetch( 3 );
if( $fid > 0 )
{
	nv_insert_logs( NV_LANG_DATA, $module_name, 'log_del_family', 'fid ' . $fid, $admin_info['userid'] );
	$check_del_fid = false;
	$check_del_fid = true;
	
	if( $check_del_fid )
	{
		$query = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_family WHERE fid=' . $fid;
		if( $db->exec( $query ) )
		{
			
			$contents = 'OK_' . $fid;
		}
	}
	nv_del_moduleCache( $module_name );
}

include NV_ROOTDIR . '/includes/header.php';
echo $contents;
include NV_ROOTDIR . '/includes/footer.php';