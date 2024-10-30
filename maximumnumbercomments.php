<?php
/*
Plugin Name: Maximum Number of Comments
Plugin URI: http://www.bombolom.com/weblog_en/wordpress/PluginMaximumNumberComments-2007-10-27-12-05.html
Description: Show all comments until the defined maximum number, with an option link to show the remaining.
Version: 1.0
Author: José Lopes
Author URI: http://www.bombolom.com/
*/


/*

This plugin enables the setting of a maximum number of comments allowed to display
in each post. In addition it provides a link to show all the remaining comments.

*/


/*	Copyright 2007 Jose Lopes (email: jose.lopes@paxjulia.com)

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
if(function_exists('load_plugin_textdomain'))
	load_plugin_textdomain('maximumnumbercomments','wp-content/plugins/maximum-number-of-comments');

function getCommentDate( $d = '' , $comment='') {
	if ( '' == $d )
		$date = mysql2date( get_option('date_format'), $comment);
	else
		$date = mysql2date($d, $comment);
	return apply_filters('get_comment_date', $date, $d);
}

function getCommentTime( $comment1='', $comment2='', $d = '', $gmt = false ) {
	$comment_date = $gmt? $comment1 : $comment2;
	if ( '' == $d )
		$date = mysql2date(get_option('time_format'), $comment_date);
	else
		$date = mysql2date($d, $comment_date);
	return apply_filters('get_comment_time', $date, $d, $gmt);
}

function MaximumComments ($max_comm = 2, $comments, $oddcomment= 'alt') {
	
	// Text for internacionalization //

	$linkMoreComments = __("Click here to see the remaining comments", "maximumnumbercomments");
	$commentBy = __("Comment by", "maximumnumbercomments");
	$commentDate = __("at", "maximumnumbercomments");
	$waitingModeration = __("Your comment is waiting moderation", "maximumnumbercomments");
	

	// Constants //
	$comm_id= 1; 
	$block_hide= 1;
	$close_div = "";
	$javascript = '<script type="text/javascript"> 
		var currLayerId2 = "yes_show"; 

		function togLayer2(id) 
		{ 
		if(currLayerId2) setDisplay2(currLayerId2, "none"); 
		if(id)setDisplay2(id, "block"); 
		currLayerId2 = id; 
		}

		function setDisplay2(id,value) 
		{ 
		var elm = document.getElementById(id); 
		elm.style.display = value; 
		}

	</script>';
	
	if ($comments) {
		echo '<ol>';
		echo $javascript;
		
		foreach ($comments as $comment) {
			if ($$comm_id>=$max_comm && $block_hide==1){
				$close_div = '</div>';
				echo '<div id="yes_show" style="display: block;">';
				echo "<a href=\"#\" style=\"text-decoration:none\" onclick=\"togLayer2('yes_hide');return false;\" title=\"\">";
				echo $linkMoreComments, '</a>
					</div>
					<div id="yes_hide" style="display: none;">';
				$block_hide++;
			}
		
			$$comm_id++;

			echo '<li class=';
			echo $oddcomment; 
			echo ' id=comment-', $comment->comment_ID, '">';
			echo $commentBy, ' <strong><a href="', $comment->comment_author_url, '">', $comment->comment_author, '</a></strong>';
			echo ', ', getCommentDate('d-m-Y', $comment->comment_date);
			echo '&nbsp;', $commentDate, '&nbsp;', getCommentTime($comment->comment_date_gmt, $comment->comment_date, 'H:i');

			if ($comment->comment_approved == '0') {
				echo '<p><em>', $waitingModeration, '.</em></p>';
			}
			
			echo '<p>', $comment->comment_content, '</p>';

			echo '</li>';


	/* Changes every other comment to a different class */
			if ('alt' == $oddcomment) $oddcomment = '';
			else $oddcomment = 'alt';

		} // end for each comment //

		echo $close_div;
		echo '</ol>';

	}
// this is displayed if there are no comments so far
 else {
	// If comments are open, but there are no comments. //
	if ('open' == $post->comment_status) { echo ''; }
		
	// If comments are closed. //
	 else { echo '<p class="nocomments"></p>';}

	}
}
?>
