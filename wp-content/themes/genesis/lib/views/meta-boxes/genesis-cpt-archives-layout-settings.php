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

$layout = $this->get_field_value( 'layout' );
?>
<table class="form-table">
<tbody>
	<?php if ( $this->layout_enabled ) : ?>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Select Layout', 'genesis' ); ?></th>
		<td>
			<fieldset class="genesis-layout-selector">
				<legend class="screen-reader-text"><?php esc_html_e( 'Layout Settings', 'genesis' ); ?></legend>

				<p><input type="radio" class="default-layout" name="<?php $this->field_name( 'layout' ); ?>" id="default-layout" value="" <?php checked( $layout, '' ); ?> />
					<label class="default" for="default-layout">
					<?php
					/* translators: Open and close link tags to theme settings. */
					printf( esc_html__( 'Default Layout set in %sTheme Settings%s', 'genesis' ), '<a href="' . menu_page_url( 'genesis', 0 ) . '">', '</a>' );
					?>
					</label>
				</p>
				<?php
				genesis_layout_selector( array(
					'name'     => $this->get_field_name( 'layout' ),
					'selected' => $layout,
					'type'     => array( 'archive', 'post-type-archive-' . $this->post_type->name ),
				) );
				?>

			</fieldset>
		</td>
	</tr>
	<?php endif; ?>

	<tr valign="top">
		<th scope="row"><label for="<?php $this->field_id( 'body_class' ); ?>"><b><?php esc_html_e( 'Custom Body Class', 'genesis' ); ?></b></label></th>
		<td>
			<p><input class="large-text" type="text" name="<?php $this->field_name( 'body_class' ); ?>" id="<?php $this->field_id( 'body_class' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'body_class' ) ); ?>" /></p>
		</td>
	</tr>

</tbody>
</table>
