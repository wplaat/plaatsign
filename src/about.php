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
**  All copyrights reserved (c) 1996-2018 PlaatSoft
*/

/*
** ------------------
** UI
** ------------------
*/

function plaatsign_about_form() {

	/* output */
	global $page;
	global $title;
	
	$title = strtoupper(t('LINK_HELP')).' - '.t('ABOUT_TITLE');
	
	$page .= '<div id="content">';	
 	$page .= '<h1>'.$title.'</h1>';			
	$page .= t('ABOUT_CONTENT');	
	$page .= '</div>';
	
	$page .= '<div id="column">';
   $page .= '<img class="imgr" src="images/help.svg" width="256" height="256" alt="" />';
	$page .= '</div>';
}

/*
** ------------------
** HANDLER
** ------------------
*/

function plaatsign_about() {

	/* input */
	global $sid;
		
	switch ($sid) {

		case PAGE_ABOUT: 
					plaatsign_about_form();
					break;
	}
}

/*
** ------------------
** The End
** ------------------
*/

