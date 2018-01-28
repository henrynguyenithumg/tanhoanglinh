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

wp_nonce_field( 'genesis_inpost_layout_save', 'genesis_inpost_layout_nonce' );
?>
<table class="form-table">
<tbody>

<?php
if ( genesis_has_multiple_layouts() ) :
	$layout = genesis_get_custom_field( '_genesis_layout' );
?>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Select Layout', 'genesis' ); ?></th>
		<td>
			<fieldset class="genesis-layout-selector">
				<legend class="screen-reader-text"><?php esc_html_e( 'Layout Settings', 'genesis' ); ?></legend>

				<p><input type="radio" name="genesis_layout[_genesis_layout]" class="default-layout" id="default-layout" value="" <?php checked( $layout, '' ); ?> /> <label class="default" for="default-layout">
					<?php
					/* translators: Theme settings admin screen link */
					printf( esc_html__( 'Default Layout set in %s', 'genesis' ), '<a href="' . esc_url( menu_page_url( 'genesis', 0 ) ) . '">' . esc_html__( 'Theme Settings', 'genesis' ) . '</a>' );
					?>
				</label></p>
				<?php
				genesis_layout_selector( array(
					'name'     => 'genesis_layout[_genesis_layout]',
					'selected' => $layout,
					'type'     => array( 'singular', get_post_type(), get_the_ID() ),
				) );
				?>

			</fieldset>
		</td>
	</tr>
<?php endif; ?>

	<tr valign="top">
		<th scope="row"><label for="genesis_custom_body_class"><?php esc_html_e( 'Custom Body Class', 'genesis' ); ?></label></th>
		<td><p><input class="large-text" type="text" name="genesis_layout[_genesis_custom_body_class]" id="genesis_custom_body_class" value="<?php echo esc_attr( genesis_get_custom_field( '_genesis_custom_body_class' ) ); ?>" /></p></td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="genesis_custom_post_class"><?php esc_html_e( 'Custom Post Class', 'genesis' ); ?></label></th>
		<td><p><input class="large-text" type="text" name="genesis_layout[_genesis_custom_post_class]" id="genesis_custom_post_class" value="<?php echo esc_attr( genesis_get_custom_field( '_genesis_custom_post_class' ) ); ?>" /></p></td>
	</tr>

</tbody>
</table>
