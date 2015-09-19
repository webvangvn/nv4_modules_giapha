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
$post['id'] = $nv_Request->get_int( 'cuid', 'get', 0 );
$post['parentid'] = $nv_Request->get_int( 'parentid', 'get', 0 );
$post['title_cu'] = '';
$post['alias'] = '';

if( $post['id'] != 0 )
{
	$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE  location_id=' . $post['id'] . ' ORDER BY location_id';
	$result = $db->query( $sql );
	$post = $result->fetch();
	$post['id'] = $post['location_id'];
	$post['parentid'] = $post['parentid'];
	$post['title_cu'] = $post['title'];
	$post['alias'] = $post['alias'];
}


if( $nv_Request->isset_request( 'save', 'post' ) )
{ 
	
	$post = array();
	$post['id'] = $nv_Request->get_int( 'cuid', 'post', 0 );
	$post['parentid'] = $nv_Request->get_int( 'parentid', 'post', 0 );
	$post['title'] = nv_substr( $nv_Request->get_title( 'title', 'post', '', 1 ), 0, 255 );
	$post['alias'] = $nv_Request->get_string( 'alias', 'post', '', 1, 255 );
	$post['title_cu'] = $post['title'];
	$pa_old = $nv_Request->get_int( 'parentid_old', 'post', 0 );
	if( empty( $post['title'] ) )
	{
		$error = $lang_module['error_location_name'];
	}
	elseif( $post['id'] == 0 )
	{
		//echo 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE title= :title AND parentid=' . $post['parentid'] . '';
		$stmt = $db->prepare( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE title= :title AND parentid=' . $post['parentid'] . ''  );
		$stmt->bindParam( ':title', $post['title'], PDO::PARAM_STR );
		$stmt->execute();
		if( $stmt->fetchColumn() )
		{
			$error = $lang_module['title_exit_cat'];
		}
		else
		{
			//echo 'SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE  parentid=' . intval( $post['parentid'] . ''  );
			$weight = $db->query( 'SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE  parentid=' . intval( $post['parentid'] . ''  ) )->fetchColumn();
			$weight = intval( $weight ) + 1;
			$sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_location (parentid, title, alias, weight, status) VALUES (
				" . intval( $post['parentid'] ) . ",
				:title,
				:alias,
				" . intval( $weight ) . ",
				1
			)";

			$data_insert = array();
			$data_insert['title'] = $post['title'];
			$data_insert['alias'] = $post['alias'];


			if( $db->insert_id( $sql, 'location_id', $data_insert ) )
			{
			
				nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['log_add_location'], $lang_module['location'] .": ". $post['title']."", $admin_info['userid'] );
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
	else
	{
		//echo "SELECT count(*) FROM " . NV_PREFIXLANG . "_" . $module_data . "_location WHERE title= :title AND parentid=" . $post['parentid'] . " AND location_id NOT IN (" . $post['id'] . ")";
		$stmt = $db->prepare( "SELECT count(*) FROM " . NV_PREFIXLANG . "_" . $module_data . "_location WHERE title= :title AND parentid=" . $post['parentid'] . " AND location_id NOT IN (" . $post['id'] . ")" );
		$stmt->bindParam( ':title', $post['title'], PDO::PARAM_STR );
		$stmt->execute();
		if( $stmt->fetchColumn() )
		{
			$error = $lang_module['title_exit_cat'];
		}
		else
		{
			$title_old = $db->query( "SELECT title FROM " . NV_PREFIXLANG . "_" . $module_data . "_location WHERE  parentid=" . intval( $post['parentid']) . " AND location_id=" . intval( $post['id']  ) )->fetchColumn();
			$stmt = $db->prepare( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_location SET
				parentid=" . intval( $post['parentid'] ) . ",
				title= :title,
				alias= :alias
			WHERE location_id=" . intval( $post['id'] ) );

			$stmt->bindParam( ':title', $post['title'], PDO::PARAM_STR );
			$stmt->bindParam( ':alias', $post['alias'], PDO::PARAM_STR );

			if( $stmt->execute() )
			{
				//echo $pa_old;
				
				if( $pa_old != $post['parentid'] )
				{
					//echo "SELECT max(weight) FROM " . NV_PREFIXLANG . "_" . $module_data . "_location WHERE  parentid=" . intval( $post['parentid'] . " " ) ;
					$weight = $db->query( "SELECT max(weight) FROM " . NV_PREFIXLANG . "_" . $module_data . "_location WHERE  parentid=" . intval( $post['parentid'] . " " ) )->fetchColumn();
					$weight = intval( $weight ) + 1;

					$sql = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_location SET weight=" . intval( $weight ) . " WHERE location_id=" . intval( $post['id'] );
					$db->query( $sql );
					//echo $sql;
				}


				nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['log_edit_location'], $lang_module['location_old'] .": ".$title_old."<br>".$lang_module['location_new'].": ". $post['title']."", $admin_info['userid'] );
				nv_del_moduleCache( $module_name );
				Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=location&parentid=' . $post['parentid'] );
				exit();
			}
			else
			{
				$error = $lang_module['errorsave'];
			}
		}
	}
}
	

$db->select( '*' )
	->from( NV_PREFIXLANG . '_' . $module_data . '_location')
	->order( 'weight' );
$result = $db->query( $db->sql() );
$num = 0;
$location=array();
while( $_r = $result->fetch( 2 ) )
{
	++$num;
	$location[$_r['location_id']] = $_r;			
}

$xtpl = new XTemplate( 'location.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=location' ) . '&amp;parentid=' . $post['parentid'];
$xtpl->assign( 'title_cata', $lang_module['title_cata'] );
$xtpl->assign( 'parentid', $post['parentid'] );
$xtpl->assign( 'location_id', $post['id'] );
$xtpl->assign( 'title_cu', $post['title_cu'] );
$xtpl->assign( 'alias', $post['alias'] );
$array_status=array(1=>array(0,$lang_module['no']),2=>array(1,$lang_module['yes']));
if( !empty( $location) )
{
	foreach( $location as $rows )
	{
		
		$sql = 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_location WHERE parentid=' . $rows['location_id'];
		//echo $sql;
		$nu = $db->query( $sql )->fetchColumn();
		
		$xtpl->assign( 'title', $rows['title'] );
		$xtpl->assign( 'num', 0 );
		$xtpl->assign( 'cuid', $rows['location_id'] );
		$xtpl->assign( 'parentid', $rows['parentid'] );
		$xtpl->assign( 'link_cu', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=location' . '&amp;cuid=' . $rows['location_id'] );
		$xtpl->assign( 'editlink', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=location' . '&amp;cuid=' . $rows['location_id'] );
		$xtpl->assign( 'nu', $nu );
		for($i=1;$i <2;++$i)
		{
			$xtpl->assign( 'stt', $i );
		}
		for( $i = 1; $i <= $num; ++$i )
		{
			$xtpl->assign( 'stt', $i );
			if( $i == $rows['weight'] )
			{
				$xtpl->assign( 'select', 'selected="selected"' );
			}
			else
			{
				$xtpl->assign( 'select', '' );
			}
			$xtpl->parse( 'main.data.loop.loop1' );
		}
		$i=0;
		foreach($array_status as $status)
		{
			++$i;
			$xtpl->assign( 'key', $status[0]);
			$xtpl->assign( 'value', $status[1] );
			if( $status[0] == $rows['status'] )
			{
				$xtpl->assign( 'sel', 'selected="selected"' );
			}
			else
			{
				$xtpl->assign( 'sel', '' );
			}
			
			$xtpl->parse( 'main.data.loop.loop2' );
		}

		$xtpl->parse( 'main.data.loop' );
	}

	$xtpl->parse( 'main.data' );
}
if( !empty( $error ) )
{
	$xtpl->assign( 'ERROR', $error );
	$xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';


?>