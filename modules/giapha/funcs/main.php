<?php

/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */


if(!defined('NV_IS_MOD_GIAPHA'))die('Stop!!!');

$data_content=array();
$contents=call_user_func('nv_theme_giapha_main_location',$data_content);
include(NV_ROOTDIR."/includes/header.php");
echo nv_site_theme($contents);
include(NV_ROOTDIR."/includes/footer.php");
