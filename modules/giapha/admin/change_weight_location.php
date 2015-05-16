<?php

/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
if( ! defined( 'NV_IS_AJAX' ) ) die( 'Wrong URL' );

$id = $nv_Request->get_int( 'cuid', 'post', 0 );
$parentid = $nv_Request->get_int( 'parentid', 'post', 0 );
$new_weight = $nv_Request->get_int( 'new_weight', 'post', 0 );
//$id = $nv_Request->get_int( 'cuid', 'get', 0 );
//$parentid = $nv_Request->get_int( 'parentid', 'get', 0 );
//$new_weight = $nv_Request->get_int( 'new_weight', 'get', 0 );
$sql = 'SELECT weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE location_id=' . $id . ' AND parent_id=' . $parentid;
$row = $db->query( $sql )->fetch();

if( empty( $row ) OR empty( $new_weight ) ) die( 'NO_' . $id );

$query = 'SELECT location_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE location_id !=' . $id . ' AND parent_id=' . $parentid . '  ORDER BY weight ASC';



$result = $db->query( $query );
//echo $query ;
$weight = 0;
while( $row = $result->fetch() )
{
	++$weight;
	if( $weight == $new_weight ) ++$weight;
	//echo $row['location_id'];
	$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_location SET weight=' . $weight . ' WHERE location_id=' . $row['location_id'] );
}

$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_location SET weight=' . $new_weight . ' WHERE location_id=' . $id . ' AND parent_id=' . $parentid );

nv_del_moduleCache( $module_name );

include NV_ROOTDIR . '/includes/header.php';
echo 'OK_' . $id . '_' . $parentid;
include NV_ROOTDIR . '/includes/footer.php';