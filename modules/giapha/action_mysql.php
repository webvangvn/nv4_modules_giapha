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

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "";

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_location";

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_family";

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_genealogy";


$sql_create_module = $sql_drop_module;


$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . " (
  id int(11) NOT NULL AUTO_INCREMENT,
  gid int(11) NOT NULL DEFAULT '0',
  parentid int(11) NOT NULL DEFAULT '0' COMMENT 'Là con của Ai, thường là bố',
  parentid2 int(11) NOT NULL DEFAULT '0' COMMENT 'Là con của mẹ nào',
  weight int(11) NOT NULL DEFAULT '0' COMMENT 'Là con/vợ thứ mấy (Thứ 2, 3 hay cả, hai, ba , tư..)',
  lev int(11) NOT NULL DEFAULT '0' COMMENT 'Đời thứ',
  relationships tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Quan hệ với người được chọn: Vợ/Con.',
  gender tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Nam/Nữ/Chưa biết',
  status tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Còn sống/ đã mất/ không rõ',
  anniversary varchar(10) NOT NULL DEFAULT '0' COMMENT 'Ngày giỗ',
  actanniversary tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Hiển thị ngày giỗ hay không',
  alias varchar(255) NOT NULL DEFAULT '',
  full_name varchar(255) NOT NULL COMMENT 'Tên húy (Là tên trong khai sinh, tên cúng cơm)',
  code varchar(50) NOT NULL COMMENT 'Số mã hiệu (Là số mã hiệu trong gia phả, nếu có)',
  name1 varchar(200) NOT NULL COMMENT 'Tên tự (Là tên tự gọi)',
  name2 varchar(200) NOT NULL COMMENT 'Là tên thụy phong, truy phong sau khi mất',
  birthday datetime NOT NULL COMMENT 'Ngày giờ sinh ',
  dieday datetime NOT NULL COMMENT 'Ngày giờ mất ',
  life int(11) NOT NULL DEFAULT '0' COMMENT 'Hưởng thọ',
  burial varchar(255) NOT NULL COMMENT 'Mộ táng tại',
  content mediumtext NOT NULL COMMENT 'Sự nghiệp, công đức của nguời này. (Nếu là nữ, ghi tên con, cháu ngoại cũng như các ghi chú khác vào đây.)',
  image varchar(255) NOT NULL COMMENT 'Upload đính kèm ảnh chân dung',
  userid int(11) NOT NULL DEFAULT '0',
  add_time int(11) NOT NULL DEFAULT '0',
  edit_time int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY gid (gid,alias),
  KEY parentid (parentid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";





$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_location (
  locationid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  parentid mediumint(8) unsigned NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL DEFAULT '',
  alias varchar(255) NOT NULL DEFAULT '',
  weight smallint(4) NOT NULL DEFAULT '0',
  sort mediumint(8) NOT NULL DEFAULT '0',
  lev smallint(4) NOT NULL DEFAULT '0',
  numlistcu int(11) NOT NULL DEFAULT '0',
  listcu mediumtext NOT NULL,
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  number int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (locationid),
  UNIQUE KEY title (title),
  UNIQUE KEY alias (alias)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_family (
  fid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  status tinyint(4) NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL DEFAULT '',
  alias varchar(255) NOT NULL DEFAULT '',
  description varchar(255) NOT NULL,
  weight smallint(4) NOT NULL DEFAULT '0',
  keywords mediumtext NOT NULL,
  add_time int(11) NOT NULL DEFAULT '0',
  edit_time int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (fid),
  UNIQUE KEY alias (alias)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";


$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_genealogy (
  gid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL DEFAULT '',
  alias varchar(255) NOT NULL DEFAULT '',
  weight smallint(4) NOT NULL DEFAULT '0',
  add_time int(11) NOT NULL DEFAULT '0',
  edit_time int(11) NOT NULL DEFAULT '0',
  userid int(11) NOT NULL DEFAULT '0',
  fid int(11) NOT NULL DEFAULT '0',
  locationid int(11) NOT NULL DEFAULT '0',
  description mediumtext NOT NULL,
  rule mediumtext NOT NULL,
  content mediumtext NOT NULL,
  status tinyint(4) NOT NULL DEFAULT '1',
  number int(11) NOT NULL DEFAULT '0',
  years varchar(55) NOT NULL DEFAULT '',
  author varchar(255) NOT NULL DEFAULT '',
  full_name varchar(255) NOT NULL DEFAULT '',
  telephone varchar(55) NOT NULL DEFAULT '',
  email varchar(200) NOT NULL DEFAULT '',
  who_view tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (gid),
  UNIQUE KEY alias (alias),
  KEY locationid (locationid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

