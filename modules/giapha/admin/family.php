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
$page_title = $lang_module['family'];

$error = '';
$savecat = 0;
list( $fid, $title, $alias, $description, $image, $keywords ) = array( 0, '', '', '', '', '' );

$savecat = $nv_Request->get_int( 'savecat', 'post', 0 );
if( ! empty( $savecat ) )
{
	$fid = $nv_Request->get_int( 'fid', 'post', 0 );
	$title = $nv_Request->get_title( 'title', 'post', '', 1 );
	$keywords = $nv_Request->get_title( 'keywords', 'post', '', 1 );
	$alias = $nv_Request->get_title( 'alias', 'post', '' );
	$description = $nv_Request->get_string( 'description', 'post', '' );
	$description = nv_nl2br( nv_htmlspecialchars( strip_tags( $description ) ), '<br />' );
	$alias = ( $alias == '' ) ? change_alias( $title ) : change_alias( $alias );

	$image = $nv_Request->get_string( 'image', 'post', '' );
	if( empty( $title ) )
	{
		$error = $lang_module['error_name'];
	}
	elseif( $fid == 0 )
	{
		
		$weight = $db->query( "SELECT max(weight) FROM " . NV_PREFIXLANG . "_" . $module_data . "_family" )->fetchColumn();
		$weight = intval( $weight ) + 1;
		
		$sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_family (adddefault, numbers, title, alias, description, image, weight, keywords, add_time, edit_time) VALUES (0, 4, :title , :alias, :description, :image, :weight, :keywords, " . NV_CURRENTTIME . ", " . NV_CURRENTTIME . ")";
		$data_insert = array();
		$data_insert['title'] = $title;
		$data_insert['alias'] = $alias;
		$data_insert['description'] = $description;
		$data_insert['image'] = $image;
		$data_insert['weight'] = $weight;
		$data_insert['keywords'] = $keywords;
		
		if( $db->insert_id( $sql, 'fid', $data_insert ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['add_family'], " ", $admin_info['userid'] );
			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
			die();
		}
		else
		{
			$error = $lang_module['errorsave'];
		}
		
	}
	else
	{
		$stmt = $db->prepare( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_family SET title= :title, alias = :alias, description= :description, image= :image, keywords= :keywords, edit_time=" . NV_CURRENTTIME . " WHERE fid =" . $fid );
		$stmt->bindParam( ':title', $title, PDO::PARAM_STR );
		$stmt->bindParam( ':alias', $alias, PDO::PARAM_STR );
		$stmt->bindParam( ':description', $description, PDO::PARAM_STR );
		$stmt->bindParam( ':image', $image, PDO::PARAM_STR );
		$stmt->bindParam( ':keywords', $keywords, PDO::PARAM_STR );
		$stmt->execute();
		if( $stmt->execute() )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['edit_family'], $fid."-" . $title, $admin_info['userid'] );
			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
			die('den day');
		}
		else
		{
			$error = $lang_module['errorsave'];
		}
		
	}
}


$fid = $nv_Request->get_int( 'fid', 'get', 0 );
if( $fid > 0 )
{
	list( $fid, $title, $alias, $description, $image, $keywords ) = $db->query( "SELECT fid, title, alias, description, image, keywords FROM " . NV_PREFIXLANG . "_" . $module_data . "_family where fid=" . $fid )->fetch( 3 );
	$lang_module['add_family'] = $lang_module['edit_family'];
}
$xtpl = new XTemplate( 'family.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'BLOCK_CAT_LIST', nv_show_family_cat_list() );
$xtpl->assign( 'fid', $fid );
$xtpl->assign( 'title', $title );
$xtpl->assign( 'alias', $alias );
$xtpl->assign( 'keywords', $keywords );
$xtpl->assign( 'description', nv_htmlspecialchars( nv_br2nl( $description ) ) );
if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', $error );
	$xtpl->parse( 'main.error' );
}

if( empty( $alias ) )
{
	$xtpl->parse( 'main.getalias' );
}
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

