<?php
/**
 * Tân Hoàng Linh.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Admin
 * @author  TanHoangLinh
 * @license GPL-2.0+
 * @link    #
 */

/**
 * Handle for Genesis_Admin_Meta_Boxes class.
 *
 * @since 2.5.0
 */
function genesis_meta_boxes() {

	static $meta_boxes = null;

	if ( null === $meta_boxes ) {
		require_once( PARENT_DIR . '/lib/classes/class-genesis-admin-meta-boxes.php' );
		$meta_boxes = new Genesis_Admin_Meta_Boxes();
	}

	return $meta_boxes;

}
