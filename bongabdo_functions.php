<?php
/*  Copyright 2008-2009  Sajid Muhaimin Choudhury (email : smc@ieee.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


//taken from bongabdo core
/* BEGIN DATE TIME FUNCTIONS */


function bongabdo_dateFromPost($old_date, $format ='', $before = '', $after = '') {
	global $post;
//	if ($format == '') $format = 'd/m/Y'; 

$indate = mysql2date('d/m/Y',$post->post_date);
return $before  . bongabdo($indate) .$after;
	//return bongabdo_strftime(($format), mysql2date('U',$post->post_date), $old_date, $before, $after);
}

function bongabdo_dateModifiedFromPost($old_date, $format ='') {
	global $post;
	$indate = mysql2date('d/m/Y',$post->post_date);
	return $before  . bongabdo($indate) .$after;

//	return bongabdo_strftime(($format), mysql2date('U',$post->post_modified), $old_date);
}

function bongabdo_timeFromPost($old_date, $format = '', $post = null, $gmt = false) {
	$post = get_post($post);
	$post_date = $gmt? $post->post_date_gmt : $post->post_date;
	$post_date = mysql2date('G:i:s', $post_date );
	return $before  . number2bengunicode($post_date) .$after;

	
}

function bongabdo_timeModifiedFromPost($old_date, $format = '', $gmt = false) {
	global $post;
	$post_date = $gmt? $post->post_modified_gmt : $post->post_modified;
	$post_date = mysql2date('G:i:s', $post_date );
	return $before  . number2bengunicode($post_date) .$after;
}

function bongabdo_dateFromComment($old_date, $format ='') {
	global $comment;
	$indate = mysql2date('d/m/Y',$post->post_date);
	return $before  . bongabdo($indate) .$after;
}

function bongabdo_timeFromComment($old_date, $format = '', $gmt = false, $translate = true) {
	if(!$translate) return $old_date;
	//if ($format == '') $format = 'G:i:s';
	global $comment;
	$comment_date = $gmt? $comment->comment_date_gmt : $comment->comment_date;
	$comment_date = mysql2date('G:i:s', $comment_date);
	return $before  . number2bengunicode($comment_date) . $after;
	
	//return bongabdo_strftime(($format), mysql2date('U',$comment_date), $old_date);
}

/* END DATE TIME FUNCTIONS */


//taken from bongabdo utils
function bongabdo_convertFormat($format, $default_format) {
	global $q_config;
	// check for multilang formats
	//$format = bongabdo_useCurrentLanguageIfNotFoundUseDefaultLanguage($format);
	//$default_format = bongabdo_useCurrentLanguageIfNotFoundUseDefaultLanguage($default_format);
	switch($q_config['use_strftime']) {
		case QT_DATE:
			if($format=='') $format = $default_format;
			return bongabdo_convertDateFormatToStrftimeFormat($format);
		case QT_DATE_OVERRIDE:
			return bongabdo_convertDateFormatToStrftimeFormat($default_format);
		case QT_STRFTIME:
			return $format;
		case QT_STRFTIME_OVERRIDE:
			return $default_format;
	}
}

function bongabdo_convertDateFormat($format) {
	global $q_config;
	if(isset($q_config['date_format'][$q_config['language']])) {
		$default_format = $q_config['date_format'][$q_config['language']];
	} elseif(isset($q_config['date_format'][$q_config['default_language']])) {
		$default_format = $q_config['date_format'][$q_config['default_language']];
	} else {
		$default_format = '';
	}
	return bongabdo_convertFormat($format, $default_format);
}

function bongabdo_convertTimeFormat($format) {
	global $q_config;
	if(isset($q_config['time_format'][$q_config['language']])) {
		$default_format = $q_config['time_format'][$q_config['language']];
	} elseif(isset($q_config['time_format'][$q_config['default_language']])) {
		$default_format = $q_config['time_format'][$q_config['default_language']];
	} else {
		$default_format = '';
	}
	return bongabdo_convertFormat($format, $default_format);
}

function bongabdo_formatCommentDateTime($format) {
	global $comment;
	return bongabdo_strftime(bongabdo_convertFormat($format, $format), mysql2date('U',$comment->comment_date), '', $before, $after);
}

function bongabdo_formatPostDateTime($format) {
	global $post;
	return bongabdo_strftime(bongabdo_convertFormat($format, $format), mysql2date('U',$post->post_date), '', $before, $after);
}

function bongabdo_formatPostModifiedDateTime($format) {
	global $post;
	return bongabdo_strftime(bongabdo_convertFormat($format, $format), mysql2date('U',$post->post_modified), '', $before, $after);
}


?>