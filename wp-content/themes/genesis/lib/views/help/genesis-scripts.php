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
<h3><?php esc_html_e( 'Header and Footer Scripts', 'genesis' ); ?></h3>
<p>
	<?php
	/* translators: Escaped HTML head and body tags. */
	printf( esc_html__( 'This provides you with two fields that will output to the %1$s element of your site and just before the %2$s tag. These will appear on every page of the site and are a great way to add analytic code and other scripts. You cannot use PHP in these fields. If you need to use PHP then you should look into the Genesis Simple Hooks plugin.', 'genesis' ), '<code>&lt;head&gt;</code>', '<code>&lt;/body&gt;</code>' );
	?>
</p>