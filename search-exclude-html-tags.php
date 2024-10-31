<?php
/*
Plugin Name: Search Exclude HTML Tags
Plugin URI: http://superann.com/search-exclude-html-tags/
Description: Makes the built-in search ignore HTML tags in post content.
Version: 1.0
Author: Ann Oyama
Author URI: http://superann.com
License: GPL2

MySQL function fnStripTags found on various websites and attributed to
Robert Davis is included in this plugin.

Copyright 2011 Ann Oyama  (email : wordpress [at] superann.com)

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
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function super_search_exclude_activate() {
	$striptags = "CREATE FUNCTION fnStripTags( Dirty longtext )
	RETURNS longtext
	DETERMINISTIC 
	BEGIN
	  DECLARE iStart, iEnd, iLength int;
		WHILE Locate( '<', Dirty ) > 0 And Locate( '>', Dirty, Locate( '<', Dirty )) > 0 DO
		  BEGIN
			SET iStart = Locate( '<', Dirty ), iEnd = Locate( '>', Dirty, Locate('<', Dirty ));
			SET iLength = ( iEnd - iStart) + 1;
			IF iLength > 0 THEN
			  BEGIN
				SET Dirty = Insert( Dirty, iStart, iLength, '');
			  END;
			END IF;
		  END;
		END WHILE;
		RETURN Dirty;
	END;";
	global $wpdb;
	$wpdb->query("DROP FUNCTION IF EXISTS fnStripTags");
	$wpdb->query($striptags);
}
register_activation_hook(__FILE__, 'super_search_exclude_activate');

function super_search_exclude_deactivate() {
	global $wpdb;
	$wpdb->query("DROP FUNCTION IF EXISTS fnStripTags");
}
register_deactivation_hook(__FILE__, 'super_search_exclude_deactivate');

function super_search_exclude_posts_search($search) {
	if(is_search()) {
		global $wpdb;
		if(stripos($search, 'post_content LIKE')) {
			$search = str_replace("{$wpdb->posts}.post_content LIKE", "fnStripTags({$wpdb->posts}.post_content) LIKE", $search);
		}
	}
	return $search;
}
add_filter('posts_search', 'super_search_exclude_posts_search');
?>