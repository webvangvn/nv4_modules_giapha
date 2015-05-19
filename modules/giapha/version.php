<?php

/**
 * @Project NUKEVIET 4.x
 * @Author WEBVANG.VN (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2015 WEBVANG.VN. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 19 May 2015 10:34:00 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(
	'name' => 'Giapha',
	'modfuncs' => 'main,detail,search,anniversary,genealogy,shows,location,manager',
	'change_alias' => 'main,detail,search,anniversary,genealogy,shows,location,manager',
	'submenu' => 'main,detail,search,anniversary,genealogy,shows,location,manager',
	'is_sysmod' => 0,
	'virtual' => 1,
	'version' => '4.0.00',
	'date' => 'Tue, 19 May 2015 10:34:01 GMT',
	'author' => 'WEBVANG.VN (hoang.nguyen@webvang.vn)',
	'uploads_dir' => array($module_name),
	'note' => ''
);