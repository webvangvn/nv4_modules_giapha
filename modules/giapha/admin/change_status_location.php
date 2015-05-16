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
$new_status = $nv_Request->get_int( 'new_status', 'post', 0 );
//$id = $nv_Request->get_int( 'cuid', 'get', 0 );
//$parentid = $nv_Request->get_int( 'parentid', 'get', 0 );
//$new_status = $nv_Request->get_int( 'new_status', 'get', 0 );
$sql = 'SELECT status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE location_id=' . $id . ' AND parent_id=' . $parentid;
$row = $db->query( $sql )->fetch();

if( empty( $row ) ) die( 'NO_' . $id );

$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_location SET status=' . $new_status . ' WHERE location_id=' . $id . ' AND parent_id=' . $parentid );

nv_del_moduleCache( $module_name );

include NV_ROOTDIR . '/includes/header.php';
echo 'OK';
include NV_ROOTDIR . '/includes/footer.php';