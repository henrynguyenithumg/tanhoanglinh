<?php
/**
 * Tân Hoàng Linh.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  TanHoangLinh
 * @license GPL-2.0+
 * @link    #
 */

?>
<h3><?php esc_html_e( 'Blog Page', 'genesis' ); ?></h3>
<p>
	<?php esc_html_e( 'This works with the Blog Template, which is a page template that shows your latest posts. It\'s what people see when they land on your homepage.', 'genesis' ); ?>
</p>
<p>
	<?php esc_html_e( 'In the General Settings you can select a specific category to display from the drop down menu, and exclude categories by ID, or even select how many posts you\'d like to display on this page.', 'genesis' ); ?>
</p>
<p>
	<?php esc_html_e( 'There are some special features of the Blog Template that allow you to specify which category to show on each page using the template, which is helpful if you have a "News" category (or something else) that you want to display separately.', 'genesis' ); ?>
</p>
<p>
	<?php
	/* translators: Open and close anchor tags. */
	printf( esc_html__( 'You can find more on this feature in the %sHow to Add a Post Category Page tutorial.%s', 'genesis' ), '<a href="http://www.studiopress.com/tutorials/genesis/add-post-category-page" target="_blank">', '</a>' );
	?>
</p>
