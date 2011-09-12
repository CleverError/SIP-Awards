<?php
	if(file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF')) {
		require_once(dirname(__FILE__) . '/SSI.php');
		db_extend('packages');
	}
	else if(!defined('SMF')) {
		die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php and SSI.php files.');
	}
	
	if((SMF == 'SSI') && !$user_info['is_admin']) {
		die('Admin priveleges required.');
	}
		
	######################################################################################
	
	$given_awards_columns[] = array('name' => 'uniq_id', 'type' => 'mediumint', 'size' => 5, 'null' => false, 'auto' => true);
	$given_awards_columns[] = array('name' => 'id_award', 'type' => 'bigint', 'size' => 10, 'null' => false, 'default' => '0');
	$given_awards_columns[] = array('name' => 'id_member', 'type' => 'int', 'size' => 8, 'null' => false, 'default' => '0');
	$given_awards_columns[] = array('name' => 'more_info', 'type' => 'varchar', 'size' => 255, 'null' => false);
	
	$given_awards_indexes[] = array('type' => 'unique', 'columns' => array('id_award', 'id_member'));
	$given_awards_indexes[] = array('type' => 'primary', 'columns' => array('uniq_id'));
	
	$smcFunc['db_create_table']('{db_prefix}awards_given', $awards_members_columns, $awards_members_indexes, array(), 'ignore');
	
	######################################################################################
	
	$awards_columns[] = array('name' => 'id_award', 'type' => 'mediumint', 'size' => 5, 'null' => false, 'auto' => true);
	$awards_columns[] = array('name' => 'award_name', 'type' => 'varchar', 'size' => 80, 'null' => false);
	$awards_columns[] = array('name' => 'description', 'type' => 'varchar', 'size' => 80, 'null' => false);
	$awards_columns[] = array('name' => 'filename', 'type' => 'tinytext', 'null' => false);
	
	$awards_indexes[] = array('type' => 'primary', 'columns' => array('id_award'));
	
	$smcFunc['db_create_table']('{db_prefix}awards', $awards_columns, $awards_indexes, array(), 'ignore');
	
	######################################################################################
	
//	$smcFunc['db_insert']('replace',
//						  '{db_prefix}settings',
//						  array('variable' => 'string', 'value' => 'string'),
//						  array(
//								array('awards_dir', 'awards'),
//								array('awards_favorites', '1'),
//								array('awards_in_post', '1')
//								),
//						  array('variable')
//						  );
	
	if(SMF == 'SSI') {
		echo 'Database changes are complete!';
	}
?>