=== Maximum Number of Comments ===
Contributors: zelopes
Tags: comments
Requires at least: 
Tested up to: 2.7
Stable tag: trunk

Sets the maximum number of comments allowed to display in each post. Provides a link to show the remaining comments.

== Description ==

This plugin enables the setting of a maximum number of comments allowed to display
in each post. In addition, it provides a link to expand the comments showing all the remaining ones.

All the comments above the defined maximum number are hidden.
By clicking on the link 'Click here to see the remaining comments' they will be shown.

On the <b>Plugin homepage</b> you will find these description and instructions:

- in <a href="http://www.bombolom.com/weblog_en/wordpress/PluginMaximumNumberComments-2007-10-27-12-05.html">English</a>
- in <a href="http://www.bombolom.com/weblog_pt/wordpress/PluginMaximumNumberComments-2007-10-27-12-05.html">Portuguese</a>


== Installation ==

1. Decompress the files to the <i>/wp-content/plugins/</i> directory.
2. Confirm that the plugin content is on the directory <i>maximum-number-of-comments</i>.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Edit the comments.php file of your theme.
4. Delete the comment block starting with &lt;?php if ($comments) : ?&gt; and ending with &lt;?php endif; ?&gt;.
5. Write in its place &lt;?php  MaximumComments(2, $comments, $oddcomment) ?&gt;, were:

	1. the number 2 represents the maximum number of comments displayed (can be any value).
	2. the constant $comments should not be changed.
	3. for the constant $oddcomment, if it doesn't appear previouly on the comments.php file just write 'alt' instead.


== Internationalization ==

This Plugin has English as the default language but you may find the POT file
available with this distribution to create your own language version.

Also in this distribution you have the language versions:

- Portuguese (Portugal)
- French (France)

== Credits ==

Copyright 2007 Jose Lopes

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
