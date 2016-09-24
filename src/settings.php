<?php

/* 
**  ==========
**  plaatsign
**  ==========
**
**  Created by wplaat
**
**  For more information visit the following website.
**  Website : www.plaatsoft.nl 
**
**  Or send an email to the following address.
**  Email   : info@plaatsoft.nl
**
**  All copyrights reserved (c) 2008-2016 PlaatSoft
*/

/*
** ------------------
** POST PARAMETERS
** ------------------
*/

$timer = plaatsign_post("timer", "5");

/*
** ------------------
** ACTIONS
** ------------------
*/

function plaatsign_settings_save_do() {
	
	/* input */
	global $user;
	global $timer;
		
	$data = plaatsign_db_config("slide_show_delay");
	
	if ($data->id>0) {
						
		$data->value = $timer;			
		plaatsign_db_config_update($data);	

		plaatsign_ui_box('info', t('SETTING_UPDATED'));
		plaatsign_info($user->name.' ['.$user->uid.'] update settings');		
	}
}

/*
** ------------------
** UI
** ------------------
*/

function plaatsign_settings_form() {

	/* output */
	global $mid;
	global $sid;
	
	global $page;
	global $title;
	
	$data = plaatsign_db_config("slide_show_delay");
	
	$title = t('SETTINGS_TITLE');
	
	$page .= '<div id="detail">';
	
 	$page .= '<h1>'.$title.'</h1>';
			
	$page .= t('SETTINGS_CONTENT');
	
	$page .= '<fieldset>' ;
	$page .= '<legend>'.t('USER_GENERAL').'</legend>';
	
	$page .= '<p>';
	$page .= '<label>'.t('SLIDE_SHOW_DELAY').'</label>';
	$page .= plaatsign_ui_input("timer", 5, 5, $data->value);
	$page .= '  '.t('SLIDE_SECONDS');
	$page .= '</p>';
	
	$page .= '</fieldset>' ;
	
	$page .= plaatsign_link('mid='.$mid.'&sid='.$sid.'&eid='.EVENT_SAVE, t('LINK_SAVE'));	
	$page .= '</div>';
}

/*
** ------------------
** HANDLER
** ------------------
*/

function plaatsign_settings() {

	/* input */
	global $sid;
	global $eid;
	
	/* Event handler */
	switch ($eid) {
		
		case EVENT_SAVE: 
					plaatsign_settings_save_do();
					break;
	}
		
	switch ($sid) {

		case PAGE_SETTINGS: 
					plaatsign_settings_form();
					break;
	}
}

/*
** ------------------
** The End
** ------------------
*/
