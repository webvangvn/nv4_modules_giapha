<?php

/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */

if( ! defined( 'NV_ADMIN' ) ) die( 'Stop!!!' );
$submenu['genealogy'] = $lang_module['genealogy'];
$submenu['location'] = $lang_module['location'];
$submenu['family'] = $lang_module['family'];


$allow_func = array( 'main','location','change_weight_location','alias','change_status_location','location_del','genealogy','family','list_family','chang_family','del_family');