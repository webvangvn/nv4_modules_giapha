<?php

/**
 * @Project NUKEVIET 4.x
 * @Author WEBVANG.VN (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2015 WEBVANG.VN. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 19 May 2015 10:34:00 GMT
 */

if( ! defined( 'NV_IS_FILE_SITEINFO' ) ) die( 'Stop!!!' );

$lang_siteinfo = nv_get_lang_module( $mod );
/*
// Tong so bai viet
$number = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_rows where status= 1 AND publtime < ' . NV_CURRENTTIME . ' AND (exptime=0 OR exptime>' . NV_CURRENTTIME . ')' )->fetchColumn();
if ( $number > 0 )
{
    $siteinfo[] = array(
        'key' => $lang_siteinfo['siteinfo_publtime'], 'value' => $number
    );
}
*/