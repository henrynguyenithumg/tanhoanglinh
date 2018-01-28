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

add_action( 'after_setup_theme', 'genesis_add_admin_menu' );
/**
 * Add Genesis top-level item in admin menu.
 *
 * Calls the `genesis_admin_menu hook` at the end - all submenu items should be attached to that hook to ensure
 * correct ordering.
 *
 * @since 0.2.0
 *
 * @global \Genesis_Admin_Settings _genesis_admin_settings          Theme Settings page object.
 * @global string                  _genesis_theme_settings_pagehook Old backwards-compatible pagehook.
 *
 * @return void Return early if not viewing WP admin, Genesis menu is disabled, or disabled for current user.
 */
function genesis_add_admin_menu() {

	if ( ! is_admin() ) {
		return;
	}

	global $_genesis_admin_settings;

	if ( ! current_theme_supports( 'genesis-admin-menu' ) ) {
		return;
	}

	// Don't add menu item if disabled for current user.
	$user = wp_get_current_user();
	if ( ! get_the_author_meta( 'genesis_admin_menu', $user->ID ) ) {
		return;
	}

	$_genesis_admin_settings = new Genesis_Admin_Settings;

	// Set the old global pagehook var for backward compatibility.
	global $_genesis_theme_settings_pagehook;
	$_genesis_theme_settings_pagehook = $_genesis_admin_settings->pagehook;

	do_action( 'genesis_admin_menu' );

}

add_action( 'genesis_admin_menu', 'genesis_add_admin_submenus' );
/**
 * Add submenu items under Genesis item in admin menu.
 *
 * @since 0.2.0
 *
 * @see Genesis_Admin_SEO_Settings SEO Settings class
 * @see Genesis_Admin_Import_export Import / Export class
 *
 * @global string $_genesis_seo_settings_pagehook Old backwards-compatible pagehook.
 * @global string $_genesis_admin_seo_settings
 * @global string $_genesis_admin_import_export
 *
 * @return void Return early if not viewing WP admin, or if Genesis menu is not supported.
 */
function genesis_add_admin_submenus() {

	if ( ! is_admin() ) {
		return;
	}

	global $_genesis_admin_seo_settings, $_genesis_admin_import_export;

	// Don't add submenu items if Genesis menu is disabled.
	if( ! current_theme_supports( 'genesis-admin-menu' ) ) {
		return;
	}

	$user = wp_get_current_user();

	// Add "SEO Settings" submenu item.
	if ( current_theme_supports( 'genesis-seo-settings-menu' ) && get_the_author_meta( 'genesis_seo_settings_menu', $user->ID ) ) {
		$_genesis_admin_seo_settings = new Genesis_Admin_SEO_Settings;

		// set the old global pagehook var for backward compatibility.
		global $_genesis_seo_settings_pagehook;
		$_genesis_seo_settings_pagehook = $_genesis_admin_seo_settings->pagehook;
	}

	// Add "Import/Export" submenu item.
	if ( current_theme_supports( 'genesis-import-export-menu' ) && get_the_author_meta( 'genesis_import_export_menu', $user->ID ) ) {
		$_genesis_admin_import_export = new Genesis_Admin_Import_Export;
	}

	// Add the upgraded page (no menu).
	new Genesis_Admin_Upgraded;

}

add_action( 'admin_menu', 'genesis_add_cpt_archive_page', 5 );
/**
 * Add archive settings page to relevant custom post type registrations.
 *
 * An instance of `Genesis_Admin_CPT_Archive_Settings` is instantiated for each relevant CPT, assigned to an individual
 * global variable.
 *
 * @since 2.0.0
 */
function genesis_add_cpt_archive_page() {
	$post_types = genesis_get_cpt_archive_types();

	foreach( $post_types as $post_type ) {
		if ( genesis_has_post_type_archive_support( $post_type->name ) ) {
			$admin_object_name = '_genesis_admin_cpt_archives_' . $post_type->name;
			global ${$admin_object_name};
			${$admin_object_name} = new Genesis_Admin_CPT_Archive_Settings( $post_type );
		}
	}
}
