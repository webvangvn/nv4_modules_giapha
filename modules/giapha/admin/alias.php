<?php

/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$title = $nv_Request->get_title( 'title', 'post', '' );
$alias = change_alias( $title );

$id = $nv_Request->get_int( 'id', 'post', 0 );
$mod = $nv_Request->get_string( 'mod', 'post', '' );


if( $mod == 'family' )
{
	$tab = NV_PREFIXLANG . '_' . $module_data . '_family';
	$stmt = $db->prepare( 'SELECT COUNT(*) FROM ' . $tab . ' WHERE fid!=' . $id . ' AND alias= :alias' );
	$stmt->bindParam( ':alias', $alias, PDO::PARAM_STR );
	$stmt->execute();
	$nb = $stmt->fetchColumn();
	if( ! empty( $nb ) )
	{
		$nb = $db->query( 'SELECT MAX(fid) FROM ' . $tab )->fetchColumn();

		$alias .= '-' . ( intval( $nb ) + 1 );
	}
}
include NV_ROOTDIR . '/includes/header.php';
echo $alias;
include NV_ROOTDIR . '/includes/footer.php';