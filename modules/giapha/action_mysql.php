<?php

/**
 * @Project NUKEVIET 4.x
 * @Author WEBVANG.VN (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2015 WEBVANG.VN. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 19 May 2015 10:34:00 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_admins`";

$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_location`";

$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_family`";


$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_admins` (
userid mediumint( 8  )  unsigned NOT  NULL DEFAULT  '0',
 catid smallint( 5  )  NOT  NULL DEFAULT  '0',
 admin tinyint( 4  )  NOT  NULL DEFAULT  '0',
 add_content tinyint( 4  )  NOT  NULL DEFAULT  '0',
 pub_content tinyint( 4  )  NOT  NULL DEFAULT  '0',
 edit_content tinyint( 4  )  NOT  NULL DEFAULT  '0',
 del_content tinyint( 4  )  NOT  NULL DEFAULT  '0',
 app_content tinyint( 4  )  NOT  NULL DEFAULT  '0',
 UNIQUE  KEY  userid (  userid ,  catid  )
) ENGINE  =  MyISAM  DEFAULT CHARSET  = utf8";

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_location` (
location_id int(10) NOT NULL AUTO_INCREMENT,
  parent_id int(10) NOT NULL,
  title varchar(250) NOT NULL,
  alias varchar(250) NOT NULL,
  status tinyint(1) NOT NULL DEFAULT '0',
  weight int(11) NOT NULL,
  PRIMARY KEY (location_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_family` (
 fid smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  adddefault tinyint(4) NOT NULL DEFAULT '0',
  numbers smallint(5) NOT NULL DEFAULT '10',
  title varchar(255) NOT NULL DEFAULT '',
  alias varchar(255) NOT NULL DEFAULT '',
  image varchar(255) DEFAULT '',
  description varchar(255) DEFAULT '',
  weight smallint(5) NOT NULL DEFAULT '0',
  keywords text,
  add_time int(11) NOT NULL DEFAULT '0',
  edit_time int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (fid),
  UNIQUE KEY title (title),
  UNIQUE KEY alias (alias)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";


$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_location (location_id, parent_id, title, alias, status, weight) VALUES
(1, 0, 'Hà Nội', 'Ha-Noi', 1, 1),
(2, 0, 'Hồ Chí Minh', 'Ho-Chi-Minh', 1, 2)";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_family (fid, adddefault, numbers, title, alias, image, description, weight, keywords, add_time, edit_time) VALUES
(1, 1, 4, 'Nguyễn', 'Nguyen', '', 'Họ Nguyễn', 1, 'Nguyễn', 1420291650, 1420293130),
(2, 1, 4, 'Văn', 'Van', '', '', 2, 'Văn', 1420345531, 1420345531)";
