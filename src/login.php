<?php

/* 
**  ==========
**  PlaatSign
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
**  All copyrights reserved (c) 1996-2018 PlaatSoft
*/


/*
** ------------------
** POST PARAMETERS
** ------------------
*/

$name = plaatsign_post("name", "");
$email = plaatsign_post("email", "");
$username = plaatsign_post("username", "");
$password  = plaatsign_post("password", "");

/*
** ------------------
** ACTIONS
** ------------------
*/
	
function plaatsign_login_do() {

	/* input */
   global $username;
	global $password;
	
	/* output */
	global $mid;
	global $sid;	
	global $user;
	global $session;
	global $page;
					
	$uid = plaatsign_db_user_id($username, $password);	
	
	if ($uid == 0) {
	
		plaatsign_ui_box('warning', t('LOGIN_FAILED'));
		plaatsign_info("Login [".$username."] failed!");
	
	} else { 
		
		$session = plaatsign_db_session_add($uid);
		$user = plaatsign_db_user($uid);

		/* Redirect to home page. */
		$mid = MENU_HOME;			
		$sid = PAGE_HOME;	
		$page = "";
		
		plaatsign_info('Login '.$user->name.' ['.$user->uid.']');
	} 
}

function plaatsign_logout_do() {

	/* output */
	global $session;
	global $user;
	global $access;
	
	if (isset($user->uid)) {
	
		plaatsign_info('Logout '.$user->name.' ['.$user->uid.']');
		plaatsign_ui_box('info', t('LOGIN_LOGOUT'));
	
		plaatsign_db_session_delete($session);
	
		/* Destroy user and access information */
		$user="";
		$access="";
	}
}


/*
** ------------------
** UI
** ------------------
*/

function plaatsign_login_footer() {

	$page  = '<br class="clear" />';
		
	$page .= '<div id="footer">';
   	 
   $page .= '<br class="clear"/>';
	$page .= '</div>';
	
	return $page;
}

function plaatsign_login_form() {

	/* input */
	global $mid;
	
	/* output */
	global $page;
		
   $page .= '<div id="content">';
	
	$page .= '<h1>'.t('LOGIN_WELCOME_TITLE').'</h1>';
	$page .= '<img class="imgl" src="images/plaatsign256.png" widht="220" height="220" alt="" />';
	$page .= t('LOGIN_WELCOME');	
	$page .= '</div>'; 
		
	$page .= '<div id="column">';
   $page .= '<div class="subnav">';
   $page .= '<h2>'.t('LOGIN_TITLE').'</h2>';
		  	
	$page .= '<p>';
	$page .= '<label>'.t('GENERAL_USERNAME').':</label>';
	$page .= '<input type="text" name="username" id="username" value=""/>';
	$page .= '</p>';
	
	$page .= '<p>';
	$page .= '<label>'.t('GENERAL_PASSWORD').':</label>';
	$page .= '<input type="password" name="password" id="password" value=""/>';
	$page .= '</p>';
	
	$page .= plaatsign_link('mid='.$mid.'&eid='.EVENT_LOGIN, t('LINK_LOGIN'));
			
	$page .= '</div>';
	$page .= '</div>';	
	
	$page .= '<br class="clear" /><div id="footer"><h1>SCREENSHOTS</h1>';
	$page .= '<div class="footbox"><img  src="images/screenshot1.png" style="border:1px;border-style:solid;border-color:lightgray;" />';
	$page .= '<p><b>Content Editor</b></p></div>';
	$page .= '<div class="footbox"><img  src="images/screenshot2.png" style="border:1px;border-style:solid;border-color:lightgray;"/>';
	$page .= '<p><b>Content Preview</b></p></div>';
	$page .= '<div class="footbox"><img  src="images/screenshot3.png" style="border:1px;border-style:solid;border-color:lightgray;"/>';
	$page .= '<p><b>Weather Forecast</b></p></div>';
	$page .= '<div class="footbox"><img  src="images/screenshot4.png" style="border:1px;border-style:solid;border-color:lightgray;"/>';
	$page .= '<p><b>PlaatEnergy Data</b></p></div>';
	$page .= '<div class="footbox last"><img  src="images/screenshot5.png" style="border:1px;border-style:solid;border-color:lightgray;"/>';
	$page .= '<p><b>Latest News</b></p></div>';
		
	$page .= plaatsign_login_footer();
		
	return $page;	
}
    
/*
** ------------------
** HANDLER
** ------------------
*/

function plaatsign_login() {

	/* input */
	global $eid;
	global $sid;
		
	/* Event handler */
	switch ($eid) {
	
		case EVENT_LOGIN: 	
					plaatsign_login_do();	
					break;
					
		case EVENT_LOGOUT: 	
					plaatsign_logout_do();
					break;
	}
	
	/* Page handler */
	switch ($sid) {
			
		default:
		case PAGE_LOGIN: 
					plaatsign_login_form();	
				   break;
								
		case PAGE_HOME:
					plaatsign_home_form();	
					break;
			
	}
}

/*
** ------------------
** The End
** ------------------
*/
