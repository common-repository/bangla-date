<?php
/*
Plugin Name: Bangla Date (bongabdo)
Plugin URI: http://www.sajidmc.net/en/2009/03/bongabdo/
Description: Convert English Dates to Bangla Dates. Call the function bongabdo($indate)
 any where in your template to return the Bangla Date. $indate can be left blank. Otherwise
 it must be a date in the format of php 'd-M-Y' (DD-MM-YYYY)
Version: 1.2
Author: Sajid Muhaimin Choudhury
Author URI: http://www.sajidmc.net/
License: GNU GPL
*/
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

$beng_date_options['use bangla'] = 0; //set 0 to autodetect language

$beng_month_name[1]['bd'] 		= "বৈশাখ";
$beng_month_name[2]['bd'] 		= "জ্যৈষ্ঠ";
$beng_month_name[3]['bd'] 		= "আষাঢ়";
$beng_month_name[4]['bd'] 		= "শ্রাবণ";
$beng_month_name[5]['bd'] 		= "ভাদ্র";
$beng_month_name[6]['bd'] 		= "আশ্বিন";
$beng_month_name[7]['bd'] 		= "কার্তিক";
$beng_month_name[8]['bd'] 		= "অগ্রহায়ন";
$beng_month_name[9]['bd'] 		= "পৌষ";
$beng_month_name[10]['bd'] 		= "মাঘ";
$beng_month_name[11]['bd'] 		= "ফাল্গুন";
$beng_month_name[12]['bd'] 		= "চৈত্র";
$beng_month_name[1]['en'] 		= "Boishakh";
$beng_month_name[2]['en'] 		= "Joishtho";
$beng_month_name[3]['en'] 		= "Ashar";
$beng_month_name[4]['en'] 		= "Srabon";
$beng_month_name[5]['en'] 		= "Bhadro";
$beng_month_name[6]['en'] 		= "Ashin";
$beng_month_name[7]['en'] 		= "Kartrik";
$beng_month_name[8]['en'] 		= "Agrohayon";
$beng_month_name[9]['en'] 		= "Poush";
$beng_month_name[10]['en'] 		= "Magh";
$beng_month_name[11]['en'] 		= "Falgun";
$beng_month_name[12]['en'] 		= "Chaitro";


require_once(dirname(__FILE__)."/bongabdo_core.php");
require_once(dirname(__FILE__)."/bongabdo_functions.php");
require_once(dirname(__FILE__)."/bongabdo_hooks.php");

add_action('wp_head',						'bongabdo_header');
 ?>