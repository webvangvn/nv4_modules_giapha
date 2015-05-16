<?php

/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
if( ! defined( 'NV_IS_AJAX' ) ) die( 'Wrong URL' );


$fid = $nv_Request->get_int( 'fid', 'post', 0 );
$mod = $nv_Request->get_string( 'mod', 'post', '' );
$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );

if( empty( $fid ) ) die( 'NO_' . $fid );
$content = 'NO_' . $fid;

if( $mod == 'weight' and $new_vid > 0 )
{
	$sql = 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_family WHERE fid=' . $fid;
	$numrows = $db->query( $sql )->fetchColumn();
	if( $numrows != 1 ) die( 'NO_' . $fid );

	$sql = 'SELECT fid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_family WHERE fid!=' . $fid . ' ORDER BY weight ASC';
	$result = $db->query( $sql );

	$weight = 0;
	while( $row = $result->fetch() )
	{
		++$weight;
		if( $weight == $new_vid ) ++$weight;
		$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_family SET weight=' . $weight . ' WHERE fid=' . $row['fid'];
		$db->query( $sql );
	}

	$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_family SET weight=' . $new_vid . ' WHERE fid=' . $fid;
	$db->query( $sql );

	$content = 'OK_' . $fid;
	nv_del_moduleCache( $module_name );
}
elseif( $mod == 'adddefault' and $fid > 0 )
{
	$new_vid = ( intval( $new_vid ) == 1 ) ? 1 : 0;
	$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_family SET adddefault=' . $new_vid . ' WHERE fid=' . $fid;
	$db->query( $sql );
	$content = 'OK_' . $fid;
}
include NV_ROOTDIR . '/includes/header.php';
echo $content ;
include NV_ROOTDIR . '/includes/footer.php';