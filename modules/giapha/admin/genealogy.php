<?php

/**
 * @Project NUKEVIET 4.x
 * @Author CLB NukeViet HCMC (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2014 Webvang.vn . All rights reserved
 * @Createdate 08/10/2014
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
{
	die ( 'Stop!!!' );
}


$db->sqlreset()
  ->select( 'fid, title' )
  ->from( NV_PREFIXLANG . '_' . $module_data . '_family' )
  ->order( 'weight ASC' )
  ->limit( 100 );
$result = $db->query( $db->sql() );

$array_family_module = array();
$array_family_module[0] = $lang_module['family_sl'];

while( list( $fid_i, $title_i ) = $result->fetch( 3 ) )
{
	$array_family_module[$fid_i] = $title_i;
}
$db->sqlreset()
  ->select( 'location_id, title' )
  ->from( NV_PREFIXLANG . '_' . $module_data . '_location' )
  ->order( 'weight ASC' )
  ->limit( 100 );
$result = $db->query( $db->sql() );

$array_location_module = array();
$array_location_module[0] = $lang_module['location_sl'];

while( list( $lid_i, $title_i ) = $result->fetch( 3 ) )
{
	$array_location_module[$lid_i] = $title_i;
}

$rowgenea = array(
	'gid' => '',
	'fid' => '',
	'admin_id' => $admin_info['userid'],
	'author' => '',
	'locationid' => 0,
	'addtime' => NV_CURRENTTIME,
	'edittime' => NV_CURRENTTIME,
	'status' => 0,
	'publtime' => NV_CURRENTTIME,
	'title' => '',
	'alias' => '',
	'description' => '',
	'rule' => '',
	'content' => '',
	'copyright' => 0,
	'inhome' => 1,
	'hitstotal' => 0,
	'hitscm' => 0,
	'mode' => 'add'
);
$page_title = $lang_module['genealogy'];
$error = array();

$rowgenea['gid'] = $nv_Request->get_int( 'gid', 'get,post', 0 );
		

if(  $nv_Request->isset_request( 'save', 'post' ) )
{
	$rowgeneat['fid'] = $nv_Request->get_int( 'fid', 'post', 0 );
	$rowgenea['title'] = $nv_Request->get_string( 'title', 'post', '', 1 );
	$rowgenea['alias'] =  $nv_Request->get_string( 'alias', 'post', '', 1, 255 );
	if( empty( $rowgenea['title'] ) )
	{
		$error = $lang_module['error_genealogy_name'];
	}
	elseif( $rowgenea['gid'] == 0 )
	{
		//echo 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE title= :title AND parentid=' . $post['parentid'] . '';
		$stmt = $db->prepare( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_genealogy WHERE alias= :alias ' );
		$stmt->bindParam( ':alias', $rowgenea['alias'], PDO::PARAM_STR );
		$stmt->execute();
		if( $stmt->fetchColumn() )
		{
			$error = $lang_module['title_exit_cat'];
		}
		else
		{
			$weight = $db->query( 'SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_genealogy '  )->fetchColumn();
			$weight = intval( $weight ) + 1;
			$sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_genealogy ( title, alias, weight, add_time, edit_time, userid, fid, locationid, description, rule, content, status, number, years, author, full_name, telephone, email, who_view) VALUES (
				
				:title,
				:alias,
				" . intval( $weight ) . ",
				" . NV_CURRENTTIME . ",
				" . NV_CURRENTTIME . ",
				" . $admin_info['userid'] . ",
				" . intval( $rowgenea['fid'] ) . ",
				:locationid,
				:description,
				'',
				:content,
				1,
				0,
				:years,
				:author,
				:full_name,
				:telephone,
				:email,
				0
			)";

			$data_insert = array();
			$data_insert['title'] = $rowgenea['title'];
			$data_insert['alias'] = $rowgenea['alias'];
			$data_insert['locationid'] = '';
			$data_insert['description'] = '';
			$data_insert['content'] = '';
			$data_insert['years'] = '';
			$data_insert['author'] = '';
			$data_insert['full_name'] = '';
			$data_insert['telephone'] = '';
			$data_insert['email'] = '';

			if( $db->insert_id( $sql, 'gid', $data_insert ) )
			{
			
				nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['log_add_genealogy'], $lang_module['genealogy'] .": ". $rowgeneat['title']."", $admin_info['userid'] );
				nv_del_moduleCache( $module_name );
				Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=location&parentid=' . $post['parentid'] );
				exit();
			}
			else
			{
				$error = $sql;
			}
		}
	}
}
if( defined( 'NV_EDITOR' ) ) require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';


$xtpl = new XTemplate( 'genealogy.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'MODULE_NAME', $module_name );
// family
while( list( $fid_i, $title_i ) = each( $array_family_module ) )
{
	//$sl = ( $fid_i == $rowgenea['fid'] ) ? ' selected="selected"' : '';
	$xtpl->assign( 'fid', $fid_i );
	$xtpl->assign( 'title', $title_i );
	//$xtpl->assign( 'sl', $sl );
	$xtpl->parse( 'main.family' );
}
// location
while( list( $lid_i, $title_i ) = each( $array_location_module ) )
{
	$sl = ( $fid_i == $rowgenea['fid'] ) ? ' selected="selected"' : '';
	$xtpl->assign( 'locationid', $lid_i );
	$xtpl->assign( 'title', $title_i );
	//$xtpl->assign( 'sl', $sl );
	$xtpl->parse( 'main.location' );
}
$uploads_dir_user="";
$currentpath="";
//phaky
$rowgenea['description'] = htmlspecialchars( nv_editor_br2nl( $rowgenea['description'] ) );
if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$rowgenea['description'] = nv_aleditor( 'description', '100%', '300px', $rowgenea['description']);
}
else
{
	$rowgenea['description'] = "<textarea style=\"width: 100%\" name=\"description\" id=\"description\" cols=\"20\" rows=\"15\">" . $rowgenea['description'] . "</textarea>";
}

//toc uoc
$rowgenea['rule'] = htmlspecialchars( nv_editor_br2nl( $rowgenea['rule'] ) );
if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$rowgenea['rule'] = nv_aleditor( 'rule', '100%', '400px', $rowgenea['rule'] );
}
else
{
	$rowgenea['rule'] = "<textarea style=\"width: 100%\" name=\"rule\" id=\"rule\" cols=\"20\" rows=\"15\">" . $rowgenea['rule'] . "</textarea>";
}

//huong hoa
$rowgenea['content'] = htmlspecialchars( nv_editor_br2nl( $rowgenea['content'] ) );
if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$rowgenea['content'] = nv_aleditor( 'content', '100%', '400px', $rowgenea['content'] );
}
else
{
	$rowgenea['content'] = "<textarea style=\"width: 100%\" name=\"content\" id=\"content\" cols=\"20\" rows=\"15\">" . $rowgenea['content'] . "</textarea>";
}


$xtpl->assign( 'DATA', $rowgenea );
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

