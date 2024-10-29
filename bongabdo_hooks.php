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

add_filter('get_comment_date',				'bongabdo_dateFromComment',0,2);
add_filter('get_comment_time',				'bongabdo_timeFromComment',0,4);
add_filter('get_post_modified_time',		'bongabdo_timeModifiedFromPost',0,3);
add_filter('get_the_time',					'bongabdo_timeFromPost',0,3);
add_filter('get_the_date',					'bongabdo_dateFromPost',0,4);

function bongabdo_header() {
echo '<!--Bongabdo -->';
}
?>